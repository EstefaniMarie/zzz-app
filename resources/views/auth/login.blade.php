<x-public-layout>
    <div class="content-header row">
    </div>
    <div class="content-body">
        <section id="account-login" class="flexbox-container">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <!-- image -->
                <div class="col-xl-3 col-lg-4 col-md-5 col-sm-5 col-12 p-0 text-center d-none d-md-block">
                    <div class="border-grey border-lighten-3 m-0 box-shadow-0 card-account-left height-400" style="background: none !important;">
                        <img src="{{ asset('images/logo.png') }}"
                            class="card-account-img width-300" alt="card-account-img">
                    </div>
                </div>
                <!-- login form -->
                <div class="col-xl-3 col-lg-4 col-md-5 col-sm-5 col-12 p-0">
                    <div class="card border-grey border-lighten-3 m-0 box-shadow-0 card-account-right height-400">
                        <div class="card-content">
                            <div class="card-body p-3">
                                <p class="text-center h5 text-capitalize">{{ __('Bienvenido a ' . config('app.name', 'MINAGUAS') . '!') }}</p>
                                <p class="mb-1 text-center">{{ __('Por favor ingresa tu correo y contraseña para ingresar al sistema') }}</p>
                                <form class="form-horizontal form-signin" action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <fieldset class="form-label-group">
                                        <x-text-input id="email" class="form-control" type="email" name="email" placeholder=""
                                            :value="old('email')" required autofocus autocomplete="email"/>
                                        <x-input-error :messages="$errors->get('email')" class="m-0 text-danger pl-1" />
                                        <x-input-label for="email" :value="__('Correo')" />
                                    </fieldset>
                                    <fieldset class="form-label-group">
                                        <x-text-input id="password" class="form-control" type="password" placeholder=""
                                            name="password" required autocomplete="current-password" />
                                        <x-input-error :messages="$errors->get('password')" class="m-0 text-danger pl-1" />
                                        <x-input-label for="password" :value="__('Contraseña')" />
                                    </fieldset>
                                    <div class="form-group row">
                                        <div class="col-md-6 col-12 text-center text-sm-left">
                                            <fieldset>
                                                <input type="checkbox" id="remember-me" class="chk-remember">
                                                <label for="remember-me"> Recordar</label>
                                            </fieldset>
                                        </div>
                                        {{-- <div class="col-md-6 col-12 float-sm-left text-center text-sm-right"><a
                                                href="#" class="card-link">Forgot Password?</a></div> --}}
                                    </div>
                                    <button type="submit" class="btn-gradient-primary btn-block my-1">{{ __('Ingresar') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-public-layout>
