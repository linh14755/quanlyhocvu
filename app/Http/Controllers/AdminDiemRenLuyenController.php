<?php

namespace App\Http\Controllers;

use App\Imports\ChiTietLopHocPhanImport;
use App\Imports\DiemRenLuyenImport;
use App\LopHocPhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Lop;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class AdminDiemRenLuyenController extends Controller
{
    private $lophp;
    private $lop;

    public function __construct(LopHocPhan $lophp, Lop $lop)
    {
        $this->lophp = $lophp;
        $this->lop = $lop;
    }

    public function index()
    {
        $lophps = $this->lophp->latest()->paginate(35);
        $lops = $this->lop->all();
        $namhocs = DB::table('lop_hoc_phans')
            ->select('namhoc')
            ->groupBy('namhoc')
            ->get();
        $khoas = DB::select('select substring(malhp,4,2) as khoa from lop_hoc_phans group by khoa');
        return view('admin.diemrenluyen.index', compact('lophps', 'namhocs', 'khoas', 'lops'));
    }

    public function importForm()
    {
        return view('admin.diemrenluyen.import');
    }

    public function import(Request $request)
    {
        try {
            DB::beginTransaction();
            Excel::import(new DiemRenLuyenImport(), $request->file);
            DB::commit();

            return redirect()->back()->with('message', 'Import Successfully !!');
        } catch (\Exception $exception) {
            Log::error('Message: ' . $exception->getMessage() . ' ------Line ' . $exception->getLine());
            DB::rollBack();
            return redirect()->back()->with('message', 'Message: ' . $exception->getMessage());
        }
    }

    public function chitiet(Request $request)
    {
        $drls = DB::select('SELECT * FROM diem_ren_luyens a, sinhvien_lops b, sinh_viens c WHERE a.masv = b.masv and a.masv = c.masv and b.malop = "' . $request->lop . '" AND a.namhoc = "' . $request->namhoc . '" AND a.hocky = "HK0' . $request->hocky . '"');

        return view('admin.diemrenluyen.chitiet', compact('drls'));
    }

    public function chonkhoa()
    {
        $khoa = DB::select('select * from khoas where makhoa = "' . $_GET['id'] . '"');

        $lops = $this->lop->where('makhoa', $khoa[0]->id)->get();
        return response()->json([
            'code' => 200,
            'message' => 'success',
            'data' => $lops
        ], 200);
    }
}
