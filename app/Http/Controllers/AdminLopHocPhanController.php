<?php

namespace App\Http\Controllers;

use App\ChiTietLopHocPhan;
use App\LopHocPhan;
use Illuminate\Http\Request;

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
        return view('admin.lophocphan.index', compact('lophps'));
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
