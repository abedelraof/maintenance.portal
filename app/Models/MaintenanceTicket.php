<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceTicket extends Model
{
    use HasFactory;

    protected $attributes = [
        "property_id" => 0,
        "unit_id" => 0,
        "vendor_id" => 0,
        "renter_id" => 0,
        "category_id" => 0,
        "status_id" => 0,
        "notes" => null,
        "renter_mobile" => null,
        "property_location" => null,
        "property_longitude" => null,
        "property_latitude" => null,
        "image" => null,
        "created_at" => null,
        "updated_at" => null,
        "deleted_at" => null,
        "track" => "applications",
        "track_time" => null,
        "track_location" => null,
        "track_mobile" => null,
        "track_notes" => null,
        "track_date" => null,
        "status" => "application",
        "hasBeenConvertedToExpense" => false,
        "s_id" => 0,
        "labor_value" => null,
        "material_value" => null,
        "send_sms" => null,
        "user_id" => 0,
        "user_name" => null,
        "bill_number" => null,
        "canceled_reason" => null,
    ];


    protected $connection = 'maintenance';

    protected $table = "maintenance_tickets";

    protected $guarded = [];
}
