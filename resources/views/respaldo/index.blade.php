
<x-app-layout>
    <x-slot name="css">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('theme/CryptoDash') }}/app-assets/vendors/css/forms/toggle/switchery.min.css">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('theme/CryptoDash') }}/app-assets/css/pages/account-profile.css">
    </x-slot>
    <x-slot name="js">
        <script src="{{ asset('theme/CryptoDash') }}/app-assets/js/scripts/forms/account-profile.js" type="text/javascript">
        </script>
        <script src="{{ asset('theme/CryptoDash') }}/app-assets/vendors/js/forms/toggle/switchery.min.js"
            type="text/javascript"></script>
    </x-slot>
   
    <x-slot name="header">

        <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Administrador</h3>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a>
                        </li>
                        <li class="breadcrumb-item active">Respaldo
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </x-slot>
    
    @include('layouts.messages')
    
    <x-slot name="body">
        <div></div>
    </x-slot>
    
</x-app-layout>
