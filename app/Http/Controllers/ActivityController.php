<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Activity;
use App\Models\ActivityDtl;
use App\Models\Address;
use App\SmartSystem\General;
use Carbon\Carbon;
use App\Adn;
use App\Models\Customer;
use Validator;

class ActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $vargeneral = new General();
        $this->general = $vargeneral;
        if (!SESSION::has('UserID')) {
            // return redirect()->route('aman');
        }
    }

    public function index(Request $req)
    {
        $app['judul']       = "Aktivitas";
        $app['customer']    = DB::table('aa_customer')->get()->toArray();
        $app['action']      = DB::table('cr_action')->get()->toArray();
        $app['response']    = DB::table('cr_response')->get()->toArray();
        $app['sales']       = DB::table('aa_employe')->get()->toArray();
        $app['startDate']   = (isset($_GET['tglDr'])&&$_GET['tglDr']!='') ? $_GET['tglDr'] : ((!isset($_GET['tglDr'])) ? Carbon::now()->format('Y-m-d') : '');
        $app['endDate']     = (isset($_GET['tglSd'])&&$_GET['tglSd']!='') ? $_GET['tglSd'] : ((!isset($_GET['tglDr'])) ? Carbon::now()->format('Y-m-d') : '');
        $app['roleName']    = $this->general->role_name();
        if ($app['roleName'] == 'ADMIN') {
            $app['salesId'] = (isset($_GET['salesId'])&&$_GET['salesId']!='') ? $_GET['salesId'] : '';
        } elseif ($app['roleName'] == 'SALES') {
            $app['salesId'] = auth()->user()->eid;
        }

        $tampilBarisTabel   = Adn::getSysVar('TampilBarisTabel');
        Session::put('TampilBarisTabel', $tampilBarisTabel);
        return view('pages.activity.sales', $app);
    }

    public function get(Request $req)
    {
        // $data = Activity::where('id',$req->id)->get()->toArray();
        // return response()->json($data);
        return $this->create($req->mode);
    }

    public function create()
    {
        $app['judul']       = "Aktivitas";
        // if(!isset($_GET['id'])) { //add
        //     $app['sales']       = DB::table('aa_employe')->get()->toArray();
        //     $app['customer']    = DB::table('aa_customer')->get()->toArray();
        //     $app['category']    = DB::table('rf_category_action')->get()->toArray();
        //     $app['action']      = DB::table('cr_action')->get()->toArray();
        //     $app['response']    = DB::table('cr_response')->get()->toArray();
        //     $app['user']        = DB::table('users')->where('id', auth()->user()->id)->first();
        //     $app['date']        = Carbon::now()->format('Y-m-d');
        //     $app['time']        = Carbon::now()->format('H:00');
        //     $app['ModeEdit']    = 'EDIT';
        // } else { //edit
            // $activity = Activity::where('id', $_GET['id'])->first();
            $qry    = DB::table('aa_customer AS cus')->select('cus.id','cus.name')
                    ->rightJoin('cr_sales_owner AS own','cus.id','=','own.cid')
                    ->where('periode',DB::raw((int)Carbon::now()->format('Ym')));
            if ($this->general->role_name() == 'SALES') {
                $qry = $qry->where('eid',auth()->user()->id);
            }
            $qry    = $qry->orderBy('cus.id','DESC')
                    ->get()->toArray();

            $app['customer']    = $qry;
            $app['category']    = DB::table('rf_category_action')->select('id','name')->get()->toArray();
            $app['action']      = DB::table('cr_action')->select('id','name')->get()->toArray();
            $app['response']    = DB::table('cr_response')->select('id','name')->get()->toArray();
            $app['date']        = Carbon::now()->format('Y-m-d');
            $app['time']        = Carbon::now()->format('H:00');
            $app['ModeEdit']    = 'EDIT';
        // }

        return view('pages.activity.create', $app);
    }

    public function getByCategoryAction(Request $req)
    {
        $action = DB::table('cr_action')->where('category_id',$req->id)->get()->toArray();
        $response = DB::table('cr_response')->where('category_id',$req->id)->get()->toArray();
        return Response::json(array('success' => true,'action'=>$action,'response'=>$response));
    }

    public static function getCustomer(Request $req)
    {
        $id = trim($req->id);
        try {
            $query = DB::table('aa_customer')->where('id', 'like',"%".$id."%")->first();
            if(isset($query)) {
                $qry = trim($query->id);
                if($id == $qry) {
                    $query = DB::table('aa_customer')->where('id', $query->id)->first();
                    return response()->json(["IsSuccess"=>true,"ID"=>$query->id,"Obj"=>$query]);
                } else {
                    return response()->json(["IsSuccess"=>true,"ID"=>""]);
                }
            } else {
                return response()->json(["IsSuccess"=>true,"ID"=>""]);
            }
        } catch(\Exception $e) {
            return response()->json(['error'=>$e]);
        }
    }

    public function delete(Request $req)
    {
        try {
            $getDtl = ActivityDtl::leftJoin('cr_activity AS act','cr_activity_dtl.activity_id','=','act.id')
                    ->where('cr_activity_dtl.activity_id',$req->id)
                    ->get();
            $activity_id = $getDtl->activity_id;
            $dtl = Activity::where('id',$activity_id)->delete();
            $dtl = ActivityDtl::where('activity_id',$getDtl->activity_id)->delete();

            $response= Adn::Response(true,"Sukses");
        }
        catch(\PDOException $e)
        {
            $response= Adn::Response(false,"Database > " .$e->getMessage());
        }
        catch (\Error $e) {
            $response= Adn::Response(false,$e->getMessage());
        }

        return response()->json($response);
    }

    public function getTabel(Request $req)
    {
        $output ='
        <table class="table table-bordered card-table table-vcenter text-nowrap" width="100%">
        <thead>
          <tr class="border-top">
            <th class="py-2" width="10%">Tanggal</th>
            <th class="py-2">Nama Pelanggan</th>
            <th class="py-2">Hp</th>
            <th class="py-2">Aksi</th>
            <th class="py-2">Respon</th>
            <th class="py-2">Sales</th>
            <th class="py-2" colspan="2" width="5%"></th>
          </tr>
        </thead>
        <tbody>';

        if ($this->general->role_name() == 'ADMIN') {
            $salesId = $req->salesId;
        } elseif ($this->general->role_name() == 'SALES') {
            $salesId = auth()->user()->eid;
        }
        $dateFr  = $req->tglDr;
        $dateTo  = $req->tglSd;
        $page = (isset($req->page))?$req->page:1;
        $limit = session('TampilBarisTabel');
        $limit_start = ($page - 1) * $limit;
        $no = $limit_start + 1;

        $q = Activity::getActivity($dateFr,$dateTo,$salesId,'');

        $q = $q->offset($limit_start)
            ->limit($limit)->get();

        $activityList = Activity::getActivity($dateFr,$dateTo,$salesId,'');
        // dd($activityList->toSql());
        $total_records =$activityList->count();

        $kelas_baris_akhir ='';
        $tr = '';
        foreach ($q as $row) {
            $tr .= '
            <tr ' . $kelas_baris_akhir .'>
              <input type="hidden" value="'. $row->id .'">
              <td class="py-1">'. $row->date .'</td>
              <td class="py-1">'. $row->name .'</td>
              <td class="py-1">'. $row->hp .'</td>
              <td class="py-1">'. $row->action .'</td>
              <td class="py-1">'. $row->response .'</td>
              <td class="py-1">'. $row->sales .'</td>

            </tr>'
        ;
            $no++;
            if ($no==($limit_start + $limit))
            {
                $kelas_baris_akhir = 'class="border-bottom"';
            }
        }
        $output .=  $tr .'</tbody></table>';

        $tampilDr= $total_records >0 ? $limit_start+1:0;
        $tampilSd = $total_records >0 ?$no-1:0;
        $output .= '<div class="row mt-4">
            <div class="col-sm-12 col-md-5">
                <div>Tampil '.  ($tampilDr) . ' sd ' . ($tampilSd) .' dari ' . $total_records .' </div>
            </div>
            <div class="col-sm-12 col-md-7">
                <div>
                <nav class="mb-5">
                <ul class="pagination justify-content-end">';

                $jumlah_page = ceil($total_records / $limit);
                $jumlah_number = 3; //jumlah halaman ke kanan dan kiri dari halaman yang aktif
                $start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1;
                $end_number = ($page < ($jumlah_page - $jumlah_number))? $page + $jumlah_number : $jumlah_page;

                if($page == 1){
                    $output .= '<li class="page-item disabled"><a class="page-link" href="#">First</a></li>';
                    $output .= '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
                } else {
                    $link_prev = ($page > 1)? $page - 1 : 1;
                    $output .= '<li class="page-item halaman" id="1"><a class="page-link" href="#">First</a></li>';
                    $output .= '<li class="page-item halaman" id="'.$link_prev.'"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
                }

                for($i = $start_number; $i <= $end_number; $i++){
                    $link_active = ($page == $i)? ' active' : '';
                    $output .= '<li class="page-item halaman '.$link_active.'" id="'.$i.'"><a class="page-link" href="#">'.$i.'</a></li>';
                }

                if($page == $jumlah_page){
                    $output .= '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
                    $output .= '<li class="page-item disabled"><a class="page-link" href="#">Last</a></li>';
                } else {
                    $link_next = ($page < $jumlah_page)? $page + 1 : $jumlah_page;
                    $output .= '<li class="page-item halaman" id="'.$link_next.'"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
                    $output .= '<li class="page-item halaman" id="'.$jumlah_page.'"><a class="page-link" href="#">Last</a></li>';
                }
                $output .= '
                    </ul>
                </nav>
                </div>
            </div>
        </div>';

        echo $output;
    }

    public function search(Request $request)
    {
        $search             = $request->search;
        $qry = DB::table('aa_customer AS cus')
            ->rightJoin('cr_sales_owner AS own','cus.id','=','own.cid')
            ->where('periode',DB::raw((int)Carbon::now()->format('Ym')));

            if ($this->general->role_name() == 'SALES') {
                $qry = $qry->where('eid',auth()->user()->id);
            }

            $qry = $qry->where('name', 'LIKE', '%'.$search.'%')
            ->orWhere('hp', 'LIKE', '%'.$search.'%')
            ->orWhere('address','LIKE', '%'.$search.'%')
            ->orWhere('email','LIKE', '%'.$search.'%')
            ->orWhere('facebook','LIKE', '%'.$search.'%')
            ->orWhere('instagram','LIKE', '%'.$search.'%')
            ->select('cus.id','cus.name')
            ->get();
        $array = array('resultSearch'=>$qry);
        echo (count($qry)>0) ? json_encode($array) : '' ;
    }

    public static function validation(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'customer' => 'required',
            'hp' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }

        return response()->json(["status"=>true,"Message"=>"Data Lengkap."]);
    }

    public static function save(Request $req)
    {
        $req = $req->all();
        $activityId = 0;
        foreach ($req as $k => $v) {
            if($k == 0) {
                $hdr = new Activity;
                $hdr->date          = $v["date"].' '.$v["time"];//Carbon::now()->toDateTimeString();
                $hdr->customer_id   = isset($v["customer"]) ? $v["customer"] : 0;
                $hdr->sales_id      = auth()->user()->eid;
                $hdr->cby           = auth()->user()->id;
                $hdr->save();
                $activityId = $hdr->id;

                // Update Pelanggan
                $customer = Customer::find($hdr->customer_id);
                $customer->update(['address' => $v["address"], 'hp' => $v["hp"], 'email' => $v["email"], 'facebook' => $v["facebook"], 'instagram' => $v["instagram"]]);
            } else {
                foreach ($v as $kdtl => $vdtl) {
                    $getAction          = DB::table('cr_action')->where('name',$vdtl['action'])->first();
                    $getResponse        = DB::table('cr_response')->where('name',$vdtl['response'])->first();

                    $dtl = new ActivityDtl;
                    $dtl->activity_id   = $activityId;
                    $dtl->action_id     = $getAction->id;
                    $dtl->action_desc   = $vdtl['actionDesc'];
                    $dtl->response_id   = $getResponse->id;
                    $dtl->response_desc = $vdtl['responseDesc'];
                    $dtl->cby           = auth()->user()->id;
                    $dtl->save();
                }
            }
        }
        return response()->json(["IsSuccess"=>true,"Message"=>"Berhasil disimpan"]);
    }
}
