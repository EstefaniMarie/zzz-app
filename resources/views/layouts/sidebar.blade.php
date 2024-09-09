@php
    $user = auth()->user();
@endphp
<div class="main-menu menu-fixed menu-dark menu-bg-default rounded menu-accordion menu-shadow w-80">
    <div class="main-menu-content">
        <a class="navigation-brand d-none d-md-block d-lg-block d-xl-block" href="{{ route('dashboard') }}">
            <img class="brand-logo" alt="CryptoDash admin logo" src="{{ asset('images/logo.png') }}"
                style="width:8.3rem; height:8rem;" />
        </a>
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            @hasanyrole('admin|Recepcionista')
            <x-nav-link-dropdown title="Citas" icon="icon-calendar">
                <li>
                    <a class="menu-item" href="{{ route('historiasClinicas') }}">Historia Clinica</a>
                </li>
                <li>
                    <a class="menu-item" href="{{ route('citas') }}">Asignación de Citas</a>
                </li>
            </x-nav-link-dropdown>
            @endhasanyrole
            @hasanyrole('admin|Medico')
            <x-nav-link-dropdown title="Atención Primaria" icon="icon-heart">
                <li>
                    <a class="menu-item" href="{{ route('sintomas') }}">Síntomas</a>
                </li>
                <li>
                    <a class="menu-item" href="{{ route('diagnosticos') }}">Diágnosticos</a>
                </li>
                <li>
                    <a class="menu-item" href="{{ route('tratamientos') }}">Tratamiento</a>
                </li>
                <li>
                    <a class="menu-item" href="{{ route('indicaciones') }}">Indicaciones</a>
                </li>
            </x-nav-link-dropdown>
            @endhasanyrole
            @role('admin')
            <x-nav-link-dropdown title="Administrador" icon="icon-layers">
                <li>
                    <a class="menu-item" href="{{route('usuarios')}}">Usuarios</a>
                </li>
                <li>
                    <a class="menu-item" href="{{route('respaldo')}}">Respaldo</a>
                </li>
                <li>
                    <a class="menu-item" href="{{route('tablas')}}">Tablas</a>
                </li>
            </x-nav-link-dropdown>
            @endrole
            @role('admin')
            <x-nav-link route="estadisticas" icon="icon-printer">
                {{ __('Estadística') }}
            </x-nav-link>
            @endrole
        </ul>
    </div>
</div>

<style>
    .vertical-compact-menu .main-menu .navigation-brand {
        display: inline-block;
        padding-left: 0.5rem;
        padding-right: 0.5rem;
        margin-left: auto;
        margin-right: auto;
    }
</style>