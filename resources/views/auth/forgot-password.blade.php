<x-public-layout>
    <div class="content-header row">
    </div>
    <div class="content-body">
        <section id="account-forgot-password" class="flexbox-container">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <!-- image -->
                <div class="col-xl-3 col-lg-4 col-md-5 col-sm-5 col-12 p-0 text-center d-none d-md-block">
                    <div class="border-grey border-lighten-3 m-0 box-shadow-0 card-account-left height-400"
                        style="background: none !important;">
                        <img src="{{ asset('images/logo.png') }}" class="card-account-img width-300 mt-5"
                            alt="card-account-img">
                    </div>
                </div>
                <!-- forgot password form -->
                <div class="col-xl-3 col-lg-4 col-md-5 col-sm-5 col-12 p-0">
                    <div class="card border-grey border-lighten-3 m-0 box-shadow-0 card-account-right">
                        <div class="card-content">
                            <div class="card-body p-3">
                                <p class="text-center h5 text-capitalize">
                                    {{ __('Recuperar Contraseña') }}</p>
                                <p class="mb-1 text-center">
                                    {{ __('Por favor ingresa tu correo electrónico registrado') }}</p>
                                <form class="form-horizontal form-forgot-password" action="{{ route('password.email') }}" method="POST">
                                    @csrf
                                    <fieldset class="form-label-group">
                                        <x-text-input id="email" class="form-control" type="email" name="email"
                                            placeholder="" :value="old('email')" required autofocus
                                            autocomplete="email" />
                                        <x-input-error :messages="$errors->get('email')" class="m-0 text-danger pl-1" />
                                        <x-input-label for="email" :value="__('Correo')" />
                                    </fieldset>
                                    <button type="submit"
                                        class="btn-gradient-primary btn-block my-1">{{ __('Enviar') }}</button>
                                </form>
                                <div class="form-group row">
                                    <div class="col-12 float-sm-left">
                                        <a href="{{ route('login') }}" class="card-link">{{ __('Regresar') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-public-layout>

<style>
    .card-account-right {
        min-height: fit-content;
    }
</style>
