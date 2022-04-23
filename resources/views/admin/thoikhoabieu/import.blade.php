@extends('layouts.admin')

@section('title')
    <title>Thời khóa biểu</title>
@endsection

@section('js')
    <script src="{{asset('admins/js/main.js')}}"></script>
    <script src="{{asset('vendors/sweetAlert2/sweetalert2@10.js')}}"></script>
    <script>
        $('#YearStudy').on('change', '', function () {
            var YearStudy = $('#YearStudy').children("option:selected").val();
            var TermID = $('#TermID').children("option:selected").val();

            $.ajax({
                type: 'GET',
                url: '{{route('thoikhoabieu.getweek')}}',
                data: {YearStudy, TermID},

                success: function (data) {
                    if (data.code == 200) {
                        $('#Week').html(data.data);
                    }
                }
            });
        });
        $('#TermID').on('change', '', function (e) {
            var YearStudy = $('#YearStudy').children("option:selected").val();
            var TermID = $('#TermID').children("option:selected").val();

            $.ajax({
                type: 'GET',
                url: '{{route('thoikhoabieu.getweek')}}',
                data: {YearStudy, TermID},

                success: function (data) {
                    if (data.code == 200) {
                        $('#Week').html(data.data);
                    }
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
                        {{--                        <a href="{{route('chitietlophocphan.import-form')}}" type="button" class="btn btn-success"><i--}}
                        {{--                                class="fa fa-table" aria-hidden="true"></i>--}}
                        {{--                            Import - Theo lớp học phần</a>--}}

                    </div>
                </dvi>
                <div class="row">

                    <div class="col-6">
                        <div class="card">
                            <div class="card-header row">
                                <h3 class="card-title col-12">Thời khóa biểu </h3>


                                <div class="card-tools col-12">
                                    @if (\Session::has('message'))
                                        <div class="alert alert-warning" role="alert">
                                            {!! \Session::get('message') !!}</ul>
                                        </div>
                                    @endif
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
                                <form action="{{route('thoikhoabieu.import')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Năm học</label>
                                        <select class="form-control" name="YearStudy"
                                                id="YearStudy" {{(date("m") <= 6 ? $value_selected = date("Y", strtotime('-1 year')).'-'.date("Y"): $value_selected = date("Y") .'-'.date("Y", strtotime('+1 year')))}}
                                        >
                                            @foreach($year_study as $key=>$value)
                                                <option
                                                    {{($value_selected == $key ?'selected':'')}}
                                                    value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Học kỳ</label>
                                        <select class="form-control" name="TermID" id="TermID">
                                            @foreach($term_id as $key=>$value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Lớp</label>
                                        <select class="form-control" name="ClassStudentID">
                                            @foreach($class_student_id as $key=>$value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Danh sách tuần ( value)</label>
                                        <textarea id="Week" name="Week" rows="4" cols="50"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Import</button>
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
