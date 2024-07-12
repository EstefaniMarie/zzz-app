@php
    $fechaNacimiento = new DateTime($diagnostico->consultas->first()->cita->paciente->fecha_nacimiento);
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
                        <li class="breadcrumb-item">Tratamientos</li>
                    </ol>
                </div>
            </div>
        </div>
    </x-slot>
    <div class="d-flex justify-content-end mr-5">
        <a class="btn btn-success text-white my-2" data-toggle="modal" data-target="#addDiagnosticos">Añadir</a>
    </div>
    @include('layouts.mensajes')
    <div class="container mt-2">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="details-box">
                    <div class="col-md-4">
                        <img src="{{ asset('images/example.png') }}" class="img-fluid rounded-circle"
                            style="max-width: 170px; max-height: 200px;">
                    </div>
                    <div class="col-md-8">
                        <table class="table details-table">
                            <tbody>
                                <tr>
                                    <th scope="row">Nombre y Apellido:</th>
                                    <td>{{ $diagnostico->consultas->first()->cita->paciente->nombres }}
                                        {{ $diagnostico->consultas->first()->cita->paciente->apellidos }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Cédula:</th>
                                    <td>{{ $diagnostico->consultas->first()->cita->paciente->cedula }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Edad:</th>
                                    <td>{{ $edad }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row mt-4">
                    @foreach ($tratamientos as $tratamiento)
                        <div class="col-md-4">
                            <div class="info-box">
                                <h4 class="text-center">{{ $tratamiento->tipo }}</h4>
                                <details>
                                    <summary>
                                        @php
                                            $maxLength = 230;
                                            $truncatedText = strlen($tratamiento->descripcion) > $maxLength ? substr($tratamiento->descripcion, 0, $maxLength) . '...' : $tratamiento->descripcion;
                                            echo $truncatedText;
                                        @endphp
                                    </summary>
                                    <p>{{ $tratamiento->descripcion }}</p>
                                </details>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-end">
                    {{ $tratamientos->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>