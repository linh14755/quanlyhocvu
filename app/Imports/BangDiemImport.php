<?php

namespace App\Imports;

use App\ChiTietLopHocPhan;
use App\HocPhan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BangDiemImport implements ToModel, SkipsEmptyRows, WithHeadingRow
{
    protected $fileName;
    protected $yearStudy;
    protected $termId;
    protected $khoa_id;
    protected $lop;
    protected $subject;

    public function fromFile(string $fileName, string $yearStudy, string $termId, string $khoa_id, string $lop, string $subject)
    {
        $this->fileName = $fileName;
        $this->yearStudy = $yearStudy;
        $this->termId = $termId;
        $this->khoa_id = $khoa_id;
        $this->lop = $lop;
        $this->subject = substr($subject, 0, strlen($subject) - 1);
        return $this;
    }

    public function model(array $row)
    {
//        stt" => 1
//  "ma_sinh_vien" => 2115182
//  "ho_lot" => "Nguyễn Duy "
//  "ten" => "Nguyên"
//  "stctl" => 13
//  "diem_10" => 7.16
//  "diem_4" => 2.69
//  "diem_tblt_10" => 7.16
//  "diem_tblt_4" => 2.69
//  "xep_loai_ht" => "Khá"
        try {
            DB::beginTransaction();
            $diem_duy_doi = '';
            $diem_tk_4 = intval($row['diem_tblt_10']);
            if ($diem_tk_4 < 4) {
                $diem_duy_doi = 'F';
            } elseif ($diem_tk_4 >= 4 && $diem_tk_4 < 5.5) {
                $diem_duy_doi = 'D';
            } elseif ($diem_tk_4 >= 5.5 && $diem_tk_4 < 7) {
                $diem_duy_doi = 'C';
            } elseif ($diem_tk_4 >= 7 && $diem_tk_4 < 8.5) {
                $diem_duy_doi = 'B';
            } else {
                $diem_duy_doi = 'A';
            }


            ChiTietLopHocPhan::where('malhp', 'like', $this->subject . '%')->where('masv', $row['ma_sinh_vien'])->update([
                'diemtk' => $row['diem_tblt_10'],
                'diemtkhe4' => $row['diem_tblt_4'],
                'diemquydoi' => $diem_duy_doi,
            ]);

            DB::commit();

            return null;
        } catch (\Exception $exception) {
            Log::error('Message: ' . $exception->getMessage() . ' ------Line ' . $exception->getLine());
            DB::rollBack();
            return null;
        }
    }
}
