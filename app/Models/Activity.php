<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Activity extends Model
{
    use HasFactory;

    const CREATED_AT = 'con';
    const UPDATED_AT = 'uon';

    protected $table = "cr_activity";
    protected $fillable = ['date','customer_id','sales_id','cby','uby'];

    public static function getTimeRange($salesId='',$startDate='',$endDate='')
    {
        $q = DB::table('cr_activity')
            ->selectRaw('MIN(HOUR(DATE)) AS min, MAX(HOUR(DATE)) AS max')
            ->where('sales_id',$salesId)
            ->whereBetween('date',[$startDate, $endDate])
            ->first();
        return $q;
    }

    public static function getDailyReport($salesId='',$startDate='',$endDate='')
    {
        $q = DB::table('cr_activity_dtl AS dtl')
            ->selectRaw('action_id, HOUR(date) AS hour, COUNT(HOUR(DATE)) result')
            ->leftJoin('cr_activity AS vit','dtl.activity_id','=','vit.id')
            ->where('sales_id',$salesId)
            ->whereBetween('date',[DB::raw("'$startDate'"), DB::raw("'$endDate'")])
            ->groupBy('action_id', DB::raw("HOUR(date)"))
            ->get();
        return $q;
    }

    public static function getActivity($dateFr='',$dateTo='',$salesId='',$id='')
    {
        $qrySales       = Employe::selectRaw('aa_employe.id, aa_employe.name')->leftJoin('cr_activity','aa_employe.id','=','cr_activity.sales_id')->groupBy('aa_employe.id');

        $q = DB::table('cr_activity_dtl AS dtl')
            ->selectRaw('act.id, DATE(act.date) AS date, cus.name AS name, cus.hp AS hp, GROUP_CONCAT(acn.name) AS action, GROUP_CONCAT(res.name) AS response, sls.name AS sales')
            ->leftJoin('cr_activity AS act','dtl.activity_id','=','act.id')
            ->leftJoin('aa_customer AS cus','act.customer_id','=','cus.id')
            ->leftJoin(DB::raw('('.$qrySales->toSql().') as sls'),'act.sales_id','=','sls.id')
            ->leftJoin('cr_action AS acn','dtl.action_id','=','acn.id')
            ->leftJoin('cr_response AS res','dtl.response_id','=','res.id');
            if($id!='') {
                $q->where('act.id',$id);
            }
            if($salesId!='') {
                $q->where('act.sales_id',$salesId);
            }
            if($dateFr!='' && $dateTo!='') {
                $q->whereBetween('act.date', [(string)$dateFr, (string)$dateTo]);
            }

        $q = $q->groupBy('cus.name');

        return $q;
    }
}
