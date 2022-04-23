@extends('layouts.admin')

@section('title')
    <title>Import Chi Tiết Bảng Điểm Lớp Học Phần</title>
@endsection
@section('js')
    <script>
        $('#YearStudy').on('change', '', function (e) {
            var ClassStudentID = $('#khoa').children("option:selected").val();
            var YearStudy = $('#YearStudy').children("option:selected").val();
            var TermID = $('#TermID').children("option:selected").val();

            $.ajax({
                type: 'GET',
                url: '{{route('hocphan.get-lop-va-hoc-phan-from-khoa')}}',
                data: {ClassStudentID, YearStudy, TermID},

                success: function (data) {
                    if (data.code == 200) {
                        $('#ClassStudentID').html(data.htmllop);
                        $('#subject').html(data.htmllophocphan);
                    }
                }
            });
        });
        $('#TermID').on('change', '', function (e) {
            var ClassStudentID = $('#khoa').children("option:selected").val();
            var YearStudy = $('#YearStudy').children("option:selected").val();
            var TermID = $('#TermID').children("option:selected").val();

            $.ajax({
                type: 'GET',
                url: '{{route('hocphan.get-lop-va-hoc-phan-from-khoa')}}',
                data: {ClassStudentID, YearStudy, TermID},

                success: function (data) {
                    if (data.code == 200) {
                        $('#ClassStudentID').html(data.htmllop);
                        $('#subject').html(data.htmllophocphan);
                    }
                }
            });
        });
        $('#khoa').on('change', '', function (e) {
            var ClassStudentID = $('#khoa').children("option:selected").val();
            var YearStudy = $('#YearStudy').children("option:selected").val();
            var TermID = $('#TermID').children("option:selected").val();

            $.ajax({
                type: 'GET',
                url: '{{route('hocphan.get-lop-va-hoc-phan-from-khoa')}}',
                data: {ClassStudentID, YearStudy, TermID},

                success: function (data) {
                    if (data.code == 200) {
                        $('#ClassStudentID').html(data.htmllop);
                        $('#subject').html(data.htmllophocphan);
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

                <div class="row">

                    <div class="col-6 mt-5">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Import chi tiết bảng điểm lớp học phần</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{route('hocphan.bangdiem-import')}}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
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
                                        <label>Khoa</label>
                                        <select class="form-control" name="khoa" id="khoa">
                                            <option value="0"></option>
                                            @foreach($khoas as $value)
                                                <option
                                                    value="{{$value->id}}">{{$value->tenkhoa.' - '.$value->makhoa}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Lớp</label>
                                        <select class="form-control" name="ClassStudentID" id="ClassStudentID">
                                            {{--                                            @foreach($class_student_id as $key=>$value)--}}
                                            {{--                                                <option value="{{$key}}">{{$value}}</option>--}}
                                            {{--                                            @endforeach--}}
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Danh sách môn</label>
                                        <select class="form-control" name="subject" id="subject">
                                            <option value="0"></option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Import file excel</label>
                                        <input name="file" type="file" class="form-control-file"
                                               accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        @if (\Session::has('message'))
                            <div class="alert alert-info alert-block" role="alert">
                                {!! \Session::get('message') !!}</ul>
                            </div>

                    @endif
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
