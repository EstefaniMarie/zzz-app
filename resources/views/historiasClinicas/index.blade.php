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
        <div class="content-header-left col-12 mb-2 breadcrumb-new ">
            <h3 class="content-header-title mb-0 d-inline-block">Citas</h3>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Historias Clínicas</li>
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
                    @include('historiasClinicas.partials.añadirPacienteModal')
                    <table style="width: 100% !important" id="HistoriasClinicasTable" class="example table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Cédula</th>
                                <th>Nombre</th>
                                <th>Apellido</th> 
                                <th>Edad</th>
                                <th>Detalles</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($pacientes))
                                @foreach($pacientes as $paciente)
                                        <tr>
                                            <td>{{ $paciente->personas->cedula }}</td>
                                            <td>{{ $paciente->personas->nombres }}</td>
                                            <td>{{ $paciente->personas->apellidos }}</td>
                                            <td>
                                                <?php
                                                    $fechaNacimiento = new DateTime($paciente->personas->fecha_nacimiento);
                                                    $fechaActual = new DateTime();
                                                    $edad = $fechaActual->diff($fechaNacimiento)->y;
                                                    echo $edad;
                                                ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary ver-mas mx-1"
                                                    {{-- data-toggle="modal" --}}
                                                    data-target="#Detalles" onclick='detallesClinicos({{$paciente->personas}})'
                                                    data-persona-id='{{ $paciente->personas->id }}'>
                                                    Ver
                                                </button>
                                            </td>
                                        </tr>
                                @endforeach
                                @include('historiasClinicas.partials.detallesModal')
                                @include('layouts.messages')
                            @endif        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
</x-app-layout>
<script src="{{asset('js/detallesClinicos.js')}}"></script>
<!-- <script src="{{asset('js/crearAntecedente.js')}}"></script> -->
<script src="{{asset('js/antecedentesPersonalesForm.js')}}"></script>
<script src="{{asset('js/antecedentesFamiliaresForm.js')}}"></script>
<script>
    new DataTable('#HistoriasClinicasTable',{
        pageLength: 25,
        layout: {
            topStart :[
                'buttons',
                {
                    pageLength : {
                        menu: [25, 50, 100, "Todos"]
                    }
                }
            ],
            topEnd: {
                search: {
                    placeholder: 'Inserte por nombre, cedula o edad'
                },
                buttons: [
                    {
                        text: 'Añadir Paciente',
                        className: 'btn btn-success text-white my-2',
                        attr: {
                            'data-target': '#PacienteNuevo',
                            'data-toggle': 'modal'
                        }
                    }
                ]
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
