<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminHocPhiController extends Controller
{
    public function index()
    {
        return view('admin.hocphi.index');
    }
}
