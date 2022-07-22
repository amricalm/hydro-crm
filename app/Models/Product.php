<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    const CREATED_AT = 'con';
    const UPDATED_AT = 'uon';

    protected $table = "cr_product";
    protected $fillable = ['code','name','desc','type','cby','uby'];
}
