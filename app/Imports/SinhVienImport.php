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
        $masv = $row['ma_sv'];
        $tensv = $row['ho_lot'].' '.$row['ten'];
        $lop = $row['thuoc_lop'];
        $ngaysinh = (isset($row['ngay_sinh']) && $row['ngay_sinh'] != '') ? $row['ngay_sinh'] : '';
        $maph1 = (isset($row['maph1'])) ? $row['maph1'] : '0';
        $maph2 = (isset($row['maph2'])) ? $row['maph2'] : '0';
        $quanheph1 = (isset($row['quanheph1'])) ? $row['quanheph1'] : '0';
        $quanheph2 = (isset($row['quanheph2'])) ? $row['quanheph2'] : '0';
        if ($ngaysinh != '') {
            $arr = array(
                'masv' => $masv,
                'tensv' => $tensv,
                'ngaysinh' => $ngaysinh,
                'malop' => $lop,
                'maph1' => $maph1,
                'maph2' => $maph2,
                'quanheph1' => $quanheph1,
                'quanheph2' => $quanheph2,
            );
        } else {
            $arr = array(
                'masv' => $masv,
                'tensv' => $tensv,
                'malop' => $lop,
                'maph1' => $maph1,
                'maph2' => $maph2,
                'quanheph1' => $quanheph1,
                'quanheph2' => $quanheph2,
            );
        }

        return new SinhVien($arr);
    }
}
