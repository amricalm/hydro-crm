<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Models\CategoryAction;
use App\Models\Action;
use Maatwebsite\Excel\Facades\Excel;
use App\SmartSystem\General;
use Carbon\Carbon;
use Validator;
use App\Adn;

class ActionController extends Controller
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
        $app['judul']       = "Aksi";
        $app['category']    = CategoryAction::all();

        $tampilBarisTabel  = Adn::getSysVar('TampilBarisTabel');
        Session::put('TampilBarisTabel', $tampilBarisTabel);
        return view('pages.action.index', $app);
    }

    public function getTabel(Request $req){
        $output ='
        <table class="table table-bordered card-table table-vcenter text-nowrap" width="100%">
        <thead>
          <tr class="border-top">
            <th class="py-2" width="5%">#</th>
            <th class="py-2">Kategori</th>
            <th class="py-2">Kode</th>
            <th class="py-2">Nama Aksi</th>
            <th class="py-2">weight(%)</th>
            <th class="py-2">Target/Bln</th>
            <th class="py-2">Keterangan</th>
        ';
        $output .='<th class="py-2" colspan="2" width="5%"></th>
          </tr>
        </thead>
        <tbody>';

        $page = (isset($req->page))?$req->page:1;
        $limit = session('TampilBarisTabel');
        $limit_start = ($page - 1) * $limit;
        $no = $limit_start + 1;

        $category = $req->category;
        $q = DB::table('cr_action');
        if($category == '') { //Jika tidak dipilih
            $q = $q->whereNull('category_id');
        } elseif ($category != '' && $category != 999) { //Jika dipilh
            $q = $q->where('category_id',$category);
        }

        $total_records = $q->count();

        $q = $q->offset($limit_start)
            ->limit($limit)->get();

        $kelas_baris_akhir ='';
        $tr = '';
        foreach ($q as $row) {
            $getCategory = (!empty($row->category_id)) ? CategoryAction::where('id', $row->category_id)->first() : '';
            $setNameType = !empty($getCategory) ? $getCategory->name : '';
            $tr .= '
            <tr ' . $kelas_baris_akhir .'>
              <input type="hidden" value="'. $row->id .'">
              <td class="py-1">'. $no .'</td>
              <td class="py-1">'. $setNameType .'</td>
              <td class="py-1">'. $row->code .'</td>
              <td class="py-1">'. $row->name .'</td>
              <td class="py-1">'. $row->weight .'</td>
              <td class="py-1">'. $row->target .'</td>
              <td class="py-1">'. $row->desc .'</td>
            ';
            $tr .= '<td class="py-1">
                    <button type="button" class="btn bg-info-transparent py-0 px-2 btn-edit" ><i class="fe fe-edit"></i></button>
                    <button type="button" class="btn bg-danger-transparent py-0 px-2 btn-delete"><i class="fe fe-x-square"></i></button>
                </td>
            </tr>';
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
        $data = Action::selectRaw('cr_action.*, pt.name as category_name')
                ->leftJoin('rf_category_action AS pt','pt.id', '=', 'cr_action.category_id')
                ->where('cr_action.id',$req->id)
                ->get()->toArray();
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
        $q = Action::where('name','=',$req->name)->get();
        if($q->count()>0)
        {
            $result = true;
        }
        return json_encode($result);
    }

    public function save(Request $req)
    {
        try {
            //Simpan Aksi
            $obj = new Action;
            if ($req->mode=='EDIT')
            {
                $obj = Action::find($req->id);
            }
            if($obj==null){
                $response= Adn::Response(false,"Data Aksi Tidak Ditemukan.");
                return response()->json($response);
            }

            $obj->category_id=$req->category;
            $obj->code=$req->code;
            $obj->name=$req->name;
            $obj->weight=$req->weight;
            $obj->target=$req->target;
            $obj->desc=$req->desc;
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
            Action::where('id',$req->id)->delete();
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
}
