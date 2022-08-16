<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    use HasFactory;


    const CREATED_AT = 'con';
    const UPDATED_AT = 'uon';

    protected $table = "aa_customer";
    protected $fillable = ['name','address','province','city','zip_code','hp','email','facebook','instagram','sales_owner','status','history','cby','uby'];

    public static function getCustomerName($id='')
    {
        $q = DB::table('cr_sales_owner AS so')
            ->select('cus.id', 'cus.name')
            ->leftJoin('aa_customer AS cus','so.cid','=','cus.id');
        if($id!='') {
            $q->where('so.eid',$id);
        }
        $q = $q->get();
        return $q;
    }
}
