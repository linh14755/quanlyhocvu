@extends('layouts.admin')

@section('title')
    <title>Sửa Khoa</title>
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
                                <h3 class="card-title">Sửa khoa</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST"
                                  action="{{route('khoa.update',['id'=>(isset($khoa) ? $khoa->makhoa :'')])}}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Mã khoa</label>
                                        <input disabled value="{{(isset($khoa) ? $khoa->makhoa :'')}}" name="makhoa" type="text"
                                               class="form-control" placeholder="Nhập mã khoa">
                                    </div>
                                    <div class="form-group">
                                        <label>Tên khoa</label>
                                        <input value="{{(isset($khoa) ? $khoa->tenkhoa :'')}}" name="tenkhoa" type="text"
                                        class="form-control" placeholder="Nhập tên khoa">
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
