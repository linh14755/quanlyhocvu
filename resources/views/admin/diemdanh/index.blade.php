@extends('layouts.admin')

@section('title')
    <title>Điểm danh</title>
@endsection

@section('js')
    <script src="{{asset('admins/js/main.js')}}"></script>
    <script src="{{asset('vendors/sweetAlert2/sweetalert2@10.js')}}"></script>
    <script>
        $('#khoa').on('change', '', function () {
            var khoa = $('#khoa').children("option:selected").val();


            $.ajax({
                type: 'GET',
                url: '{{route('diemdanh.timkhoa')}}',
                data: {khoa},

                success: function (data) {
                    if (data.code == 200) {
                        $('#lop').html(data.html);
                    }
                }
            });
        });

        {{--$('#form-post').on('submit', function (e) {--}}
        {{--    e.preventDefault();--}}
        {{--    YearStudy = $('#YearStudy').val();--}}
        {{--    TermID = $('#TermID').val();--}}
        {{--    khoa_id = $('#khoa').val();--}}
        {{--    dieukien = $('#dieukien').val();--}}

        {{--    if (dieukien == 'theolop') {--}}
        {{--        $.ajax({--}}
        {{--            type: 'GET',--}}
        {{--            url: '{{route('diemdanh.timkhoa')}}',--}}
        {{--            data: {khoa_id},--}}

        {{--            success: function (data) {--}}
        {{--                if (data.code == 200) {--}}
        {{--                    var inputOptions = {};--}}
        {{--                    $.each(data.lops, function (key, value) {--}}
        {{--                        inputOptions[value.malop] = value.malop--}}
        {{--                    })--}}

        {{--                    Swal.fire({--}}
        {{--                        title: 'Chọn lớp để tìm kiếm',--}}
        {{--                        input: 'select',--}}
        {{--                        inputOptions: inputOptions,--}}
        {{--                        inputAttributes: {--}}
        {{--                            autocapitalize: 'off'--}}
        {{--                        },--}}
        {{--                        showCancelButton: true,--}}
        {{--                        confirmButtonText: 'Look up',--}}
        {{--                        showLoaderOnConfirm: true,--}}
        {{--                        allowOutsideClick: false,--}}

        {{--                        preConfirm: (lop) => {--}}

                                    {{--$.ajax({--}}
                                    {{--    type: 'GET',--}}
                                    {{--    url: '{{route('diemdanh.timtheolop')}}',--}}
                                    {{--    data: {YearStudy, TermID, khoa_id, lop},--}}

                                    {{--    success: function (data) {--}}
                                    {{--        if (data.code == 200) {--}}
                                    {{--            $('body').html(data.html);--}}
                                    {{--        }--}}
                                    {{--    }--}}
                                    {{--});--}}
        {{--                        },--}}
        {{--                    })--}}

        {{--                }--}}
        {{--            }--}}
        {{--        });--}}
        {{--    } else if (dieukien == 'theohocphan') {--}}

        {{--    }--}}


        {{--});--}}
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
                        <a href="{{route('diemdanh.import-form')}}" type="button" class="btn btn-success"><i
                                class="fa fa-table" aria-hidden="true"></i>
                            Import</a>

                    </div>
                </dvi>
                <div class="row">

                    <div class="col-6">
                        <div class="card">
                            <div class="card-header row">
                                <h3 class="card-title col-4">Xem điểm danh</h3>

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
                                <form action="{{route('diemdanh.timtheolop')}}" method="post" id="form-post">
                                    @csrf

                                    <div class="form-group">
                                        <label>Khoa</label>
                                        <select class="form-control" name="khoa" id="khoa">
                                            <option value="0"></option>
                                            @foreach($khoas as $khoa)
                                                <option value="{{$khoa->id}}">{{$khoa->tenkhoa}}</option>
                                            @endforeach
                                        </select>
                                    </div>
{{--                                    <div class="form-group">--}}
{{--                                        <label>Điều kiện tìm kiếm</label>--}}
{{--                                        <select class="form-control" name="dieukien" id="dieukien">--}}
{{--                                            <option value="theolop">Theo lớp</option>--}}
{{--                                            <option value="theohocphan">Theo học phần</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
                                    <div class="form-group">
                                        <label>Lớp</label>
                                        <select class="form-control" name="lop" id="lop">
                                            <option value="0"></option>

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
