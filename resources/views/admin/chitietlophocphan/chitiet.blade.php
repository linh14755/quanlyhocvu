@extends('layouts.admin')

@section('title')
    <title>Kết quả đk học phần</title>
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

                    <div class="col-12 mt-5">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Chi tiết kết quả đăng ký của
                                    SV: {{optional($chitietlhp->sinhvien)->tensv}}
                                    - {{optional($chitietlhp->sinhvien)->masv}}</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Mã LHP</label>
                                                <input value="{{$chitietlhp->malhp}}" name="malhp" type="text"
                                                       class="form-control" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Mã SV</label>
                                                <input value="{{$chitietlhp->masv}}" name="masv" type="text"
                                                       class="form-control" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Tên SV</label>
                                                <input value="{{optional($chitietlhp->sinhvien)->tensv}}" name="tensv"
                                                       type="text" class="form-control" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Mã HP</label>
                                                <input value="{{$chitietlhp->mahp}}" name="mahp" type="text"
                                                       class="form-control" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Tên HP</label>
                                                <input value="{{optional($chitietlhp->hocphan)->tenhp}}" name="tenhp"
                                                       type="text" class="form-control" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Ngày ĐK</label>
                                                <input value="{{$chitietlhp->ngaydk}}" name="ngaydk" type="date"
                                                       class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Điểm QT</label>
                                                <input value="{{$chitietlhp->diemqt}}" name="diemqt" type="number"
                                                       step="0.01" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>% quá trình</label>
                                                <input value="{{$chitietlhp->phantramqt}}" name="phantramqt" type="text"
                                                       step="0.01" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Điểm L1</label>
                                                <input value="{{$chitietlhp->dieml1}}" name="dieml1" type="number"
                                                       step="0.01" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>% lần 1</label>
                                                <input value="{{$chitietlhp->phantraml1}}" name="phantraml1" type="text"
                                                       step="0.01" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Điểm L2</label>
                                                <input value="{{$chitietlhp->dieml2}}" name="dieml2" type="number"
                                                       step="0.01" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>% lần 2</label>
                                                <input value="{{$chitietlhp->phantraml2}}" name="phantraml2" type="text"
                                                       step="0.01" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Điểm tổng kết</label>
                                                <input value="{{$chitietlhp->diemtk}}" name="diemtk" type="text"
                                                       step="0.01" class="form-control">
                                            </div>

                                        </div>
                                    </div>


                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
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
