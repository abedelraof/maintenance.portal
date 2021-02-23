<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTicketRequest extends FormRequest
{

    public $property_id;
    public $customer_id;
    public $units;
    public $category;
    public $description;
    public $mobileNumber;
    public $otherMobileNumber;
    public $lat;
    public $lng;
    public $files;

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
            "property_id" => "required|numeric",
            "customer_id" => "required|numeric",
            "units" => "required",
            "description" => "required",
            "mobileNumber" => "required|numeric",
            "otherMobileNumber" => "",
            "lat" => "required|numeric",
            "lng" => "required|numeric",
            "files" => "",
            "contract_number" => "",
            "category" => "required|numeric"
        ];
    }
}
