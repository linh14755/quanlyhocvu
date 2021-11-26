<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Lop;
use App\SessionUser;
use Illuminate\Http\Request;

class LopController extends Controller
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
//            $Lop = Lop::all();
//            return response()->json([
//                'code'=> 200,
//                'data'=> $Lop
//            ], 200);
//        }
        $Lop = Lop::all();
        return response()->json([
            'code' => 200,
            'data' => $Lop
        ], 200);
    }

    public function show($id)
    {
        return Lop::where('malop', $id)->get();
    }
}
