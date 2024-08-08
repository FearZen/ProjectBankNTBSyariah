@extends('layouts.auth')

@section('title', 'Verify Email')

@section('content')
    <div class="verify-email-box">
        <div class="verify-email-logo">
            <a href="{{ url('/') }}"><b>Verify Email</b></a>
        </div>
        <div class="card">
            <div class="card-body verify-email-card-body">
                <div class="mb-4 text-sm text-gray-600">
                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                    </div>
                @endif

                <div class="mt-4 flex items-center justify-between">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf

                        <div>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Resend Verification Email') }}
                            </button>
                        </div>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="btn btn-link">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .verify-email-box {
            width: 360px;
            margin: 7% auto;
        }
        .verify-email-logo a {
            font-weight: bold;
            color: #333;
        }
        .verify-email-card-body {
            padding: 20px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            border-radius: 5px;
        }
    </style>
@endsection
