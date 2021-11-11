@extends('layouts.admin')

@section('title')
    <title>Sửa phụ huynh</title>
@endsection


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    {{--    @include('partial.content-header',['name'=>'','key' =>''])--}}
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">

                    <div class="col-6 mt-5">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Thêm phụ huynh</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{route('phuhuynh.update',['id'=>$phuhuynh->id])}}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Tên PH</label>
                                        <input value="{{$phuhuynh->tenph}}" name="tenph" type="text" class="form-control" placeholder="Nhập tên phụ huynh">
                                    </div>
                                    <div class="form-group">
                                        <label>Số ĐT</label>
                                        <input value="{{$phuhuynh->sodt}}" name="sodt" type="text" class="form-control" placeholder="Nhập số điện thoại">
                                    </div>
                                    <div class="form-group">
                                        <label>Địa chỉ</label>
                                        <input value="{{$phuhuynh->diachi}}" name="diachi" type="text" class="form-control" placeholder="Nhập địa chỉ">
                                    </div>
                                    <div class="form-group">
                                        <label>Đặt lại mật Khẩu</label>
                                        <input name="matkhau" type="password" class="form-control" placeholder="Nhập mật khẩu mới">
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    <!-- /.content-wrapper -->
@endsection
