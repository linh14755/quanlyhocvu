<?php

namespace App\Http\Controllers;

use App\ChiTietLopHocPhan;
use App\HocPhan;
use App\Imports\ChiTietLopHocPhanImport;
use App\SinhVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class AdminChiTietLopHocPhanController extends Controller
{
    private $chitietlhp;

    public function __construct(ChiTietLopHocPhan $chitietlhp)
    {
        $this->chitietlhp = $chitietlhp;
    }

    public function index()
    {
        $chitietlhps = $this->chitietlhp->latest()->paginate(35);

        return view('admin.chitietlophocphan.index', compact('chitietlhps'));
    }

    public function chitiet($masv, $malhp)
    {
        $chitietlhp = $this->chitietlhp->where('masv', $masv)->where('malhp', $malhp)->first();
        return view('admin.chitietlophocphan.chitiet', compact('chitietlhp'));
    }

    public function importForm()
    {
        return view('admin.chitietlophocphan.import');
    }

    public function import(Request $request)
    {
        try {
            DB::beginTransaction();
            Excel::import(new ChiTietLopHocPhanImport(), $request->file);
            DB::commit();

            return redirect()->back()->with('message', 'Import Successfully !!');
        } catch (\Exception $exception) {
            Log::error('Message: ' . $exception->getMessage() . ' ------Line ' . $exception->getLine());
            DB::rollBack();
            return redirect()->back()->with('message', 'Message: ' . $exception->getMessage());
        }
    }

    public function theosinhvien($masv)
    {
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
                    $hocphan = HocPhan::where('mahp',$chitietlhps[$i]->mahp)->first();

                    //masv
                    //tensv
                    //mahp
                    //tenhp
                    //stc
                    //diemtk
                    //diemquydoi
                    $arr = [
                        'malhp'=>$chitietlhps[$i]->malhp,
                        'masv' =>$sv->masv,
                        'tensv' =>$sv->tensv,
                        'mahp' =>$hocphan->mahp,
                        'tenhp' =>$hocphan->tenhp,
                        'stc' =>$hocphan->stc,
                        'diemtk' =>$chitietlhps[$i]->diemtk,
                        'diemquydoi' =>$chitietlhps[$i]->diemquydoi,
                    ];
                    $arr_ctlhp[$j]["ctlhp"][] = $arr;
                }
            }
        }

        return view('admin.chitietlophocphan.theosv', compact('arr_ctlhp', 'sv'));
    }
}
