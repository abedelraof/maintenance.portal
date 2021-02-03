<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $connection = 'asaas';

    protected $table = "tbl_customer";

    public function user()
    {
        return $this->belongsTo(User::class, "id");
    }

}
