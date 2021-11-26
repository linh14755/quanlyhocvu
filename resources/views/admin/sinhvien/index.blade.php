@extends('layouts.admin')

@section('title')
    <title>Sinh viên</title>
@endsection
@section('css')
    @livewireStyles
@endsection

@section('js')
    <script src="{{asset('admins/js/main.js')}}"></script>
    <script src="{{asset('vendors/sweetAlert2/sweetalert2@10.js')}}"></script>
    @livewireScripts
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
                        {{--                        <a href="{{route('sinhvien.import-form')}}" type="button" class="btn btn-success"><i--}}
                        {{--                                class="fa fa-table" aria-hidden="true"></i>--}}
                        {{--                            Import</a>--}}
                        <a href="{{route('sinhvien.create')}}" type="button" class="btn btn-success"><i
                                class="fa fa-plus-square" aria-hidden="true"></i>
                            Add</a>
                    </div>


                </div>
                <div class="row">

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header row">
                                <h3 class="card-title col-4">{{(isset($tenlop))? 'Các sinh viên thuộc: '. $tenlop.' - '.count($lsinhvien).' sinh viên' :'Danh sách sinh viên'}}</h3>
                                <div class="card-tools col-8">
                                    @livewire('sinh-vien-search-bar')
                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã SV</th>
                                        <th>Họ Tên</th>
                                        <th>Ngày Sinh</th>
                                        <th>Lớp</th>
                                        <th>Tên Phụ huynh</th>
                                        <th>SĐT Phụ huynh</th>
                                        <th>Kết quả DKHP</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 0; ?>
                                    @foreach($lsinhvien as $sv)
                                        <?php $i = $i + 1; ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td>{{$sv->masv}}</td>
                                            <td>{{$sv->tensv}}</td>
                                            <td>{{$sv->ngaysinh}}</td>
                                            <td>
                                                @foreach($sv->lop as $lop)

                                                    <a class="text-dark"
                                                       href="{{route('lop.edit',['id'=>$lop->malop])}}">{{$lop->malop}}
                                                        <i class="fas fa-edit text-warning mr-2" aria-hidden="true"></i></a>
                                                @endforeach
                                            </td>
                                            <td>
                                                @if($sv->maph1 != 0)
                                                    <a href="{{route('phuhuynh.edit',['id'=>$sv->maph1])}}">{{optional($sv->phuhuynh1)->tenph}}
                                                        <i
                                                            class="fas fa-edit text-warning mr-2"
                                                            aria-hidden="true"></i></a>

                                                @endif
                                            </td>
                                            <td>{{optional($sv->phuhuynh1)->sodt}}</td>
                                            <td>
                                                <a class="text-dark"
                                                   href="{{route('chitietlophocphan.theosinhvien',['masv'=>$sv->masv])}}">Chi
                                                    tiết <i
                                                        class="fa fa-link text-primary" aria-hidden="true"></i></a>
                                            </td>
                                            <td>
                                                <a href="{{route('sinhvien.edit',['id'=>$sv->masv])}}"><i
                                                        class="fas fa-edit text-warning mr-2"
                                                        aria-hidden="true"></i></a>
                                                <a data-url="{{route('sinhvien.delete',['id'=>$sv->masv])}}"
                                                   class="action_delete"><i class="fa fa-trash text-danger"
                                                                            aria-hidden="true"
                                                                            style="cursor: pointer;"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    @if($lsinhvien instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                        <td colspan="7">
                                            {{$lsinhvien->links()}}
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
