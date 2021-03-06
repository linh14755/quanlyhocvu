<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset('adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2"
                     alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth::user()->name}}</a>

            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('khoa.index')}}" class="nav-link">
{{--                        <i class="nav-icon fas fa-user"></i>--}}
                        <p>
                            Khoa
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('lop.index')}}" class="nav-link">
{{--                        <i class="nav-icon fas fa-user"></i>--}}
                        <p>
                            Lớp
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('giaovien.index')}}" class="nav-link">
{{--                        <i class="nav-icon fas fa-user"></i>--}}
                        <p>
                            Giáo viên
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('phuhuynh.index')}}" class="nav-link">
{{--                        <i class="nav-icon fas fa-user"></i>--}}
                        <p>
                            Phụ huynh
                        </p>
                    </a>
                </li>

                {{--                <li class="nav-item">--}}
                {{--                    <a href="{{route('sinhvien.index')}}" class="nav-link">--}}
                {{--                        <i class="nav-icon fas fa-user"></i>--}}
                {{--                        <p>--}}
                {{--                            Sinh viên--}}
                {{--                        </p>--}}
                {{--                    </a>--}}
                {{--                </li>--}}
                <li class="nav-item">
                    <a href="{{route('lophocphan.index')}}" class="nav-link">
{{--                        <i class="nav-icon fas fa-user"></i>--}}
                        <p>
                            Lớp học phần
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('diemrenluyen.index')}}" class="nav-link">
{{--                        <i class="nav-icon fas fa-user"></i>--}}
                        <p>
                            Điểm rèn luyện
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('thoikhoabieu.index')}}" class="nav-link">
{{--                        <i class="nav-icon fas fa-user"></i>--}}
                        <p>
                            Thời khóa biểu
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('diemdanh.index')}}" class="nav-link">
{{--                        <i class="nav-icon fas fa-user"></i>--}}
                        <p>
                            Điểm danh
                        </p>
                    </a>
                </li>
                                <li class="nav-item">
                                    <a href="{{route('hocphi.index')}}" class="nav-link">
{{--                                        <i class="nav-icon fas fa-user"></i>--}}
                                        <p>
                                            Học phí
                                        </p>
                                    </a>
                                </li>
                {{--                <li class="nav-item">--}}
                {{--                    <a href="{{route('chitietlophocphan.index')}}" class="nav-link">--}}
                {{--                        <i class="nav-icon fas fa-user"></i>--}}
                {{--                        <p>--}}
                {{--                            Chi tiết lớp học phần--}}
                {{--                        </p>--}}
                {{--                    </a>--}}
                {{--                </li>--}}

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
