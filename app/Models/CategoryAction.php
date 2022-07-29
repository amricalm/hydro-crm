<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryAction extends Model
{
    use HasFactory;

    const CREATED_AT = 'con';
    const UPDATED_AT = 'uon';

    protected $table = "rf_category_action";
    protected $fillable = ['id','name'];
}
