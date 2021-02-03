<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceUnit extends Model
{
    use HasFactory;

    protected $attributes = [
        "number" => "",
        "asaas_id" => "",
        "property_id" => "",
        "asaas_owner_id" => 0,
        "asaas_property_id" => "",
    ];


    protected $connection = 'maintenance';

    protected $table = "units";

    protected $fillable = [
        "number",
        "asaas_id",
        "property_id",
        "asaas_owner_id",
        "asaas_property_id"
    ];

}
