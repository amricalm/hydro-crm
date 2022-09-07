<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\SmartSystem\General;
use App\Models\Action;
use App\Models\Activity;
use Carbon\Carbon;

class HomeController extends Controller
{
    var $general;
    public function __construct()
    {
        $vargeneral = new General();
        $this->general = $vargeneral;
        $this->middleware('auth');
    }

    public function index(Request $req)
    {
        $app['judul']       = 'Dashboard';
        $app['roleName']    = $this->general->role_name();
        $app['startDate']   = (isset($_GET['tglDr'])&&$_GET['tglDr']!='') ? $_GET['tglDr'] : ((!isset($_GET['tglDr'])) ? Carbon::now()->format('Y-m-d') : '');
        $app['endDate']     = (isset($_GET['tglSd'])&&$_GET['tglSd']!='') ? $_GET['tglSd'] : ((!isset($_GET['tglSd'])) ? Carbon::now()->format('Y-m-d') : '');
        $startDate          = $app['startDate'];
        $endDate            = $app['endDate'];
        $nowDate            = Carbon::now()->format('Y-m-d');

        if ($app['roleName'] == 'ADMIN') {
            $app['sales']       = DB::table('aa_employe')->get()->toArray();
            $app['salesId']    = (isset($_GET['salesId'])&&$_GET['salesId']!='') ? $_GET['salesId'] : '';
        } elseif ($app['roleName'] == 'SALES') {
            $app['salesId']    = auth()->user()->eid;
            $app['sales']       = DB::table('aa_employe')->where('id',auth()->user()->eid)->get()->toArray();
        }
        //KPI
        $app['actionKpi'] = Action::select('cr_action.id', 'cr_action.name', 'tar.target', DB::raw('COUNT(vit.sales_id) AS result'))
                            ->leftJoin('cr_activity_dtl AS dtl','cr_action.id','=','dtl.action_id')
                            ->leftJoin('cr_action_target AS tar', function($join) use($nowDate)
                            {
                                $join->on('cr_action.id','=','tar.action_id');
                                $join->on(DB::raw("'$nowDate'"),'>=', 'tar.start_date');
                                $join->on(DB::raw("'$nowDate'"),'<=', 'tar.end_date');
                            })
                            ->leftJoin('cr_activity AS vit', function($join) use($app,$startDate,$endDate)
                            {
                                $join->on('dtl.activity_id','=','vit.id');
                                if($app['salesId']!='') {
                                    $join->on('vit.sales_id','=', DB::raw($app['salesId']));
                                }

                                $join->on('vit.date','>=', DB::raw("'$startDate'"));
                                $join->on('vit.date','<=', DB::raw("'$endDate' + INTERVAL 1 DAY"));
                            })
                            ->where('cr_action.category_id', $this->general->category_action_id('KPI'))
                            ->groupBy('cr_action.id')
                            ->get();

        //Laporan Harian
        $app['actionDaily'] = DB::table('cr_action AS a')
                            ->leftJoin('rf_category_action as ca','category_id','=','ca.id')
                            ->where('ca.id', $this->general->category_action_id('DAILY'))
                            ->select('a.id','a.name')
                            ->get();
        $timeRange = Activity::getTimeRange($app['salesId'], $startDate,$endDate);
        $timeRangeMin = ($timeRange->min=='' || $timeRange->min>9) ? 9 : $timeRange->min;
        $timeRangeMax = ($timeRange->max=='' || $timeRange->max<16) ? 16 : $timeRange->max;
        $app['timeRange'] = ['min'=>$timeRangeMin,'max'=>$timeRangeMax];

        $app['dailyReport'] = Activity::getDailyReport($app['salesId'], $startDate,$endDate);

        return view('pages.dashboard', $app);
    }
}
