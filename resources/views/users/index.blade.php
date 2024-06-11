{{-- {{ Auth::user()->roles->pluck('name') }} --}}
{{-- {{ $user()->getRoleNames() }} --}}

<x-app-layout>
    <x-slot name="css">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('theme/CryptoDash') }}/app-assets/vendors/css/forms/toggle/switchery.min.css">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('theme/CryptoDash') }}/app-assets/css/pages/account-profile.css">
    </x-slot>
    <x-slot name="js">
        <script src="{{ asset('theme/CryptoDash') }}/app-assets/js/scripts/forms/account-profile.js" type="text/javascript">
        </script>
        <script src="{{ asset('theme/CryptoDash') }}/app-assets/vendors/js/forms/toggle/switchery.min.js"
            type="text/javascript"></script>
    </x-slot>
    <x-modal name="createUser" route="{{ route('users.store') }}" title="registro de usuario">
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
    <x-slot name="header">
        <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Usuarios</h3>
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a>
                        </li>
                        <li class="breadcrumb-item active">Usuarios
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="content-header-right col-md-4 col-12 d-none d-md-inline-block">
            <div class="btn-group float-md-right">
                <a class="btn-gradient-primary btn-sm white" data-toggle="modal" data-target="#createUser">Crear
                    usuario</a>
            </div>
        </div>
    </x-slot>

    <div class="row">
        <div id="recent-transactions" class="col-12">
            <h6 class="my-2">{{ $head }}</h6>
            <div class="card">
                <div class="card-content">
                    <div class="table-responsive">
                        <table id="recent-orders" class="table table-hover table-xl mb-0">
                            <thead>
                                <tr>
                                    @foreach ($headers as $item)
                                        <th class="border-top-0">{{ $item }}</th>
                                    @endforeach
                                    <th class="border-top-0">Rol</th>
                                    <th class="border-top-0"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $user)
                                    <tr>
                                        @foreach ($indexs as $item)
                                            <td class="text-truncate">
                                                {{ $user->$item }}
                                            </td>
                                        @endforeach
                                        <td class="text-truncate">
                                            <a href="#"
                                                class="mb-0 btn-sm btn {{ $user->getRoleNames()[0] == 'Root' ? 'btn-outline-danger' : '' }} {{ $user->getRoleNames()[0] == 'Gerente' ? 'btn-outline-info' : '' }} {{ $user->getRoleNames()[0] == 'Vendedor' ? 'btn-outline-warning' : '' }} {{ $user->getRoleNames()[0] == 'Cliente' ? 'btn-outline-success' : '' }} round">{{ $user->getRoleNames()[0] }}</a>
                                        </td>
                                        <td class="text-truncate text-center">
                                            @role('Root')
                                                <a href="#">
                                                    <i class="mb-0 btn-sm btn icon-trash btn-outline-danger round"></i>
                                                </a>
                                            @endrole

                                            <a href="#">
                                                <i
                                                    class="mb-0 mx-1 btn-sm btn icon-pencil btn-outline-warning round"></i>
                                            </a>
                                            <a href="#">
                                                <i class="mb-0 btn-sm btn icon-eye btn-outline-info round"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
