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
                return view('pages.customer.export',$datas);
                break;

            default:
                break;
        }
    }
}
