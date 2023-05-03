@extends('layouts.guest')
@section('title', 'Reset Password')

@section('content')

    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="main-panel">
                <div class="content-wrapper d-flex align-items-center auth px-0">
                    <div class="row w-100 mx-0">
                        <div class="col-lg-4 mx-auto">
                            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                                <div class="brand-logo">
                                    <img src="{{ asset('assets/images/logo.svg') }}" alt="logo">
                                </div>
                                <h4>New here?</h4>
                                <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
                                <form method="POST" action="{{ route('password.store') }}">
                                    @csrf
                                    <!-- Password Reset Token -->
                                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-lg" id="exampleInputEmail1"
                                            placeholder="Email" name="email" value="{{old('email')}}">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-lg"
                                            id="exampleInputPassword1" placeholder="New Password" name="password" value="{{old('password')}}">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-lg"
                                            id="exampleInputPassword2" placeholder="Confirm New Password"
                                            name="password_confirmation" value="{{old('password_confirmation')}}">
                                    </div>
                                    <div class="mt-3">
                                        <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                            type="submit">Reset Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
