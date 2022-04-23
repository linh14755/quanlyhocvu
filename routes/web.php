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
        Route::get('/theokhoa/{makhoa}', [
            'as' => 'lop.theokhoa',
            'uses' => 'AdminLopController@theokhoa',
        ]);
    });

    //Giao vien
    Route::prefix('giaovien')->group(function () {
        Route::get('/', [
            'as' => 'giaovien.index',
            'uses' => 'AdminGiaoVienController@index',
        ]);
        Route::get('/create', [
            'as' => 'giaovien.create',
            'uses' => 'AdminGiaoVienController@create',
        ]);
        Route::post('/store', [
            'as' => 'giaovien.store',
            'uses' => 'AdminGiaoVienController@store',
        ]);
        Route::get('/edit/{id}', [
            'as' => 'giaovien.edit',
            'uses' => 'AdminGiaoVienController@edit',
        ]);
        Route::post('/update/{id}', [
            'as' => 'giaovien.update',
            'uses' => 'AdminGiaoVienController@update',
        ]);

        Route::get('/delete/{id}', [
            'as' => 'giaovien.delete',
            'uses' => 'AdminGiaoVienController@delete',
        ]);

        Route::get('/import-form', [
            'as' => 'giaovien.import-form',
            'uses' => 'AdminGiaoVienController@importForm',
        ]);
        Route::post('/import', [
            'as' => 'giaovien.import',
            'uses' => 'AdminGiaoVienController@import',
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

        Route::get('/import-form', [
            'as' => 'phuhuynh.import-form',
            'uses' => 'AdminPhuHuynhController@importForm',
        ]);

        Route::post('/import', [
            'as' => 'phuhuynh.import',
            'uses' => 'AdminPhuHuynhController@import',
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
        Route::get('/theolop/{malop}', [
            'as' => 'sinhvien.theolop',
            'uses' => 'AdminSinhVienController@theolop',
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

    //Lop hoc phan
    Route::prefix('lophocphan')->group(function () {
        Route::get('/', [
            'as' => 'lophocphan.index',
            'uses' => 'AdminLopHocPhanController@index',
        ]);
        Route::get('/create', [
            'as' => 'lophocphan.create',
            'uses' => 'AdminLopHocPhanController@create',
        ]);
        Route::get('/theolhp/{malhp}', [
            'as' => 'lophocphan.theolhp',
            'uses' => 'AdminLopHocPhanController@theolhp',
        ]);
        Route::post('/chitiet', [
            'as' => 'lophocphan.chitiet',
            'uses' => 'AdminLopHocPhanController@chitiet',
        ]);
    });

    //Hoc phan
    Route::prefix('hocphan')->group(function () {
        Route::get('/', [
            'as' => 'hocphan.index',
            'uses' => 'AdminHocPhanController@index',
        ]);
        Route::get('/theohocphan/{mahp}', [
            'as' => 'hocphan.theohocphan',
            'uses' => 'AdminHocPhanController@theohocphan',
        ]);

        Route::get('/bangdiem/import-form', [
            'as' => 'hocphan.bangdiem-import-form',
            'uses' => 'AdminHocPhanController@bangDiemImportForm',
        ]);
        Route::post('/bangdiem/import', [
            'as' => 'hocphan.bangdiem-import',
            'uses' => 'AdminHocPhanController@bangDiemImport',
        ]);

        Route::get('/get-lop-from-khoa', [
            'as' => 'hocphan.get-lop-va-hoc-phan-from-khoa',
            'uses' => 'AdminHocPhanController@getLopVaHocPhanFromKhoa',
        ]);
    });

    //Chi tiet lop hoc phan
    Route::prefix('chitietlophocphan')->group(function () {
        Route::get('/', [
            'as' => 'chitietlophocphan.index',
            'uses' => 'AdminChiTietLopHocPhanController@index',
        ]);
        Route::get('/chitiet/{masv}/{malhp}', [
            'as' => 'chitietlophocphan.chitiet',
            'uses' => 'AdminChiTietLopHocPhanController@chitiet',
        ]);
        Route::get('/import-form', [
            'as' => 'chitietlophocphan.import-form',
            'uses' => 'AdminChiTietLopHocPhanController@importForm',
        ]);
        Route::post('/import', [
            'as' => 'chitietlophocphan.import',
            'uses' => 'AdminChiTietLopHocPhanController@import',
        ]);
        Route::get('/theosinhvien/{masv}', [
            'as' => 'chitietlophocphan.theosinhvien',
            'uses' => 'AdminChiTietLopHocPhanController@theosinhvien',
        ]);
    });

    //diem ren luyen
    Route::prefix('diemrenluyen')->group(function () {
        Route::get('/', [
            'as' => 'diemrenluyen.index',
            'uses' => 'AdminDiemRenLuyenController@index',
        ]);

        Route::get('/import-form', [
            'as' => 'diemrenluyen.import-form',
            'uses' => 'AdminDiemRenLuyenController@importForm',
        ]);
        Route::post('/import', [
            'as' => 'diemrenluyen.import',
            'uses' => 'AdminDiemRenLuyenController@import',
        ]);

        Route::post('/chitiet', [
            'as' => 'diemrenluyen.chitiet',
            'uses' => 'AdminDiemRenLuyenController@chitiet',
        ]);
        Route::get('/chonkhoa', [
            'as' => 'diemrenluyen.chonkhoa',
            'uses' => 'AdminDiemRenLuyenController@chonkhoa',
        ]);

    });
    //thoikhoabieu
    Route::prefix('thoikhoabieu')->group(function () {
        Route::get('/', [
            'as' => 'thoikhoabieu.index',
            'uses' => 'AdminThoiKhoaBieuController@index',
        ]);

        Route::get('/import-form', [
            'as' => 'thoikhoabieu.import-form',
            'uses' => 'AdminThoiKhoaBieuController@importForm',
        ]);

        Route::post('/import', [
            'as' => 'thoikhoabieu.import',
            'uses' => 'AdminThoiKhoaBieuController@import',
        ]);

        Route::get('/getweek', [
            'as' => 'thoikhoabieu.getweek',
            'uses' => 'AdminThoiKhoaBieuController@getWeek',
        ]);

    });

    //diemdanh
    Route::prefix('diemdanh')->group(function () {
        Route::get('/', [
            'as' => 'diemdanh.index',
            'uses' => 'AdminDiemDanhController@index',
        ]);
        Route::get('/get-subject', [
            'as' => 'diemdanh.getsubject',
            'uses' => 'AdminDiemDanhController@getsubject',
        ]);

        Route::get('/import-form', [
            'as' => 'diemdanh.import-form',
            'uses' => 'AdminDiemDanhController@importForm',
        ]);

        Route::post('/import', [
            'as' => 'diemdanh.import',
            'uses' => 'AdminDiemDanhController@import',
        ]);
        Route::get('/timkhoa', [
            'as' => 'diemdanh.timkhoa',
            'uses' => 'AdminDiemDanhController@timkhoa',
        ]);
        Route::post('/timtheolop', [
            'as' => 'diemdanh.timtheolop',
            'uses' => 'AdminDiemDanhController@timtheolop',
        ]);
        Route::get('/chitiet_theosv', [
            'as' => 'diemdanh.chitiet_theosv',
            'uses' => 'AdminDiemDanhController@chitiet_theosv',
        ]);
        Route::get('/chitiet_diemdanh_theosv', [
            'as' => 'diemdanh.chitiet_diemdanh_theosv',
            'uses' => 'AdminDiemDanhController@chitiet_diemdanh_theosv',
        ]);
    });

    //hocphi
    Route::prefix('hocphi')->group(function () {
        Route::get('/', [
            'as' => 'hocphi.index',
            'uses' => 'AdminHocPhiController@index',
        ]);

    });
});

