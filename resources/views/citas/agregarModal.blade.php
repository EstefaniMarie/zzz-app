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
                <form method="POST" action="{{ route('storeCitas') }}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <fieldset class="form-group">
                                <label for="pacientes">Nombre y Apellido del Paciente</label>
                                <select class="pacientes form-control" style="width: 27.5rem;" name="idPaciente" required>
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
                                <select id="medicos" class="medicos medicosHoras medicosDias form-control" name="idMedico" style="width: 27.5rem;" required>
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
                                <select class="especialidades form-control-sm" style="width: 29.5rem !important;"
                                    required>
                                    <option value="">Seleccione una especialidad</option>
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-12">
                            <fieldset class="form-group">
                                <label for="fecha">Fecha</label>
                                <input type="date" id="fecha" class="form-control form-control-sm"
                                    style="width: 29.5rem !important;" name="fecha" required min="{{ date('Y-m-d') }}">
                            </fieldset>
                        </div>
                        <div class="col-12">
                            <fieldset class="form-group">
                                <label for="hora">Hora</label>
                                <select id="hora" class="form-control form-control-sm"
                                    style="width: 29.5rem !important;" name="hora" required>
                                    <option value="1">8:00 am</option>
                                    <option value="2">9:00 am</option>
                                    <option value="3">10:00 am</option>
                                    <option value="4">11:00 am</option>
                                    <option value="5">12:00 pm</option>
                                    <option value="6">01:00 pm</option>
                                    <option value="7">02:00 pm</option>
                                    <option value="8">03:00 pm</option>
                                </select>
                            </fieldset>
                        </div>
                        <div id="error-message" class="alert alert-danger"
                            style="display: none; position: fixed; top: 20px; right: 0; width: 100%; text-align: center; z-index: 1000; font-size: 15px;">
                            El médico no está disponible en la fecha seleccionada.
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


<script>
    $(document).ready(function () {
        $('.medicosDias').on('change', function () {
            let medicoId = $(this).val();
            if (medicoId) {
                $.ajax({
                    url: '{{ route("getMedicoDisponibilidad") }}',
                    type: 'GET',
                    data: { id: medicoId },
                    success: function (data) {
                        console.log(data)
                        let diasDisponibles = data.diasDisponibles;
                        let dateInput = $('#fecha');
                        dateInput.attr('disabled', false);
                        dateInput.attr('min', '{{ date("Y-m-d") }}');
                        dateInput.off('input').on('input', function () {
                            let selectedDate = new Date($(this).val());
                            let dayOfWeek = selectedDate.getUTCDay();
                            if (!diasDisponibles.includes(dayOfWeek + 1)) {
                                $(this).val('');
                                let errorMessage = $('#error-message');
                                errorMessage.fadeIn().delay(3000).fadeOut();
                            }
                        });
                    },
                    error: function () {
                        alert('Error al obtener la disponibilidad del médico.');
                    }
                });
            } else {
                $('#fecha').attr('disabled', true);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
    $('.medicosHoras').change(function() {
        let medicoId = $(this).val();
        if (medicoId) {
            $.ajax({
                url: '/get-horas-disponibles/' + medicoId,
                method: 'GET',
                success: function(data) {
                    console.log(data);
                    let horasDisponibles = data.horasDisponibles;
                    let horaSelect = $('#hora');
                    horaSelect.empty();
                    horaSelect.append('<option value="">Seleccione una hora</option>');
                    $.each(horasDisponibles, function(index, hora) {
                        horaSelect.append('<option value="' + (index + 1) + '">' + hora + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        }
    });
});
</script>
