@php
    $data = Auth::user()
        ->where('id', Auth::user()->id)
        ->first();
@endphp
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ url('assets/img/logo.png') }}" alt="" class="brand-image" style="opacity: .8">
        <span class="brand-text font-weight-bold" style="color: rgb(0, 0, 0)">Kampus Merdeka</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ url('assets/img/no-profile.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block font-weight-bold" style="color: rgb(0, 0, 0)">{{ $data->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2 main-menu-content">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ url('dashboard') }}" class="nav-link" style="color: rgb(0, 0, 0)">
                        <i class="nav-icon fas fa-tachometer-alt" style="color: rgb(0, 0, 0)"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-header" style="color: rgb(0, 0, 0)">Master Data</li>
                <li class="nav-item">
                    <a href="{{ url('master-mahasiswa') }}" class="nav-link" style="color: rgb(0, 0, 0)">
                        <i class="nav-icon fas fa-folder-open" style="color: rgb(0, 0, 0)"></i>
                        <p>
                            Berkas Mahasiswa
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('master-mhs-dsn.index') }}" class="nav-link" style="color: rgb(0, 0, 0)">
                        <i class="nav-icon fas fa-id-card-alt" style="color: rgb(0, 0, 0)"></i>
                        <p>
                            Data Mahasiswa Dosen Penguji
                        </p>
                    </a>
                </li>
                <li class="nav-header" style="color: rgb(0, 0, 0)">Rekap Laporan</li>
                <li class="nav-item">
                    <a href="{{ route('master-konversi.index') }}" class="nav-link" style="color: rgb(0, 0, 0)">
                        <i class="nav-icon fas fa-swatchbook" style="color: rgb(0, 0, 0)"></i>
                        <p>
                            Data Konversi Mahasiswa
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('mbkm.index') }}" class="nav-link" style="color: rgb(0, 0, 0)">
                        <i class="nav-icon fas fa-paperclip"></i>
                        <p>
                            Data MBKM
                        </p>
                    </a>
                </li>
                <li class="nav-header" style="color: rgb(0, 0, 0)">User Page</li>
                <li class="nav-item">
                    <a href="{{ route('user-page.index') }}" class="nav-link" style="color: rgb(0, 0, 0)">
                        <i class="nav-icon fas fa-list-ol"></i>
                        <p>
                            User
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
