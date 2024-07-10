@php
    $fechaNacimiento = new DateTime($consulta->cita->paciente->fecha_nacimiento);
    $fechaActual = new DateTime();
    $edad = $fechaActual->diff($fechaNacimiento)->y;
@endphp
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
    <x-slot name='header'>
        <div class="content-header-left col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Atención primaria</h3>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Diágnosticos</li>
                    </ol>
                </div>
            </div>
        </div>
    </x-slot>
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
                                    <td>{{ $consulta->cita->paciente->nombres }}
                                        {{ $consulta->cita->paciente->apellidos }} </td>
                                </tr>
                                <tr>
                                    <th scope="row">Cédula:</th>
                                    <td>{{ $consulta->cita->paciente->cedula }}</td>
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
                    @foreach ($diagnosticos as $diagnostico)
                    <div class="col-md-4">
                        <div class="info-box">
                            <h4 class="text-center"> {{ $diagnostico->tipo }}</h4>
                            <p>{{ $diagnostico->descripcion }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .details-box {
        border: 1px solid #ddd;
        padding: 15px;
        border-radius: 5px;
        display: flex;
        align-items: center;
    }

    .details-table {
        margin: 0;
    }

    .details-table th,
    .details-table td {
        text-transform: uppercase;
    }

    .info-box {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 15px;
        margin-top: 20px;
    }
</style>
