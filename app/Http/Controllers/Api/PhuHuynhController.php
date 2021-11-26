<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\PhuHuynh;
use App\SessionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PhuHuynhController extends Controller
{
    public function index(Request $request)
    {
//        $token = $request->header('token');
//        $checkTokenIsValid = SessionUser::where('token',$token)->first();
//        if (empty($token)){
//            return response()->json([
//                'code'=> 401,
//                'message'=> 'token khong duoc gui thong qua header',
//            ], 401);
//        }elseif(empty($checkTokenIsValid)){
//            return response()->json([
//                'code'=> 401,
//                'message'=> 'token khong hop le',
//            ], 401);
//        }else{
//            $phuHuynh = PhuHuynh::all();
//            return response()->json([
//                'code'=> 200,
//                'data'=> $phuHuynh
//            ], 200);
//        }
        $phuHuynh = PhuHuynh::all();
        return response()->json([
            'code' => 200,
            'data' => $phuHuynh
        ], 200);
    }

    public function login(Request $request)
    {
        $phuhuynh = PhuHuynh::where('sodt',$request->sodt)->first();

        if (Hash::check($request->matkhau, $phuhuynh->matkhau)) {
            return response()->json([
                'code' => 200,
                'data' => $phuhuynh
            ], 200);
        } else {
            return response()->json([
                'code' => 200,
                'data' => 'tai khoan hoac mat khau sai'
            ], 200);
        }
    }
}
