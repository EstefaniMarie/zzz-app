<form action="" method="post" id="userForm">
    @csrf
    <input type="hidden" name="idPersona" id="idPersona" value="" hidden>

    <div class="mb-3 form-row">
        <div class="col">
            <h6>Nombres</h6>
            <label for="" class="form-label">
                <input class="form-control" type="text" name="nombres" id="nombres" value="" disabled>
            </label>
        </div>

        <div class="col">
            <h6>Apellidos</h6>
            <label for="" class="form-label">
                <input class="form-control" type="text" name="apellidos" id="apellidos" value="" disabled>
            </label>
        </div>

        <div class="col">
            <h6>Cedula</h6>
            <label for="" class="form-label">
                <input class="form-control" type="number" min="1000000" max="99999999" name="cedula" id="cedula" value="" disabled>
            </label>
        </div>
    </div>

    
    <div class="mb-3 row" id="telefono_fecha" style="display: none;">
        <hr>
        <div class="col">
            <h6>Fecha Nacimiento</h6>
            <label for="" class="form-label"> 
                <input type="date" class="form-control" name="fecha_nacimiento" id="fechaNacimiento" max="{{ date('Y-m-d') }}" required>
            </label>
        </div>
        <div class="col">
            <h6>Telefono</h6>
            <label for="" class="form-label">
                <input class="form-control" type="tel" name="numero_telefono" pattern="[0-4]{2}[1-4]{2}[0-9]{7}">
            </label>
        </div>
    </div>
    
    <hr>

    <div class="mb-3 row">
        <div class="col">
            <h6>Email</h6>
            <label for="" class="form-label">
                <input class="form-control" type="email" name="email" id="email" value="" disabled>
            </label>
        </div>

        <div class="col" style="display: none;" id="password">
            <h6>Password</h6>
            <input class="form-control" type="password" name="password" id="password">
        </div>

        <div class="col">
            <h6>Rol</h6>
            <label for="">
                <select class="form-control" name="idRol" id="rol" disabled>
                    <option value="2">Admin</option>
                    <option value="3">Medico</option>
                    <option value="4">Recepcionista</option>
                    <option value="5">Farmaceutico</option>
                </select>
            </label>
        </div>
    </div>
    @include('users.partials.modalConfirmacion')
</form>
<hr>
<a class="btn btn-success text-white float-right mx-1 w-25" id="confirmarUsuarioBtn" data-target='#Confirmacion' data-toggle='modal' style="display: none;">
    Confirmar
</a>