<?php

namespace App\Http\Controllers;

use App\Imports\SinhVienImport;
use App\Lop;
use App\PhuHuynh;
use App\QuanheSvPh;
use App\SinhVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Traits\DeleteModelTrait;
use Maatwebsite\Excel\Facades\Excel;

class AdminSinhVienController extends Controller
{
    use DeleteModelTrait;

    private $sinhvien;
    private $lop;
    private $phuhuynh;
    private $quanhe_sv_ph;

    public function __construct(SinhVien $sinhvien, Lop $lop, PhuHuynh $phuhuynh, QuanheSvPh $quanhe_sv_ph)
    {
        $this->sinhvien = $sinhvien;
        $this->lop = $lop;
        $this->phuhuynh = $phuhuynh;
        $this->quanhe_sv_ph = $quanhe_sv_ph;
    }

    public function index()
    {
        $lsinhvien = $this->sinhvien->latest()->paginate(35);
        return view('admin.sinhvien.index', compact('lsinhvien'));
    }

    public function create()
    {
        $lops = $this->lop->all();
        $phuhuynhs = $this->phuhuynh->all();
        $quanhe_sv_phs = $this->quanhe_sv_ph->all();
        return view('admin.sinhvien.add', compact('lops', 'phuhuynhs', 'quanhe_sv_phs'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->sinhvien->create([
                'masv' => $request->masv,
                'tensv' => $request->tensv,
                'ngaysinh' => $request->ngaysinh,
                'malop' => $request->malop,
                'maph1' => $request->maph1,
                'maph2' => $request->maph2,
                'quanheph1' => $request->quanheph1,
                'quanheph2' => $request->quanheph2,
            ]);
            DB::commit();
            return redirect()->route('sinhvien.index');
        } catch (\Exception $exception) {
            Log::error('Message' . $exception->getMessage() . ' ------Line ' . $exception->getLine());
            DB::rollBack();
        }
    }

    public function edit($id)
    {
        $sinhvien = $this->sinhvien->where('masv', $id)->first();
        $lops = $this->lop->all();
        $phuhuynhs = $this->phuhuynh->all();
        $quanhe_sv_phs = $this->quanhe_sv_ph->all();
        return view('admin.sinhvien.edit', compact('sinhvien', 'lops', 'phuhuynhs', 'quanhe_sv_phs'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $this->sinhvien->where('masv', $id)->update([
//                'masv'=>$request->masv,
                'tensv' => $request->tensv,
                'ngaysinh' => $request->ngaysinh,
                'malop' => $request->malop,
                'maph1' => $request->maph1,
                'maph2' => $request->maph2,
                'quanheph1' => $request->quanheph1,
                'quanheph2' => $request->quanheph2,
            ]);
            DB::commit();
            return redirect()->route('sinhvien.index');
        } catch (\Exception $exception) {
            Log::error('Message' . $exception->getMessage() . ' ------Line ' . $exception->getLine());
            DB::rollBack();
        }
    }

    public function delete($id)
    {
        return $this->deleteModelTrait('masv', $id, $this->sinhvien);
    }

    public function importForm()
    {
        return view('admin.sinhvien.import');
    }

    public function import(Request $request)
    {
        try {
            DB::beginTransaction();
            Excel::import(new SinhVienImport, $request->file);
            DB::commit();

            return redirect()->back()->withStatus('Import successfully');
        } catch (\Exception $exception) {
            Log::error('Message' . $exception->getMessage() . ' ------Line ' . $exception->getLine());
            DB::rollBack();
        }
    }
}
