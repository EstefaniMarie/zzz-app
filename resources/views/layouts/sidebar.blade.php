@php
    $user = auth()->user();
@endphp
<div class="main-menu menu-fixed menu-dark menu-bg-default rounded menu-accordion menu-shadow">
    <div class="main-menu-content">
        <a class="navigation-brand d-none d-md-block d-lg-block d-xl-block" href="{{ route('dashboard') }}">
            <img class="brand-logo" alt="CryptoDash admin logo" src="{{ asset('images/logo.png') }}"/>
        </a>
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <x-nav-link-dropdown title="Citas" icon="icon-calendar">
                {{-- <li>
                    <a class="menu-item" href="{{ route('pacientes') }}">Pacientes</a>
                </li> --}}
                <li>
                    <a class="menu-item" href="{{route('historiasClinicas')}}">Historia Clinica</a>
                </li>
                <li>
                    <a class="menu-item" href="listados.recipes">Asignación de Citas</a>
                </li>
            </x-nav-link-dropdown>
            <x-nav-link-dropdown title="Atención Primaria" icon="icon-heart">
                <li>
                    <a class="menu-item">Diágnostico</a>
                </li>
                <li>
                    <a class="menu-item">Tratamiento</a>
                </li>
                <li>
                    <a class="menu-item" href="listados.recipes">Recipes e Indicaciones</a>
                </li>
            </x-nav-link-dropdown>
            <x-nav-link-dropdown title="Inventario de Medicamentos" icon="icon-docs">
                <li>
                    <a class="menu-item" href="listados.inventario">Registro de Inventario</a>
                </li>
                <li>
                    <a class="menu-item" href="listados.entregaMedicamento">Entrega de Medicamentos</a>
                </li>
            </x-nav-link-dropdown>
            @if($user->role_id === 1 || $user->role_id === 2)
                <x-nav-link route="listados.usuarios" icon="icon-users">
                    {{ __('Usuarios') }}
                </x-nav-link>
            @endif
            <x-nav-link route="listados.estadisticas" icon="icon-printer">
                {{ __('Estadística') }}
            </x-nav-link>
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
