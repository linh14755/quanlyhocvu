<?php

namespace App\Http\Controllers;

use App\ChiTietLopHocPhan;
use App\Khoa;
use App\LopHocPhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminLopHocPhanController extends Controller
{
    private $lophp;
    private $chitietlhp;

    public function __construct(LopHocPhan $lophp, ChiTietLopHocPhan $chitietlhp)
    {
        $this->lophp = $lophp;
        $this->chitietlhp = $chitietlhp;
    }

    public function index()
    {
        $lophps = $this->lophp->latest()->paginate(35);
        $namhocs = DB::table('lop_hoc_phans')
            ->select('namhoc')
            ->groupBy('namhoc')
            ->get();
        $makhoas = DB::select('select substring(malhp,4,2) as khoa from lop_hoc_phans group by khoa');
        $khoas = array();
        foreach ($makhoas as $makhoa){
           $khoa =  Khoa::where('makhoa',$makhoa->khoa)->first();

            array_push($khoas,$khoa);
        }

        return view('admin.lophocphan.index', compact('lophps', 'namhocs', 'khoas'));
    }

    public function chitiet(Request $request)
    {
        $flag = substr($request->namhoc, 2, 2) . $request->hocky . $request->khoa;

        $lophps = DB::select('SELECT * FROM chi_tiet_lop_hoc_phans a, hoc_phans b, lop_hoc_phans c where a.malhp = c.malhp and a.mahp = b.mahp and a.malhp like "' . $flag . '%" GROUP BY a.malhp');

        return view('admin.lophocphan.chitiet', compact('lophps'));
    }

    public function create()
    {
        return view('admin.lophocphan.add');
    }

    public function theolhp($malhp)
    {
        $chitietlhps = $this->chitietlhp->where('malhp', $malhp)->get();
        $tenlhp = $malhp;

        return view('admin.chitietlophocphan.index', compact('chitietlhps', 'tenlhp'));
    }
}
