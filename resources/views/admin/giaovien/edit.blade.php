@extends('layouts.admin')

@section('title')
    <title>Sửa Giáo Viên</title>
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
                                <h3 class="card-title">Sửa giáo viên</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{route('giaovien.update',['id'=>$giaovien->id])}}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Tên giáo viên</label>
                                        <input value="{{$giaovien->tengv}}" name="tengv" type="text"
                                               class="form-control"
                                               placeholder="Nhập tên giáo viên">
                                    </div>
                                    <div class="form-group">
                                        <label>Số điện thoại</label>
                                        <input value="{{$giaovien->sodt}}" name="sodt" type="text" class="form-control"
                                               placeholder="Nhập số đt">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input value="{{$giaovien->email}}" name="email" type="email"
                                               class="form-control"
                                               placeholder="Nhập số email">
                                    </div>
                                    <div class="form-group">
                                        <label>Facebook</label>
                                        <input value="{{$giaovien->facebook}}" name="facebook" type="url"
                                               class="form-control"
                                               placeholder="Nhập địa chỉ fb">
                                    </div>
                                    <div class="form-group">
                                        <label>Thuộc khoa</label>
                                        <select name="makhoa" class="form-control select2">
                                            <option value="0">Chọn khoa</option>
                                            @foreach($khoas as $khoa)
                                                <option {{($giaovien->makhoa == $khoa->id)?'selected':''}}
                                                        value="{{$khoa->id}}">{{$khoa->id.' - '.$khoa->tenkhoa}}</option>
                                            @endforeach
                                        </select>
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
