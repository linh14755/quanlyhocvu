<?php

namespace App\Imports;

use App\ChiTietLopHocPhan;
use App\HocPhan;
use App\Khoa;
use App\Lop;
use App\LopHocPhan;
use App\SinhVien;
use App\SinhvienLop;
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
        //Sinh viên
        $masv = $row['ma_sv'];
        $tensv = $row['ho_lot'] . ' ' . $row['ten'];
        $ngaysinh = (isset($row['ngay_sinh']) && $row['ngay_sinh'] != '') ? $row['ngay_sinh'] : '';
        $maph1 = (isset($row['maph1'])) ? $row['maph1'] : '0';
        $maph2 = (isset($row['maph2'])) ? $row['maph2'] : '0';
        $quanheph1 = (isset($row['quanheph1'])) ? $row['quanheph1'] : '0';
        $quanheph2 = (isset($row['quanheph2'])) ? $row['quanheph2'] : '0';
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
                //sau khi tạo khoa và lớp thành công cộng 1 cho sĩ số lớp
                $lop = Lop::where('malop', $lop)->get();
                $sisonew = $lop[0]->siso + 1;
                Lop::where('malop', $lop[0]->malop)->update([
                    'siso' => $sisonew
                ]);
            }
            //Them lop cho sinh vien
            SinhvienLop::create([
                'masv' => $masv,
                'malop' => $lop
            ]);
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

        //Thêm chi tiết lớp học phần
        $chitietlophocphan = ChiTietLopHocPhan::create([
            'malhp' => $malhpnew,
            'masv' => $masv,
            'mahp' => $mahpnew,
        ]);
        if ($ngaydk != '') {
            $chitietlophocphan->update([
                'ngaydk' => $ngaydk
            ]);
        }

        if ($ngaysinh != '') {
            $arr = array(
                'masv' => $masv,
                'tensv' => $tensv,
                'ngaysinh' => $ngaysinh,
                'maph1' => $maph1,
                'maph2' => $maph2,
                'quanheph1' => $quanheph1,
                'quanheph2' => $quanheph2,
            );
        } else {
            $arr = array(
                'masv' => $masv,
                'tensv' => $tensv,
                'maph1' => $maph1,
                'maph2' => $maph2,
                'quanheph1' => $quanheph1,
                'quanheph2' => $quanheph2,
            );
        }

        return new SinhVien($arr);
    }
}
