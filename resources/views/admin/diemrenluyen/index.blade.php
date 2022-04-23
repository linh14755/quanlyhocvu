@extends('layouts.admin')

@section('title')
    <title>Điểm rèn luyện</title>
@endsection

@section('js')
    <script src="{{asset('admins/js/main.js')}}"></script>
    <script src="{{asset('vendors/sweetAlert2/sweetalert2@10.js')}}"></script>
    <script>
        http://qlgd.dlu.edu.vn/public/DrawingClassStudentSchedules_Mau2?YearStudy=2021-2022&TermID=HK02&Week=11&ClassStudentID=CTK42&t=0.8524489837203575;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#khoa').on('change', function () {
            $.ajax({
                url: '{{route('diemrenluyen.chonkhoa')}}',
                type: 'GET',
                data: {id: this.value},
                success: function (data) {
                    if (data.code == 200) {
                        let str = ''
                        $.each(data.data,function (index,value) {
                            str +="<option>"+value.malop+"</option>"

                        })
                        $('#lop').html(str)
                    }
                },
                error: function () {

                }
            });
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
                <dvi class="row mb-3 pt-3">
                    <div class="col-4">
                        <a href="{{route('diemrenluyen.import-form')}}" type="button" class="btn btn-success"><i
                                class="fa fa-table" aria-hidden="true"></i>
                            Import - Điểm rèn luyện</a>

                    </div>
                </dvi>
                <div class="row">

                    <div class="col-6">
                        <div class="card">
                            <div class="card-header row">
                                <h3 class="card-title col-4">Điểm rèn luyện</h3>

                                <div class="card-tools col-8">
                                    <div class="input-group input-group-sm">
                                        {{--                                        <input type="text" name="table_search" class="form-control float-right"--}}
                                        {{--                                               placeholder="Search">--}}

                                        {{--                                        <div class="input-group-append">--}}
                                        {{--                                            <button type="submit" class="btn btn-default">--}}
                                        {{--                                                <i class="fas fa-search"></i>--}}
                                        {{--                                            </button>--}}
                                        {{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-2">
                                <form action="{{route('diemrenluyen.chitiet')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Khoa</label>
                                        <select class="form-control" id="khoa">
                                            <option value="">Chọn khoa</option>
                                            @foreach($khoas as $item)
                                                <option>{{$item->khoa}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Lớp</label>
                                        <select class="form-control" name="lop" id="lop">
                                            @foreach($lops as $item)
                                                <option>{{$item->malop}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Năm học</label>
                                        <select class="form-control" name="namhoc">
                                            @foreach($namhocs as $item)
                                                <option>{{$item->namhoc}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Học kỳ</label>
                                        <select class="form-control" name="hocky">
                                            <option value="1">HK01</option>
                                            <option value="2">HK02</option>
                                            <option value="3">HK03</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Chọn</button>
                                </form>
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
