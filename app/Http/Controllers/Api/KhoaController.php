<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Khoa;
use App\SessionUser;

use Illuminate\Http\Request;

class KhoaController extends Controller
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
//            $khoa = Khoa::all();
//            return response()->json([
//                'code'=> 200,
//                'data'=> $khoa
//            ], 200);
//        }
        $khoa = Khoa::all();
        return response()->json([
            'code'=> 200,
            'data'=> $khoa
        ], 200);
    }
}
