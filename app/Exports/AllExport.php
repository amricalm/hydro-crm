<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AllExport implements FromView
{
    var $data;
    public function __construct(array $array)
    {
        $this->data = $array;
    }
    public function view(): View
    {
        $datas = $this->data;
        switch ($datas['type']) {
            case 'customer':
                unset($datas['type']);
                return view('pages.customer.export_customer',$datas);
                break;

            case 'employe':
                unset($datas['type']);
                return view('pages.customer.export_employe',$datas);
                break;

            case 'daily-report':
                unset($datas['type']);
                return view('pages.report.export_daily_report',$datas);
                break;

            case 'report-dtl':
                unset($datas['type']);
                return view('pages.report.export_report_dtl',$datas);
                break;

            default:
                break;
        }
    }
}
