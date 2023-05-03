@extends('layouts.guest')
@section('title', 'Register')

@section('content')
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
                            <h4>New here?</h4>
                            <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg"
                                        id="exampleInputUsername1" placeholder="Name" name="name">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" id="exampleInputEmail1"
                                        placeholder="Email" name="email">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg"
                                        id="exampleInputPassword1" placeholder="Password" name="password">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg"
                                        id="exampleInputPassword2" placeholder="Confirm Password" name="password_confirmation">
                                </div>
                                <div class="mb-4">
                                    {{-- si el check box es seleccionado, el usuario acepta los terminos y condiciones y lo deja registrar si no lo selecciona no lo deja registrar y regresa a la pagina de registro --}}
                                    <script>
                                        function checkTerms() {
                                            if (document.getElementById('terms').checked) {
                                                document.getElementById('submit').disabled = false;
                                            } else {
                                                document.getElementById('submit').disabled = true;
                                            }
                                        }
                                    </script>
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input">
                                            I agree to all Terms & Conditions
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button  class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                        type="submit">Register</button>
                                </div>
                                <div class="text-center mt-4 font-weight-light">
                                    Already have an account? <a href="{{url('/login')}}" class="text-primary">Login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
@endsection
