<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Assessment;
use App\Models\Customer;
use App\Models\GradeWeight;

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


            Customer::updateOrCreate(
                [
                    'name' => $name,
                    'hp' => $hp,
                ],
                [
                    'address' => $address,
                    'email' => $email,
                    'facebook' => $facebook,
                    'instagram' => $instagram,
                    'uby' => auth()->user()->id,
                    'cby' => auth()->user()->id,
                ]
            );
        }
        echo 'Berhasil';
    }
}
