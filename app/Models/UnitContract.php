<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitContract extends Model
{
    use HasFactory;

    protected $connection = 'asaas';

    protected $table = "tbl_contract_unit";

}
