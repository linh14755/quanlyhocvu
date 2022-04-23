@extends('layouts.admin')

@section('title')
    <title>Chi tiết lớp học phần</title>
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
                        {{--                        <a href="{{route('chitietlophocphan.import-form')}}" type="button" class="btn btn-success"><i--}}
                        {{--                                class="fa fa-table" aria-hidden="true"></i>--}}
                        {{--                            Import</a>--}}
                        {{--                        <a href="#" type="button" class="btn btn-success"><i--}}
                        {{--                                class="fa fa-plus-square" aria-hidden="true"></i>--}}
                        {{--                            Add</a>--}}

                    </div>
                </div>
                <div class="row">

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header row ">
                                <h3 class="card-title col-6 ">
                                    Kết quả đăng ký HP của [ {!! $sv->tensv .' - '. $sv->masv !!} ]
                                </h3>

                                <div class="card-tools col-6">
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
                                        {{--                                        <th>MSSV</th>--}}
                                        {{--                                        <th>Tên sinh viên</th>--}}
                                        <th>Mã học phần</th>
                                        <th>Tên học phần</th>
                                        <th>Tín chỉ</th>

                                        <th>Điểm tổng </br> học phần</th>
                                        <th>Điểm quy đổi</th>
                                        <th>Kết quả</th>
                                        <th>Chi tiết</th>
                                        <th>Điểm danh</th>
                                        {{--                                        <th>Action</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($arr_ctlhp as $ctlhp)
                                        <tr>
                                            <td style="background-color: #c7d6f3; color: blue; font-weight: bold"
                                                colspan="11">Năm học : {{ $ctlhp["namhoc"] }} - Học
                                                kỳ : {{ $ctlhp["hocky"] }}</td>
                                        </tr>
                                        <?php $i = 0; ?>
                                        @foreach($ctlhp["ctlhp"] as $chitietlhp)
                                            <?php $i = $i + 1; ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                {{--                                                <td>{{$chitietlhp["masv"]}}</td>--}}
                                                {{--                                                <td>{{$chitietlhp["tensv"]}}</td>--}}
                                                <td>{{$chitietlhp["mahp"]}}</td>
                                                <td>{{$chitietlhp["tenhp"]}}</td>
                                                <td>{{$chitietlhp["stc"]}}</td>
                                                <td>{{$chitietlhp["diemtk"]}}</td>
                                                <td>{{$chitietlhp["diemquydoi"]}}</td>
                                                <td>
                                                    @if($chitietlhp["diemquydoi"] !='')
                                                        {!!($chitietlhp["diemquydoi"] == 'F') ? "<img src='".url('/storage/diem/Rot.png')."' >" :"<img src='".url('/storage/diem/Dau.png')."' >"!!}
                                                    @else
                                                        <img style="width: 22px"
                                                             src="{{url('/storage/diem/question.png')}}">
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="text-warning"
                                                       href="{{route('chitietlophocphan.chitiet',['masv'=> $chitietlhp["masv"],'malhp'=>$chitietlhp["malhp"]])}}">
                                                        <img src="{{url('/storage/diem/detail.png')}}"
                                                             style="width: 22px">
                                                    </a>
                                                </td>

                                                <td>
                                                    <a class="text-warning"
                                                       href="{{route('diemdanh.chitiet_diemdanh_theosv', ['masv' => $chitietlhp["masv"], 'malhp' => $chitietlhp["malhp"]])}}">
                                                        <img src="{{url('/storage/diem/view.png')}}"
                                                             style="width: 22px">
                                                    </a>
                                                </td>

                                            </tr>
                                        @endforeach
                                    @endforeach
                                    {{--                                    @if($chitietlhps instanceof \Illuminate\Pagination\LengthAwarePaginator)--}}
                                    {{--                                        <td colspan="7">--}}
                                    {{--                                            {{$chitietlhps->links()}}--}}
                                    {{--                                        </td>--}}
                                    {{--                                    @endif--}}
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
