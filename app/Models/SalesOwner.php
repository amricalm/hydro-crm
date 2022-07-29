<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOwner extends Model
{
    use HasFactory;

    const CREATED_AT = 'con';
    const UPDATED_AT = 'uon';

    protected $table = "cr_sales_owner";
    protected $fillable = ['periode','cid','eid','cby','uby'];
}
