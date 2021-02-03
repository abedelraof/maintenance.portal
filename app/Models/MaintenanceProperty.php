<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceProperty extends Model
{
    use HasFactory;

    protected $attributes = [
        "title" => "",
        "owner_id" => 0,
    ];


    protected $connection = 'maintenance';

    protected $table = "properties";

    protected $fillable = [
        "title",
        "asaas_id",
        "owner_id",
        "asaas_owner_id",
    ];

}
