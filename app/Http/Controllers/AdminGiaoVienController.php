<?php

namespace App\Http\Controllers;

use App\GiaoVien;
use App\Khoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Traits\DeleteModelTrait;

class AdminGiaoVienController extends Controller
{
    use DeleteModelTrait;

    private $giaovien;
    private $khoa;

    public function __construct(GiaoVien $giaovien, Khoa $khoa)
    {
        $this->giaovien = $giaovien;
        $this->khoa = $khoa;
    }

    public function index()
    {
        $giaoviens = $this->giaovien->latest()->paginate(35);
        return view('admin.giaovien.index', compact('giaoviens'));
    }

    public function create()
    {
        $khoas = $this->khoa->all();
        return view('admin.giaovien.add', compact('khoas'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->giaovien->create([
                'tengv' => $request->tengv,
                'sodt' => $request->sodt,
                'email' => $request->email,
                'facebook' => $request->facebook,
                'makhoa' => $request->makhoa,
            ]);
            DB::commit();
            return redirect()->route('giaovien.index');
        } catch (\Exception $exception) {
            Log::error('Message' . $exception->getMessage() . ' ------Line ' . $exception->getLine());
            DB::rollBack();

        }
    }

    public function edit($id)
    {
        $giaovien = $this->giaovien->find($id);
        $khoas = $this->khoa->all();
        return view('admin.giaovien.edit', compact('giaovien', 'khoas'));
    }

    public function update(Request $request, $id)
    {

        try {
            DB::beginTransaction();
            $this->giaovien->find($id)->update([
                'tengv' => $request->tengv,
                'sodt' => $request->sodt,
                'email' => $request->email,
                'facebook' => $request->facebook,
                'makhoa' => $request->makhoa,
            ]);
            DB::commit();
            return redirect()->route('giaovien.index');
        } catch (\Exception $exception) {
            Log::error('Message' . $exception->getMessage() . ' ------Line ' . $exception->getLine());
            DB::rollBack();
        }

    }

    public function delete($id)
    {
        return $this->deleteModelTrait('id', $id, $this->giaovien);
    }
}
