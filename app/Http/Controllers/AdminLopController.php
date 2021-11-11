<?php

namespace App\Http\Controllers;

use App\GiaoVien;
use App\Khoa;
use App\Lop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Traits\DeleteModelTrait;

class AdminLopController extends Controller
{
    use DeleteModelTrait;

    private $lop;
    private $giaovien;
    private $khoa;

    public function __construct(Lop $lop, GiaoVien $giaovien, Khoa $khoa)
    {
        $this->lop = $lop;
        $this->giaovien = $giaovien;
        $this->khoa = $khoa;
    }

    public function index()
    {
        $lops = $this->lop->latest()->paginate(35);
        return view('admin.lop.index', compact('lops'));
    }

    public function create()
    {
        $khoas = $this->khoa->all();
        $giaoviens = $this->giaovien->all();
        return view('admin.lop.add', compact('khoas', 'giaoviens'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->lop->create([
                'malop' => $request->malop,
                'makhoa' => $request->makhoa,
                'magvcn' => $request->magvcn,
                'siso' => $request->siso,
                'nienkhoa' => $request->nienkhoa,
            ]);
            DB::commit();
            return redirect()->route('lop.index');
        } catch (\Exception $exception) {
            Log::error('Message' . $exception->getMessage() . ' ------Line ' . $exception->getLine());
            DB::rollBack();

        }
    }

    public function edit($id)
    {
        $lop = $this->lop->where('malop', $id)->first();
        $khoas = $this->khoa->all();
        $giaoviens = $this->giaovien->all();
        return view('admin.lop.edit', compact('lop', 'khoas', 'giaoviens'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $this->lop->where('malop', $id)->update([
//                'malop' => $request->malop,
                'makhoa' => $request->makhoa,
                'magvcn' => $request->magvcn,
                'siso' => $request->siso,
                'nienkhoa' => $request->nienkhoa,
            ]);
            DB::commit();
            return redirect()->route('lop.index');
        } catch (\Exception $exception) {
            Log::error('Message' . $exception->getMessage() . ' ------Line ' . $exception->getLine());
            DB::rollBack();
        }
    }

    public function delete($id)
    {
        return $this->deleteModelTrait('malop', $id, $this->lop);
    }
}
