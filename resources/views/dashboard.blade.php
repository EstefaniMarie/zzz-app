<x-app-layout>
    @if (session('status') === 'password-updated')
        <div class="alert alert-success text-center" role="alert">
            Contraseña actualizada exitosamente.
        </div>
    @endif
</x-app-layout>
