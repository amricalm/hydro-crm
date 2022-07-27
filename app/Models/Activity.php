<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;


    const CREATED_AT = 'con';
    const UPDATED_AT = 'uon';

    protected $table = "cr_activity";
    protected $fillable = ['date','customer_id','sales_id','action_id','action_desc','response_id','response_desc','cby','uby'];
}
