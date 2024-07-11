@php
    use Carbon\Carbon;
@endphp
<div class="modal fade" id="addDiagnosticos" aria-labelledby="addDiagnosticos" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDiagnosticos">Añadir Diágnosticos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body px-3 py-2">
                <form method="POST" action="{{ route('diagnosticos.crear') }}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <fieldset class="form-group">
                                <label for="name" style="color:black;">Nombre y Apellido del Paciente</label>
                                <input type="text" class="form-control" readonly
                                    value="{{ $consulta->cita->paciente->nombres}} {{ $consulta->cita->paciente->apellidos }}">
                            </fieldset>
                        </div>
                        <div class="col-12">
                            <fieldset class="form-group">
                                <label for="fecha" style="color:black;">Fecha de Consulta</label>
                                <input type="text" class="form-control" readonly
                                    value="{{ Carbon::parse($consulta->fechaConsulta)->format('d-m-Y') }}">
                                <input type="hidden" name="idConsulta" value="{{ $consulta->id }}">
                            </fieldset>
                        </div>
                        <div class="col-12">
                            <fieldset class="form-group">
                                <label for="diagnosticos" style="color:black;">Diagnósticos disponibles</label>
                                <select class="diagnosticos form-control" multiple name="diagnosticos_select[]"
                                    style="width: 27.5rem;">
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
                            <fieldset class="form-group" id="diagnostico" style="display: none;">
                                <label for="diagnostico_input" style="color:black;">Diagnóstico</label>
                                <input type="text" class="form-control" name="diagnostico_input">
                            </fieldset>
                        </div>
                        <div class="col-12">
                            <fieldset class="form-group">
                                <label for="descripcion" style="color:black;">Descripción</label>
                                <textarea class="form-control" name="descripcion" required></textarea>
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
        $.ajax({
            url: '/get-diagnosticos',
            type: 'GET',
            success: function (data) {
                var diagnosticoSelect = $('.diagnosticos');
                diagnosticoSelect.empty();
                diagnosticoSelect.append('<option value="">Seleccione algún diágnostico</option>');
                $.each(data, function (index, diagnostico) {
                    diagnosticoSelect.append('<option value="' + diagnostico.id + '">' + diagnostico.tipo + '</option>');
                });
                diagnosticoSelect.select2({
                    placeholder: "Seleccione uno o más diágnosticos",
                    language: { 'noResults': () => { return 'No se encontró diágnosticos' } },
                    allowClear: true
                });
            },
            error: function () {
                console.error('Error al obtener la lista de diagnósticos');
            }
        });
        $('.agregar').on('click', function () {
            $('#diagnostico').toggle();
        });
    });
</script>