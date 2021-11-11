@extends('layouts.admin')

@section('title')
    <title>Sinh viên</title>
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
                    <div class="col-4">
                        <a href="{{route('sinhvien.import-form')}}" type="button" class="btn btn-success"><i class="fa fa-table" aria-hidden="true"></i>
                            Import</a>
                        <a href="{{route('sinhvien.create')}}" type="button" class="btn btn-success"><i
                                class="fa fa-plus-square" aria-hidden="true"></i>
                            Add</a>

                    </div>
                </div>
                <div class="row">

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Danh sách sinh viên</h3>

                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 500px;">
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
                                        <th>Mã SV</th>
                                        <th>Họ Tên</th>
                                        <th>Ngày Sinh</th>
                                        <th>Lớp</th>
                                        <th>Tên Phụ huynh</th>
                                        <th>SĐT Phụ huynh</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($lsinhvien as $sv)
                                        <tr>
                                            <td>{{$sv->masv}}</td>
                                            <td>{{$sv->tensv}}</td>
                                            <td>{{$sv->ngaysinh}}</td>
                                            <td>{{optional($sv->lop)->malop}}</td>
                                            <td>{{optional($sv->phuhuynh1)->tenph}}</td>
                                            <td>{{optional($sv->phuhuynh1)->sodt}}</td>
                                            <td>
                                                <a href="{{route('sinhvien.edit',['id'=>$sv->masv])}}"><i class="fas fa-edit text-warning mr-2"
                                                               aria-hidden="true"></i></a>
                                                <a data-url="{{route('sinhvien.delete',['id'=>$sv->masv])}}" class="action_delete"><i class="fa fa-trash text-danger"
                                                               aria-hidden="true" style="cursor: pointer;"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <td colspan="7">
                                        {{$lsinhvien->links()}}
                                    </td>
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
