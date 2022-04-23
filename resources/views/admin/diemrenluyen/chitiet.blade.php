@extends('layouts.admin')

@section('title')
    <title>Chi tiết điểm rèn luyện</title>
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
                <dvi class="row mb-3 pt-3">
                    <div class="col-4">
                        <a href="{{route('diemrenluyen.import-form')}}" type="button" class="btn btn-success"><i
                                class="fa fa-table" aria-hidden="true"></i>
                            Import</a>
                        {{--                        <a href="javascript:void(0)" type="button" class="btn btn-success"><i--}}
                        {{--                                class="fa fa-plus-square" aria-hidden="true"></i>--}}
                        {{--                            Add</a>--}}

                    </div>
                </dvi>
                <div class="row">

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header row">
                                <h3 class="card-title col-4">Danh sách điểm rèn luyện</h3>

                                <div class="card-tools col-8">
                                    <div class="input-group input-group-sm">
                                        <input type="text" name="table_search" class="form-control float-right"
                                               placeholder="Search">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>MSSV</th>
                                        <th>Họ tên</th>
                                        <th>Ngày sinh</th>
                                        <th>Lớp</th>
                                        <th>Điểm cuối</th>
                                        <th>Xếp loại</th>
                                        <th>Năm học</th>
                                        <th>Học kỳ</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 0 ?>
                                    @foreach($drls as $drl)
                                        <tr>
                                            <td><?php $i = $i + 1; echo $i ?></td>
                                            <td>{{$drl->masv}}</td>
                                            <td>{{$drl->tensv}}</td>
                                            <td>{{$drl->ngaysinh}}</td>
                                            <td>{{$drl->malop}}</td>
                                            <td>{{$drl->diem}}</td>
                                            <td>{{$drl->xeploai}}</td>
                                            <td>{{$drl->namhoc}}</td>
                                            <td>{{$drl->hocky}}</td>


                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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
