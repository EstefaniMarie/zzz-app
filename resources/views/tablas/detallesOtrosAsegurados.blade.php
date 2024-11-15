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
            <h3 class="content-header-title mb-0 d-inline-block">Administrador</h3>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb d-flex align-items-center">
                        <li class="breadcrumb-item">Tablas</li>
                        <li class="breadcrumb-separator mx-2">
                            <div class="separator"></div>
                        </li>
                        <li class="breadcrumb-item">Otros Asegurados</li>
                    </ol>
                </div>
            </div>
        </div>
    </x-slot>
    <div class="d-flex justify-content-end mr-5">
        <a class="btn btn-warning text-white my-2 mr-2" href="{{ route('tablas') }}">Regresar</a>
        <a class="btn btn-success text-white my-2" data-toggle="modal" data-target="#addOtroAsegurado">Añadir</a>
        @include('tablas.agregarOtroAsegurado')
    </div>
    @include('layouts.messages')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <h1 class="text-center">Otros Asegurados</h1>
                    <table style="width: 100% !important" id="otrosAseguradosTable"
                        class="example table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="text-align: left;">Cédula</th>
                                <th style="text-align: left;">Nombre y Apellido</th>
                                <th style="text-align: left;">Edad</th>
                                <th style="text-align: left;">Estatus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($otrosAsegurados as $otroAsegurado)
                                @php
                                    $fechaNacimiento = new DateTime($otroAsegurado->pacientes->personas->fecha_nacimiento);
                                    $fechaActual = new DateTime();
                                    $edad = $fechaActual->diff($fechaNacimiento)->y;
                                @endphp
                                <tr>
                                    <td style="text-align: left;">{{ $otroAsegurado->pacientes->personas->cedula }}</td>
                                    <td style="text-align: left;">{{ $otroAsegurado->pacientes->personas->nombres }}
                                        {{ $otroAsegurado->pacientes->personas->apellidos }}
                                    </td>
                                    <td style="text-align: left;">{{ $edad }}</td>
                                    <td>
                                        <button
                                            class="btn {{ $otroAsegurado->estatus == 1 ? 'btn-success' : 'btn-danger' }} btn-sm"
                                            onclick="toggleStatus({{ $otroAsegurado->id }}, {{ $otroAsegurado->estatus }})">
                                            {{ $otroAsegurado->estatus == 1 ? 'Activo' : 'Inactivo' }}
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .breadcrumb-separator .separator {
        height: 1px;
        background-color: #000;
        width: 30px;
    }
</style>

<script>
    new DataTable('#otrosAseguradosTable', {
        pageLength: 10,
        layout: {
            topStart: [
                'buttons',
                {
                    pageLength: {
                        menu: [10, 20, 50, 100]
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
                extend: 'colvis',
                text: 'Ocultar columnas',
                className: 'btn btn-secondary mb-2'
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

<script>
    function toggleStatus(id, currentStatus) {
        var newStatus = currentStatus == 1 ? 2 : 1;
        fetch(`/otrosAsegurados/${id}/status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ estatus: newStatus })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    var button = document.querySelector(`button[onclick="toggleStatus(${id}, ${currentStatus})"]`);
                    button.className = newStatus == 1 ? 'btn btn-success btn-sm' : 'btn btn-danger btn-sm';
                    button.innerText = newStatus == 1 ? 'Activo' : 'Inactivo';
                    button.setAttribute('onclick', `toggleStatus(${id}, ${newStatus})`);
                }
            })
            .catch(error => console.error('Error:', error));
    }
</script>
