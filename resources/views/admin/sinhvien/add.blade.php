@extends('layouts.admin')

@section('title')
    <title>Thêm Sinh viên</title>
@endsection

@section('css')
    <link href="{{asset('vendors\select2\select2.min.css')}}" rel="stylesheet"/>
@endsection

@section('js')
    <script src="{{asset('vendors\select2\select2.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
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
                                <h3 class="card-title">Thêm sinh viên</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{route('sinhvien.store')}}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Mã SV</label>
                                        <input name="masv" type="text" class="form-control"
                                               placeholder="Nhập mã sinh viên">
                                    </div>
                                    <div class="form-group">
                                        <label>Họ tên sinh viên</label>
                                        <input name="tensv" type="text" class="form-control"
                                               placeholder="Nhập họ tên sinh viên">
                                    </div>
                                    <div class="form-group">
                                        <label>Ngày sinh (tháng/ngày/năm)</label>
                                        <input value="@php echo date('Y-m-d'); @endphp" name="ngaysinh" type="date"
                                               class="form-control" placeholder="Nhập ngày sinh">
                                    </div>
                                    <div class="form-group">
                                        <label>Lớp</label>
                                        <select name="malop" class="form-control select2">
                                            <option value="0">Chọn lớp</option>
                                            @foreach($lops as $lop)
                                                <option value="{{$lop->malop}}">{{$lop->malop}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-8">
                                                <label>Phụ huynh 1</label>
                                                <select name="maph1" class="form-control select2">
                                                    <option value="0">Chọn phụ huynh 1</option>
                                                    @foreach($phuhuynhs as $phuhuynh)
                                                        <option
                                                            value="{{$phuhuynh->id}}">{{$phuhuynh->tenph .' - '.$phuhuynh->sodt}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <label>Quan hệ</label>
                                                <select name="quanheph1" class="form-control select2">
                                                    <option value="0">Chọn quan hệ</option>
                                                    @foreach($quanhe_sv_phs as $quanhe_sv_ph)
                                                        <option value="{{$quanhe_sv_ph->maquanhe}}">{{$quanhe_sv_ph->tenquanhe}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-8">
                                                <label>Phụ huynh 2</label>
                                                <select name="maph2" class="form-control select2">
                                                    <option value="0">Chọn phụ huynh 2</option>
                                                    @foreach($phuhuynhs as $phuhuynh)
                                                        <option
                                                            value="{{$phuhuynh->id}}">{{$phuhuynh->tenph .' - '.$phuhuynh->sodt}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <label>Quan hệ</label>
                                                <select name="quanheph2" class="form-control select2">
                                                    <option value="0">Chọn quan hệ</option>
                                                    @foreach($quanhe_sv_phs as $quanhe_sv_ph)
                                                        <option value="{{$quanhe_sv_ph->maquanhe}}">{{$quanhe_sv_ph->tenquanhe}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
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
