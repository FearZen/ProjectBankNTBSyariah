@extends('layouts.auth')

@section('title', 'Register')

@section('content')
    <div class="register-box">
        <div class="register-logo">
            <a href="{{ url('/') }}"><b>Register</b></a>
        </div>
        <div class="card">
            <div class="card-body register-card-body">

                {{-- Pesan kesalahan validasi --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Form registrasi --}}
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- Input nama --}}
                    <div class="input-group mb-3">
                        <input type="text" id="name" name="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                    </div>

                    {{-- Input email --}}
                    <div class="input-group mb-3">
                        <input type="email" id="email" name="email" class="form-control" placeholder="{{ __('Email') }}" value="{{ old('email') }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </div>
                        </div>
                    </div>

                    {{-- Input password --}}
                    <div class="input-group mb-3">
                        <input type="password" id="password" name="password" class="form-control" placeholder="{{ __('Password') }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                    </div>

                    {{-- Konfirmasi password --}}
                    <div class="input-group mb-3">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="{{ __('Confirm Password') }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                    </div>

                    {{-- Tombol daftar dan link untuk login --}}
                    <div class="row">
                        <div class="col-8">
                            <a class="btn btn-link" href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                            </a>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .register-box {
            width: 360px;
            margin: 7% auto;
        }
        .register-logo a {
            font-weight: bold;
            color: #333;
        }
        .register-card-body {
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #0B6E45;
            border-color: #0B6E45;
        }
        .btn-primary:hover {
            background-color: #094e32;
            border-color: #094e32;
        }
        .input-group-text {
            background-color: #A2CA71;
            border-color: #A2CA71;
            color: #000;
        }
        .alert-danger {
            margin-bottom: 20px;
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
    </style>
@endsection
