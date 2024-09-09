<x-app-layout>
    @if (session('status') === 'password-updated')
        <div class="alert alert-success text-center" role="alert">
            Contraseña actualizada exitosamente.
        </div>
    @endif
    <h3 class="text-center"> Bienvenido al Centro Médico Asistencial Dr. José Gregorio Hernández </h3>
    <div class="row">
        <div class="col-md-8 col-12">
            <h6 class="my-2">Total de citas registradas</h6>
            <div class="card pull-up">
                <div class="card-content" style="padding: 1rem;">
                    <div class="card-body">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-8 col-12">
                                    <p><strong>Total:</strong></p>
                                    <h1>{{ $totalConsultasMesActual }}</h1>
                                    <p class="mb-0">Citas registradas en el <strong> mes actual </strong> </p>
                                </div>
                                <div class="col-md-4 col-12 text-center text-md-right">
                                    <a href="{{ route('citas') }}" class="btn btn-gradient-secondary mt-2">Ver detalles
                                        <i class="la la-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <h6 class="my-2">Total de pacientes registrados</h6>
            <div class="card pull-up">
                <div class="card-content" style="padding: 1rem;">
                    <div class="card-body">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-8 col-12">
                                    <p><strong>Total:</strong></p>
                                    <h1>{{ $totalPacientesRegistrados }}</h1>
                                    <p class="mb-0">Pacientes registrados en el <strong> sistema </strong> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="display: flex; justify-content: center;">
        <div id="recent-transactions" class="col-10">
            <h6 class="my-2">Especialidades médicas disponibles</h6>
            <div class="card">
                <div class="card-content">
                    <div class="table-responsive">
                        <table id="recent-orders" class="table table-hover table-xl mb-0">
                            <thead>
                                <tr>
                                    <th class="border-top-0">Nombre</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($especialidades as $especialidad)
                                    <tr>
                                        <td class="text-truncate">{{ $especialidad->descripcion }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center mt-3">
                            {{ $especialidades->links() }} 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>