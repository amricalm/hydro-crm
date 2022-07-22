<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Models\Employe;
use App\Models\Customer;
use App\Models\MsUpload;
use App\Exports\AllExport;
use App\Imports\CustomerImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Adn;

class CustomerController extends Controller
{
    public function __construct()
    {
        if (!SESSION::has('UserID')) {
            // return redirect()->route('aman');
        }
        $this->middleware('auth');
    }

    public function index(Request $req)
    {
        $app['judul']   = "Pelanggan";
        $app['karyawan']   = Employe::all();

        $tampilBarisTabel  = Adn::getSysVar('TampilBarisTabel');
        Session::put('TampilBarisTabel', $tampilBarisTabel);
        return view('pages.customer.index', $app);
    }

    public function get(Request $req)
    {
        $data = Customer::where('id',$req->id)->get()->toArray();

        return response()->json($data);
    }

    public function save(Request $req)
    {
        try {
            $obj = new Customer;
            if ($req->mode=='EDIT')
            {
                $obj = Customer::find($req->id);
            }
            if($obj==null){
                $response= Adn::Response(false,"Data Karyawan Tidak Ditemukan.");
                return response()->json($response);
            }

            $obj->nip=$req->nip;
            $obj->name=$req->name;
            $obj->address=$req->address;
            $obj->hp=$req->hp;
            $obj->email=$req->email;
            $obj->facebook=$req->facebook;
            $obj->instagram=$req->instagram;
            $obj->status=!($req->aktif);
            $obj->cby=1;
            $obj->uby=1;

            $obj->save();

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

    public function delete(Request $req)
    {
        try {
            Customer::where('id',$req->id)->delete();
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

    public function getTabel(Request $req){
        $output ='
        <table class="table table-bordered card-table table-vcenter text-nowrap" width="100%">
        <thead>
          <tr class="border-top">
            <th class="py-2" width="10%">#</th>
            <th class="py-2">Nama Lengkap</th>
            <th class="py-2">Status</th>
            <th class="py-2" colspan="2" width="6%"></th>
          </tr>
        </thead>
        <tbody>';

        $status = (trim($req->status))!='1'?0:1;

        $page = (isset($req->page))?$req->page:1;
        $limit = session('TampilBarisTabel');
        $limit_start = ($page - 1) * $limit;
        $no = $limit_start + 1;

        $q = Customer::selectRaw("*")
        ->where('status',$status)
        ->offset($limit_start)
        ->limit($limit)->get();
        $jmh = Customer::where('status',$status);
        $total_records =$jmh->count();

        $kelas_baris_akhir ='';
        $tr = '';
        $status = 'AKTIF';
        foreach ($q as $row) {
            $status = ($row->status==1)?'AKTIF':'TIDAK AKTIF';
            $tr .= '
            <tr ' . $kelas_baris_akhir .'>
              <input type="hidden" value="'. $row->id .'">
              <td class="py-1">'. $row->id .'</td>
              <td class="py-1">'. $row->name .'</td>
              <td class="py-1">'. $status .'</td>

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

    public function isExist(Request $req)
    {
        $result =false;
        $q = Customer::where('nip','=',$req->nip)->get();
        if($q->count()>0)
        {
            $result = true;
        }
        return json_encode($result);
    }

    public function template(Request $request)
    {
        $array = array('type'=>'customer');
        return Excel::download(new AllExport($array),'Pelanggan.xlsx');
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

            // echo 'Berhasil|'.$request->file->extension().'|'.$fileModel->original_file;
        }
    }
}
