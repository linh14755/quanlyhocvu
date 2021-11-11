<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDangKyHocPhanController extends Controller
{
    public function index()
    {
        return view('admin.dangkyhocphan.index');
    }
}
