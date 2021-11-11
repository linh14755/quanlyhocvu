<?php

namespace App\Http\Controllers;

use App\PhuHuynh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Traits\DeleteModelTrait;

class AdminPhuHuynhController extends Controller
{
    use DeleteModelTrait;

    private $phuhuynh;

    public function __construct(PhuHuynh $phuhuynh)
    {
        $this->phuhuynh = $phuhuynh;
    }

    public function index()
    {
        $phuhuynhs = $this->phuhuynh->latest()->paginate(35);
        return view('admin.phuhuynh.index', compact('phuhuynhs'));
    }

    public function create()
    {
        return view('admin.phuhuynh.add');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->phuhuynh->create([
                'tenph' => $request->tenph,
                'sodt' => $request->sodt,
                'diachi' => $request->diachi,
                'matkhau' => Hash::make($request->matkhau),
            ]);
            DB::commit();
            return redirect()->route('phuhuynh.index');
        } catch (\Exception $exception) {
            Log::error('Message' . $exception->getMessage() . ' ------Line ' . $exception->getLine());
            DB::rollBack();
        }
    }

    public function edit($id)
    {
        $phuhuynh = $this->phuhuynh->find($id);
        return view('admin.phuhuynh.edit', compact('phuhuynh'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            if ($request->matkhau != '') {
                $this->phuhuynh->find($id)->update([
                    'tenph' => $request->tenph,
                    'sodt' => $request->sodt,
                    'diachi' => $request->diachi,
                    'matkhau' => Hash::make($request->matkhau),
                ]);
            } else {
                $this->phuhuynh->find($id)->update([
                    'tenph' => $request->tenph,
                    'sodt' => $request->sodt,
                    'diachi' => $request->diachi,
                ]);
            }
            DB::commit();
            return redirect()->route('phuhuynh.index');
        } catch (\Exception $exception) {
            Log::error('Message' . $exception->getMessage() . ' ------Line ' . $exception->getLine());
            DB::rollBack();
        }
    }

    public function delete($id)
    {
        return $this->deleteModelTrait('id', $id, $this->phuhuynh);
    }
}
