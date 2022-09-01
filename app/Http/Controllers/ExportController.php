<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Exports\AllExport;
use App\Models\Activity;
use App\Models\Employe;
use App\SmartSystem\General;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class ExportController extends Controller
{
    var $general;
    public function __construct()
    {
        $vargeneral = new General();
        $this->general = $vargeneral;
        $this->middleware('auth');
    }

    public function dailyReport(Request $req)
    {
        $array = array('type'=>'daily-report');
        $app['roleName']    = $this->general->role_name();
        $startDate   = (isset($req->tglDr)&&$req->tglDr!='') ? $req->tglDr : ((!isset($req->tglDr)) ? Carbon::now()->format('Y-m-d') : '');
        $endDate     = (isset($req->tglSd)&&$req->tglSd!='') ? $req->tglSd : ((!isset($req->tglSd)) ? Carbon::now()->format('Y-m-d') : '');
        $sales       = Employe::select('name')->where('id', $req->salesId)->first();
        if ($app['roleName'] == 'ADMIN') {
            $app['salesId']    = (isset($req->salesId)&&$req->salesId!='') ? $req->salesId : '';
        } elseif ($app['roleName'] == 'SALES') {
            $app['salesId']    = auth()->user()->eid;
        }
        $app['actionDaily'] = DB::table('cr_action AS a')
                            ->leftJoin('rf_category_action as ca','category_id','=','ca.id')
                            ->where('ca.id', $this->general->category_action_id('DAILY'))
                            ->select('a.id','a.name')
                            ->get();
        $timeRange      = Activity::getTimeRange($app['salesId'], $startDate,$endDate);
        $timeRangeMin   = ($timeRange->min=='' || $timeRange->min>9) ? 9 : $timeRange->min;
        $timeRangeMax   = ($timeRange->max=='' || $timeRange->max<16) ? 16 : $timeRange->max;
        $app['timeRange'] = ['min'=>$timeRangeMin,'max'=>$timeRangeMax];
        $app['dailyReport'] = Activity::getDailyReport($app['salesId'], $startDate,$endDate);

        $array += array('actionDaily'=>$app['actionDaily'], 'timeRange'=>$app['timeRange'], 'dailyReport'=>$app['dailyReport'], 'salesId'=>$app['salesId']);
        return Excel::download(new AllExport($array),'Laporan-Aktivitas-Harian_'.$sales->name.'_'.$startDate.'_'.$endDate.'.xlsx');
    }

    public function reportDtl(Request $req)
    {
        $array = array('type'=>'report-dtl');
        $app['roleName']    = $this->general->role_name();
        $startDate   = (isset($req->tglDr)&&$req->tglDr!='') ? $req->tglDr : ((!isset($req->tglDr)) ? Carbon::now()->format('Y-m-d') : '');
        $endDate     = (isset($req->tglSd)&&$req->tglSd!='') ? $req->tglSd : ((!isset($req->tglSd)) ? Carbon::now()->format('Y-m-d') : '');
        if ($app['roleName'] == 'ADMIN') {
            $app['salesId']    = (isset($req->salesId)&&$req->salesId!='') ? $req->salesId : '';
        } elseif ($app['roleName'] == 'SALES') {
            $app['salesId']    = auth()->user()->eid;
        }
        $getSales       = Employe::select('name')->where('id', $app['salesId'])->first();
        $seles          = isset($getSales) ? $getSales->name : '';


        $q = Activity::getActivity($startDate,$endDate,$app['salesId'],'')->get();

        $array += array('allData'=>$q);
        return Excel::download(new AllExport($array),'Laporan-Aktivitas-Detail_'.$seles.'_'.$startDate.'_'.$endDate.'.xlsx');
    }
}
