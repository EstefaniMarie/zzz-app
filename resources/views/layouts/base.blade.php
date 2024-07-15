<!DOCTYPE html>
<html class="loading" lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-textdirection="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Rosales-Youngo">
    <meta name="keywords" content="">
    <meta name="author" content="Rosales-Youngo">
    <title>{{ config('app.name', 'Rosales-Youngo') }}</title>
    <link
        href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i|Comfortaa:300,400,500,700"
        rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/CryptoDash') }}/app-assets/css/vendors.css">
    @if (isset($css))
        {{ $css }}
    @endif
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/CryptoDash') }}/app-assets/css/app.css">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/CryptoDash') }}/app-assets/css/core/menu/menu-types/vertical-compact-menu.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('theme/CryptoDash') }}/app-assets/vendors/css/cryptocoins/cryptocoins.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/CryptoDash') }}/assets/css/style.css">
    <!-- END Custom CSS-->
    <!-- Select2 css & script -->
    <link rel="stylesheet" href="{{ asset('update/select2/css/select2.min.css') }}">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="{{ asset('update/select2/js/select2.min.js') }}" defer></script>
    <!-- End Select2 script-->


    {{-- DATATABLES --}}
        <link rel="stylesheet" href="{{asset('update/DataTables/datatables.min.css')}}" />
        <script src="{{asset('update/DataTables/datatables.min.js')}}"></script>
    {{-- END DATATABLES --}}

    <link rel="stylesheet" href="{{asset('css/validations.css')}}">
    <script src="{{asset('js/utils.js')}}"></script>
</head>

<body class="vertical-layout vertical-compact-menu 2-columns   menu-expanded fixed-navbar" data-open="click"
    data-menu="vertical-compact-menu" data-col="2-columns">

    <!-- fixed-top-->
    @include('layouts.navbar')
    <!-- fixed-left-->
    @include('layouts.sidebar')
    <!-- container-->
    <div class="app-content content">
        <div class="content-wrapper">
            @if (isset($header))
                <div class="content-header row">
                    {{ $header }}
                </div>
            @endif
            <div class="content-body">
                {{ $slot }}
            </div>
        </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <footer class="footer footer-static footer-transparent row justify-content-center">
        <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
            <span class="float-md-left d-block d-md-inline-block">Copyright &copy;
                <script>
                    document.write(new Date().getFullYear())
                </script>
                <a class="text-bold-800 grey darken-2" href="#">
                    Sheldon Youngo & Estefani Rosales
                </a>, All rights reserved.
            </span>
        </p>
    </footer>

    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('theme/CryptoDash') }}/app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    @if (isset($js))
        {{ $js }}
    @endif
    <!-- BEGIN MODERN JS-->
    <script src="{{ asset('theme/CryptoDash') }}/app-assets/js/core/app-menu.js" type="text/javascript"></script>
    <script src="{{ asset('theme/CryptoDash') }}/app-assets/js/core/app.js" type="text/javascript"></script>
    <!-- END MODERN JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    {{-- <script src="{{ asset('theme/CryptoDash') }}/app-assets/js/scripts/pages/dashboard-ico.js" type="text/javascript"></script> --}}
    <!-- END PAGE LEVEL JS-->
</body>

</html>
