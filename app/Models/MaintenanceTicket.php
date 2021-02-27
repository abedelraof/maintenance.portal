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

    public function property()
    {
        return $this->belongsTo(MaintenanceProperty::class);
    }

    public function unit()
    {
        return $this->belongsTo(MaintenanceUnit::class);
    }

    public function category()
    {
        return $this->belongsTo(TicketCategory::class);
    }

    public function getPropertyName()
    {
        if ($this->Property) {
            return $this->Property->title;
        }
        return null;
    }

    public function getUnitNumber()
    {
        if ($this->Unit) {
            return $this->Unit->number;
        }
        return null;
    }

    public function getCategoryName()
    {
        if ($this->Category) {
            return $this->Category->name_ar;
        }
        return null;
    }

    public function files()
    {
        return $this->hasMany(MaintenanceFile::class, "ticket_id");
    }

    public function vendor()
    {
        return $this->belongsTo(MaintenanceCustomer::class, "vendor_id");
    }

    public function getVendorName()
    {
        if ($this->vendor) {
            return $this->vendor->name;
        }
        return null;
    }
}
