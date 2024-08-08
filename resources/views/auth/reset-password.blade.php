@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')
    <div class="reset-password-box">
        <div class="reset-password-logo">
            <a href="{{ url('/') }}"><b>Reset Password</b></a>
        </div>
        <div class="card">
            <div class="card-body reset-password-card-body">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="input-group mb-3">
                        <input type="email" id="email" name="email" class="form-control" placeholder="{{ __('Email') }}" value="{{ old('email', $request->email) }}" required autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" id="password" name="password" class="form-control" placeholder="{{ __('Password') }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="{{ __('Confirm Password') }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .reset-password-box {
            width: 360px;
            margin: 7% auto;
        }
        .reset-password-logo a {
            font-weight: bold;
            color: #333;
        }
        .reset-password-card-body {
            padding: 20px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            border-radius: 5px;
        }
    </style>
@endsection
