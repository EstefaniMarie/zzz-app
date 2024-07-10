<x-modal name="createUser"  title="registro de usuario">
        <div class="row">
            <div class="col-6">
                <fieldset class="form-label-group">
                    <input type="text" class="form-control" id="dni" name="dni" required placeholder="">
                    <label for="dni">Cédula</label>
                </fieldset>
            </div>
            <div class="col-6">
                <fieldset class="form-label-group">
                    <input type="text" class="form-control" id="phone" name="phone" required placeholder="">
                    <label for="phone">Teléfono</label>
                </fieldset>
            </div>
            <div class="col-6">
                <fieldset class="form-label-group">
                    <input type="text" class="form-control" id="name" name="name" autocomplete="name"
                        required autofocus placeholder="">
                    <label for="name">Nombres</label>
                </fieldset>
            </div>
            <div class="col-6">
                <fieldset class="form-label-group">
                    <input type="text" class="form-control" id="last-name" name="last_name" required placeholder="">
                    <label for="last-name">Apellidos</label>
                </fieldset>
            </div>
            <div class="col-6">
                <fieldset class="form-label-group">
                    <input type="text" class="form-control" id="email-address" name="email" type="email" required
                        autocomplete="username" placeholder="">
                    <label for="email-address">Correo</label>
                </fieldset>
            </div>
            <div class="col-6">
                <fieldset class="form-label-group">
                    <select name="role" id="user-rol" class="form-control">
                        <option selected disabled>Rol</option>
                        @role('Root')
                            <option value="Root">Root</option>
                        @endrole
                        <option value="Administrador">Administrador</option>
                        <option value="Gerente">Gerente</option>
                        <option value="Vendedor">Vendedor</option>
                    </select>
                </fieldset>
            </div>
            <div class="col-6">
                <fieldset class="form-label-group">
                    <input type="password" class="form-control" id="new-password" placeholder="" required
                        name="password" autocomplete="new-password">
                    <label for="new-password">Contraseña</label>
                </fieldset>
            </div>
            <div class="col-6">
                <fieldset class="form-label-group">
                    <input type="password" class="form-control" id="conf-password" placeholder="" required
                        name="password_confirmation" autocomplete="new-password">
                    <label for="conf-password">Confirmar contraseña</label>
                </fieldset>
            </div>
        </div>
    </x-modal>