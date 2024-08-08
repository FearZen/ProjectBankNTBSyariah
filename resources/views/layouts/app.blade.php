<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    @yield('styles')

    <style>
        /* CSS untuk mengatur ukuran dan tampilan logo */

        .nav-item {
            right: 0;
            left: auto;
        }
        .brand-link {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem; /* Tambahkan padding jika diperlukan */
        }

        .brand-image {
            width: 150px; /* Sesuaikan ukuran logo sesuai kebutuhan */
            height: auto; /* Pertahankan rasio aspek */
        }

        .main-header .navbar {
            padding: 0.5rem 1rem; /* Sesuaikan padding navbar */
        }

        .nav-link {
            padding: 0.5rem 1rem; /* Sesuaikan padding untuk link navigasi */  
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark navbar-primary">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ms-auto">
                @if (Auth::check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link">
                <img src="{{ asset('assets/images/logodms.png') }}" alt="Bank NTB Syariah Logo" class="brand-image">
            </a>

            <div class="sidebar">
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
        <footer class="main-footer">
            <strong>Copyright &copy; 2024 <a href="https://www.bankntbsyariah.co.id/">Bank NTB Syariah</a>.</strong>
            All rights reserved.
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/js/adminlte.min.js"></script>
    @yield('scripts')
</body>
</html>
