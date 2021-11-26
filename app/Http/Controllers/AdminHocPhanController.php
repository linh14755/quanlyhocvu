<?php

namespace App\Http\Controllers;

use App\ChiTietLopHocPhan;
use App\HocPhan;
use Illuminate\Http\Request;

class AdminHocPhanController extends Controller
{
    private $hocphan;
    private $chitietlhp;

    public function __construct(HocPhan $hocphan, ChiTietLopHocPhan $chchitietlhp)
    {
        $this->hocphan = $hocphan;
        $this->chitietlhp = $chchitietlhp;
    }

    public function index()
    {
        $hocphans = $this->hocphan->latest()->paginate(35);
        return view('admin.hocphan.index', compact('hocphans'));
    }

    public function theohocphan($mahp)
    {
        $chitietlhps = $this->chitietlhp->where('mahp', $mahp)->get();
        $tenhp = optional($chitietlhps[0]->hocphan)->tenhp;
        return view('admin.chitietlophocphan.index', compact('chitietlhps', 'tenhp'));
    }
}
