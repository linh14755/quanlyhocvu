@extends('layouts.admin')

@section('title')
    <title>Lớp học phần</title>
@endsection

@section('js')
    <script src="{{asset('admins/js/main.js')}}"></script>
    <script src="{{asset('vendors/sweetAlert2/sweetalert2@10.js')}}"></script>
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
                <div class="row mb-3 pt-3">
                    <div class="col-3">
                        <a href="{{route('chitietlophocphan.import-form')}}" type="button" class="btn btn-success"><i
                                class="fa fa-table" aria-hidden="true"></i>
                            Import - Chi tiết kết quả đăng ký lớp học phần</a>


                    </div>
                    <div class="col-3">
                        <a href="{{route('hocphan.bangdiem-import-form')}}" type="button" class="btn btn-success"><i
                                class="fa fa-table" aria-hidden="true"></i>
                            Import - Chi tiết bảng điểm lớp học phần</a>
                    </div>
                </div>
                <div class="row">

                    <div class="col-6">
                        <div class="card">
                            <div class="card-header row">
                                <h3 class="card-title col-4">Lớp học phần</h3>

                                <div class="card-tools col-8">
                                    <div class="input-group input-group-sm">
                                        {{--                                        <input type="text" name="table_search" class="form-control float-right"--}}
                                        {{--                                               placeholder="Search">--}}

                                        {{--                                        <div class="input-group-append">--}}
                                        {{--                                            <button type="submit" class="btn btn-default">--}}
                                        {{--                                                <i class="fas fa-search"></i>--}}
                                        {{--                                            </button>--}}
                                        {{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-2">
                                <form action="{{route('lophocphan.chitiet')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Khoa</label>
                                        <select class="form-control" name="khoa">
                                            @foreach($khoas as $item)
                                                <option value="{{$item->makhoa}}">{{$item->tenkhoa.' - '.$item->makhoa}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Năm học</label>
                                        <select class="form-control" name="namhoc">
                                            @foreach($namhocs as $item)
                                                <option>{{$item->namhoc}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Học kỳ</label>
                                        <select class="form-control" name="hocky">
                                            <option value="1">HK01</option>
                                            <option value="2">HK02</option>
                                            <option value="3">HK03</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Chọn</button>
                                </form>
                            </div>
                            <!-- /.card-body -->
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
