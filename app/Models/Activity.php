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
}
