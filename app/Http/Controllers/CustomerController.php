<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Models\Employe;
use App\Models\Customer;
use App\Models\SalesOwner;
use App\Models\MsUpload;
use App\Exports\AllExport;
use App\Imports\CustomerImport;
use Maatwebsite\Excel\Facades\Excel;
use App\SmartSystem\General;
use Carbon\Carbon;
use Validator;
use App\Adn;

class CustomerController extends Controller
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
        $app['judul']   = "Pelanggan";
        $app['roleName']= $this->general->role_name();
        if ($app['roleName'] == 'ADMIN') {
            $app['karyawan']   = Employe::all();
        } elseif ($app['roleName'] == 'SALES') {
            $app['karyawan']   = Employe::where('id', auth()->user()->eid)->get();
        }

        $tampilBarisTabel  = Adn::getSysVar('TampilBarisTabel');
        Session::put('TampilBarisTabel', $tampilBarisTabel);
        $lastPeriode  = Adn::getSysVar('LastPeriode');
        Session::put('LastPeriode', $lastPeriode);
        return view('pages.customer.index', $app);
    }

    public function getTabel(Request $req)
    {
        $output ='
        <table class="table table-bordered card-table table-vcenter text-wrap" width="100%">
        <thead>
          <tr class="border-top">
            <th class="py-2" width="5%">#</th>
            <th class="py-2" width="20%">Nama Pelanggan</th>
            <th class="py-2" width="15%">Hp</th>
            <th class="py-2">Alamat</th>
            <th class="py-2">Jenis/Tipe Produk</th>
            <th class="py-2">CRO</th>
            <th class="py-2">Tanggal</th>
            <th class="py-2">Teknisi/Sales</th>
            <th class="py-2">Kunjungan/Penjualan</th>
            <th class="py-2">Rp</th>
            <th class="py-2" colspan="2" width="5%"></th>
          </tr>
        </thead>
        <tbody>';

        $status = (trim($req->status))!='1'?0:1;
        $employe = $req->employe;
        $search  = $req->search;
        $page = (isset($req->page))?$req->page:1;
        $limit = session('TampilBarisTabel');
        $limit_start = ($page - 1) * $limit;
        $no = $limit_start + 1;

        $q = Customer::getCustomer($employe,$status,$search);

        $q = $q->offset($limit_start)
                ->limit($limit)
                ->orderBy('cus.name','ASC')
                ->get();

        $list = Customer::getCustomer($employe,$status,$search);
        $total_records = $list->count();

        $kelas_baris_akhir ='';
        $tr = '';
        $status = 'AKTIF';
        foreach ($q as $row) {
            $status = ($row->status==1)?'AKTIF':'TIDAK AKTIF';
            $product_name = ($row->product_name!='') ? $row->product_name : '';
            $date1 = isset($row->date1) ? Carbon::parse($row->date1)->format('d/m/y') : '';
            $date2 = isset($row->date2) ? Carbon::parse($row->date2)->format('d/m/y') : '';
            $date3 = isset($row->date3) ? Carbon::parse($row->date3)->format('d/m/y') : '';
            $tech1 = str_replace(array("\n", "\r\n"),', ',trim($row->technician1));
            $tech2 = str_replace(array("\n", "\r\n"),', ',trim($row->technician2));
            $tech3 = str_replace(array("\n", "\r\n"),', ',trim($row->technician3));
            $main1 = str_replace(array("\n", "\r\n"),', ',trim($row->maintenance1));
            $main2 = str_replace(array("\n", "\r\n"),', ',trim($row->maintenance2));
            $main3 = str_replace(array("\n", "\r\n"),', ',trim($row->maintenance3));
            $price1 = isset($row->price1) ? $row->price1 : 0;
            $price2 = isset($row->price2) ? $row->price2 : 0;
            $price3 = isset($row->price3) ? $row->price3 : 0;
            $date       = array($date1, $date2, $date3);
            $technician = array($tech1,$tech2,$tech3);
            $maintenance= array($main1,$main2,$main3);
            $sumPrice   = $price1 + $price2 + $price3;
            $tr .= '
            <tr ' . $kelas_baris_akhir .'>
              <input type="hidden" id="customer_id" value="'. $row->id .'">
              <input type="hidden" id="sales_id" value="'. $row->sales_id .'">
              <td class="py-1">'. $no .'</td>
              <td class="py-1">'. $row->name .'</td>
              <td class="py-1">'. $row->hp .'</td>
              <td class="py-1">'. $row->address .'</td>
              <td class="py-1">'. $row->history .''. $product_name .'</td>
              <td class="py-1">'. $row->sales_name .'</td>
              <td class="py-1">'. implode(', ', array_filter($date)) .'</td>
              <td class="py-1">'. implode(', ', array_filter($technician)) .'</td>
              <td class="py-1">'. implode(', ', array_filter($maintenance)) .'</td>
              <td class="py-1 text-right">'. number_format($sumPrice,0,",",".") .'</td>

              <td class="py-1">
                    <button type="button" class="btn bg-info-transparent py-0 px-2 btn-edit"><i class="fe fe-edit"></i></button>
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
        $data = Customer::selectRaw('aa_customer.*, eid')
                ->leftJoin('cr_sales_owner AS so', function($join)
                {
                    $join->on('aa_customer.id', '=', 'so.cid');
                    $join->on('so.periode', '=', DB::raw((int)session('LastPeriode')));
                })
                ->where('aa_customer.id',$req->id)
                ->get()
                ->toArray();
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
            //Simpan Pelanggan
            $obj = new Customer;
            if ($req->mode=='EDIT')
            {
                $obj = Customer::find($req->id);
            }
            if($obj==null){
                $response= Adn::Response(false,"Data Karyawan Tidak Ditemukan.");
                return response()->json($response);
            }

            $obj->name=$req->name;
            $obj->address=$req->address;
            $obj->hp=$req->hp;
            $obj->email=$req->email;
            $obj->facebook=$req->facebook;
            $obj->instagram=$req->instagram;
            $obj->history=$req->history;
            $obj->date1=$req->date1;
            $obj->date2=$req->date2;
            $obj->date3=$req->date3;
            $obj->technician1=$req->technician1;
            $obj->technician2=$req->technician2;
            $obj->technician3=$req->technician3;
            $obj->maintenance1=$req->maintenance1;
            $obj->maintenance2=$req->maintenance2;
            $obj->maintenance3=$req->maintenance3;
            $obj->price1=$req->price1;
            $obj->price2=$req->price2;
            $obj->price3=$req->price3;
            $obj->status=!($req->aktif);
            if ($req->mode=='EDIT') {
                $obj->uby=auth()->user()->id;
            } else {
                $obj->cby=auth()->user()->id;
            }
            $obj->save();

            if($req->sales != '') {
                //Simpan Sales Owner
                $customer_id = $obj->id;
                $salesOwner = SalesOwner::updateOrCreate(
                    ['periode' => session('LastPeriode'), 'cid' => $customer_id],
                    ['eid' => $req->sales, 'cby' => auth()->user()->id, 'uby' => auth()->user()->id]
                );
            }

            $response= Adn::Response(true,"Sukses",[$req->mode,$obj]);
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
            $countCustomer = SalesOwner::selectRaw('COUNT(cus.id) AS count_customer_id')
                            ->leftJoin('aa_customer AS cus','cr_sales_owner.cid','=','cus.id')
                            ->where('periode', session('LastPeriode'))
                            ->where('cr_sales_owner.cid', $req->customer_id)
                            ->groupBy('cr_sales_owner.cid')
                            ->count();
            if($countCustomer<=1) {
                Customer::where('id',$req->customer_id)->delete();
                $getSalesOwner = SalesOwner::where('cid',$req->customer_id)->get();
                if(isset($getSalesOwner)) {
                    SalesOwner::where('cid',$req->customer_id)->delete();
                }
            } else {
                SalesOwner::where('cid',$req->customer_id)->where('eid',$req->sales_id)->delete();
            }
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

    public function template(Request $request)
    {
        $array = array('type'=>'customer');
        return Excel::download(new AllExport($array),'Pelanggan.xlsx');
    }

    public function employeList(Request $request)
    {
        $data = Employe::select('id','name')->get();
        $array = array('type'=>'employe');
        $array += array('alldata'=>$data);
        return Excel::download(new AllExport($array),'Daftar Karyawan.xlsx');
    }

    public function upload(Request $request)
    {
        $ext = $request->file('file')->getClientOriginalExtension();
        if($ext!='xls'&&$ext!='xlsx')
        {
            echo 'File harus file excel (xls/xlsx)!';
            die();
        }

        $fileModel = new MsUpload;
        $fileModel->eid = (auth()->user()->pid!='') ? auth()->user()->pid : auth()->user()->id;
        $fileModel->desc = 'Import Pelanggan';
        $fileModel->cby = auth()->user()->id;
        $fileModel->uby = '0';

        if($request->file())
        {
            $filename = time().'_'.$request->file->getClientOriginalName();
            $filepath = $request->file('file')->storeAs('',$filename,'upload');

            $fileModel->url = $filepath;
            $fileModel->original_file = 'uploads/'.$filepath;
            $fileModel->save();

            $import = Excel::import(new CustomerImport, $fileModel->original_file);

            // echo 'Berhasil|'.$request->file->extension().'|'.$f
        }
    }
}
