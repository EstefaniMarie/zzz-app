{{-- <form class="form" method="post">
    <input type="text" value="ABCD" disabled>
    <input type="text" value="DEFG" disabled>
</form> --}}

<form method="post">
    @csrf
    {{-- <input type="hidden" name="idPersona" value="{{ $usuario->idPersona }}" hidden> --}}

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
                <input class="form-control" type="text" name="cedula" id="cedula" value="" disabled>
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

        <div class="col">
            <h6>Rol</h6>
            <label for="">
                <select name="roles" id="rol" disabled>
                    <option value="2">Admin</option>
                    <option value="3">Medico</option>
                    <option value="4">Recepcionista</option>
                    <option value="5">Farmaceutico</option>
                </select>
            </label>
        </div>
    </div>

    <button class="btn btn-success ver-mas mx-1" id="editarUsuario" style="display: none;">
        Editar
    </button>
</form>