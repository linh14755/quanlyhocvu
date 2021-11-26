<?php

namespace App\Imports;

use App\ChiTietLopHocPhan;
use App\HocPhan;
use App\Khoa;
use App\Lop;
use App\LopHocPhan;
use App\SinhVien;
use App\SinhvienLop;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ChiTietLopHocPhanImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
        //Sinh viên
        $masv = $row['ma_sv'];
        $tensv = $row['ho_lot'] . ' ' . $row['ten'];
        $ngaysinh = (isset($row['ngay_sinh']) && $row['ngay_sinh'] != '') ? $row['ngay_sinh'] : '';

        //Khoa
        $tenkhoa = (isset($row['thuoc_khoa']) && $row['thuoc_khoa'] != '') ? $row['thuoc_khoa'] : 0;
        //Lớp
        $lops = (isset($row['ma_lop']) && $row['ma_lop'] != '') ? $row['ma_lop'] : 0;
        $lops = explode(',', $lops);
        // Lớp học phần
        $malhp = (isset($row['ma_lhp'])) ? $row['ma_lhp'] : '0';
        $mahp = (isset($row['ma_hp'])) ? $row['ma_hp'] : '0';
        $tenhp = (isset($row['ten_hp'])) ? $row['ten_hp'] : '';
        $loaihp = (isset($row['loai_hp'])) ? $row['loai_hp'] : '';
        $sotc = (isset($row['so_tc'])) ? $row['so_tc'] : '0';
        $ngaydk = (isset($row['ngay_dk'])) ? $row['ngay_dk'] : '';

        //Check xem sinh viên đã đăng ký mã học phần này, và trong lớp học phần này chưa nếu có thì dừng
        $checkValid = ChiTietLopHocPhan::where('malhp', $malhp)->where('mahp', $mahp)->where('masv', $masv)->get();
        if (count($checkValid) != 0) {
            DB::rollBack();
            throw new ModelNotFoundException('dữ liệu bị trùng - MSSV: ' . $masv . ' đã đăng ký HP: ' . $mahp . ' với LHP: ' . $malhp);
        }


        //Check khoa đã tồn tại chưa
        $khoa = Khoa::where('tenkhoa', $tenkhoa)->get();
        if (count($khoa) == 0) {
            $khoanew = Khoa::create([
                'tenkhoa' => $tenkhoa,
            ]);
            $makhoa = $khoanew->id;
        } else {
            $makhoa = $khoa[0]->id;
        }


        foreach ($lops as $lop) {
            $lop = trim($lop);
            //Check lop da co chua khong thi tao
            $llop = Lop::where('malop', $lop)->get();

            if (count($llop) == 0) {
                Lop::create([
                    'malop' => $lop,
                    'makhoa' => $makhoa,
                    'magvcn' => 0,
                ]);
            }
            //Them lop cho sinh vien
            $sinhvienlop = SinhvienLop::where('masv', $masv)->where('malop', $lop)->get();
            if (count($sinhvienlop) == 0) {
                SinhvienLop::create([
                    'masv' => $masv,
                    'malop' => $lop
                ]);

                //Sinh viên chưa có trong lớp mới + 1 cho lớp, nếu có thì không cần +
                $lop = Lop::where('malop', $lop)->get();
                $sisonew = $lop[0]->siso + 1;
                Lop::where('malop', $lop[0]->malop)->update([
                    'siso' => $sisonew
                ]);
            }
        }

        //Thêm lớp học phần
        $lophocphan = LopHocPhan::where('malhp', $malhp)->get();
        if (count($lophocphan) == 0) {
            $lophocphannew = LopHocPhan::create([
                'malhp' => $malhp,
                'namhoc' => '20' . substr($malhp, 0, 2),
                'hocky' => substr($malhp, 2, 1),
            ]);
            $malhpnew = $lophocphannew->malhp;
        } else {
            $malhpnew = $malhp;
        }

        //Thêm học phần
        $hocphan = HocPhan::where('mahp', $mahp)->get();
        if (count($hocphan) == 0) {
            $hocphannew = HocPhan::create([
                'mahp' => $mahp,
                'tenhp' => $tenhp,
                'loai' => $loaihp,
                'stc' => $sotc
            ]);
            $mahpnew = $hocphannew->mahp;
        } else {
            $mahpnew = $mahp;
        }


        //Thêm sinh viên
        $sinhvien = SinhVien::where('masv', $masv)->get();
        if (count($sinhvien) == 0) {
            $sinhviennew = SinhVien::create([
                'masv' => $masv,
                'tensv' => $tensv,
            ]);
            $masvnew = $sinhviennew->masv;
        } else {
            $masvnew = $masv;
        }


        if ($ngaysinh != '') {
            $sinhviennew->update([
                'ngaysinh' => $ngaysinh,
            ]);
        }

        //Thêm chi tiết lớp học phần
        $chitietlophocphan = array(
            'malhp' => $malhpnew,
            'masv' => sprintf($masv),
            'mahp' => $mahpnew,
        );
        if ($ngaydk != '') {
            $chitietlophocphan = array(
                'malhp' => $malhpnew,
                'masv' => sprintf($masvnew),
                'mahp' => $mahpnew,
                'ngaydk' => $ngaydk
            );
        }

        return new ChiTietLopHocPhan($chitietlophocphan);
    }
}
