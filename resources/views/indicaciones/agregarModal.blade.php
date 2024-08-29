<div class="modal fade" id="addIndicaciones" aria-labelledby="addIndicaciones" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addIndicaciones">Añadir Indicaciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body px-3 py-2">
                <form method="POST" action="{{ route('indicaciones.crear') }}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <fieldset class="form-group">
                                <label for="name" style="color:black;">Nombre y Apellido del Paciente</label>
                                <input type="text" class="form-control" readonly
                                    value="{{ $paciente->nombres}} {{ $paciente->apellidos }}">
                            </fieldset>
                        </div>
                        <div class="col-12">
                            <fieldset class="form-group">
                                <label for="tratamientos" style="color:black;">Tratamientos del Paciente</label>
                                <select class="tratamientos form-control" multiple name="tratamientos_select[]"
                                    style="width: 27.5rem;" required>
                                    @foreach ($tratamientos as $tratamiento)
                                        <option value="{{ $tratamiento->id }}">{{ $tratamiento->tipo }}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-12">
                            <fieldset class="form-group">
                                <label for="indicaciones" style="color:black;">Indicaciones disponibles</label>
                                <select class="indicaciones form-control" multiple name="indicaciones_select[]" style="width: 27.5rem;">
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
                            <fieldset class="form-group" id="indicacion" style="display: none;">
                                <label for="indicacion_input" style="color:black;">Indicación</label>
                                <input type="text" class="form-control" name="indicacion_input">
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
        $('.tratamientos').select2({
            placeholder: "Seleccione tratamientos del paciente",
            allowClear: true
        });
        $('.agregar').on('click', function () {
            $('#indicacion').toggle();
            $('#descripcion').toggle();
        });
        $.ajax({
            url: '/get-indicaciones',
            type: 'GET',
            success: function (data) {
                let indicacionSelect = $('.indicaciones');
                indicacionSelect.empty();
                indicacionSelect.append('<option value="">Seleccione alguna indicación</option>');
                $.each(data, function (index, indicacion) {
                    indicacionSelect.append('<option value="' + indicacion.id + '">' + indicacion.tipo + '</option>');
                });
                $('.indicaciones').select2({
                    placeholder: 'Seleccione una o más indicaciones',
                    language: {
                        noResults: function () {
                            return 'No se encontró ninguna indicación';
                        }
                    },
                    allowClear: true
                });
            },
            error: function () {
                console.error('Error al obtener la lista de indicaciones');
            }
        });
    });
</script>