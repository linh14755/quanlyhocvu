<?php

namespace App\Http\Controllers;

use App\Khoa;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Traits;

class AdminKhoaController extends Controller
{
    use DeleteModelTrait;
    private $khoa;

    public function __construct(Khoa $khoa)
    {
        $this->khoa = $khoa;
    }

    public function index()
    {
        $khoas = $this->khoa->latest()->paginate(35);
        return view('admin.khoa.index', compact('khoas'));
    }

    public function create()
    {
        return view('admin.khoa.add');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->khoa->create([
                'makhoa' => $request->makhoa,
                'tenkhoa' => $request->tenkhoa,
            ]);
            DB::commit();
            return redirect()->route('khoa.index');
        } catch (\Exception $exception) {
            Log::error('Message' . $exception->getMessage() . ' ------Line ' . $exception->getLine());
            DB::rollBack();

        }
    }

    public function edit($id)
    {
        $khoa = $this->khoa->where('makhoa', $id)->first();
        return view('admin.khoa.edit', compact('khoa'));
    }

    public function update(Request $request, $id)
    {
        if ($id != '') {
            try {
                DB::beginTransaction();
                $this->khoa->where('makhoa', $id)->update([
//                    'makhoa' => $request->makhoa,
                    'tenkhoa' => $request->tenkhoa,
                ]);
                DB::commit();
                return redirect()->route('khoa.index');
            } catch (\Exception $exception) {
                Log::error('Message' . $exception->getMessage() . ' ------Line ' . $exception->getLine());
                DB::rollBack();
            }
        }
    }

    public function delete($id)
    {
        return $this->deleteModelTrait('makhoa',$id, $this->khoa);
    }
}
