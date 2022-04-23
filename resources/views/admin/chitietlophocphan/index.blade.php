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
                        <a href="#" type="button" class="btn btn-success"><i
                                class="fa fa-plus-square" aria-hidden="true"></i>
                            Add</a>

                    </div>
                </div>
                <div class="row">

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header row">
                                <h3 class="card-title col-4">

                                    @if(isset($tenlhp))
                                        Danh sách sinh viên thuộc LHP [ {{$tenlhp}} ]
                                    @elseif(isset($tenhp))
                                        Danh sách sinh viên thuộc học phần [ {{$tenhp}} ]
                                    @elseif(isset($tensv))
                                        Kết quả đăng ký HP của [ {{$tensv}} ]
                                    @else
                                        Danh sách chi tiết lớp học phần
                                    @endif
                                </h3>

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
                                        <th>STT</th>
                                        <th>MSSV</th>
                                        <th>Tên sinh viên</th>
                                        <th>Mã học phần</th>
                                        <th>Tên học phần</th>
                                        <th>Tín chỉ</th>

                                        <th>Điểm tổng </br> học phần</th>
                                        <th>Điểm quy đổi</th>
                                        <th>Kết quả</th>
                                        <th>Chi tiết</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 0; ?>
                                    @foreach($chitietlhps as $chitietlhp)
                                        <?php $i = $i + 1; ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td>{{optional($chitietlhp->sinhvien)->masv}}</td>
                                            <td>{{optional($chitietlhp->sinhvien)->tensv}}</td>
                                            <td>{{$chitietlhp->mahp}}</td>
                                            <td>{{optional($chitietlhp->hocphan)->tenhp}}</td>
                                            <td>{{optional($chitietlhp->hocphan)->stc}}</td>
                                            <td>{{$chitietlhp->diemtk}}</td>
                                            <td>{{$chitietlhp->diemquydoi}}</td>
                                            <td>
                                                @if($chitietlhp->diemquydoi !='')
                                                    {!!($chitietlhp->diemquydoi == 'F') ? "<img src='".url('/storage/diem/Rot.png')."' >" :"<img src='".url('/storage/diem/Dau.png')."' >"!!}
                                                @else
                                                    <img style="width: 22px" src="{{url('/storage/diem/question.png')}}">
                                                @endif
                                            </td>
                                            <td>
                                                <a class="text-warning" href="{{route('chitietlophocphan.chitiet',['masv'=>$chitietlhp->masv,'malhp'=>$chitietlhp->malhp])}}">
                                                    <img src="{{url('/storage/diem/detail.png')}}" style="width: 22px">
                                                </a>
                                            </td>

                                            <td>
                                                {{--                                                <a href="{{route('khoa.edit',['id'=>$khoa->id])}}"><i--}}
                                                {{--                                                        class="fas fa-edit text-warning mr-2"--}}
                                                {{--                                                        aria-hidden="true"></i></a>--}}
                                                {{--                                                <a class="action_delete" href=""--}}
                                                {{--                                                   data-url="{{route('khoa.delete',['id'=>$khoa->id])}}"><i--}}
                                                {{--                                                        class="fa fa-trash text-danger"--}}
                                                {{--                                                        aria-hidden="true"></i></a>--}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if($chitietlhps instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                        <td colspan="7">
                                            {{$chitietlhps->links()}}
                                        </td>
                                    @endif
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
