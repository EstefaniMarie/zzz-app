<x-app-layout>
    <x-slot name="css">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('theme/CryptoDash') }}/app-assets/vendors/css/forms/toggle/switchery.min.css">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('theme/CryptoDash') }}/app-assets/css/pages/account-profile.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/citas.css') }}">
        @vite('resources/css/app.css')
    </x-slot>
    <x-slot name="js">
        <script src="{{ asset('theme/CryptoDash/app-assets/vendors/js/forms/toggle/switchery.min.js') }}"
            type="text/javascript"></script>
        <script src="{{ asset('theme/CryptoDash') }}/app-assets/js/scripts/forms/account-profile.js"
            type="text/javascript"></script>
        <script src="{{ asset('js/citas.js') }}" type="text/javascript"></script>
        @vite('resources/js/app.js')
    </x-slot>
    <x-slot name="header">
        <div class="content-header-left col-12 mb-2 breadcrumb-new">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="content-header-title mb-0 d-inline-block">Citas</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Asignación de Citas</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div>
                    <a class="btn btn-success text-white my-2" data-toggle="modal"
                        data-target="#addCitas">Añadir</a>
                        @include('citas.agregarModal')
                </div>
            </div>
        </div>
        @include('layouts.messages')
    </x-slot>
    <div class="container">
        <div class="row align-items-center justify-content-end mb-3">
            <div class="col-auto text-right">
                <label for="medicos" style="color:black; margin-right: 10px; margin-top:10px;">Médicos:</label>
            </div>
            <div class="col-auto">
                <select id="medicos" class="form-control-sm" style="min-width: 200px;">
                    <option value="">Seleccione algún médico</option>
                    @foreach ($medicos as $medico)
                        <option value="{{ $medico->usuario->persona->cedula }}">
                            {{ $medico->usuario->persona->nombres }} {{ $medico->usuario->persona->apellidos }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>


    <div id="calendar" data-eventos="{{ json_encode($eventos) }}"></div>
</x-app-layout>
