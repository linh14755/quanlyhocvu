<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\PhuHuynh;
use App\SessionUser;
use App\SinhVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $phuhuynh = PhuHuynh::where('sodt', $request->sdt)->first();
        if (Hash::check($request->password, $phuhuynh->matkhau)) {
            $listsv = SinhVien::where('maph1', $phuhuynh->sodt)->orWhere('maph2', $phuhuynh->sodt)->get();
            return response()->json([
                'code' => 200,
                'message' => 'Đăng nhập thành công',
                'sinhvien' => $listsv,
                'phuhuynh' => $phuhuynh
            ], 200);
        } else {
            return response()->json([
                'code' => 500,
                'message' => 'Sai thông tin đăng nhập'
            ], 200);
        }
    }

    public function resetPassword(Request $request)
    {
        try {
            DB::beginTransaction();

            $check = PhuHuynh::where('sodt', $request->sodt)->first();
            if (!empty($check)) {
                //reset password
                //rand new password
                $new_password = strval(rand(100000, 999999));
                //update data
                PhuHuynh::where('sodt', $request->sodt)->update(['matkhau' => Hash::make($new_password)]);
                //send_mail
                $to_mail = $check->email;
                //data này là biến truyền qua view send_mail.blade
                $data = array('new_password' => $new_password);
                Mail::send('admin.phuhuynh.send_mail', $data, function ($message) use ($to_mail) {
                    $message->to($to_mail)->subject('Lấy lại mật khẩu');
                    $message->from('linhnkctk42@gmail.com', 'Hệ thống cảnh báo học vụ');
                });
            } else {
                return response()->json([
                    'code' => 500,
                    'message' => 'Số điện thoại không tồn tại'
                ]);
            }

            DB::commit();
            return response()->json([
                'code' => 200,
                'message' => 'Mật khẩu mới đã được gửi vào email: ' . $to_mail
            ]);
        } catch (\Exception $exception) {
            Log::error('Message' . $exception->getMessage() . ' ------Line ' . $exception->getLine());
            DB::rollBack();
        }
    }

    public function changePassword(Request $request)
    {
        try {
            DB::beginTransaction();
            $sodt = $request->sodt;
            $old_password = $request->old_password;
            $new_password = Hash::make($request->new_password);

            //Check mat khau cu
            $phuhuynh = PhuHuynh::where('sodt', $sodt)->first();
            if (Hash::check($old_password, $phuhuynh->matkhau)) {
                PhuHuynh::where('sodt', $sodt)->update(['matkhau' => $new_password]);
            } else {
                return response()->json([
                    'code' => 500,
                    'message' => 'Sai thông tin tài khoản hoặc mật khẩu!'
                ]);
            }

            DB::commit();
            return response()->json([
                'code' => 200,
                'message' => 'Mật khẩu đã được đổi thành công!'
            ]);
        } catch (\Exception $exception) {
            Log::error('Message' . $exception->getMessage() . ' ------Line ' . $exception->getLine());
            DB::rollBack();
        }
    }
}
