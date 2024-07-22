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
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Tablas</li>
                    </ol>
                </div>
            </div>
            <div class="container">
                <div class="row align-items-center justify-content-between mb-3">
                    <div class="col-auto text-left">
                        <label for="tablas" style="color:black; margin-right: 10px; margin-top:10px;">Tablas:</label>
                        <select id="tablas" class="form-control-sm my-2 ml-2" style="min-width: 200px;">
                            <option value="">Seleccione alguna tabla</option>
                            <option value="empleados">Empleados</option>
                            <option value="otrosAsegurados">Otros Asegurados</option>
                            <option value="parentesco">Parentesco</option>
                            <option value="especialidades">Especialidades</option>
                            <option value="medicos">Médicos</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>

<script>
    document.getElementById('tablas').addEventListener('change', function() {
        var selectedValue = this.value;
        var basePath = '/tablas/';
        var viewMapping = {
            empleados: 'detallesEmpleados',
            otrosAsegurados: 'detallesOtrosAsegurados',
            parentesco: 'detallesParentesco',
            especialidades: 'detallesEspecialidades',
            medicos: 'detallesMedicos'
        };

        if (selectedValue && viewMapping[selectedValue]) {
            // Redirige a la URL correspondiente
            window.location.href = viewMapping[selectedValue];
        }
    });
</script>
