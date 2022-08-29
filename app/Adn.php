<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Adn{
    private $IsSuccess;
    private $Message;
    private $Obj;

    public static function Response($aSuccess,$aMessage,$aObj=null) {
        $paket['IsSuccess'] = $aSuccess;
        $paket['Message']= $aMessage;
        $paket['Obj'] = $aObj;
        return $paket;
    }

    public static function SetYMD($aDate) {
        $result = Date("Y-m-d",$aDate);
        return $result;
    }

    public static function SetdmYHi($aDate) {
        $result = Date("d/m/Y H:i",strtotime($aDate));
        return $result;
    }

    public static function setTglSd($aStrDate){
        $result =Date('Y-m-d', strtotime($aStrDate. ' + 1 days'));
        return $result;
    }

    public static function getSysVar($col){
        $result = DB::table('sys_var')
                ->where('sys_col','=',$col)
                ->value('sys_val');
        return $result;
    }

    public static function setSysVar($col,$val){
        $affected = DB::table('sys_var')
                    ->where('sys_col','=',$col)
                    ->update(['sys_val' => $val]);

        //DB::enableQueryLog();
        //Log::info(DB::getQueryLog());

        return $affected;
    }

    public static function setSortIcon($sort,$sortField, $kolom)
    {
        if($sortField==$kolom)
        {
            if($sort=='asc')
            {
                return 'fa fa-sort-asc';
            }
            else
            {
                return 'fa fa-sort-desc';
            }
        }
        else
        {
            return 'fa fa-sort';
        }
    }
    public static function setSortData($sort,$sortField, $kolom)
    {
        if($sortField==$kolom)
        {
            return $sort;
        }
        else
        {
            return '';
        }
    }
    public static function setSortAktif($sortField, $kolom)
    {
        if($sortField==$kolom)
        {
            return 'sortAktif';
        }
        else
        {
            return 'sort';
        }
    }

}
