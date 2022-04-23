<?php

namespace App\Imports;

use App\DiemRenLuyen;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DiemRenLuyenImport implements ToModel, SkipsEmptyRows, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new DiemRenLuyen([
            'masv' => $row['mssv'],
            'diem' => $row['diem_cuoi'],
            'xeploai' => $row['xep_loai'],
            'namhoc' => $row['nam_hoc'],
            'hocky' => $row['ma_hoc_ky']
        ]);
    }
}
