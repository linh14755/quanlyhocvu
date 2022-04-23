@extends('layouts.admin')

@section('title')
    <title>Điểm danh</title>
@endsection



@section('js')
    <script src="{{asset('admins/js/main.js')}}"></script>
    <script src="{{asset('vendors/sweetAlert2/sweetalert2@10.js')}}"></script>
    <script>


        $('.btn-thongtin-sv').on('click', function (e) {
            e.preventDefault();
            let idsv = $(this).data('idsv');


            $.ajax({
                type: 'GET',
                url: '{{route('diemdanh.chitiet_theosv')}}',
                data: {idsv: idsv},
                success: function (res) {
                    Swal.fire({
                        title: 'Chi tiết !',
                        width: '90%',
                        html: res.html,
                        showCloseButton: true,
                        showConfirmButton:false,


                    }).then(function (result) {
                            swal(JSON.stringify(result))
                        }
                    ).catch(swal.noop)

                }
            });
        })
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
                <div class="row mb-3 pt-3">
                    <div class="col-4">


                    </div>


                </div>
                <div class="row">

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header row">
                                <h3 class="card-title col-4">Bảng điểm danh lớp: {{$lop}}</h3>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã SV</th>
                                        <th>Họ Tên</th>
                                        <th>Lớp</th>
                                        <th>Bảng điểm danh</th>
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
                                            <td>{{$lop}}</td>
                                            <td><a href=""
                                                   data-idsv="{{$sv->masv}}"
                                                   class="btn-thongtin-sv"><img src="{{url('/storage/diem/view.png')}}"></a>
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
