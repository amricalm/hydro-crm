<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Models\Employe;
use App\Models\Customer;
use App\Models\SalesOwner;
use App\Models\Saleing;
use App\Models\MsUpload;
use App\Exports\AllExport;
use App\Imports\CustomerImport;
use Maatwebsite\Excel\Facades\Excel;
use App\SmartSystem\General;
use Carbon\Carbon;
use Validator;
use App\Adn;

class SaleingController extends Controller
{
    public function __construct()
    {
        if (!SESSION::has('UserID')) {
        }
        $vargeneral = new General();
        $this->general = $vargeneral;
        $this->middleware('auth');
    }

    public function index(Request $req)
    {
        $app['judul']   = "Penjualan";
        $app['roleName']= $this->general->role_name();
        if ($app['roleName'] == 'ADMIN') {
            $app['karyawan']    = Employe::all();
            $app['customer']    = Customer::getCustomerName();
        } elseif ($app['roleName'] == 'SALES') {
            $app['karyawan']    = Employe::where('id', auth()->user()->eid)->get();
            $app['customer']    = Customer::getCustomerName(auth()->user()->eid);
        }
        $app['product']         = DB::table('cr_product')->get()->toArray();
        $app['date']            = Carbon::now()->format('Y-m-d');
        $app['startDate']       = (isset($_GET['tglDr'])&&$_GET['tglDr']!='') ? $_GET['tglDr'] : ((!isset($_GET['tglDr'])) ? Carbon::now()->format('Y-m-d') : '');
        $app['endDate']         = (isset($_GET['tglSd'])&&$_GET['tglSd']!='') ? $_GET['tglSd'] : ((!isset($_GET['tglDr'])) ? Carbon::now()->format('Y-m-d') : '');

        $tampilBarisTabel  = Adn::getSysVar('TampilBarisTabel');
        Session::put('TampilBarisTabel', $tampilBarisTabel);
        return view('pages.saleing.index', $app);
    }

    public function getTabel(Request $req){
        $output ='
        <table class="table table-bordered card-table table-vcenter text-nowrap" width="100%">
        <thead>
          <tr class="border-top">
            <th class="py-2" width="5%">#</th>
            <th class="py-2">Tanggal</th>
            <th class="py-2">Nama Pelanggan</th>
            <th class="py-2">Produk</th>
            <th class="py-2">Teknisi</th>
            <th class="py-2">Sales</th>
            <th class="py-2">Harga</th>
            <th class="py-2" colspan="2" width="5%"></th>
          </tr>
        </thead>
        <tbody>';

        $employe = $req->employe;
        $dateFr  = $req->tglDr;
        $dateTo  = $req->tglSd;
        $page    = (isset($req->page))?$req->page:1;
        $limit   = session('TampilBarisTabel');
        $limit_start = ($page - 1) * $limit;
        $no = $limit_start + 1;

        $q = Saleing::getSaleing($dateFr,$dateTo,$employe,'');

        $q = $q->offset($limit_start)
                ->limit($limit)->get();

        $saleingList = Saleing::getSaleing($dateFr,$dateTo,$employe,'');
        $total_records = $saleingList->count();

        $kelas_baris_akhir ='';
        $tr = '';
        foreach ($q as $row) {
            $tr .= '
            <tr ' . $kelas_baris_akhir .'>
              <input type="hidden" value="'. $row->id .'">
              <td class="py-1">'. $no .'</td>
              <td class="py-1">'. Carbon::parse($row->date)->format('d/m/Y') .'</td>
              <td class="py-1">'. $row->customer_name .'</td>
              <td class="py-1">'. $row->product_name .'</td>
              <td class="py-1">'. $row->technician_name .'</td>
              <td class="py-1">'. $row->sales_name .'</td>
              <td class="py-1">'. number_format($row->amount, 0,'.','.') .'</td>

              <td class="py-1">
                    <button type="button" class="btn bg-info-transparent py-0 px-2 btn-edit" ><i class="fe fe-edit"></i></button>
                    <button type="button" class="btn bg-danger-transparent py-0 px-2 btn-delete"><i class="fe fe-x-square"></i></button>
                </td>
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

    public function get(Request $req)
    {
        $data = Saleing::getSaleing('','','',$req->id)->get()->toArray();
        return response()->json($data);
    }

    public static function validation(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }

        return response()->json(["status"=>true,"Message"=>"Data Lengkap."]);
    }

    public function isExist(Request $req)
    {
        $result =false;
        $q = Customer::where('name','=',$req->name)->get();
        if($q->count()>0)
        {
            $result = true;
        }
        return json_encode($result);
    }

    public function save(Request $req)
    {
        try {
            //Simpan
            $obj = new Saleing;
            if ($req->mode=='EDIT')
            {
                $obj = Saleing::find($req->id);
            }
            if($obj==null){
                $response= Adn::Response(false,"Data Penjualan Tidak Ditemukan.");
                return response()->json($response);
            }


            // $cus = new Customer;
            // if ($req->mode=='EDIT')
            // {
            //     $cus = Customer::find($obj->customer_id);
            // }
            // $cus->name=$req->customer;
            // $cus->address=$req->address;
            // $cus->hp=$req->hp;
            // $cus->email=$req->email;
            // $cus->facebook=$req->facebook;
            // $cus->instagram=$req->instagram;
            // $cus->cby=auth()->user()->id;
            // $cus->uby=auth()->user()->id;
            // $cus->save();
            // $cusid = $cus->id;

            // $sal = new SalesOwner;
            // if ($req->mode=='EDIT')
            // {
            //     $sal = SalesOwner::firstOrNew(['cid'=>$cusid, 'periode'=>DB::raw((int)Carbon::now()->format('Ym'))]);
            // }
            // $sal->periode=Carbon::now()->format('Ym');
            // $sal->cid=$cusid;
            // $sal->eid=$req->sales;
            // $sal->save();

            $obj->date=$req->date;
            $obj->customer_id=$req->customer_id;
            $obj->product_id=$req->product;
            $obj->technician_id=$req->technician;
            $obj->sales_id=$req->sales;
            $obj->desc=$req->desc;
            $obj->amount=$req->amount;
            if ($req->mode=='EDIT') {
                $obj->uby=auth()->user()->id;
            } else {
                $obj->cby=auth()->user()->id;
            }
            $obj->save();

            $response= Adn::Response(true,"Sukses",$req->mode);
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

    public function delete(Request $req)
    {
        try {
            Saleing::where('id',$req->id)->delete();
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

    public function create()
    {
        $app['judul']       = "Penjualan";
            $qry    = DB::table('aa_customer AS cus')->select('cus.id','cus.name')
                    ->rightJoin('cr_sales_owner AS own','cus.id','=','own.cid')
                    ->where('periode',DB::raw((int)Carbon::now()->format('Ym')));
            if ($this->general->role_name() == 'SALES') {
                $qry = $qry->where('eid',auth()->user()->id);
            }
            $qry    = $qry->orderBy('cus.id','DESC')
                    ->get()->toArray();

            $app['customer']    = $qry;
            $app['product']     = DB::table('cr_product')->select('id','name')->get()->toArray();
            $app['technician']  = DB::table('aa_employe')->select('id','name')->get()->toArray();
            $app['sales']       = DB::table('aa_employe')->select('id','name')->get()->toArray();
            $app['date']        = Carbon::now()->format('Y-m-d');
            $app['ModeEdit']    = 'EDIT';

        return view('pages.saleing.create', $app);
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

    public static function validationCustomer(Request $req)
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

    public static function saveSaleing(Request $req)
    {
        $req = $req->all();
        foreach ($req as $k => $v) {
            if($k == 0) {
                // Update Pelanggan
                $customer = Customer::find($v["customer"]);
                $customer->update(['address' => $v["address"], 'hp' => $v["hp"], 'email' => $v["email"], 'facebook' => $v["facebook"], 'instagram' => $v["instagram"]]);
            } else {
                foreach ($v as $kdtl => $vdtl) {
                    $getProduct          = DB::table('cr_product')->select('id')->where('name',$vdtl['product'])->first();
                    $getTechnician        = DB::table('aa_employe')->select('id')->where('name',$vdtl['technician'])->first();
                    $getSales             = DB::table('aa_employe')->select('id')->where('name',$vdtl['sales'])->first();

                    $dtl = new Saleing;
                    $dtl->date          = $vdtl["date"]; //Carbon::now()->toDateTimeString();
                    $dtl->customer_id   = $vdtl["customer"];
                    $dtl->product_id    = $getProduct->id;
                    $dtl->technician_id = $getTechnician->id;
                    $dtl->sales_id      = $getSales->id;
                    $dtl->desc          = $vdtl["desc"];
                    $dtl->amount        = isset($vdtl["amount"]) ? $vdtl["amount"] : 0;
                    $dtl->cby           = auth()->user()->id;
                    $dtl->save();
                }
            }
        }
        return response()->json(["IsSuccess"=>true,"Message"=>"Berhasil disimpan"]);
    }
}
