<div class="modal fade" id="addEspecialidad" aria-labelledby="addEspecialidad" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEspecialidad">Añadir Especialidad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body px-3 py-2">
                <form method="POST" action="{{ route('storeEspecialidades') }}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <fieldset class="form-group">
                                <label for="medicoSelect" style="color:black;">Nombre y Apellido del Médico</label>
                                <select id="medicoSelect" class="medicos form-control" name="idMedico"
                                    style="width: 27.5rem;" required>
                                    <option value="">Seleccione un médico</option>
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-12">
                            <fieldset class="form-group">
                                <label for="cedulaInput" style="color:black;">Cédula de Identidad del Médico</label>
                                <input type="number" id="cedulaInput" class="form-control" readonly>
                            </fieldset>
                        </div>
                        <div class="col-12">
                            <fieldset class="form-group">
                                <label for="especialidadPrincipal" style="color:black;">Especialidad Principal</label>
                                <input type="text" class="form-control" name="especialidad_principal" required>
                            </fieldset>
                        </div>
                        <div class="col-12">
                            <fieldset class="form-group">
                                <button type="button" class="btn btn-success agregar mx-1">+</button>
                            </fieldset>
                        </div>
                        <div class="col-12" id="especialidadFieldset" style="display: none;">
                            <fieldset class="form-group">
                                <label for="especialidadAdicional" style="color:black;">Especialidad Adicional</label>
                                <input type="text" class="form-control" name="especialidad_adicional">
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
            url: '/get-medicos',
            method: 'GET',
            success: function (data) {
                var medicoSelect = $('#medicoSelect');
                medicoSelect.empty();
                medicoSelect.append('<option value="">Seleccione un médico</option>');
                $.each(data, function (index, medico) {
                    var nombres = medico.usuario.persona.nombres;
                    var apellidos = medico.usuario.persona.apellidos;
                    var cedula = medico.usuario.persona.cedula;
                    medicoSelect.append('<option value="' + medico.id + '" data-cedula="' + cedula + '">' + nombres + ' ' + apellidos + ', ' + cedula + '</option>');
                });
                medicoSelect.select2({
                    placeholder: "Seleccione un médico",
                    language: { 'noResults': () => { return 'No se encontró ningún médico' } },
                    allowClear: true
                });
            },
            error: function (xhr, status, error) {
                console.error('Error fetching data:', error);
            }
        });

        $('#medicoSelect').change(function () {
            var selectedOption = $(this).find('option:selected');
            var cedula = selectedOption.data('cedula');
            $('#cedulaInput').val(cedula);
        });

        $('.agregar').on('click', function () {
            $('#especialidadFieldset').toggle();
        });
    });
</script>
