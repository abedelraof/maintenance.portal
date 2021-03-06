<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $connection = 'asaas';

    protected $table = "tbl_contract";

    public function customer()
    {
        return $this->hasOne(Customer::class, "id", "renter");
    }

}
