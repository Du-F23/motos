@extends('layouts.guest')
@section('title', 'Login')
@section('content')
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="container-scroller">
            <div class="container-fluid page-body-wrapper full-page-wrapper">
                <div class="main-panel">
                    <div class="content-wrapper d-flex align-items-center auth px-0">
                        <div class="row w-100 mx-0">
                            <div class="col-lg-4 mx-auto">
                                <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                                    <div class="brand-logo">
                                        <img src="{{asset("assets/images/logo.svg")}}" alt="logo">
                                    </div>
                                    <h4>Hello! let's get started</h4>
                                    <h6 class="font-weight-light">Sign in to continue.</h6>
                                    <form class="pt-3">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-lg"
                                                id="exampleInputEmail1" placeholder="Email" name="email">
                                            @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-lg"
                                                id="exampleInputPassword1" placeholder="Password" name="password">
                                            @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mt-3">
                                            <button
                                                class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                                type="submit">Login</button>
                                        </div>
                                        <div class="my-2 d-flex justify-content-between align-items-center">
                                            <div class="form-check">
                                                <label class="form-check-label text-muted">
                                                    <input type="checkbox" class="form-check-input">
                                                    Keep me signed in
                                                </label>
                                            </div>
                                            {{-- <a href="{{url('/forgot-password')}}" class="auth-link text-black">Forgot password?</a> --}}
                                            @if (Route::has('password.request'))
                                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                    href="{{ route('password.request') }}">
                                                    {{ __('Forgot your password?') }}
                                                </a>
                                            @endif
                                        </div>
                                        <div class="text-center mt-4 font-weight-light">
                                            Don't have an account? <a href="{{ url('/register') }}"
                                                class="text-primary">Create</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
