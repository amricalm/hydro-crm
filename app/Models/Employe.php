<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;


    const CREATED_AT = 'con';
    const UPDATED_AT = 'uon';

    protected $table = "aa_employe";
    protected $fillable = ['nip','name','address','province','city','zip_code','hp','email','facebook','instagram','status','cby','uby'];
}
