<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\VarGlobal;

class DashboardController extends Controller
{
    var $global;
    public function __construct()
    {
        $varglobal = new VarGlobal();
        $this->global = $varglobal;
    }
    public function index()
    {
        // if (session('UserID') == '') {
        //     return redirect('aman')->with('alert', 'Silahkan login kembali!');
        // }
        $app['judul'] = 'Dashboard';
        return view('pages.dashboard', $app);
    }

    public function modules()
    {
        if (session('UserID') == '') {
            return redirect('aman')->with('alert', 'Silahkan login kembali!');
        }
        $app['judul'] = 'Modules';
        return view('pages.modules', $app);
    }

    public function ceksesi(Request $request)
    {
        dd(session()->all());
    }
}
