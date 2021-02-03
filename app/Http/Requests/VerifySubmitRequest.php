<?php

namespace App\Http\Requests;

use App\Models\Contract;
use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;

class VerifySubmitRequest extends FormRequest
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
            "maintenance_app_verification_code" => "required|numeric",
        ];
    }

    public function withValidator($validator)
    {
        /*
         * test case :
         * contractNumber : 126
         * id : 1138443020
         */
        /*
         * test case :
         * contractNumber : 163
         * id : 2027447347
         */
        $validator->after(function ($validator) {
            if (empty($this->validator->invalid())) {
                // all attributes have been validated.
                // check if contractNumber exists and id exists.
                $contract = Contract::where("cid", session()->get("contractNumber"))
                    ->where("isDeleted", 0)
                    ->where("isCancelled", 0)
                    ->first();
                if (!$contract) {
                    return false;
                }
                // check renter id.
                $customer = Customer::where("personalId", session()->get("id"))
                    ->where("maintenance_app_verification_code", $this->request->get("maintenance_app_verification_code"))
                    ->whereHas("User", function ($q) {
                        $q->where("isDeleted", 0);
                    })
                    ->first();
                if (!$customer) {
                    dd("ss");
                    $validator->errors()->add('id', "رقم التحقق خاطيء");
                    return false;
                }
                // all verified, set verification code.

//                $verificationCode = rand(10000, 99999);
                $verificationCode = 12345;

                $customer->maintenance_app_verification_code = $verificationCode;
                if ($customer->save()) {
                    // send sms message.
                    return true;
                }

            }
        });
    }

}
