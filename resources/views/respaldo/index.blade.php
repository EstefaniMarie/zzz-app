
<x-app-layout>
    <x-slot name="css">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('theme/CryptoDash') }}/app-assets/vendors/css/forms/toggle/switchery.min.css">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('theme/CryptoDash') }}/app-assets/css/pages/account-profile.css">
    </x-slot>
    <x-slot name="js">
        <script src="{{ asset('theme/CryptoDash') }}/app-assets/js/scripts/forms/account-profile.js" type="text/javascript">
        </script>
        <script src="{{ asset('theme/CryptoDash') }}/app-assets/vendors/js/forms/toggle/switchery.min.js"
            type="text/javascript"></script>
    </x-slot>
   
    <x-slot name="header">

        <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Administrador</h3>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a>
                        </li>
                        <li class="breadcrumb-item active">Respaldo
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </x-slot>

    @include('layouts.messages')
    
    <div class="content-fluid">
        <div class="row bg-white p-3 d-flex">
            <div class="col-md-8 me-2 border-right">
                <table id="BackupTable"  style="width: 100%" class="table text-black">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($syncs))
                            @foreach($syncs as $sync)
                                <td>{{$sync->created_at}}</td>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="col-md-2 m-auto text-center">
                <h2 class="font-weight-bold">Sincronizar</h2>
                <p class="text-muted">Seleccione su modo de sincronización de preferencia</p>
                <button class="btn btn-primary btn-sm">
                    <i class='icon-reload'></i>
                    Automático
                </button>
                <button class="btn btn-info btn-sm">
                    <i class="icon-plus"></i>
                    Manual
                </button>
              </div>
        </div>
    </div>

</x-app-layout>
<script src="{{asset('js/backup/BackupTable.js')}}"></script>
<script src="{{asset('js/backup/downloadBackup.js')}}"></script>