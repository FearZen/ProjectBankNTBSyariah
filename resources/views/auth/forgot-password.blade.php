@extends('layouts.auth')

@section('title', 'Forgot Password')

@section('content')
    <div class="forgot-password-box">
        <div class="forgot-password-logo">
            <a href="{{ url('/') }}"><b>Forgot Password</b></a>
        </div>
        <div class="card">
            <div class="card-body forgot-password-card-body">
                <div class="mb-4 text-sm text-gray-600">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </div>

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <input type="email" id="email" name="email" class="form-control" placeholder="{{ __('Email') }}" value="{{ old('email') }}" required autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Email Password Reset Link') }}
                        </button>
                    </div>
                </form>

                <p class="mt-3 mb-1">
                    <a href="{{ route('login') }}">Back to Login</a>
                </p>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .forgot-password-box {
            width: 360px;
            margin: 7% auto;
        }
        .forgot-password-logo a {
            font-weight: bold;
            color: #333;
        }
        .forgot-password-card-body {
            padding: 20px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            border-radius: 5px;
        }
    </style>
@endsection
