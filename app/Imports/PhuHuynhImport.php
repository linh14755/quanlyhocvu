<?php

namespace App\Imports;

use App\PhuHuynh;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PhuHuynhImport implements ToModel, SkipsEmptyRows, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $tenph = $row['ten_ph'];
        $sodt = $row['so_dt'];
        $diachi = $row['dia_chi'];
        $matkhau = Hash::make('123456');
        $masv = $row['ma_sv'];
        $email = $row['email'];

        DB::select('update sinh_viens SET maph1 = "' . $sodt . '" WHERE masv = ' . $masv);

        return new PhuHuynh([
            'tenph' => $tenph,
            'sodt' => $sodt,
            'diachi' => $diachi,
            'matkhau' => $matkhau,
            'email' => $email
        ]);
    }
}
