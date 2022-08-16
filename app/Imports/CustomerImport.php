<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Customer;
use App\Models\SalesOwner;

class CustomerImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        unset($rows[0]);
        $rows = $rows->toArray();

        for($i=0;$i<count($rows);$i++)
        {
            $name       = $rows[$i+1][0];
            $address    = $rows[$i+1][1];
            $hp         = strval($rows[$i+1][2]);
            $email      = $rows[$i+1][3];
            $facebook   = $rows[$i+1][4];
            $instagram  = $rows[$i+1][5];
            $periode    = $rows[$i+1][6];
            $eid        = $rows[$i+1][7];
            $history    = $rows[$i+1][8];
            $status     = $rows[$i+1][9];

            $customer = Customer::updateOrCreate(
                            [
                                'hp' => $hp,
                            ],
                            [
                                'name' => $name,
                                'address' => $address,
                                'email' => $email,
                                'facebook' => $facebook,
                                'instagram' => $instagram,
                                'status' => $status,
                                'history' => $history,
                                'uby' => auth()->user()->id,
                                'cby' => auth()->user()->id,
                            ]
                         );

            $cid    = $customer->id;
            SalesOwner::updateOrCreate(
                [
                    'periode' => $periode,
                    'cid' => $cid,
                    'eid' => $eid,
                    'cby' => auth()->user()->id,
                ],
                [
                    'uby' => auth()->user()->id,
                ]
            );
        }
        echo 'Berhasil';
    }
}
