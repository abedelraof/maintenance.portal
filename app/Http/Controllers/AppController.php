<?php

namespace App\Http\Controllers;

use App\File;
use App\Http\Requests\CheckLoginFormRequest;
use App\Http\Requests\CreateTicketRequest;
use App\Http\Requests\VerifyRequest;
use App\Http\Requests\VerifySubmitRequest;
use App\Models\Customer;
use App\Models\MaintenanceCustomer;
use App\Models\MaintenanceFile;
use App\Models\MaintenanceProperty;
use App\Models\MaintenanceTicket;
use App\Models\MaintenanceUnit;
use App\Models\Property;
use App\Models\TicketCategory;
use App\Models\Unit;
use App\Models\UnitContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;
use function PHPUnit\Framework\assertFileIsReadable;

class AppController extends Controller
{

    public function actionListTickets()
    {
        $data = MaintenanceTicket::query()
            ->where("renter_id", session()->get("user")->id)
            ->orderBy("id", "desc")
            ->paginate(15);
        return view("app.tickets_list", [
            "data" => $data
        ]);
    }

    public function actionViewTicket(MaintenanceTicket $model)
    {
        $files = MaintenanceFile::where("ticket_id", $model->id)->get()->map(function ($item) {
            $item->isImage = $this->isImage($item->full_path);
            return $item;
        });
        return view("app.ticket_view", [
            "model" => $model,
            "files" => $files
        ]);
    }


    private function isImage($mediapath)
    {
        $arr = explode(".", $mediapath);
        $fileExtension = strtolower(end($arr));
        $extensions = [
            "png",
            "jpg",
            "jpeg",
            "gif"
        ];
        if (in_array($fileExtension, $extensions)) {
            return true;
        }
        return false;
    }

    public function actionUploadFile(Request $request)
    {
        $file = $request->file('file');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $s3 = \Storage::disk('s3');
        $filePath = '/maintenance.tenant.app/' . $fileName;
        $s3->put($filePath, file_get_contents($file), 'public');

        $filePath = env("AWS_DOMAIN_URL") . $filePath;

        // save file.
        $file = MaintenanceFile::create([
            "name" => $fileName,
            "full_path" => $filePath,
        ]);
        return response($file);
    }

    public function actionCheckLogin()
    {
        return redirect()->route("auth.login");
    }

    public function actionLogout()
    {
        session()->flush();
        return redirect()->route("auth.login");
    }

    public function actionLogin()
    {
        return view("app.login");
    }

    public function actionLoginSubmit(CheckLoginFormRequest $request)
    {
        session()->put("contractNumber", $request->contractNumber);
        session()->put("id", $request->id);
        return redirect()->route("auth.verify");
    }

    public function actionVerify(VerifyRequest $request)
    {
        return view("app.verify");
    }

    public function actionVerifySubmit(VerifySubmitRequest $request)
    {
        session()->forget("contractNumber");
        session()->forget("id");
        session()->put("isAuthenticated", true);
        return redirect()->route("tickets.create");
    }

    public function actionCreateTicket()
    {
        $categories = TicketCategory::all();

        $units = [];
        $property = null;

        $asaasContract = session()->get("asaasContract");


        // sync data between Asaas and Maintenance.

        // sync Customer.
        $asaasCustomer = session()->get("asaas_customer");
        if ($asaasCustomer instanceof Customer) {
            $model = MaintenanceCustomer::updateOrCreate(
                ['asaas_id' => $asaasCustomer->id],
                array_merge(
                    $asaasCustomer->getAttributes(),
                    [
                        "name" => $asaasCustomer->User->real_name,
                        "email" => $asaasCustomer->User->email,
                        "mobile" => $asaasCustomer->mobileNumber,
                        "type" => $asaasCustomer->customer_type
                    ]
                )
            );
            session()->put("user", $model);
            if (!$model) {
                abort(404);
            }
        }

        // sync Property.
        $asaasPropertyId = session()->get("asaasPropertyId");
        if ($asaasPropertyId > 0) {
            $asaasProperty = Property::find($asaasPropertyId);
            if ($asaasProperty instanceof Property) {
                $property = MaintenanceProperty::updateOrCreate(
                    ['asaas_id' => $asaasProperty->id],
                    array_merge(
                        $asaasProperty->getAttributes(),
                        [
                            "title" => $asaasProperty->name . " - " . $asaasProperty->title
                        ]
                    )
                );
                if (!$property) {
                    abort(404);
                }

                // sync Units.
                $asaasContractId = session()->get("asaasContractId");
                if ($asaasContractId > 0) {
                    $relationData = UnitContract::where("contract", $asaasContractId)->select("unit")->distinct()->get();
                    foreach ($relationData as $relation) {
                        if ($relation instanceof UnitContract) {
                            // GET UNIT INFORMATION.
                            $asaasUnit = Unit::find($relation->unit);
                            if ($asaasUnit instanceof Unit) {
                                $unit = MaintenanceUnit::updateOrCreate(
                                    ['asaas_id' => $asaasUnit->id],
                                    [
                                        "number" => $asaasUnit->unitNumber,
                                        "property_id" => $property->id,
                                        "asaas_property_id" => $asaasUnit->property_id,
                                    ]
                                );
                                if (!$unit) {
                                    abort(404);
                                }
                                $units[] = $unit;
                            }

                        }
                    }
                }

            }
        } else {
            abort(404);
        }

        return view("app.create_ticket", [
            "categories" => $categories,
            "units" => $units,
            "property" => $property,
            "asaasContract" => $asaasContract
        ]);

    }

    public function actionStoreTicket(CreateTicketRequest $request)
    {
        try {
            DB::connection("maintenance")->transaction(function () use ($request) {
                $model = MaintenanceTicket::create([
                    "property_id" => $request->get("property_id"),
                    "contract_number" => $request->get("contract_number"),
                    "unit_id" => $request->get("units")[0],
                    "renter_id" => $request->get("customer_id"),
                    "category_id" => $request->get("category"),
                    "notes" => $request->get("description"),
                    "renter_mobile" => $request->get("mobileNumber"),
                    "otherMobileNumber" => $request->get("otherMobileNumber"),
                    "property_longitude" => $request->get("lng"),
                    "property_latitude" => $request->get("lat"),
                ]);

                if ($model) {
                    if (is_array($request->get("files"))) {
                        foreach ($request->get("files") as $id) {
                            $file = MaintenanceFile::find($id);
                            if ($file instanceof MaintenanceFile) {
                                $file->ticket_id = $model->id;
                                $file->save();
                            }
                        }
                    }
                }
            });
        } catch (\Exception $exception) {
            return redirect()->route("tickets.create");
        }
        return redirect()->route("tickets.store.success");
    }

    public function actionStoreSuccess()
    {
        $categories = TicketCategory::all();
        return view("app.create_ticket_success", [
            "categories" => $categories,
        ]);
    }


}
