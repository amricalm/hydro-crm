<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = "sc_roles";
    protected $primaryKey = 'id';
    protected $fillable = [
        'name','desc'
    ];
}
