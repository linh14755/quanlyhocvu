<?php

namespace App\Imports;

use App\GiaoVien;
use App\Khoa;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GiaoVienImport implements ToModel, SkipsEmptyRows, WithHeadingRow
{

    public function model(array $row)
    {
        $tenkhoa = (isset($row['thuoc_khoa']) && $row['thuoc_khoa'] != '') ? $row['thuoc_khoa'] : 0;

        //Check khoa đã tồn tại chưa
        $khoa = Khoa::where('tenkhoa', $tenkhoa)->get();

        if (count($khoa) != 0) {
            $makhoa = $khoa[0]->id;
            return new GiaoVien([
                'tengv' => $row['ten_gv'],
                'sodt' => $row['so_dt'],
                'email' => $row['email'],
                'facebook' => $row['facebook'],
                'makhoa' => $makhoa
            ]);
        }

    }
}




