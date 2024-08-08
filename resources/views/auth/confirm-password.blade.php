@extends('layouts.auth')

@section('title', 'Confirm Password')

@section('content')
    <div class="confirm-password-box">
        <div class="confirm-password-logo">
            <a href="{{ url('/') }}"><b>Confirm Password</b></a>
        </div>
        <div class="card">
            <div class="card-body confirm-password-card-body">
                <div class="mb-4 text-sm text-gray-600">
                    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                </div>

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <input type="password" id="password" name="password" class="form-control" placeholder="{{ __('Password') }}" required autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Confirm') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .confirm-password-box {
            width: 360px;
            margin: 7% auto;
        }
        .confirm-password-logo a {
            font-weight: bold;
            color: #333;
        }
        .confirm-password-card-body {
            padding: 20px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            border-radius: 5px;
        }
    </style>
@endsection
        