<div class="modal fade w-100 mx-auto" id="PacienteNuevo"  aria-labelledby="PacienteNuevo" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="PacienteNuevo">Añadir antecedente PacienteNuevo</h5>
                <button type="button" id="PacienteNuevoClose" data-dismiss="modal" class="close" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('añadirPaciente')}}" method="post">
                    @csrf

                    <div class="mb-3 row">
                        <div class="col">
                            {{-- <h6>Nombres</h6> --}}
                            <label for="" class="form-label">
                                Nombres
                            </label>
                            <input class="form-control" type="text" name="nombres" placeholder="Alejandro Figuera" required>
                        </div>

                        <div class="col">
                            {{-- <h6>Apellidos</h6> --}}
                            <label for="" class="form-label">
                                Apellidos
                            </label>
                            <input class="form-control form-control-sm" type="text" name="apellidos" placeholder="Rivera Molina" required> 
                        </div>

                        <div class="col">
                            <label for="cedula">
                                Cedula
                            </label>
                            <input class="form-control form-control-sm" type="number" name="cedula" id="cedula" placeholder="12345678"  minlength='6' maxlength="8">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="form-group mx-3">
                            <label for="fechaNacimiento">
                                Fecha de Nacimiento
                            </label>
                            <br>
                            <input type="date" class="form-control" name="fecha_nacimiento" id="fechaNacimiento" max="{{ date('Y-m-d') }}" required>
                        </div>
                        
                        <div class="form-group mx-3">
                            <label for="" class="form-label">
                                <h6>Telefono</h6>
                                <input class="form-control" type="tel" name="numero_telefono" pattern="[0-4]{2}[1-6]{2}[0-9]{7}" required>
                            </label>
                        </div>

                        <div class="form-group mx-4">
                            <label for="genero">
                                Genero
                            </label>
                            <select class="form-control" name="idGenero" id="genero" required>
                                <option value="1">Masculino</option>
                                <option value="2">Femenino</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <button class="btn btn-success ver-mas mx-1">
                        Añadir
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>