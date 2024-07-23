<div class="modal fade" id="addOtroAsegurado" aria-labelledby="addOtroAsegurado" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addOtroAsegurado">Añadir Otro Asegurado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body px-3 py-2">
                <form method="POST" action="{{ route('storeOtroAsegurado') }}">
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
                        <div class="col-6">
                            <fieldset class="form-group">
                                <label for="genero">Género</label>
                                <select class="form-control" name="idGenero" id="genero" required>
                                    <option value="1">Masculino</option>
                                    <option value="2">Femenino</option>
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-6">
                            <fieldset class="form-group">
                                <label for="genero">Parentesco</label>
                                <select class="form-control" name="idParentesco" id="parentesco" required>
                                    <option value="2">Cortesía</option>
                                    <option value="3">Conyuge</option>
                                    <option value="4">Hijo(a)</option>
                                    <option value="5">Madre</option>
                                    <option value="6">Padre</option>
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