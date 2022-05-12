<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\VarGlobal;
use App\Adn;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use App\User;
use Exception;


class AmanController extends Controller
{
    public function index()
    {
        if (!empty(session('UserID'))) {
            return redirect()->route('beranda');
        } else {
            return view('pages/aman');
        }
    }
    public function logout()
    {
        session()->flush();
        return redirect()->route('aman');
    }
    public function xvalidasi()
    {
        $sess['UserID'] = '01';
        $sess['UserLogin'] = 'adn';
        $sess['tglSaw'] = '2021-01-01';
        $sess['tampilBarisTabel'] = 50;
        session($sess);
    }
    public function validasi(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        $user = DB::table('sc_pengguna')
            ->selectRaw('nm_login, nip, sc_pengguna.kd_group, kd_link, aktif, pwd')
            ->leftJoin('sc_group', 'sc_pengguna.kd_group', '=', 'sc_group.kd_group')
            ->whereRaw("nm_login = '" . $username . "'")
            ->get()->toArray();
        if (count($user) > 0) {
            if (trim($user[0]->nm_login) == $request->username && $password == trim($user[0]->pwd)) {
                // $semuamenu = array();
                // $menus = DB::table('sc_group_role')
                //     ->select('*')
                //     ->join('sysmodule', 'ModuleID', '=', 'sysmodule.ID')
                //     ->where('GroupID', $user[0]->GroupID)
                //     ->whereRaw('Type = "Menu"')
                //     ->whereNull('ParentID')
                //     ->orderBy('Seq')
                //     ->get();
                // $menus = collect($menus)->map(function ($x) {
                //     return (array) $x;
                // })->toArray();
                // for ($i = 0; $i < count($menus); $i++) {
                //     $semuamenu[$i] = $menus[$i];
                //     $menus1 = $this->getMenu($user[0]->GroupID, $menus[$i]['ID']);
                //     $menus1 = collect($menus1)->map(function ($y) {
                //         return (array) $y;
                //     })->toArray();
                //     $semuamenu[$i]['child'] = array();
                //     if (count($menus1) > 0) {
                //         $semuamenu[$i]['child'] = $menus1;
                //         for ($j = 0; $j < count($menus1); $j++) {
                //             //cari cucu menu
                //             $menus2 = $this->getMenu($user[0]->GroupID, $menus1[$j]['ID']);
                //             $menus2 = collect($menus2)->map(function ($z) {
                //                 return (array) $z;
                //             })->toArray();
                //             $semuamenu[$i]['child'][$j]['child'] = array();
                //             if (count($menus2) > 0) {
                //                 $semuamenu[$i]['child'][$j]['child'] = $menus2;
                //                 for ($k = 0; $k < count($menus2); $k++) {
                //                     //cari grand cucu menu
                //                     $menus3 = $this->getMenu($user[0]->GroupID, $menus2[$k]['ID']);
                //                     $menus3 = collect($menus3)->map(function ($z) {
                //                         return (array)$z;
                //                     })->toArray();
                //                     $semuamenu[$i]['child'][$j]['child'][$k]['child'] = array();
                //                     if (count($menus3) > 0) {
                //                         $semuamenu[$i]['child'][$j]['child'][$k]['child'] = $menus3;
                //                         for ($l = 0; $l < count($menus3); $l++) {
                //                             //cari grand cucu menu
                //                             $menus4 = $this->getMenu($user[0]->GroupID, $menus3[$l]['ID']);
                //                             $menus4 = collect($menus4)->map(function ($z) {
                //                                 return (array)$z;
                //                             })->toArray();
                //                             $semuamenu[$i]['child'][$j]['child'][$k]['child'][$l]['child'] = array();
                //                             if (count($menus4) > 0) {
                //                                 $semuamenu[$i]['child'][$j]['child'][$k]['child'][$l]['child'] = $menus4;
                //                             }
                //                         }
                //                     }
                //                 }
                //             }
                //         }
                //     }
                // }

                $sess['UserID'] = $user[0]->nm_login;
                $sess['UserLogin'] = $user[0]->nm_login;
                $sess['TampilBarisTabel'] = Adn::getSysVar('TampilBarisTabel');
                $sess['PeriodeMulai'] = Adn::getSysVar('periode_mulai');
                $sess['ServerPosting'] = Adn::getSysVar('ServerPosting');
                // $sess['UserName'] = $user[0]->Name;
                // $sess['UserEmployeeName'] = $user[0]->EmployeeName;
                // $sess['UserEmail'] = $user[0]->Email;
                // $sess['UserGroupID'] = $user[0]->GroupID;
                // $sess['UserUnitID'] = $user[0]->UnitID;
                // $sess['UserPositionID'] = $user[0]->PositionID;
                // $sess['UserHP'] = $user[0]->Hp;
                // $sess['UserFile'] = $user[0]->File;
                // $sess['UserParaf'] = $user[0]->Paraf;
                // $sess['UserSignature'] = $user[0]->Signature;
                // $sess['UserActive'] = $user[0]->Active;
                // $sess['UserReportTo'] = $user[0]->ReportTo;
                // $sess['UserDeleted'] = $user[0]->Deleted;
                // $sess['UserLevel'] = $user[0]->Level;
                // $sess['UserMenu'] = $semuamenu;
                session($sess);
                return redirect()->route('modules');
            } else {
                return redirect()->back()->with('alert', 'Password tidak dikenal!');
            }
        } else {
            return redirect()->back()->with('alert', 'Username tidak terdaftar!');
        }
    }


    function getMenu($groupID, $parentID)
    {
        return DB::table('role')
            ->select('*')
            ->join('sysmodule', 'ModuleID', '=', 'sysmodule.ID')
            ->where('GroupID', '=', $groupID)
            ->where('Type', '=', 'Menu')
            ->where('ParentID', '=', $parentID)
            ->get();
    }
    function KonversiNoSurat()
    {
        //try
        //{
        $surat = DB::table('mail')
            ->selectRaw('mail.ID,MailNo,unit.UnitCode, MailCode, MONTH(MailDate) BlnMail,YEAR(MailDate) ThnMail')
            ->join('unit', 'unit.ID', '=', "mail.MailFromID")
            ->join('mailtype', 'mailtype.ID', '=', 'mail.MailTypeID')
            ->get()->toArray();


        $g = new VarGlobal();
        foreach ($surat as $item) {
            $No = $item->UnitCode . '/' . $item->MailCode . '/' . $item->MailNo . '/' . $g->romawi($item->BlnMail) . '/' . $item->ThnMail;
            $simpan = DB::table('mail')
                ->whereRaw('ID = ' . $item->ID)
                ->update(array('MailNo' => $No));
        }
        echo 'sukses';
        // }
        // catch(Exception $e)
        // {
        //     $pesan = $e->getMessage();
        // }

        //$arr = array('status' => '$hasil', 'msg' => $pesan);
        //return Response()->json($arr);
    }


    function compareSesionUserID($reportto, $unitid, $positionid)
    {
        $compareSesionUserID = DB::table('user')
            ->select('ID')
            ->whereRaw('ID =' . $reportto)
            ->whereRaw('UnitID =' . $unitid)
            ->whereRaw('PositionID =' . $positionid)
            ->get();

        return $compareSesionUserID;
    }
}
