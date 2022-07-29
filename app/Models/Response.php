<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;


    const CREATED_AT = 'con';
    const UPDATED_AT = 'uon';

    protected $table = "cr_response";
    protected $fillable = ['id','code','name','category_id','desc','cby','uby'];
}
