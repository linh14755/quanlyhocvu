@extends('layouts.admin')

@section('title')
    <title>Giáo viên</title>
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
                        <a href="{{route('giaovien.create')}}" type="button" class="btn btn-success"><i
                                class="fa fa-plus-square" aria-hidden="true"></i>
                            Add</a>

                    </div>
                </dvi>
                <div class="row">

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header row">
                                <h3 class="card-title col-4">Danh sách giáo viên</h3>

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
                                        <th>ID</th>
                                        <th>Tên Giáo Viên</th>
                                        <th>Số điện thoại</th>
                                        <th>Email</th>
                                        <th>Facebook</th>
                                        <th>Khoa</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($giaoviens as $giaovien)
                                        <tr>
                                            <td>{{$giaovien->id}}</td>
                                            <td>{{$giaovien->tengv}}</td>
                                            <td>{{$giaovien->sodt}}</td>
                                            <td>{{$giaovien->email}}</td>
                                            <td>
                                                @if(!empty($giaovien->facebook))
                                                    <a  href="{{$giaovien->facebook}}"><i class="fa fa-link text-primary" aria-hidden="true"></i></a>
                                                @else
                                                    Chưa cập nhật...
                                                @endif
                                            </td>
                                            <td>{{optional($giaovien->khoa)->tenkhoa}}</td>
                                            <td>
                                                <a href="{{route('giaovien.edit',['id'=>$giaovien->id])}}"><i
                                                        class="fas fa-edit text-warning mr-2"
                                                        aria-hidden="true"></i></a>
                                                <a class="action_delete" href="" data-url="{{route('giaovien.delete',['id'=>$giaovien->id])}}" ><i
                                                        class="fa fa-trash text-danger"
                                                        aria-hidden="true"></i></a>
                                            </td>
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
