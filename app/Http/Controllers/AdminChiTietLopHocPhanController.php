<?php

namespace App\Http\Controllers;

use App\ChiTietLopHocPhan;
use App\Imports\ChiTietLopHocPhanImport;
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

    public function chitiet($masv)
    {
        $chitietlhp = $this->chitietlhp->where('masv', $masv)->first();
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
        $chitietlhps = $this->chitietlhp->where('masv', $masv)->get();
        $tensv = optional($chitietlhps[0]->sinhvien)->tensv;
        return view('admin.chitietlophocphan.index', compact('chitietlhps', 'tensv'));
    }
}
