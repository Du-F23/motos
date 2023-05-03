<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        @yield('title')
    </title>
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/base/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
</head>

<body>
    @include('layouts.navbar')
    @yield('content')
    @include('layouts.footer')
    <script src="{{("assets/vendors/base/vendor.bundle.base.js")}}"></script>
    <script src="{{("assets/js/template.js")}}"></script>
    <script src="{{("assets/vendors/chart.js/Chart.min.js")}}"></script>
    <script src="{{("assets/vendors/progressbar.js/progressbar.min.js")}}"></script>
    <script src="{{("assets/vendors/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js")}}"></script>
    <script src="{{("assets/vendors/justgage/raphael-2.1.4.min.js")}}"></script>
    <script src="{{("assets/vendors/justgage/justgage.js")}}"></script>
    <script src="{{("assets/js/jquery.cookie.js")}}" type="text/javascript"></script>
    <script src="{{("assets/js/dashboard.js")}}"></script>
</body>

</html>
