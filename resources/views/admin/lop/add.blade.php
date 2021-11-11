@extends('layouts.admin')

@section('title')
    <title>Thêm Lớp</title>
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
                                <h3 class="card-title">Thêm lớp</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{route('lop.store')}}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Mã Lớp</label>
                                        <input name="malop" type="text" class="form-control" placeholder="Nhập mã lớp">
                                    </div>
                                    <div class="form-group">
                                        <label>Khoa</label>
                                        <select name="makhoa" class="form-control select2">
                                            <option value="0">Chọn khoa</option>
                                            @foreach($khoas as $khoa)
                                                <option value="{{$khoa->makhoa}}">{{$khoa->makhoa.' - '.$khoa->tenkhoa}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Giáo viên chủ nhiệm</label>
                                        <select name="magvcn" class="form-control select2">
                                            <option value="0">Chọn giáo viên chủ nhiệm</option>
                                            @foreach($giaoviens as $giaovien)
                                                <option value="{{$giaovien->id}}">{{$giaovien->id.' - '.$giaovien->tengv}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Sĩ số</label>
                                        <input value="0" name="siso" type="number" class="form-control" placeholder="Nhập sĩ số">
                                    </div>
                                    <div class="form-group">
                                        <label>Niên khóa</label>
                                        <input name="nienkhoa" type="text" class="form-control" placeholder="Nhập niên khóa">
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
