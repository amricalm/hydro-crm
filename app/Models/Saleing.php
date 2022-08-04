<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Employe;

class Saleing extends Model
{
    use HasFactory;

    const CREATED_AT = 'con';
    const UPDATED_AT = 'uon';

    protected $table = "cr_saleing";
    protected $fillable = ['date','customer_id','product_id','technician_id','sales_id','desc','amount','cby','uby'];

    public static function getSaleing($dateFr='',$dateTo='',$salesId='',$id='')
    {
            $qryTechnician  = Employe::select('aa_employe.id','aa_employe.name')->leftJoin('cr_saleing AS sal','aa_employe.id','=','sal.technician_id')->groupBy('aa_employe.id');
            $qrySales       = Employe::select('aa_employe.id','aa_employe.name')->leftJoin('cr_saleing AS sal','aa_employe.id','=','sal.sales_id')->groupBy('aa_employe.id');

            $q = DB::table('cr_saleing AS sal')
                ->selectRaw('sal.id, date, puc.id AS product_id, puc.name AS product_name, cus.id AS customer_id, cus.name AS customer_name, hp, tec.id AS technician_id, tec.name AS technician_name, sls.id AS sales_id, sls.name AS sales_name, sal.desc, sal.amount')
                ->leftJoin('cr_product AS puc','sal.product_id','=','puc.id')
                ->leftJoin('aa_customer AS cus','sal.customer_id','=','cus.id')
                ->leftJoin(DB::raw('('.$qryTechnician->toSql().') as tec'),'sal.technician_id','=','tec.id')
                ->leftJoin(DB::raw('('.$qrySales->toSql().') as sls'),'sal.sales_id','=','sls.id');
                if($id!='') {
                    $q->where('sal.id',$id);
                }
                if($salesId!='') {
                    $q->where('sls.id',$salesId);
                }
                if($dateFr!='' && $dateTo!='') {
                    $q->whereBetween('sal.date', [$dateFr, $dateTo]);
                }

        return $q;
    }
}
