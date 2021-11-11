<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin', 'AdminController@loginAdmin');
Route::post('/admin', 'AdminController@postloginAdmin');

Route::get('/admin/home', function () {
    return view('admin.home');
});


//Admin
Route::prefix('admin')->group(function () {
    //logout
    Route::get('/', [
        'as' => 'logout.logout',
        'uses' => 'AdminController@logout'
    ]);

    //DangKyHocPhan
    Route::prefix('dangkyhocphan')->group(function () {
        Route::get('/', [
            'as' => 'dangkyhocphan.index',
            'uses' => 'AdminDangKyHocPhanController@index',
        ]);

    });
    //Khoa
    Route::prefix('khoa')->group(function () {
        Route::get('/', [
            'as' => 'khoa.index',
            'uses' => 'AdminKhoaController@index',
        ]);

        Route::get('/create', [
            'as' => 'khoa.create',
            'uses' => 'AdminKhoaController@create',
        ]);

        Route::post('/store', [
            'as' => 'khoa.store',
            'uses' => 'AdminKhoaController@store',
        ]);
        Route::get('/edit/{id}', [
            'as' => 'khoa.edit',
            'uses' => 'AdminKhoaController@edit',
        ]);
        Route::post('/update/{id}', [
            'as' => 'khoa.update',
            'uses' => 'AdminKhoaController@update',
        ]);
        Route::get('/delete/{id}', [
            'as' => 'khoa.delete',
            'uses' => 'AdminKhoaController@delete',
        ]);
    });

    //Lop
    Route::prefix('lop')->group(function () {
        Route::get('/', [
            'as' => 'lop.index',
            'uses' => 'AdminLopController@index',
        ]);
        Route::get('/create', [
            'as' => 'lop.create',
            'uses' => 'AdminLopController@create',
        ]);
        Route::post('/store', [
            'as' => 'lop.store',
            'uses' => 'AdminLopController@store',
        ]);
        Route::get('/edit/{id}', [
            'as' => 'lop.edit',
            'uses' => 'AdminLopController@edit',
        ]);
        Route::post('/update/{id}', [
            'as' => 'lop.update',
            'uses' => 'AdminLopController@update',
        ]);
        Route::get('/delete/{id}', [
            'as' => 'lop.delete',
            'uses' => 'AdminLopController@delete',
        ]);
    });

    //Phu huynh
    Route::prefix('phuhuynh')->group(function () {
        Route::get('/', [
            'as' => 'phuhuynh.index',
            'uses' => 'AdminPhuHuynhController@index',
        ]);

        Route::get('/create', [
            'as' => 'phuhuynh.create',
            'uses' => 'AdminPhuHuynhController@create',
        ]);
        Route::post('/store', [
            'as' => 'phuhuynh.store',
            'uses' => 'AdminPhuHuynhController@store',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'phuhuynh.edit',
            'uses' => 'AdminPhuHuynhController@edit',
        ]);

        Route::post('/update/{id}', [
            'as' => 'phuhuynh.update',
            'uses' => 'AdminPhuHuynhController@update',
        ]);

        Route::get('/delete/{id}', [
            'as' => 'phuhuynh.delete',
            'uses' => 'AdminPhuHuynhController@delete',
        ]);
    });

    //Sinh vien
    Route::prefix('sinhvien')->group(function () {
        Route::get('/', [
            'as' => 'sinhvien.index',
            'uses' => 'AdminSinhVienController@index',
        ]);

        Route::get('/create', [
            'as' => 'sinhvien.create',
            'uses' => 'AdminSinhVienController@create',
        ]);

        Route::post('/store', [
            'as' => 'sinhvien.store',
            'uses' => 'AdminSinhVienController@store',
        ]);

        Route::get('/edit/{id}', [
            'as' => 'sinhvien.edit',
            'uses' => 'AdminSinhVienController@edit',
        ]);

        Route::post('/update/{id}', [
            'as' => 'sinhvien.update',
            'uses' => 'AdminSinhVienController@update',
        ]);

        Route::get('/delete/{id}', [
            'as' => 'sinhvien.delete',
            'uses' => 'AdminSinhVienController@delete',
        ]);

        Route::get('/import-form', [
            'as' => 'sinhvien.import-form',
            'uses' => 'AdminSinhVienController@importForm',
        ]);
        Route::post('/import', [
            'as' => 'sinhvien.import',
            'uses' => 'AdminSinhVienController@import',
        ]);
    });
});

