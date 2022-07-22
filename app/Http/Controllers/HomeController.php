<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\SmartSystem\General;
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
        $app['judul']   = 'Dashboard';
        $app['roleName']= $this->general->role_name();
        $app['sales']   = DB::table('aa_employe')->get()->toArray();
        $app['startDate'] = (isset($_GET['tglDr'])&&$_GET['tglDr']!='') ? $_GET['tglDr'] : ((!isset($_GET['tglDr'])) ? Carbon::now()->format('Y-m-d') : '');
        $app['endDate']   = (isset($_GET['tglSd'])&&$_GET['tglSd']!='') ? $_GET['tglSd'] : ((!isset($_GET['tglDr'])) ? Carbon::now()->format('Y-m-d') : '');
        if ($app['roleName'] == 'ADMIN') {
            $app['salesId']    = (isset($_GET['salesId'])&&$_GET['salesId']!='') ? $_GET['salesId'] : '';
        } elseif ($app['roleName'] == 'SALES') {
            $app['salesId']    = auth()->user()->eid;
        }

        //KPI
        $app['actionKpi'] = DB::table('cr_action AS a')
                            ->leftJoin('rf_category_action as ca','category_id','=','ca.id')
                            ->where('ca.id', $this->general->category_action_id('KPI'))
                            ->select('a.id','a.name')
                            ->get();
        $app['capaian'] = DB::table('cr_action AS ac')
                        ->leftJoin('cr_activity AS vit','ac.id', '=', 'vit.action_id')
                        ->selectRaw('ac.id, COUNT(vit.id) AS result')
                        ->leftJoin('rf_category_action as ca','category_id','=','ca.id')
                        ->join('aa_employe AS em','vit.sales_id', '=', 'em.id')
                        ->where('ca.id', $this->general->category_action_id('KPI'))
                        ->where('em.id', $app['salesId'])
                        ->groupBy('ac.id')
                        ->get();

        $countDate = Carbon::parse($app['startDate'])->diffInDays(Carbon::parse($app['endDate'])) + 1;

        $target = array();
        foreach ($app['actionKpi'] as $rows) {
            $qry        = DB::table('cr_action_target')
                        ->selectRaw("action_id, target *'$countDate' AS target")
                        ->where('action_id', $rows->id)
                        ->latest('id')->first();
            $target[]   = $qry;
        }

        $app['target']  = $target;

        // dd($app['target']);
        //Laporan Harian
        $app['time']        = DB::table('rf_times')->get();
        $app['actionDaily'] = DB::table('cr_action AS a')
                            ->leftJoin('rf_category_action as ca','category_id','=','ca.id')
                            ->where('ca.id', $this->general->category_action_id('DAILY'))
                            ->select('a.id','a.name')
                            ->get();

            $res = array();
            for ($i=0; $i < count($app['time']); $i++) {
                $dtimefr = $app['startDate'].' '.$app['time'][$i]->name.':00';
                $dtimeto = $app['endDate'].' '.substr($app['time'][$i]->name,0,2).':59:00';

                $qry    = DB::table('cr_action AS ac')
                        ->leftJoin('cr_activity AS vit','ac.id', '=', 'vit.action_id')
                        ->join('aa_employe AS em','vit.sales_id', '=', 'em.id')
                        ->selectRaw('ac.id, COUNT(vit.id) AS results')
                        ->whereBetween('date', [$dtimefr, $dtimeto])
                        ->where('em.id', $app['salesId'])
                        ->groupBy('ac.id')
                        ->get()->toArray();

                if(count($qry) > 0) {
                    foreach ($qry as $key => $value) {
                        $value->hour = substr($app['time'][$i]->name,0,2);
                        $res[]   = $value;
                    }
                }
            }
            $app['daiylReport'] = $res;
        return view('pages.dashboard', $app);
    }
}
