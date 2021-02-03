<?php

namespace App\Http\Requests;

use App\Models\Contract;
use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CheckLoginFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "contractNumber" => "required|numeric",
            "id" => "required|numeric"
        ];
    }

    public function withValidator($validator)
    {
        /*
         * test case :
         * contractNumber : 126
         * id : 1138443020
         */
        $validator->after(function ($validator) {
            if (empty($this->validator->invalid())) {
                // all attributes have been validated.
                // check if contractNumber exists and id exists.
                $contract = Contract::where("cid", $this->request->get("contractNumber"))
                    ->where("isDeleted", 0)
                    ->where("isCancelled", 0)
                    ->first();
                if (!$contract) {
                    $validator->errors()->add('contractNumber', "رقم العقد غير موجود");
                    return false;
                }

                // check renter id.
                $customer = $contract->Customer;
                if (!$customer) {
                    $validator->errors()->add('id', "رقم هوية العميل غير موجودة");
                    return false;
                } else {
                    if ($customer->personalId != $this->request->get("id")) {
                        $validator->errors()->add('id', "رقم هوية العميل غير موجودة");
                    }
                }

                $user = $contract->Customer->User;

                session()->put("asaas_customer", $customer);
                session()->put("asaasPropertyId", $contract->propertyId);
                session()->put("asaasContractId", $contract->id);
                session()->put("asaasContract", $contract);

                // all verified, set verification code.

                $this->addVerificationCodeColumn();
                $this->addFilesTable();
                $this->addOtherMobileNumberColumn();

//                $verificationCode = rand(10000, 99999);
                $verificationCode = 12345;
                // test

                $this->sendSMS($customer->mobileNumber,
                    "Your verification code is {$verificationCode}");

                $customer->maintenance_app_verification_code = $verificationCode;

                // send verification code.

                if ($customer->save()) {
                    // send sms message.
                    return true;
                }

            }
        });
    }

    private function addVerificationCodeColumn()
    {
        $schema = Schema::connection('asaas');
        $table = "tbl_customer";
        $column = "maintenance_app_verification_code";
        if (!$schema->hasColumn($table, $column)) {
            $schema->table('tbl_customer', function (Blueprint $table) {
                $table->string("maintenance_app_verification_code")->nullable();
            });
        }
    }

    private function addFilesTable()
    {
        $schema = Schema::connection('maintenance');
        $table = "ticket_files";
        if (!$schema->hasTable($table)) {
            $schema->create($table, function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->integer('ticket_id');
                $table->string('full_path');
                $table->timestamps();
            });
        }
    }

    private function addOtherMobileNumberColumn()
    {
        $schema = Schema::connection('maintenance');
        $table = "maintenance_tickets";
        $column = "otherMobileNumber";
        if (!$schema->hasColumn($table, $column)) {
            $schema->table($table, function (Blueprint $table) use ($column) {
                $table->string($column)->nullable();
            });
        }
    }

    private function sendSMS($recipient, $message)
    {
        $senderAccountUsername = "966554969016";
        $senderAccountPassword = "myasaas2018";
        $senderName = "Nahdi";
        $recipient = "559028465";
        if (strpos($recipient, "966") === false) {
            $recipient = "00966" . $recipient;
        }

        $data = json_encode([
            'Username' => $senderAccountUsername,
            "Password" => $senderAccountPassword,
            "Tagname" => $senderName,
            "RecepientNumber" => $recipient,
            "Message" => $message,
            "SendDateTime" => 0,
            "EnableDR" => False
        ]);


        try {

            $ch = \curl_init();
            curl_setopt($ch, CURLOPT_URL, env('SMS_API_GATEWAY', 'http://api.yamamah.com/SendSMS'));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
            ));

            $server_output = curl_exec($ch);

            curl_close($ch);

            $response = (array)json_decode($server_output);

//            dd($response);

        } catch (\Exception $exception) {

//            dd($exception);

        }
    }


}
