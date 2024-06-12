<x-app-layout>
    <x-slot name="css">
        <link rel="stylesheet" href="{{ asset('update/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('update/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('update/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('update/select2/css/select2.min.css') }}">
        <style>
            .hidden {
                display: none;
            }
        </style>
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

        <script>
            document.getElementById('tipo').addEventListener('change', function () {
                var tipo = this.value;
                var empleadoFields = document.getElementById('empleado-fields');
                var cortesiaFields = document.getElementById('cortesia-fields');
                var familiarFields = document.getElementById('familiar-fields');
                if (tipo === 'empleado') {
                    empleadoFields.classList.remove('hidden');
                    cortesiaFields.classList.add('hidden');
                } else if (tipo === 'familiar') {
                    familiarFields.classList.remove('hidden');
                    empleadoFields.classList.add('hidden');
                    cortesiaFields.classList.add('hidden');
                } else if (tipo === 'cortesia'){
                    cortesiaFields.classList.remove('hidden');
                    empleadoFields.classList.add('hidden');
                    familiarFields.classList.add('hidden');
                } else {
                    empleadoFields.classList.add('hidden');
                    cortesiaFields.classList.add('hidden');
                    familiarFields.classList.add('hidden');
                }
            });
        </script>

    </x-slot>
    <x-modal name="addPacienteModal" route="" title="Registrar Paciente">
        <div class="row">
            <div class="col-12">
                <fieldset class="form-group">
                    <label for="primer_nombre">Nombres</label>
                    <input type="text" class="form-control" name="nombres" required>
                </fieldset>
            </div>
            <div class="col-12">
                <fieldset class="form-group">
                    <label for="name" style="color:black;">Apellidos</label>
                    <input type="text" class="form-control" name="apellidos" required>
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
                    <label for="nacimiento" style="color:black;">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" name="fecha_nacimiento" required>
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
                <fieldst class="form-group">
                    <label for="tipo">Tipo de Paciente</label>
                    <select class="form-control mb-2" id="tipo" name="tipo" required>
                        <option value="">Seleccione un tipo de Paciente</option>
                        <option value="empleado">Empleado</option>
                        <option value="familiar">Familiar de Empleado</option>
                        <option value="cortesia">Cortesía</option>
                    </select>
                </fieldst>
            </div>
            <div class="col-12">
                <div id="empleado-fields" class="hidden">
                    <fieldset class="form-group">
                        <label for="unidad">Nombre de Unidad</label>
                        <select class="form-control" id="unidad" name="nombre_unidad">
                            <option value=""></option>
                        </select>
                    </fieldset>
                </div>
            </div>
            <div class="col-12">
                <div id="familiar-fields" class="hidden">
                    <fieldset class="form-group">
                        <label for="unidad">Nombre y Apellido del Empleado</label>
                        <select class="form-control" id="unidad" name="nombre_unidad">
                            <option value=""></option>
                        </select>
                    </fieldset>
                </div>
            </div>
            <div class="col-12">
                <fieldst class="form-group">
                    <label for="tipo">Parentesco con el Empleado</label>
                    <select class="form-control mb-2" id="tipo" name="tipo" required>
                        <option value="">Seleccione un tipo de parentesco</option>
                        <option value="empleado">Empleado</option>
                        <option value="familiar">Familiar de Empleado</option>
                        <option value="cortesia">Cortesía</option>
                    </select>
                </fieldst>
            </div>
            <div id="cortesia-fields" class="hidden">
                <div>
                    <label for="tipo_cobertura">Tipo de Cobertura:</label>
                    <input type="text" id="tipo_cobertura" name="tipo_cobertura">
                </div>
                <div>
                    <label for="empleado_id">Empleado ID:</label>
                    <input type="number" id="empleado_id" name="empleado_id">
                </div>
                <div>
                    <label for="parentesco_id">Parentesco ID:</label>
                    <input type="number" id="parentesco_id" name="parentesco_id">
                </div>
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