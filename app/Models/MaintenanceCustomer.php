<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceCustomer extends Model
{
    use HasFactory;

    protected $attributes = [
        "name" => "",
        "mobile" => "",
        "address" => "",
        "email" => "",
        "username" => "",
        "password" => "",
        "type" => "",
        "personalId" => "",
        "image" => "",
        "asaas_id" => ""
    ];


    protected $connection = 'maintenance';

    protected $table = "customers";

    protected $fillable = [
        "name",
        "mobile",
        "address",
        "email",
        "username",
        "password",
        "type",
        "personalId",
        "image",
        "asaas_id"
    ];

}
