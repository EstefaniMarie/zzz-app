<div class="modal fade" id="addCitas" aria-labelledby="addCitas" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCitas">Añadir Citas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body px-3 py-2">
                <form method="POST" action="">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <fieldset class="form-group">
                                <label for="pacientes">Nombre y Apellido del Paciente</label>
                                <select class="pacientes form-control" style="width: 27.5rem;" required>
                                    <option value="">Seleccione algún paciente</option>
                                    @foreach ($pacientes as $paciente)
                                        <option value="{{ $paciente->id }}">
                                            {{ $paciente->personas->nombres }} {{ $paciente->personas->apellidos }},
                                            {{ $paciente->personas->cedula }}
                                        </option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-12">
                            <fieldset class="form-group">
                                <label for="medicos">Nombre y Apellido del Médico</label>
                                <select class="medicos form-control" style="width: 27.5rem;" required>
                                    <option value="">Seleccione algún médico</option>
                                    @foreach ($medicos as $medico)
                                        <option value="{{ $medico->id }}">
                                            {{  $medico->usuario->persona->nombres }}
                                            {{  $medico->usuario->persona->apellidos }},
                                            {{ $medico->usuario->persona->cedula }}
                                        </option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-12">
                            <fieldset class="form-group">
                                <label for="especialidades">Especialidad</label>
                                <select class="especialidades form-control-sm"
                                    style="width: 29.5rem !important;" required>
                                    <option value="">Seleccione una especialidad</option>
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-12">
                            <fieldset class="form-group">
                                <label for="fecha">Fecha</label>
                                <input type="date" class="form-control form-control-sm" style="width: 29.5rem !important;" required min="{{ date('Y-m-d') }}">
                            </fieldset>
                        </div>
                        <div class="col-12">
                            <fieldset class="form-group">
                                <label for="hora">Hora</label>
                                <select id="hora" class="form-control form-control-sm" style="width: 29.5rem !important;" required>
                                    <option value="08:00">8:00 am</option>
                                    <option value="09:00">9:00 am</option>
                                    <option value="10:00">10:00 am</option>
                                    <option value="11:00">11:00 am</option>
                                    <option value="12:00">12:00 pm</option>
                                    <option value="13:00">01:00 pm</option>
                                    <option value="14:00">02:00 pm</option>
                                    <option value="15:00">03:00 pm</option>
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary mx-1 float-right">
                                Añadir
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
