<nav
    class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-light navbar-bg-color">
    <div class="navbar-wrapper">
        <div class="navbar-header d-md-none">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                        href="#"><i class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item d-md-none"><a class="navbar-brand" href="{{ route('dashboard') }}"><img
                            class="brand-logo d-none d-md-block" alt="CryptoDash admin logo"
                            src="{{ asset('images') . '/' . env('APP_FAVICON_BLACK') }}"><img
                            class="brand-logo d-sm-block d-md-none" alt="CryptoDash admin logo sm"
                            src="{{ asset('images') . '/' . env('APP_FAVICON_BLACK') }}"></a></li>
                <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse"
                        data-target="#navbar-mobile"><i class="la la-ellipsis-v"> </i></a></li>
            </ul>
        </div>
        <div class="navbar-container">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                            href="#"><i class="ft-menu"> </i></a></li>
                </ul>
                <ul class="nav navbar-nav float-right">
                    <x-dropdown>
                        <x-dropdown-link :href="route('profile.edit')">
                            <i class="ft-user"></i>Perfil
                        </x-dropdown-link>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">

                                <i class="ft-power"></i>{{ __('Desconectar') }}
                            </x-dropdown-link>
                        </form>
                    </x-dropdown>
                </ul>
            </div>
        </div>
    </div>
</nav>
