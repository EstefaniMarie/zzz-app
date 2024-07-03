<!-- - var bodyCustom = 'bg-blue bg-lighten-2' // Use any color palette class-->
<!DOCTYPE html>
<html class="loading" lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-textdirection="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Plantilla base de laravel 10 MINAGUAS">
    <meta name="keywords" content="dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="Raknerdev">
    <title>{{ config('app.name', 'Raknerdev') }}</title>
    <link rel="apple-touch-icon" href="{{ asset('images') . '/' . env('APP_FAVICON') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images') . '/' . env('APP_FAVICON') }}">
    <link
        href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i|Comfortaa:300,400,500,700"
        rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/CryptoDash') }}/app-assets/css/vendors.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/CryptoDash') }}/app-assets/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/CryptoDash') }}/app-assets/vendors/css/forms/icheck/custom.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/CryptoDash') }}/app-assets/css/app.css">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('theme/CryptoDash') }}/app-assets/css/core/menu/menu-types/vertical-compact-menu.css"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('theme/CryptoDash') }}/app-assets/vendors/css/cryptocoins/cryptocoins.css"> --}}

    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/CryptoDash') }}/app-assets/css/pages/account-login.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('theme/CryptoDash') }}/assets/css/style.css"> --}}
    <style>
        html body.bg-full-screen-image {
            background: url("{{ asset('images/login.jpg') }}") no-repeat center center fixed;
            -webkit-background-size: cover;
            background-size: cover;
        }
    </style>
    <!-- END Custom CSS-->
    @laravelPWA
</head>

<body class="vertical-layout vertical-compact-menu 1-column  bg-full-screen-image menu-expanded blank-page blank-page"
    data-open="click" data-menu="vertical-compact-menu" data-col="1-column">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="app-content content">
        <div class="content-wrapper">
            {{ $slot }}
        </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('theme/CryptoDash') }}/app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{ asset('theme/CryptoDash') }}/app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript">
    </script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN MODERN JS-->
    <script src="{{ asset('theme/CryptoDash') }}/app-assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="{{ asset('theme/CryptoDash') }}/app-assets/js/core/app.js" type="text/javascript"></script>
    <!-- END MODERN JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ asset('theme/CryptoDash') }}/app-assets/js/scripts/forms/form-login-register.js"
        type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
</body>

</html>


chown -R www-data: /var/www/plantilla/
chown -R www-data: /var/www/plantilla/storage/framework/cache
chown -R www-data: /var/www/plantilla/storage/framework/sessions
chown -R www-data: /var/www/plantilla/storage/framework/views
chown -R www-data: /var/www/plantilla/storage/logs/laravel.log
