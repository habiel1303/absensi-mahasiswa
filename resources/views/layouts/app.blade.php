<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sistem Absensi</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                <div class="sidebar-brand-text mx-3">Absensi</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item {{ request()->is('mahasiswa*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('mahasiswa.index') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Mahasiswa</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('matakuliah*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('matakuliah.index') }}">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Mata Kuliah</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('absensi*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('absensi.index') }}">
                    <i class="fas fa-fw fa-clipboard-list"></i>
                    <span>Absensi</span>
                </a>
            </li>
        </ul>
        <!-- End Sidebar -->

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar" style="background-color: #4e73df;">
    <div class="container justify-content-center">
        <span class="navbar-brand fs-2 fw-bold text-white">
            LP3I COllEGE BANDA ACEH
        </span>
    </div>
</nav>

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <span class="navbar-brand">Sistem Absensi Mahasiswa</span>

                    <div class="ml-auto d-flex align-items-center">
                        <span class="mr-3 text-gray-600 small">
                            <i class="fas fa-user-circle mr-1"></i>
                            {{ Auth::user()->name }}
                        </span>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-sign-out-alt mr-1"></i> Logout
                            </button>
                        </form>
                    </div>
                </nav>
                <!-- End Topbar -->

                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>

        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>

</html>
