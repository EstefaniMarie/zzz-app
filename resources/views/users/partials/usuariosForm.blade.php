<form action="" method="post" id="userForm">
    @csrf
    <input type="hidden" name="idPersona" id="idPersona" value="" hidden>

    <div class="mb-2 form-row">
        <div class="col">
            <h6>Nombres</h6>
            <label for="nombres" class="form-label">
                <input class="form-control" type="text" name="nombres" id="nombres" value="" disabled>
                <div id="nombresError" class='invalid-text'></div>
            </label>
        </div>

        <div class="col">
            <h6>Apellidos</h6>
            <label for="apellidos" class="form-label">
                <input class="form-control" type="text" name="apellidos" id="apellidos" value="" disabled>
                <div id="apellidosError" class='invalid-text'></div>
            </label>
        </div>

        <div class="col">
            <h6>Cedula</h6>
            <label for="cedula" class="form-label">
                <input class="form-control" type="number" min="1000000" max="99999999" name="cedula" id="cedula" value="" disabled>
                <div id="cedulaError" class='invalid-text'></div>
            </label>
        </div>
    </div>

    <div id="telefono_fecha" style="display: none;">
        <hr>
        <div class="mb-2 row">
            <div class="col">
                <h6>Fecha Nacimiento</h6>
                <label for="fechaNacimiento" class="form-label"> 
                    <input type="date" class="form-control" name="fecha_nacimiento" id="fechaNacimiento" max="{{ date('Y-m-d') }}"> 
                    <div id="fechaNacimientoError" class='invalid-text'></div>
                </label>
            </div>
            <div class="col">
                <h6>Telefono</h6>
                <label for="numero_telefono" class="form-label">
                    <input class="form-control" type="tel" name="numero_telefono" id="numero_telefono" pattern="[0-4]{2}[1-6]{2}[0-9]{7}">
                    <div id="numero_telefonoError" class='invalid-text'></div>
                </label>
            </div>

            <div class="col">
                <h6>Genero</h6>
                <label for="idGenero" class="form-label">
                    <select class="form-control" name="idGenero" id="idGenero">
                        <option>Seleccione un genero</option>
                        <option value="1">Masculino</option>
                        <option value="2">Femenino</option>
                    </select>
                    <div id="idGeneroError" class='invalid-text'></div>
                </label>
            </div>
        </div>
    </div>
    
    
    <hr>

    <div class="mb-2 row">
        <div class="col">
            <h6>Email</h6>
            <label for="email" class="form-label">
                <input class="form-control" type="email" name="email" id="email" value="" autocomplete="email" disabled>
                <div id="emailError" class='invalid-text'></div>
            </label>
        </div>

        <div class="col" style="display: none;" id="password">
            <h6>Password</h6>
            <label for="passwordInput">
                <input class="form-control" type="password" name="password" id="passwordInput">
                <div id="passwordInputError" class='invalid-text'></div>
            </label>
        </div>

        <div class="col">
            <h6>Rol</h6>
            <label for="idRol">  
                <select class="form-control" name="idRol" id="idRol" disabled>
                    <option>Seleccione un rol</option>
                    <option value="2">Admin</option>
                    <option value="3">Medico</option>
                    <option value="4">Recepcionista</option>
                </select>
                <div id="idRolError" class='invalid-text'></div>
            </label>
        </div>

    </div>
    <div id="estatusCol">
        <h6>Estatus</h6>
        <label for="estatus">
            <select class="form-control" name="Status" id="estatus" disabled>
                <option>Seleccione un estatus</option>
                <option value="1">Activo</option>
                <option value="0">Bloqueado</option>
            </select>
            <div id="estatusError" class='invalid-text'></div>
        </label>
    </div>
    @include('users.partials.modalConfirmacion')
</form>
<hr>
<a class="btn btn-success text-white float-right mx-1 w-25" id="confirmarUsuarioBtn" data-target='#Confirmacion' data-toggle='modal' style="display: none;">
    Confirmar
</a>

<script>
    
</script>