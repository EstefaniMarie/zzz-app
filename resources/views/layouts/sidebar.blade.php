<div class="main-menu menu-fixed menu-dark menu-bg-default rounded menu-accordion menu-shadow">
    <div class="main-menu-content"><a class="navigation-brand d-none d-md-block d-lg-block d-xl-block"
            href="{{ route('dashboard') }}"><img class="brand-logo" alt="CryptoDash admin logo"
                src="{{ asset('images') . '/' . env('APP_FAVICON') }}" /></a>
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <x-nav-link :active="request()->routeIs('dashboard')" route="{{ route('dashboard') }}" icon="icon-grid">
                {{ __('Dashboard') }}
            </x-nav-link>
            <x-nav-link-dropdown title="Registros" icon="icon-settings">
            </x-nav-link-dropdown>
        </ul>
    </div>
</div>