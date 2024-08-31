@php
    $fechaNacimiento = new DateTime($persona->fecha_nacimiento);
    $fechaActual = new DateTime();
    $edad = $fechaActual->diff($fechaNacimiento)->y;
@endphp
<x-app-layout>
    <x-slot name="css">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('theme/CryptoDash') }}/app-assets/vendors/css/forms/toggle/switchery.min.css">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('theme/CryptoDash') }}/app-assets/css/pages/account-profile.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/diagnosticos.css') }}">
    </x-slot>
    <x-slot name="js">
        <script src="{{ asset('theme/CryptoDash/app-assets/vendors/js/forms/toggle/switchery.min.js') }}"
            type="text/javascript"></script>
        <script src="{{ asset('theme/CryptoDash') }}/app-assets/js/scripts/forms/account-profile.js"
            type="text/javascript"></script>
    </x-slot>
    <x-slot name='header'>
        <div class="content-header-left col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Atención primaria</h3>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Síntomas</li>
                    </ol>
                </div>
            </div>
        </div>
    </x-slot>
    <div class="d-flex justify-content-end mr-5">
        <a class="btn btn-success text-white my-2" data-toggle="modal" data-target="#addSintomas">Añadir</a>
        @include('sintomas.agregarModal')
    </div>
    @include('layouts.mensajes')
    <div class="container mt-2">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="details-box">
                    <div class="col-md-4">
                        @if($persona->image)
                            <img src="{{ asset('images/' . $persona->image) }}" class="img-fluid rounded-circle"
                                style="max-width: 170px; max-height: 200px;">
                        @else
                            <img src="{{ asset('images/hombre.png') }}" class="img-fluid rounded-circle"
                                style="max-width: 170px; max-height: 200px;">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <table class="table details-table">
                            <tbody>
                                <tr>
                                    <th scope="row">Nombre y Apellido:</th>
                                    <td>{{ $persona->nombres }}
                                        {{ $persona->apellidos }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Cédula:</th>
                                    <td>{{ $persona->cedula }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Edad:</th>
                                    <td>{{ $edad }} años</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>