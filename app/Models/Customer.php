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
    protected $fillable = ['name','address','province','city','zip_code','hp','email','facebook','instagram','sales_owner','status','history','date1','date2','date3','technician1','technician2','technician3','maintenance1','maintenance2','maintenance3','price1','price2','price3','cby','uby'];

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

    public static function getCustomer($employe='',$status='',$search='')
    {
        $q = DB::table('aa_customer AS cus')
            ->selectRaw('cus.id, cus.name, cus.hp, cus.address, cus.email, cus.facebook, cus.instagram, cus.history, pr.name AS product_name, cus.status, emp.id AS sales_id, emp.name as sales_name, cus.date1, cus.date2, cus.date3, cus.technician1, cus.technician2, cus.technician3, cus.maintenance1, cus.maintenance2, cus.maintenance3, cus.price1, cus.price2, cus.price3, IFNULL(price1, 0) + IFNULL(price2, 0) + IFNULL(price3, 0) AS total')
            ->leftJoin('cr_sales_owner AS so', function($join)
                {
                    $join->on('cus.id', '=', 'so.cid');
                    $join->on('so.periode', '=', DB::raw((int)session('LastPeriode')));
                })
            ->leftJoin('aa_employe AS emp','so.eid','=','emp.id')
            ->leftJoin('cr_saleing AS sl','cus.id','=','sl.customer_id')
            ->leftJoin('cr_product AS pr','sl.product_id','=','pr.id')
            ->where('cus.status', $status)
            ->orderBy('cus.name','ASC');

            if($employe == '') { //Jika sales tidak dipilih
                $q =  $q->whereNotIn('cus.id',
                    DB::table('cr_sales_owner AS so')
                    ->select('cid')
                    ->leftJoin('aa_employe AS emp','so.eid','=','emp.id')
                    ->where('periode',DB::raw((int)session('LastPeriode')))
                );
            } elseif ($employe == 999) { //Jika sales dipilh semua
                $q =  $q->whereIn('cid',
                    DB::table('cr_sales_owner AS so')
                    ->select('cid')
                    ->leftJoin('aa_employe AS emp','so.eid','=','emp.id')
                    ->where('periode',DB::raw((int)session('LastPeriode')))
                );
            } else {
                $q = $q->where('emp.id',$employe); //Jika sales dipilih
            }

            if($search!='') { //Jika pencarian tidak kosong
                $q = $q->where(function($cus) use ($search) {
                            $cus->where('cus.name', 'LIKE', '%'.$search.'%')
                            ->orWhere('cus.hp', 'LIKE', '%'.$search.'%')
                            ->orWhere('cus.address','LIKE', '%'.$search.'%')
                            ->orWhere('cus.history','LIKE', '%'.$search.'%');
                        });
            }

        return $q;
    }
}
