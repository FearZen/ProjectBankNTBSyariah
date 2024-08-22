@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('/') }}"><b>Login</b></a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Silakan masuk untuk memulai sesi Anda</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <a href="{{ route('password.request') }}" class="forgot-password-link">Forgot Your Password?</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                    </div>
                </form>

                <p class="mt-3 mb-1">
                    Belum punya akun? <a href="{{ route('register') }}" class="daftar-disini">Daftar di sini</a>
                </p>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .login-box {
            width: 360px;
            margin: 7% auto;
        }
        .login-logo a {
            font-weight: bold;
            color: #333;
        }
        .login-card-body {
            padding: 20px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            border-radius: 5px;
        }
        .forgot-password-link {
            color: #0B6E45;
            text-decoration: none;
        }
        .forgot-password-link:hover {
            text-decoration: underline;
        }
        /* Tambahan untuk mengatur warna sesuai dengan template yang baru */
        .btn-primary {
            background-color: #0B6E45;
            border-color: #0B6E45;
        }
        .btn-primary:hover {
            background-color: #095837;
            border-color: #095837;
        }
        .daftar-disini{
            color:#0B6E45;
        }
    </style>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2.0/dist/js/adminlte.min.js"></script>
@endsection
