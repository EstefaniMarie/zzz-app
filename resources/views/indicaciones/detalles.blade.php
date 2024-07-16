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
                        @if($paciente->image)
                            <img src="{{ asset('images/' . $paciente->image) }}" class="img-fluid rounded-circle"
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
                                        $tratamiento = $indicacion->tratamientos->first();
                                        $diagnostico = $indicacion->recipes->first()->tratamiento->diagnosticoshasTratamiento->first();
                                        $medico = null;
                                        $especialidad = null;
                                        if ($diagnostico) {
                                            $diagnosticoConsulta = $diagnostico->diagnosticoConConsultas->first();
                                            if ($diagnosticoConsulta) {
                                                $consulta = $diagnosticoConsulta->consulta;
                                                if ($consulta) {
                                                    $cita = $consulta->cita;
                                                    if ($cita) {
                                                        $medico = $cita->medico;
                                                    }
                                                }
                                            }
                                        }
                                        if($medico){
                                            $citaMedico = $medico->citasMedico->first();
                                            if($citaMedico){
                                               $consultaMedico = $citaMedico->consultas->first();
                                               if($consultaMedico) {
                                                   $doctores = $consultaMedico->medicos->first();
                                                   if($doctores){
                                                       $especialidades = $doctores->especialidades->first();
                                                       if($especialidades){
                                                           $especialidad = $especialidades->descripcion;
                                                       }
                                                   }
                                               }
                                            }
                                        }
                                    @endphp
                                    <button type="button" class="pdfRecipe btn btn-sm btn-warning text-white my-2"
                                        data-recipe-paciente="{{ $paciente->nombres . ' ' . $paciente->apellidos }}"
                                        data-recipe-cedula="{{ $paciente->cedula }}" data-recipe-edad="{{ $edad }}"
                                        data-recipe-nombre="{{ $tratamiento->tipo }}"
                                        data-recipe-presentacion="{{ $tratamiento->descripcion }}"
                                        data-recipe-indicaciones="{{ $indicacion->descripcion }}"
                                        data-recipe-medico="{{ $medico ? $medico->nombres . ' ' . $medico->apellidos : '' }}"
                                        data-recipe-fecha="{{ $fecha }}" data-recipe-especialidades="{{ $especialidad }}">
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




<script>
    function agregarListeners() {
    const generarPDFButtons = document.querySelectorAll('.pdfRecipe');
    generarPDFButtons.forEach(button => {
        button.addEventListener('click', function() {
            const paciente = button.getAttribute('data-recipe-paciente');
            const cedula = button.getAttribute('data-recipe-cedula');
            const edad = button.getAttribute('data-recipe-edad');
            const nombre = button.getAttribute('data-recipe-nombre');
            const presentacion = button.getAttribute('data-recipe-presentacion');
            const fecha = button.getAttribute('data-recipe-fecha');
            const medico = button.getAttribute('data-recipe-medico');
            const especialidad = button.getAttribute('data-recipe-especialidades');

            let indicaciones = button.getAttribute('data-recipe-indicaciones');

            indicaciones = indicaciones?.replace(/\n/g, '<br>');

            const ventanaImpresion = window.open('', '_blank');

            ventanaImpresion.document.write('<!DOCTYPE html>');
            ventanaImpresion.document.write('<html><head><title>Receta Médica</title></head><body style="width: 100%; height: 100%; margin: 20px; display: flex;">');
            ventanaImpresion.document.write('<div style="width: 50%; position: relative;">');
            ventanaImpresion.document.write(`
            <div style="display: flex; justify-content: space-between;">
                <div style="float: left;">
                <p style="margin-bottom: 0; margin-top: 0; font-style: italic;">OFICINA DE GESTIÓN HUMANA</p>
                <p style="margin-bottom: 0; margin-top: 0; font-style: italic;">CENTRO MÉDICO ASISTENCIAL</p>
                <p style="margin-bottom: 0; margin-top: 0; font-style: italic;">DR. JOSÉ GREGORIO HERNÁNDEZ</p>
                </div>
                <div style="width: 35%; background-color: #0E528E; padding: 15px; border-bottom-left-radius: 20%; margin-right:50px;">
                <p style="margin-bottom: 0; margin-top: 0; font-size: 24px; font-weight: bold; text-align: center; color:white; text-transform: uppercase;">${especialidad}</p>
                </div>
            </div>
            `);
            ventanaImpresion.document.write(`
            <div style="display: flex; justify-content: space-between;">
                <p style="margin-bottom: 0; font-size: 20px; margin-left:50px;"><strong>Fecha: ${fecha} </strong> </p>
                <p style="margin-bottom: 0; font-size: 20px; margin-right:50px;"><strong>Doctor(a):</strong> ${medico} </p>
            </div>
            `);
            ventanaImpresion.document.write('<img src="{{url('/images/logo.png') }}"alt="Transparent Image" style="position: absolute; top: 80%; left: 50%; transform: translate(-50%, -50%); opacity: 0.2;">');
            ventanaImpresion.document.write('<div style="clear: both;"></div>');
            ventanaImpresion.document.write(`<h3 style="text-align:center; font-size: 30px;">Récipe Médico</h3>`);
            ventanaImpresion.document.write(`<p style="font-family:Arial, sans-serif; font-size: 25px; margin-left:20px; margin-right:20px; text-align:center;">Nombre y Apellido: ${paciente} </p>`);
            ventanaImpresion.document.write(`<p style="font-size: 21px; margin-left:20px; margin-right:20px; text-align:center;">Cédula de Identidad: ${cedula} </p>`);
            ventanaImpresion.document.write(`<p style="font-size: 21px; margin-left:20px; margin-right:20px; text-align:center;">Edad: ${edad} años</p>`);
            ventanaImpresion.document.write(`<p style="font-size: 16px; margin-left:20px; margin-right:20px;">Medicamento: ${nombre}</p>`);
            ventanaImpresion.document.write(`<p style="font-size: 16px; margin-left:20px; margin-right:20px;">Presentación: ${presentacion} </p>`);
            ventanaImpresion.document.write(`
                <div style="position: absolute; top:42rem; left: 20px; width: 190px; height: 40px; background-color: #0E528E; border-top-right-radius: 40%;"></div>
            `);
            ventanaImpresion.document.write(`
                <img src="/images/gobierno.png" alt="Gobierno Logo" style="position: absolute; bottom: 10px; right: 50px; width: 150px; height: 50px; top:42rem;">
            `);
            ventanaImpresion.document.write('</div>');
            ventanaImpresion.document.write('<div style="width: 50%; float: right; position: relative;">');
            ventanaImpresion.document.write(`
            <div style="display: flex; justify-content: space-between;">
                <div style="float: left;">
                <p style="margin-bottom: 0; margin-top: 0; font-style: italic;">OFICINA DE GESTIÓN HUMANA</p>
                <p style="margin-bottom: 0; margin-top: 0; font-style: italic;">CENTRO MÉDICO ASISTENCIAL</p>
                <p style="margin-bottom: 0; margin-top: 0; font-style: italic;">DR. JOSÉ GREGORIO HERNÁNDEZ</p>
                </div>
                <div style="width: 35%; background-color: #0E528E; padding: 15px; border-bottom-left-radius: 20%; margin-right:50px;">
                <p style="margin-bottom: 0; margin-top: 0; font-size: 24px; font-weight: bold; text-align: center; color:white; text-transform: uppercase;">${especialidad}</p>
                </div>
            </div>
            `);
            ventanaImpresion.document.write(`
            <div style="display: flex; justify-content: space-between;">
                <p style="margin-bottom: 0; font-size: 20px; margin-left:50px;"><strong>Fecha: ${fecha} </strong> </p>
                <p style="margin-bottom: 0; font-size: 20px; margin-right:50px;"><strong>Doctor(a):</strong> ${medico} </p>
            </div>
            `);
            ventanaImpresion.document.write('<img src="{{url('/images/logo.png') }}"alt="Transparent Image" style="position: absolute; top: 80%; left: 50%; transform: translate(-50%, -50%); opacity: 0.2;">');
            ventanaImpresion.document.write('<div style="clear: both;"></div>');
            ventanaImpresion.document.write(`<h3 style="text-align:center; font-size: 30px;">Indicaciones Médicas</h3>`);
            ventanaImpresion.document.write(`<p style="font-family:Arial, sans-serif; font-size: 25px; margin-left:20px; margin-right:20px; text-align:center;">Nombre y Apellido: ${paciente} </p>`);
            ventanaImpresion.document.write(`<p style="font-size: 21px; margin-left:20px; text-align:center; margin-right:20px;">Cédula de Identidad: ${cedula} </p>`);
            ventanaImpresion.document.write(`<p style="font-size: 21px; margin-left:20px; margin-right:20px; text-align:center;">Edad: ${edad} años</p>`);
            ventanaImpresion.document.write(`<p style="font-size: 16px; margin-left:20px; margin-right:20px;">Medicamento: ${nombre}</p>`);
            ventanaImpresion.document.write('<p style="font-size: 16px; margin-left:20px; margin-right:20px;">Indicaciones</p>');
        ventanaImpresion.document.write(`<p style="font-size: 16px; margin-left:20px; margin-right:20px; text-align:justify">${indicaciones}</p>`);
            ventanaImpresion.document.write(`
                <div style="position: absolute; top:42rem; left: 20px; width: 190px; height: 40px; background-color: #0E528E; border-top-right-radius: 40%;"></div>
            `);
            ventanaImpresion.document.write(`
                <img src="/images/gobierno.png" alt="Gobierno Logo" style="position: absolute; bottom: 10px; right: 50px; width: 150px; height: 50px; top:42rem;">
            `);
            ventanaImpresion.document.write('</div>');
            ventanaImpresion.document.write('</div>');
            ventanaImpresion.document.write('</body></html>');

            ventanaImpresion.document.close();

            ventanaImpresion.onload = function() {
                ventanaImpresion.print();
            };
        });
    });
}
agregarListeners();
</script>
