@extends('layouts.admin')

@section('title')
    <title>Đăng ký học phần</title>
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
                        <a type="button" class="btn btn-success"><i class="fa fa-table" aria-hidden="true"></i> Import</a>
                        <a type="button" class="btn btn-success"><i class="fa fa-plus-square" aria-hidden="true"></i> Add</a>

                    </div>
                </dvi>
                <div class="row">

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Danh sách đăng ký học phần</h3>

                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 500px;">
                                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

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
                                        <th>Mã LHP</th>
                                        <th>Mã SV</th>
                                        <th>Mã HP</th>
                                        <th>Ngày ĐK</th>
                                        <th>Điểm QT</th>
                                        <th>Điểm thi</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>211CT3116D01</td>
                                        <td>1812790</td>
                                        <td>CT3116D</td>
                                        <td>21-10-2021</td>
                                        <td>7</td>
                                        <td>7</td>
                                        <td>
                                            <a href="#"><i class="fas fa-edit text-warning mr-2" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>211CT3116D01</td>
                                        <td>1812790</td>
                                        <td>CT3116D</td>
                                        <td>21-10-2021</td>
                                        <td>7</td>
                                        <td>7</td>
                                        <td>
                                            <a href="#"><i class="fas fa-edit text-warning mr-2" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>211CT3116D01</td>
                                        <td>1812790</td>
                                        <td>CT3116D</td>
                                        <td>21-10-2021</td>
                                        <td>7</td>
                                        <td>7</td>
                                        <td>
                                            <a href="#"><i class="fas fa-edit text-warning mr-2" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>

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
