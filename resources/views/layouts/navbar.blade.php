<div class="horizontal-menu">
    <nav class="navbar top-navbar col-lg-12 col-12 p-0">
        <div class="container-fluid">
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
                <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo" href="{{ url('/') }}"><img
                            src="{{ asset('assets/images/logo.sv') }}g" alt="logo"/></a>
                    <a class="navbar-brand brand-logo-mini" href="{{ url('/') }}"><img
                            src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo"/></a>
                    <h4 class="font-weight-bold mb-0 d-none d-md-block mt-1 text-white">&nbsp;&nbsp;{{config('app.name')}}</h4>
                </div>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item dropdown  d-lg-flex d-none">
                    </li>
                    <li class="nav-item dropdown d-lg-flex d-none">
                    </li>
                    @if (!Auth::check())
                        <li class="nav-item dropdown d-lg-flex d-none">
                            <a href="{{ url('/login') }}" type="button"
                               class="btn btn-inverse-primary btn-sm">Login</a>
                        </li>
                        or
                        <li class="nav-item dropdown d-lg-flex d-none">
                            <a href="{{ url('/register') }}" type="button"
                               class="btn btn-inverse-primary btn-sm">Register</a>
                        </li>
                    @endif
                    @if (Auth::check())
                        <li class="nav-item nav-profile dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                               id="profileDropdown">
                                <span class="nav-profile-name">{{ Auth::user()->name }}</span>
                                <span class="online-status"></span>
                                <img src="{{ asset('assets/images/faces/face28.png') }}" alt="profile"/>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                                 aria-labelledby="profileDropdown">
                                <a class="dropdown-item">
                                    <i class="mdi mdi-settings text-primary"></i>
                                    Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      class="d-none">
                                    @csrf
                                </form>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="mdi mdi-logout text-primary"></i>
                                    {{ __('Logout') }}
                                </a>
                            </div>
                        </li>
                    @endif
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                        data-toggle="horizontal-menu-toggle">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </div>
    </nav>
    <nav class="bottom-navbar">
        <div class="container">
            <ul class="nav page-navigation">
                <li class="nav-item {{ Request::is('/dashboard') ? 'active' : ''}}">
                    <a href="{{ url('/dashboard') }}" class="nav-link">
                        <i class="mdi mdi-file-document-box menu-icon"></i>
                        <span class="menu-title">
                            Inicio
                        </span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('/categorias') ? 'active' : ''}}">
                    <a class="nav-link" href="{{route('categories.index')}}">
                        <i class="mdi mdi-cube-outline menu-icon"></i>
                        <span class="menu-title">Categorias</span>
                        <i class="menu-arrow"></i>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('/motos') ? 'active' : ''}} {{ Request::is('/motos/*/show') ? 'active' : ''}}">
                    <a href="{{route('motos.index')}}" class="nav-link">
                        <i class="mdi mdi-motorbike menu-icon"></i>
                        <span class="menu-title">Motos</span>
                        <i class="menu-arrow"></i>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('/productos') ? 'active' : ''}}">
                    <a class="nav-link" href="{{route('products.index')}}">
                        <i class="mdi mdi-store menu-icon"></i>
                        <span class="menu-title">Productos</span>
                        <i class="menu-arrow"></i>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('/servicios') ? 'active' : ''}}">
                    <a href="{{ route('services.index') }}" class="nav-link">
                        <i class="mdi mdi-notebook-outline"></i>
                        <span class="menu-title">Servicios</span>
                        <i class="menu-arrow"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</div>
