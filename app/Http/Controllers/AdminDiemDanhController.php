<?php

namespace App\Http\Controllers;

use App\ChiTietLopHocPhan;
use App\DiemDanh;
use App\HocPhan;
use App\Imports\DiemDanhImport;
use App\Imports\GiaoVienImport;
use App\Khoa;
use App\Lop;
use App\LopHocPhan;
use App\SinhVien;
use App\ThoiKhoaBieu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

include(app_path() . '/Traits/simple_html_dom.php');

class AdminDiemDanhController extends Controller
{
    private $lophp;

    public function __construct(LopHocPhan $lophp)
    {
        $this->lophp = $lophp;
    }

    public function index()
    {


        $khoas = Khoa::all();

        return view('admin.diemdanh.index', compact('khoas'));


    }

    public function getsubject()
    {
        $class_student_id = $_GET['ClassStudentID'];
        $term_id = substr($_GET['TermID'], -1);
        $year_study = substr($_GET['YearStudy'], 2, 2);
        $malhp = $year_study . $term_id;
        $result = ThoiKhoaBieu::where('malhp', 'like', $malhp . '%')
            ->where('lop', 'like', '%' . $class_student_id . '%')
            ->groupby('tenhp')
            ->get();

        $data = "";
        foreach ($result as $item) {
            $data .= '<option value=' . $item['malhp'] . '>' . $item['tenhp'] . '</option>';
        }

        return response()->json([
            'code' => 200,
            'data' => $data
        ]);
    }

    public function importForm()
    {
        return view('admin.diemdanh.import');
    }

    public function import(Request $request)
    {
        try {
            DB::beginTransaction();
            $import = (new DiemDanhImport())
                ->fromFile($request->file->getClientOriginalName());
            Excel::import($import, $request->file);
            DB::commit();

            return redirect()->back()->with('message', 'Import Successfully !!');
        } catch (\Exception $exception) {
            Log::error('Message: ' . $exception->getMessage() . ' ------Line ' . $exception->getLine());
            DB::rollBack();
            return redirect()->back()->with('message', 'Message: ' . $exception->getMessage());
        }
    }

    public function timkhoa()
    {
        $khoa_id = $_GET['khoa'];
        $lops = Lop::where('makhoa', $khoa_id)->get();
        $html_option = '';
        foreach ($lops as $lop) {
            $html_option .= '<option value="' . $lop->malop . '">' . $lop->malop . '</option>';
        }

        return response()->json([
            'code' => 200,
            'html' => $html_option
        ]);
    }

    public function timtheolop(Request $request)
    {
        //Lay thong tin tu server cua truong
        $url = "http://qlgd.dlu.edu.vn";
        $year_study = array();
        $term_id = array();
        $week = array(); //tuần 10 thì giá trị là 11
        $class_student_id = array();
        //random tu 0 den 1
        $t = mt_rand(0, 10) / 10;


        $html = file_get_contents($url);
        //lay duoc html
        $data = preg_replace("/\r|\n/", "", $html);
        $html = str_get_html($data);

        //Tao mang year study
        $element = $html->find('#YearStudy', 0)->find('option');
        foreach ($element as $elemen) {
            $year_study[$elemen->value] = $elemen->plaintext;
        }
        //Tao mang term id
        $element = $html->find('#TermID', 0)->find('option');
        foreach ($element as $elemen) {
            $term_id[$elemen->value] = $elemen->plaintext;
        }

        $lop = $request->lop;
        $lsinhvien = DB::select("select * from sinh_viens sv, sinhvien_lops svl where sv.masv = svl.masv and svl.malop = '" . $lop . "'");

        return view('admin.diemdanh.list', compact('year_study', 'term_id', 'lsinhvien', 'lop'));


    }

    public function chitiet_theosv()
    {
        $masv = $_GET["idsv"];
        $chitietlhps = DB::table('chi_tiet_lop_hoc_phans')
            ->join('lop_hoc_phans', 'lop_hoc_phans.malhp', '=', 'chi_tiet_lop_hoc_phans.malhp')
            ->where('masv', $masv)
            ->orderBy('lop_hoc_phans.namhoc')
            ->orderBy('lop_hoc_phans.hocky')
            ->get();
        $sv = SinhVien::where('masv', $masv)->first();
        $arr_ctlhp = array();

        for ($i = 0; $i < count($chitietlhps); $i++) {
            $arr["namhoc"] = $chitietlhps[$i]->namhoc;
            $arr["hocky"] = $chitietlhps[$i]->hocky;
            $flag = false;
            foreach ($arr_ctlhp as $item) {
                if ($arr["namhoc"] == $item["namhoc"] && $arr["hocky"] == $item["hocky"]) {
                    $flag = true;
                }
            }
            if (!$flag) {
                array_push($arr_ctlhp, $arr);
            }
        }
        for ($i = 0; $i < count($chitietlhps); $i++) {
            for ($j = 0; $j < count($arr_ctlhp); $j++) {
                if ($chitietlhps[$i]->namhoc == $arr_ctlhp[$j]["namhoc"] && $chitietlhps[$i]->hocky == $arr_ctlhp[$j]["hocky"]) {
                    $hocphan = HocPhan::where('mahp', $chitietlhps[$i]->mahp)->first();

                    //masv
                    //tensv
                    //mahp
                    //tenhp
                    //stc
                    //diemtk
                    //diemquydoi
                    $arr = [
                        'malhp' => $chitietlhps[$i]->malhp,
                        'masv' => $sv->masv,
                        'tensv' => $sv->tensv,
                        'mahp' => $hocphan->mahp,
                        'tenhp' => $hocphan->tenhp,
                        'stc' => $hocphan->stc,
                        'diemtk' => $chitietlhps[$i]->diemtk,
                        'diemquydoi' => $chitietlhps[$i]->diemquydoi,
                    ];
                    $arr_ctlhp[$j]["ctlhp"][] = $arr;
                }
            }
        }

        $html_option = '<table style="text-align: start" class="table table-hover text-nowrap">' .
            '<thead>' .
            '<tr>' .
            '<th>STT</th>' .
            '<th>Mã học phần' .
            '</th>' .
            '<th>Tên học phần</th>' .
            '<th>Tín chỉ</th>' .

            '<th>Điểm tổng</br>' .
            'học phần' .
            '</th>' .
            '<th>Điểm quy đổi</th>' .
            '<th>Kết quả</th>' .
            '<th>Chi tiết</th>' .
            '<th>Điểm danh</th>' .

            '</tr>' .
            '</thead>' .
            '<tbody>';

        foreach ($arr_ctlhp as $ctlhp) {

            $html_option .= '<tr>' .
                '<td style="background-color: #c7d6f3; color: blue; font-weight: bold; " colspan="11">' .
                'Năm học : ' . $ctlhp["namhoc"] . ' - Học kỳ : ' . $ctlhp["hocky"] . '</td>' .
                '</tr>';
            $i = 0;
            foreach ($ctlhp["ctlhp"] as $chitietlhp) {
                //Tính phần trăm điểm danh
                $arr_phantram = array(
                    'co' => 0,
                    'vang' => 0
                );
                $danh_sach_phan_tram_diem_danh = DiemDanh::where('mssv', $masv)->where('malhp', $chitietlhp['malhp'])->get();
                if (count($danh_sach_phan_tram_diem_danh)){
                    foreach ($danh_sach_phan_tram_diem_danh as $item) {
                        $tt = trim($item->trangthai);
                        $tt = substr($tt, 0, 1);
                        if ($tt == 'P') {
                            $arr_phantram['co'] = $arr_phantram['co'] + 1;
                        } else {
                            $arr_phantram['vang'] = $arr_phantram['vang'] + 1;
                        }
                        //A la vang
                        //P la co mat
                    }
                    $phantram = $arr_phantram['co'] / ($arr_phantram['vang'] + $arr_phantram['co']) * 100;
                    $phan_tram_co = round($phantram);
                    $phan_tram_vang = 100 - $phan_tram_co;
                }else{
                    $phan_tram_co = 0;
                    $phan_tram_vang = 0;
                }

                //Tính phần trăm điểm danh
                $i = $i + 1;
                $html_option .= '<tr>' .
                    '<td>' . $i . '</td>' .
                    '<td>' . $chitietlhp["mahp"] . '</td>' .
                    '<td>' . $chitietlhp["tenhp"] . '</td>' .
                    '<td>' . $chitietlhp["stc"] . '</td>' .
                    '<td>' . $chitietlhp["diemtk"] . '</td>' .
                    '<td>' . $chitietlhp["diemquydoi"] . '</td>' .
                    '<td>';
                if ($chitietlhp["diemquydoi"] != '') {
                    $html_option .= ($chitietlhp["diemquydoi"] == 'F') ? "<img src='" . url('/storage/diem/Rot.png') . "' >" : "<img src='" . url('/storage/diem/Dau.png') . "' >";
                } else {
                    $html_option .= '<img style = "width: 22px"' .
                        'src="' . url('/storage/diem/question.png') . '">';
                }
                $html_option .=
                    '</td>' .
                    '<td>' .
                    '<a class="text-warning"' .
                    'href="' . route('chitietlophocphan.chitiet', ['masv' => $chitietlhp["masv"], 'malhp' => $chitietlhp["malhp"]]) . '">' .
                    '<img src="' . url('/storage/diem/detail.png') . '"' .
                    'style="width: 22px">' .
                    '</a>' .
                    '</td>' .


                    '<td>' .
                    '<a class="text-warning"' .
                    'href="' . route('diemdanh.chitiet_diemdanh_theosv', ['masv' => $chitietlhp["masv"], 'malhp' => $chitietlhp["malhp"]]) . '">' .
                    '<img src="' . url('/storage/diem/view.png') . '"' .
                    'style="width: 22px">' .
                    '</a>' .
                    '<div class="progress">
  <div class="progress-bar bg-success progress-bar-striped" role="progressbar" style="width: '.$phan_tram_co.'%" aria-valuenow="'.$phan_tram_co.'" aria-valuemin="0" aria-valuemax="100">'.$phan_tram_co.'%</div>
  <div class="progress-bar bg-danger progress-bar-striped" role="progressbar" style="width: '.$phan_tram_vang.'%" aria-valuenow="'.$phan_tram_vang.'" aria-valuemin="0" aria-valuemax="100"></div>
</div>' .
                    '</td>' .

                    '</tr>';
            }
        }
        $html_option .= '</tbody></table>';

        return response()->json([
            'code' => 200,
            'html' => $html_option
        ]);
    }

    public function chitiet_diemdanh_theosv()
    {
        $masv = $_GET['masv'];
        $malhp = $_GET['malhp'];
        $danhsach_diemdanh = DB::table('diem_danhs')
            ->join('lop_hoc_phans', 'lop_hoc_phans.malhp', 'diem_danhs.malhp')
            ->join('chi_tiet_lop_hoc_phans', 'chi_tiet_lop_hoc_phans.malhp', 'diem_danhs.malhp')
            ->join('hoc_phans', 'hoc_phans.mahp', 'chi_tiet_lop_hoc_phans.mahp')
            ->where('diem_danhs.mssv', $masv)
            ->where('diem_danhs.malhp', $malhp)
            ->groupBy('diem_danhs.ngay')
            ->get();
        $arr_phantram = array(
            'co' => 0,
            'vang' => 0
        );
        $tong_buoi_tkb = count(ThoiKhoaBieu::where('malhp', $malhp)->get());
        $sinhvien = SinhVien::where('masv', $masv)->first();
        if (count($danhsach_diemdanh) > 0) {

            foreach ($danhsach_diemdanh as $item) {
                $tt = trim($item->trangthai);
                $tt = substr($tt, 0, 1);
                if ($tt == 'P') {
                    $arr_phantram['co'] = $arr_phantram['co'] + 1;
                } else {
                    $arr_phantram['vang'] = $arr_phantram['vang'] + 1;
                }
                //A la vang
                //P la co mat
            }
            $phantram = $arr_phantram['co'] / ($arr_phantram['vang'] + $arr_phantram['co']) * 100;
            $arr_phantram['phantram'] = round($phantram);
            $arr_phantram['tong'] = $arr_phantram['vang'] + $arr_phantram['co'];


        }
        return view('admin.diemdanh.chitiet_diemdanh_theosv', compact('danhsach_diemdanh', 'sinhvien', 'arr_phantram', 'tong_buoi_tkb'));

    }
}
