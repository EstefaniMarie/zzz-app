$(document).ready(function() {
    $('.medicos').select2({
        placeholder: "Seleccione algún médico",
        language: {
            noResults: function() {
                return 'No se encontró ningún médico';
            }
        },
        allowClear: true
    });

    $('.pacientes').select2({
        placeholder: "Seleccione algún paciente",
        language: {
            noResults: function() {
                return 'No se encontró ningún paciente';
            }
        },
        allowClear: true
    });

    $('.medicos').change(function() {
        var medicoId = $(this).val();
        loadEspecialidades(medicoId);
    });

    function loadEspecialidades(medicoId) {
        $.ajax({
            url: '/medicos/' + medicoId + '/especialidades',
            type: 'GET',
            success: function(data) {
                let especialidadesSelect = $('.especialidades');
                especialidadesSelect.empty();
                especialidadesSelect.append('<option value="">Seleccione alguna especialidad</option>');
                
                $.each(data, function(index, especialidad) {
                    especialidadesSelect.append('<option value="' + especialidad.id + '">' + especialidad.descripcion + '</option>');
                });

                especialidadesSelect.select2({
                    placeholder: "Seleccione una especialidad",
                    language: { 'noResults': () => { return 'No se encontró ninguna especialidad' } },
                    allowClear: true
                });
            },
            error: function() {
                console.error('Error al obtener la lista de especialidades');
            }
        });
    }
});