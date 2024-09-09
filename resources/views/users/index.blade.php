<x-app-layout>
    <x-slot name="css">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('theme/CryptoDash') }}/app-assets/vendors/css/forms/toggle/switchery.min.css">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('theme/CryptoDash') }}/app-assets/css/pages/account-profile.css">
    </x-slot>
    <x-slot name="js">
        <script src="{{ asset('theme/CryptoDash') }}/app-assets/js/scripts/forms/account-profile.js"
            type="text/javascript">
            </script>
        <script src="{{ asset('theme/CryptoDash') }}/app-assets/vendors/js/forms/toggle/switchery.min.js"
            type="text/javascript"></script>
    </x-slot>

    <x-slot name="header">

        <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Admninistrador</h3>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a>
                        </li>
                        <li class="breadcrumb-item active">Usuarios
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-header-right col-md-4 col-12 d-none d-md-inline-block">
            <div class="btn-group float-md-right">
                <a id="crearUsuarioBtn" data-active="false" class="btn-gradient-primary btn-sm text-white">
                    Crear usuario
                </a>
            </div>
        </div>
    </x-slot>

    @include('layouts.messages')
    <div class="row justify-content-around bg-white p-1 rounded">
        <div class="col-md-5 me-2 border-right">
            <table style="width: 100%" id="UsuariosTable" class="table text-black">
                <thead class="">
                    <tr>
                        <th>ID</th>
                        <th>Cédula</th>
                        <th>Nombres</th>
                        <th>Estatus</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($usuarios))
                        @foreach($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->idPersona}}</td>
                                <td>{{ $usuario->cedula }}</td>
                                <td>{{ $usuario->nombres }}</td>
                                <td>{{ $usuario->Status == 1 ? 'Activo' : 'Bloqueado' }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="col-sm-5 w-80">
            <div class="card border border-secondary mb-3 shadow-lg">
                <div
                    class="card-header border border-top-0 border-left-0 border-right-0 shadow-md bg-transparent border-secondary">
                    <h3 class="card-title" id="tituloForm">DETALLES</h3>
                </div>
                <div class="card-body">
                    <div class="card-text">
                        {{-- Contenedor donde se mostrarán los datos del usuario seleccionado --}}
                        @include('users.partials.usuariosForm')
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
<!-- USERS DATATABLE SETTING -->
<script src="{{asset('js/UsuariosTable.js')}}"></script>
<script src="{{asset('js/detallesUsuarios.js')}}"></script>
<script src="{{asset('js/usuariosFormValidator.js')}}"></script>
