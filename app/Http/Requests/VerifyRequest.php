<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyRequest extends FormRequest
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
            "contractNumber" => "",
            "id" => "",
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!session()->exists("contractNumber")) {
                $validator->errors()->add('contractNumber', "رقم العقد غير مدخل");
            }
            if (!session()->exists("id")) {
                $validator->errors()->add('id', "رقم هوية العميل غير مدخل");
            }
        });
    }
}
