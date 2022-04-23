<?php

namespace App\Http\Controllers;

use App\Imports\ChiTietLopHocPhanImport;
use App\Imports\PhuHuynhImport;
use App\PhuHuynh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Traits\DeleteModelTrait;
use Maatwebsite\Excel\Facades\Excel;

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
                'email' => $request->email,
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
        $phuhuynh = $this->phuhuynh->where('sodt', $id)->orWhere('id', $id)->first();

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
                    'email'=>$request->email,
                    'matkhau' => Hash::make($request->matkhau),
                ]);
            } else {
                $this->phuhuynh->find($id)->update([
                    'tenph' => $request->tenph,
                    'sodt' => $request->sodt,
                    'diachi' => $request->diachi,
                    'email'=>$request->email,
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

    public function importForm()
    {
        return view('admin.phuhuynh.import');
    }

    public function import(Request $request)
    {

        try {
            DB::beginTransaction();
            Excel::import(new PhuHuynhImport(), $request->file);
            DB::commit();

            return redirect()->back()->with('message', 'Import Successfully !!');
        } catch (\Exception $exception) {
            Log::error('Message: ' . $exception->getMessage() . ' ------Line ' . $exception->getLine());
            DB::rollBack();
            return redirect()->back()->with('message', 'Message: ' . $exception->getMessage());
        }
    }
}
