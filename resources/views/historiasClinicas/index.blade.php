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
                                <th>Nombre</th>
                                <th>Apellido</th> 
                                <th>Fecha de nacimiento</th>
                                <th>Cédula</th>
                                <th>Detalles</th>
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
                                                    {{-- data-toggle="modal" --}}
                                                    data-target="#Detalles" onclick='detallesClinicos({{$historial->empleados->personas}})'
                                                    data-persona-id='{{ $historial->empleados->personas->id }}'>
                                                    Ver
                                                </button>
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
                                                    {{-- data-toggle="modal" --}}
                                                    data-target="#Detalles" onclick='detallesClinicos({{$historial->otrosAsegurados->personas}})' 
                                                    data-persona-id='{{ $historial->otrosAsegurados->personas->id }}'>
                                                    Ver
                                                </button>
                                            </td>
                                        </tr>
                                    @endif
                                    @endforeach
                                    @include('historiasClinicas.partials.detallesModal')
                            @endif        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
</x-app-layout>
<script src="{{asset('js/detallesClinicos.js')}}"></script>
<script src="{{asset('js/antecedentesPersonalesForm.js')}}"></script>
<script src="{{asset('js/antecedentesFamiliaresForm.js')}}"></script>
