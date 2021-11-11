@extends('layouts.admin')

@section('title')
    <title>Thêm Khoa</title>
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
                                <h3 class="card-title">Thêm khoa</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{route('khoa.store')}}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Mã Khoa</label>
                                        <input name="makhoa" type="text" class="form-control" placeholder="Nhập mã khoa">
                                    </div>
                                    <div class="form-group">
                                        <label>Tên khoa</label>
                                        <input name="tenkhoa" type="text" class="form-control" placeholder="Nhập tên khoa">
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
