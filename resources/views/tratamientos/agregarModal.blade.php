<div class="modal fade" id="addTratamientos" aria-labelledby="addTratamientos" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTratamientos">Añadir Tratamientos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body px-3 py-2">
                <form method="POST" action="{{ route('tratamientos.crear') }}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <fieldset class="form-group">
                                <label for="name" style="color:black;">Nombre y Apellido del Paciente</label>
                                <input type="text" class="form-control" readonly
                                    value="{{ $persona->nombres}} {{ $persona->apellidos }}">
                            </fieldset>
                        </div>
                        <div class="col-12">
                            <fieldset class="form-group">
                                <label for="diagnosticos" style="color:black;">Diagnósticos del Paciente</label>
                                <select class="diagnosticos form-control" multiple name="diagnosticos_select[]"
                                    style="width: 27.5rem;">
                                    @foreach ($diagnosticos as $diagnostico)
                                        <option value="{{ $diagnostico->id }}">{{ $diagnostico->tipo }}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-12">
                            <fieldset class="form-group">
                                <label for="tratamientos" style="color:black;">Tratamientos disponibles</label>
                                <select class="tratamientos form-control" multiple name="tratamientos_select[]" style="width: 27.5rem;">
                                    <option value=""></option>
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-12">
                            <fieldset class="form-group">
                                <button type="button" class="btn btn-success agregar mx-1">
                                    +
                                </button>
                            </fieldset>
                        </div>
                        <div class="col-12">
                            <fieldset class="form-group" id="tratamiento" style="display: none;">
                                <label for="diagnostico_input" style="color:black;">Tratamiento</label>
                                <input type="text" class="form-control" name="tratamiento_input">
                            </fieldset>
                        </div>
                        <div class="col-12">
                            <fieldset class="form-group" id="descripcion" style="display: none;">
                                <label for="descripcion" style="color:black;">Descripción</label>
                                <textarea class="form-control" name="descripcion"></textarea>
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

<script>
    $(document).ready(function () {
        $('.diagnosticos').select2({
            placeholder: "Seleccione diágnosticos del paciente",
            allowClear: true
        });
        $('.agregar').on('click', function () {
            $('#tratamiento').toggle();
            $('#descripcion').toggle();
        });
        $.ajax({
            url: '/get-tratamientos',
            type: 'GET',
            success: function (data) {
                let tratamientoSelect = $('.tratamientos');
                tratamientoSelect.empty();
                tratamientoSelect.append('<option value="">Seleccione algún tratamiento</option>');
                $.each(data, function (index, tratamiento) {
                    tratamientoSelect.append('<option value="' + tratamiento.id + '">' + tratamiento.tipo + '</option>');
                });
                $('.tratamientos').select2({
                    placeholder: 'Seleccione uno o más tratamientos',
                    language: {
                        noResults: function () {
                            return 'No se encontró ningún tratamiento';
                        }
                    },
                    allowClear: true
                });
            },
            error: function () {
                console.error('Error al obtener la lista de tratamientos');
            }
        });
    });
</script>