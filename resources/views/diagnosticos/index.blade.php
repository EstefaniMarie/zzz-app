@php
    use Carbon\Carbon;
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
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <h1 class="text-center">Pacientes</h1>
                    <table style="width: 100% !important" id="diagnosticosTable"
                        class="example table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Fecha de Consulta</th>
                                <th style="text-align: left;">Cédula</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th style="text-align: left;">Edad</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($diagnosticos as $diagnostico)
                                @foreach($diagnostico->consultas as $consulta)
                                    @php
                                        $fechaNacimiento = new DateTime($consulta->cita->paciente->fecha_nacimiento);
                                        $fechaActual = new DateTime();
                                        $edad = $fechaActual->diff($fechaNacimiento)->y;
                                    @endphp
                                    <tr>
                                        <td style="text-align: left;">{{ Carbon::parse($consulta->fechaConsulta)->format('d-m-Y') }}</td>
                                        <td style="text-align: left;">{{ $consulta->cita->paciente->cedula }}</td>
                                        <td>{{ $consulta->cita->paciente->nombres }}</td>
                                        <td>{{ $consulta->cita->paciente->apellidos }}</td>
                                        <td style="text-align: left;">{{ $edad }}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</x-app-layout>
<script>
    new DataTable('#diagnosticosTable', {
        pageLength: 25,
        layout: {
            topStart: [
                'buttons',
                {
                    pageLength: {
                        menu: [25, 50, 100, "Todos"]
                    }
                }
            ],
            topEnd: {
                search: {
                    placeholder: 'Buscar'
                },
            },
            bottomStart: 'info',
            bottomEnd: {
                paging: {
                    numbers: 4
                }
            }
        },
        buttons: [
            {
                extend: 'pdfHtml5',
                className: 'btn btn-primary mb-1'
            },
            {
                extend: 'print',
                className: 'btn btn-primary mb-1'
            },
            {
                extend: 'excel',
                className: 'btn btn-primary mb-1'
            }
        ],
        language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    })
</script>