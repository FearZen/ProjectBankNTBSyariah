<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link rel="icon" href="{{ asset('assets/images/logo2.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    @yield('styles')

    <style>
    /* CSS untuk mengatur ukuran dan tampilan logo di sidebar */
    .brand-link {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem; 
    }
    


    .nav-link {
        padding: 0.5rem 1rem; 
    }

    /* Sidebar Profile Dropdown Styling */
    .sidebar-profile {
        padding: 1rem;
        border-bottom: 1px solid #dee2e6;
    }
    .sidebar-profile .dropdown-menu {
        margin-left: 0;
        margin-top: 0.5rem;
    }
    .dropdown-item {
        font-size: 0.9rem;
    }

    /* CSS untuk navbar warna */
    .nav-sidebar .nav-link.active {
    background-color: #A2CA71 !important; /* Warna latar belakang menu aktif */
    color: #000; /* Warna teks menu aktif */
}
    .main-header.navbar {
        background-color: #0B6E45 !important; /* Warna navbar */
        padding: 0.8rem 2rem; /* Tambahkan padding untuk memperbesar navbar */
    }
    .main-header .navbar-nav .nav-link {
        color: #fff !important; /* Warna teks navbar */
    }
    .main-header .navbar-nav .nav-link:hover {
        color: #d4e157 !important; /* Warna teks saat hover */
    }

    /* Styling untuk profile icon dan nama */
    .sidebar-profile a {
        display: flex;
        align-items: center;
    }

    .sidebar-profile span {
        margin-left: 0.5rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 150px; /* Sesuaikan lebar maksimal */
    }

    /* Styling saat sidebar dikecilkan */
    .sidebar-mini .sidebar-profile span {
        display: none !important; /* Sembunyikan nama saat sidebar mini */
    }

    .sidebar-mini .brand-link {
        padding: 1rem; /* Sesuaikan padding agar logo tetap proporsional */
    }
    .sidebar-mini .hide-on-collapse {
    display: none;
}
</style>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Main Header Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark navbar-primary">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <!-- Add other navbar links here -->
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Add other navbar links here -->
            </ul>
        </nav>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="#" class="brand-link">
                <img src="{{ asset('assets/images/logo2.png') }}" alt="Bank NTB Syariah Logo" class="brand-image">
                <span>Bank NTB Syariah</span>
                
            </a>

            <div class="sidebar">
                <!-- Profile Dropdown in Sidebar -->
                @if (Auth::check())
                    <div class="sidebar-profile">
                        <a class="d-flex align-items-center" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="nav-icon fas fa-user"> {{ Auth::user()->name }}</i>
                            
                        </a>
                        <ul class="dropdown-menu dropdown-menu-left" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </div>
                @endif

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link @if(request()->routeIs('dashboard')) active @endif">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('forms.create') }}" class="nav-link @if(request()->routeIs('forms.create')) active @endif">
                                <i class="nav-icon fas fa-plus-circle"></i>
                                <p>Isi Formulir</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('access_forms.index') }}" class="nav-link @if(request()->routeIs('access_forms.index')) active @endif">
                                <i class="nav-icon fas fa-folder"></i>
                                <p>Formulir</p>
                            </a>
                        </li>
                        <!-- Menambahkan link untuk Visitor -->
                        <li class="nav-item">
                            <a href="{{ route('visitors.index') }}" class="nav-link @if(request()->routeIs('visitors.index')) active @endif">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Visitor</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('companies.create') }}" class="nav-link @if(request()->routeIs('companies.create')) active @endif">
                                <i class="nav-icon fas fa-building"></i>
                                <p>Tambah Perusahaan</p>
                            </a>
                        </li>
                        <!-- Add more links as needed -->
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    @yield('header')
                </div>
            </div>
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark"></aside>

        <!-- Main Footer -->
        <footer class="main-footer" style="background-color: #0B6E45; color: #FFFFFF;">
    <strong>Copyright &copy; 2024 <a href="https://www.bankntbsyariah.co.id/" style="color: #FFFFFF;">Bank NTB Syariah</a>.</strong>
    All rights reserved.
</footer>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/js/adminlte.min.js"></script>
    @yield('scripts')
</body>
</html>
