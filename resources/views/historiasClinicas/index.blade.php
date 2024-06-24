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
        <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
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
                    <table class="example table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Cédula de Identidad</th>
                                <th>Nombre y Apellido</th> 
                                <th>Fecha de nacimiento</th>
                                <th>Cédula</th>
                                <th>Detalles</th>
                                <th class="no-export"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($historiales))
                                @foreach($historiales as $historial)
                                    @if ($historial->empleados)
                                        <tr>
                                            <td>{{ $historial->empleados->personas->nombres }}</td>
                                            <td>{{ $historial->empleados->personas->apellidos }}</td>
                                            <td>{{ $historial->empleados->personas->fecha_nacimiento }}</td>
                                            <td>{{ $historial->empleados->personas->cedula }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary ver-mas mx-1"
                                                    style="border: none; background: none;" data-toggle="modal"
                                                    data-target="#verDetalles{{ $historial->id }}">Ver</button>
                                            </td>
                                        </tr>
                                    @endif
                                    
                                    @if ($historial->otrosAsegurados)
                                        <tr>
                                            <td>{{ $historial->otrosAsegurados->personas->nombres }}</td>
                                            <td>{{ $historial->otrosAsegurados->personas->apellidos }}</td>
                                            <td>{{ $historial->otrosAsegurados->personas->fecha_nacimiento }}</td>
                                            <td>{{ $historial->otrosAsegurados->personas->cedula }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary ver-mas mx-1"
                                                    style="border: none; background: none;" data-toggle="modal"
                                                    data-target="#verDetalles{{ $historial->id }}">Ver</button>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                            {{-- @if(isset($historiales))
                                @foreach($historiales as $historial)
                                    <div class="modal fade" id="verDetalles{{ $historial->id }}" tabindex="-1"
                                        aria-labelledby="verDetallesLabel{{ $historial->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="verDetallesLabel{{ $historial->id }}">Detalles del Paciente/h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                        <h4 class="card-title mt-2 text-center">Paciente:
                                                            {{ $historial->paciente->primer_nombre . ' ' . $historial->paciente->primer_apellido }}
                                                        </h4>
                                                        <h6 class="card-title text-center">Cédula de Identidad:
                                                            {{ $historial->paciente->codtra }}</h6>
                                                        <h8 class="card-title text-center">Doctor(a):
                                                            {{ $historial->doctor->nombres }}</h8>
                                                        <h8 class="card-title text-center">Especialidad:
                                                            {{ $historial->especialidad->name }} </h8>
                                                        <h8 class="card-title text-center">Creado el:
                                                            {{ $historial->created_at->format('d/m/Y') }}</h8>
                                                    </div>
                                                    <div class="card">
                                                        <div class="col-12">
                                                            <p>Antecedentes personales: {!! nl2br(e($historial->personales)) !!}</p>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="col-12">
                                                            <p>Antecedentes familiares: {!! nl2br(e($historial->familiares)) !!} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
</x-app-layout>
