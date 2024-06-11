<x-app-layout>
    <x-slot name="css">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('theme/CryptoDash') }}/app-assets/vendors/css/forms/toggle/switchery.min.css">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('theme/CryptoDash') }}/app-assets/css/pages/account-profile.css">
    </x-slot>
    <x-slot name="js">
        <script src="{{ asset('theme/CryptoDash/app-assets/vendors/js/forms/toggle/switchery.min.js') }}"
            type="text/javascript"></script>
        <script src="{{ asset('theme/CryptoDash') }}/app-assets/js/scripts/forms/account-profile.js"
            type="text/javascript">
            </script>
    </x-slot>
    <x-slot name="header">
        <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Perfil de cuenta</h3>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a>
                        </li>
                        <li class="breadcrumb-item active">Perfil de cuenta
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-header-right col-md-4 col-12 d-none d-md-inline-block">
            <div class="btn-group float-md-right"><a class="btn-gradient-secondary btn-sm white"
                    href="{{ route('dashboard') }}">Regresar</a>
            </div>
        </div>
    </x-slot>

    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-12 col-md-8 mx-auto">
            <section class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-2 col-12">
                                    <img src="{{ asset('theme/CryptoDash') }}/app-assets/images/portrait/medium/avatar-m-1.png"
                                        class="rounded-circle height-100" alt="Card image" />
                                </div>
                                <div class="col-md-10 col-12">
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <p class="text-bold-700 text-uppercase mb-0">Cédula</p>
                                            <p class="mb-0">{{ $cedula }}</p>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <p class="text-bold-700 text-uppercase mb-0">Ultimo ingreso</p>
                                            <p class="mb-0">
                                                {{ $user->last_login ? $user->last_login->format('d/m/Y H:i:s') : 'Nunca' }}
                                            </p>
                                        </div>
                                    </div>
                                    <hr />
                                    @include('profile.partials.update-profile-information-form')
                                    @include('profile.partials.update-password-form')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>