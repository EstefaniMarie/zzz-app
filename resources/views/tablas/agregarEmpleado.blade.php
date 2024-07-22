<div class="modal fade" id="addEmpleado" aria-labelledby="addEmpleado" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEmpleado">Añadir Empleado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body px-3 py-2">
                <form method="POST" action="{{ route('storeEmpleados') }}">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <fieldset class="form-group">
                                <label for="name" style="color:black;">Nombres</label>
                                <input type="text" class="form-control" name="nombres" required>
                            </fieldset>
                        </div>
                        <div class="col-6">
                            <fieldset class="form-group">
                                <label for="lastname" style="color:black;">Apellidos</label>
                                <input type="text" class="form-control" name="apellidos" required>
                            </fieldset>
                        </div>
                        <div class="col-6">
                            <fieldset class="form-group">
                                <label for="dni" style="color:black;">Cédula de Identidad</label>
                                <input type="number" class="form-control" name="cedula" required>
                            </fieldset>
                        </div>
                        <div class="col-6">
                            <fieldset class="form-group">
                                <label for="birthday" style="color:black;">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" name="fecha_nacimiento"
                                    max="{{ date('Y-m-d') }}" required>
                            </fieldset>
                        </div>
                        <div class="col-12">
                            <fieldset class="form-group">
                                <label for="unidad" style="color:black;">Nombre de Unidad</label>
                                <input type="text" class="form-control" name="nombre_unidad" required>
                            </fieldset>
                        </div>
                        <div class="col-6">
                            <fieldset class="form-group">
                                <label for="codtra" style="color:black;">Código de Trabajador</label>
                                <input type="number" class="form-control" name="codigoTrabajador" required>
                            </fieldset>
                        </div>
                        <div class="col-6">
                            <fieldset class="form-group">
                                <label for="genero">Género</label>
                                <select class="form-control" name="idGenero" id="genero" required>
                                    <option value="1">Masculino</option>
                                    <option value="2">Femenino</option>
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary mx-1 float-right">
                                Añadir
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $.ajax({
            url: '/get-parentesco',
            type: 'GET',
            success: function (data) {
                let parentescoSelect = $('.parentesco');
                parentescoSelect.empty();
                parentescoSelect.append('<option value="">Seleccione un parentesco</option>');
                $.each(data, function (index, parentesco) {
                    parentescoSelect.append('<option value="' + parentesco.id + '">' + parentesco.descripcion + '</option>');
                });
            },
            error: function () {
                console.error('Error al obtener la lista de parentesco');
            }
        });
    });
</script>
