@extends('layouts.guest')
@section('title', 'Forgot Password')
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
                                <h4>For Resset Password! let's get started</h4>
                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-lg" id="exampleInputEmail1"
                                            placeholder="Email" name="email">
                                    </div>
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
    </form>
@endsection
