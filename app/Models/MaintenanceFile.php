<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceFile extends Model
{
    use HasFactory;

    protected $attributes = [
        "name" => "",
        "full_path" => "",
        "ticket_id" => 0
    ];


    protected $connection = 'maintenance';

    protected $table = "ticket_files";

    protected $guarded = [];
}
