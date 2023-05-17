<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('assets') }}/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!-- Extra details for Live View on GitHub Pages -->
    <title>
        Kiểm tra lưới
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <!-- CSS Files -->
    <link href="{{ asset('assets') }}/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/css/now-ui-dashboard.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/css/select2.min.css" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <link href="{{ asset('assets') }}/demo/demo.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/js/app.js'])
</head>
@include('layouts.url.url')

<body class="{{ $class ?? '' }}">
    <div class="wrapper">
        @auth
            @include('layouts.page_template.auth')
        @endauth
        @guest
            @include('layouts.page_template.guest')
        @endguest
    </div>
    <!--   Core JS Files   -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="{{ asset('assets') }}/js/core/jquery.min.js"></script>
    <script src="{{ asset('assets') }}/js/core/popper.min.js"></script>
    <script src="{{ asset('assets') }}/js/core/bootstrap.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/chartjs.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/bootstrap-notify.js"></script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('APP_GOOGLE_MAPS') }}"></script>
    <!-- Control Center for Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets') }}/js/now-ui-dashboard.js?v=1.3.0" type="text/javascript"></script>
    <script src="{{ asset('assets') }}/js/select2.min.js" type="text/javascript"></script>
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <!-- Ui Dashboard DEMO methods, don't include it in your project! -->
    <script src="{{ asset('assets') }}/demo/demo.js"></script>
    @stack('js')
</body>

</html>
