<x-app-layout>
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('update/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('update/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('update/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('update/select2/css/select2.min.css') }}">
    </x-slot>
    <x-slot name="js">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="{{ asset('update/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('update/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('update/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('update/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('update/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('update/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('update/jszip/jszip.min.js') }}"></script>
        <script src="{{ asset('update/pdfmake/pdfmake.min.js') }}"></script>
        <script src="{{ asset('update/pdfmake/vfs_fonts.js') }}"></script>
        <script src="{{ asset('update/datatables-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('update/datatables-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('update/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

        <script src="{{ asset('update/select2/js/select2.full.min.js') }}"></script>
    
    </x-slot>
    <x-modal name="addPacienteModal" route="" title="Registrar Paciente">
    <div class="row">
            <div class="col-6">
                <fieldset class="form-group">
                    <label for="primer_nombre">Nombres</label>
                    <input type="text" class="form-control" name="nombres" required>
                </fieldset>
            </div>
            <div class="col-6">
                <fieldset class="form-group">
                    <label for="name" style="color:black;">Apellidos</label>
                    <input type="text" class="form-control" name="apellidos" required>
                </fieldset>
            </div>    
            <div class="col-6">
                <fieldset class="form-group">
                    <label for="nacimiento" style="color:black;">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" name="fecha_nacimiento" required>
                </fieldset>
            </div>                                                                                     
            <div class="col-6">
                <fieldset class="form-group">
                <label for="name" style="color:black;">Cédula</label>
                    <input type="number" class="form-control" name="codtra">
                </fieldset>
            </div>
            <div class="col-6">
                <fieldset class="form-group">
                <label for="role" style="color:black;">Género</label>
                    <select class="form-control" name="sexo" required>
                        <option value="" disabled selected>Selecciona un género</option>
                        <option value="1">Femenino</option>
                        <option value="2">Masculino</option>
                    </select>
                </fieldset>
            </div>
            <div class="col-6">
                <fieldset class="form-group">
                    <label for="name" style="color:black;">Teléfono Celular</label>
                    <input type="number" class="form-control" name="numero_telefono">
                </fieldset>
            </div>
            <div class="col-12">
                <fieldset class="form-group">
                <label for="role" style="color:black;">Parentesco</label>
                    <select class="form-control" name="parentesco" required>
                        <option value="" disabled selected>Selecciona un parentesco</option>
                        <option value="1">Conyuge</option>
                        <option value="2">Hijo(a)</option>
                        <option value="3">Madre</option>
                        <option value="4">Padre</option>
                    </select>
                </fieldset>
            </div>
        </div>
    </x-modal>
    <x-slot name="header">
        <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Citas</h3>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Pacientes</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-header-right col-md-4 col-12 d-none d-md-inline-block">
            <div class="btn-group float-md-right">
                <a class="btn-gradient-primary btn-sm white mr-2" data-toggle="modal"
                    data-target="#addPacienteModal">Registrar Paciente</a>
            </div>
        </div>
        @include('layouts.mensajes')
    </x-slot>
</x-app-layout>