@extends('layouts.admin')

@section('title')
    <title>Phụ huynh</title>
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
                        <a type="button" class="btn btn-success"><i class="fa fa-table" aria-hidden="true"></i>
                            Import</a>
                        <a href="{{route('phuhuynh.create')}}" type="button" class="btn btn-success"><i
                                class="fa fa-plus-square" aria-hidden="true"></i>
                            Add</a>

                    </div>
                </dvi>
                <div class="row">

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Danh sách phụ huynh</h3>

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
                                        <th>Mã PH</th>
                                        <th>Tên PH</th>
                                        <th>Số ĐT</th>
                                        <th>Địa chỉ</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($phuhuynhs as $phuhuynh)
                                        <tr>
                                            <td>{{$phuhuynh->id}}</td>
                                            <td>{{$phuhuynh->tenph}}</td>
                                            <td>{{$phuhuynh->sodt}}</td>
                                            <td>{{$phuhuynh->diachi}}</td>
                                            <td>
                                                <a href="{{route('phuhuynh.edit',['id'=>$phuhuynh->id])}}"><i
                                                        class="fas fa-edit text-warning mr-2"
                                                        aria-hidden="true"></i></a>
                                                <a class="action_delete" data-url="{{route('phuhuynh.delete',['id'=>$phuhuynh->id])}}" ><i
                                                        class="fa fa-trash text-danger"
                                                        aria-hidden="true" style="cursor: pointer;"></i></a>
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
