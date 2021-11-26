<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//api-register
Route::post('register','Api\RegisterController@register');
//login-create_token
Route::post('login','Api\LoginController@login');
//Lop
Route::get('lop','Api\LopController@index');
Route::get('lop/{id}','Api\LopController@show');
//SinhVien
Route::get('sinhvien','Api\SinhVienController@index');
Route::get('sinhvien/{id}','Api\SinhVienController@show');
//Khoa
Route::get('khoa','Api\KhoaController@index');
Route::get('khoa/{id}','Api\KhoaController@show');
//PhuHuynh
Route::get('phuhuynh','Api\PhuHuynhController@index');

//GiaoVien
Route::get('giaovien','Api\GiaoVienController@index');
Route::get('giaovien/{id}','Api\GiaoVienController@show');

