@extends('layouts.admin')

@section('title')
    <title>Điểm danh</title>
@endsection


@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    {{--    @include('partial.content-header',['name'=>'','key' =>''])--}}
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            @if(count($danhsach_diemdanh) > 0)
                <div class="container-fluid">
                    <div class="row mb-3 pt-3">
                        <div class="col-4">
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-12">
                            <div class="card">
                                <div class="card-header row">
                                    <h3 class="card-title col-6">
                                        <p>Sinh viên : {!! $sinhvien->tensv !!}</p>
                                        <p>MSSV : {!! $sinhvien->masv !!}</p>
                                        <p>Năm học : {!! $danhsach_diemdanh[0]->namhoc !!}</p>
                                        <p>Học kỳ : {!! $danhsach_diemdanh[0]->hocky !!}</p>


                                    </h3>

                                    <h3 class="card-title col-6">
                                        <p>Tổng số buổi theo TKB : {!! $tong_buoi_tkb !!}</p>
                                        <p>Đã điểm danh : {!! $arr_phantram['tong'] !!}</p>
                                        <p>Có mặt : {!! $arr_phantram['co'] !!}</p>
                                        <p>
                                        <div class="progress rounded">
                                            <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                                                 style="width: {{$arr_phantram['phantram']}}%;"
                                                 aria-valuenow="{{$arr_phantram['phantram']}}" aria-valuemin="0"
                                                 aria-valuemax="100">{{$arr_phantram['phantram']}}%
                                            </div>
                                        </div>
                                        </p>
                                        <p>Vắng : {!! $arr_phantram['vang'] !!}</p>
                                        <p>
                                        <div class="progress rounded">
                                            <div class="progress-bar progress-bar-striped bg-danger" role="progressbar"
                                                 style="width: {{100 - $arr_phantram['phantram']}}%;"
                                                 aria-valuenow="{{100- $arr_phantram['phantram']}}" aria-valuemin="0"
                                                 aria-valuemax="100">{{100 - $arr_phantram['phantram']}}%
                                            </div>
                                        </div>
                                        </p>
                                    </h3>


                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table ">
                                        <thead class="thead-light">
                                        <div class="border-top border-bottom pt-3 pl-2">
                                            <p><b>{{$danhsach_diemdanh[0]->tenhp}} - {{$danhsach_diemdanh[0]->mahp}}</b>
                                            </p>
                                        </div>

                                        <tr>
                                            <th scope="col">STT</th>
                                            <th scope="col">Ngày</th>
                                            <th scope="col">Tiết</th>
                                            <th scope="col">Trạng thái</th>
                                            <th scope="col"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 0 ?>
                                        @foreach($danhsach_diemdanh as $dsdd)
                                            <?php $i = $i + 1 ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td>{{date_format(date_create($dsdd->ngay),"d/m/Y")}}</td>
                                                <td>{{$dsdd->tiet}}</td>
                                                <td>{{$dsdd->trangthai}}</td>
                                                <td>{!!(substr($dsdd->trangthai, 0, 1)== 'P') ? '<img src="'.url('/storage/diem/dau.png').'">' :'<img src="'.url('/storage/diem/rot.png').'">'!!}</td>

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
            @else

                <div class="row">
                    <div class="col-12">
                        <h1 class="card-title col-12 d-flex justify-content-center">
                            <b>Không có dữ liệu</b>
                        </h1>

                    </div>

                </div>
            @endif
        </div><!-- /.container-fluid -->

    </div>
    <!-- /.content -->
    <!-- /.content-wrapper -->

@endsection
