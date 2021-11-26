@extends('layouts.admin')

@section('title')
    <title>Lớp</title>
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
                <dvi class="row mb-3 pt-3">
                    <div class="col-4">
                        <a href="{{route('lop.create')}}" type="button" class="btn btn-success"><i
                                class="fa fa-plus-square" aria-hidden="true"></i>
                            Add</a>
                    </div>
                </dvi>
                <div class="row">

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header row">
                                <h3 class="card-title col-4">{{(isset($tenkhoa))? 'Các lớp thuộc: '. $tenkhoa.' - '.count($lops).' lớp' :'Danh sách lớp'}}</h3>
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
                                        <th>Lớp</th>
                                        <th>Thuộc Khoa</th>
                                        <th>GVCN</th>
                                        <th>Sĩ số</th>
                                        <th>Niên khóa</th>
                                        <th>Danh sách sinh viên</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($lops as $lop)
                                        <tr>
                                            <td>{{$lop->malop}}</td>
                                            <td>{{optional($lop->khoa)->tenkhoa}}</td>
                                            <td>
                                                @if($lop->magvcn !=0)
                                                    <a href="{{route('giaovien.edit',['id'=>$lop->magvcn])}}">{{optional($lop->giaovien)->tengv}}
                                                        <i
                                                            class="fas fa-edit text-warning mr-2"
                                                            aria-hidden="true"></i></a>
                                                @endif
                                            </td>
                                            <td>{{$lop->siso}}</td>
                                            <td>{{$lop->nienkhoa}}</td>
                                            <td><a class="text-dark" href="{{route('sinhvien.theolop',['malop'=>$lop->malop])}}">Danh sách
                                                    sinh viên <i
                                                        class="fa fa-link text-primary" aria-hidden="true"></i></a></td>
                                            <td>
                                                <a href="{{route('lop.edit',['id'=>$lop->malop])}}"><i
                                                        class="fas fa-edit text-warning mr-2"
                                                        aria-hidden="true"></i></a>
                                                <a class="action_delete" href=""
                                                   data-url="{{route('lop.delete',['id'=>$lop->malop])}}"><i
                                                        class="fa fa-trash text-danger"
                                                        aria-hidden="true"></i></a>
                                            </td>
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
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    <!-- /.content-wrapper -->
@endsection
