{{-- <form class="form" method="post">
    <input type="text" value="ABCD" disabled>
    <input type="text" value="DEFG" disabled>
</form> --}}

<form method="post">
    @csrf
    <input type="hidden" name="idPersona" value="{{ $usuario->idPersona }}" hidden>

    <div class="mb-3 form-row">
        <div class="col">
            <h6>Nombres</h6>
            <label for="" class="form-label">
                <input class="form-control" type="text" name="nombres" placeholder="Nombres" disabled>
            </label>
        </div>

        <div class="col">
            <h6>Apellidos</h6>
            <label for="" class="form-label">
                <input class="form-control" type="text" name="apellidos" placeholder="Apellidos" disabled>
            </label>
        </div>

        <div class="col">
            <h6>Cedula</h6>
            <label for="" class="form-label">
                <input class="form-control" type="text" name="cedula" placeholder="Cedula" disabled>
            </label>
        </div>
    </div>

    <hr>

    <div class="mb-3 row">
        <div class="col">
            <h6>Email</h6>
            <label for="" class="form-label">
                <input class="form-control" type="email" name="email" placeholder="Email" disabled>
            </label>
        </div>

        <div class="col">
            <h6>Rol</h6>
            <label for="">
                <select name="roles" id="Roles" disabled></select>
            </label>
        </div>
    </div>

    <button class="btn btn-success ver-mas mx-1" id="crearAntecedente" >
        Editar
    </button>
</form>