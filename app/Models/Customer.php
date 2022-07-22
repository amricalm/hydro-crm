<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;


    const CREATED_AT = 'con';
    const UPDATED_AT = 'uon';

    protected $table = "aa_customer";
    protected $fillable = ['name','address','province','city','zip_code','hp','email','facebook','instagram','sales_owner','status','cby','uby'];
}
