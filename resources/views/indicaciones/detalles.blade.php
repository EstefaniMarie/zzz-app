@php
    $fechaNacimiento = new DateTime($paciente->fecha_nacimiento);
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
        <script src="{{ asset('js/recipes.js') }}" type="text/javascript"></script>
    </x-slot>
    <x-slot name='header'>
        <div class="content-header-left col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Atención primaria</h3>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Indicaciones</li>
                    </ol>
                </div>
            </div>
        </div>
    </x-slot>
    <div class="d-flex justify-content-end mr-5">
        <a class="btn btn-success text-white my-2" data-toggle="modal" data-target="#addIndicaciones">Añadir</a>
        @include('indicaciones.agregarModal')
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
                                    <td>{{ $paciente->nombres }}
                                        {{ $paciente->apellidos }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Cédula:</th>
                                    <td>{{ $paciente->cedula }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Edad:</th>
                                    <td>{{ $edad }} años</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row mt-4">
                    @foreach ($paginacionIndicaciones as $indicacion)
                        <div class="col-md-4">
                            <div class="info-box">
                                <div class="d-flex justify-content-center">
                                    @php
                                        $fecha = \Carbon\Carbon::parse($indicacion->created_at)->format('d-m-Y');
                                        $tratamiento = $tratamientos->first();
                                    @endphp
                                    <button type="button" class="pdfRecipe btn btn-sm btn-warning text-white my-2" 
                                        data-recipe-paciente="{{ $paciente->nombres . ' ' . $paciente->apellidos }}" 
                                        data-recipe-cedula="{{ $paciente->cedula }}" 
                                        data-recipe-edad="{{ $edad }}" 
                                        data-recipe-nombre="{{ $tratamiento->tipo }}" 
                                        data-recipe-presentacion="{{ $tratamiento->descripcion }}" 
                                        data-recipe-indicaciones="{{ $indicacion->descripcion }}" data-recipe-fecha="{{ $fecha }}">
                                        Imprimir
                                    </button>
                                </div>
                                <h4 class="text-center">{{ $indicacion->tipo }}</h4>
                                <details>
                                    <summary>
                                        @php
                                            $maxLength = 230;
                                            $truncatedText = strlen($indicacion->descripcion) > $maxLength ? substr($indicacion->descripcion, 0, $maxLength) . '...' : $indicacion->descripcion;
                                            echo $truncatedText;
                                        @endphp
                                    </summary>
                                    <p>{{ $indicacion->descripcion }}</p>
                                </details>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-end">
                    {{ $paginacionIndicaciones->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
