<?php

namespace App\Imports;

use App\SinhVien;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SinhVienImport implements ToModel, WithHeadingRow
{
    /**
     * /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $ngaysinh = (isset($row['ngaysinh']) && $row['ngaysinh'] != '') ? $row['ngaysinh'] : '';
        $maph1 = (isset($row['maph1'])) ? $row['maph1'] : '0';
        $maph2 = (isset($row['maph2'])) ? $row['maph2'] : '0';
        $quanheph1 = (isset($row['quanheph1'])) ? $row['quanheph1'] : '0';
        $quanheph2 = (isset($row['quanheph2'])) ? $row['quanheph2'] : '0';
        if ($ngaysinh != '') {
            $arr = array(
                'masv' => $row['masv'],
                'tensv' => $row['hoten'],
                'ngaysinh' => $ngaysinh,
                'malop' => $row['lop'],
                'maph1' => $maph1,
                'maph2' => $maph2,
                'quanheph1' => $quanheph1,
                'quanheph2' => $quanheph2,
            );
        } else {
            $arr = array(
                'masv' => $row['masv'],
                'tensv' => $row['hoten'],
                'malop' => $row['lop'],
                'maph1' => $maph1,
                'maph2' => $maph2,
                'quanheph1' => $quanheph1,
                'quanheph2' => $quanheph2,
            );
        }

        return new SinhVien($arr);
    }
}
