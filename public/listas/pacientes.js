$(document).ready(function() {
    $.ajax({
        url: 'get-pacientes',
        type: 'GET',
        success: function(data) {
            var select = $('.paciente');
            select.empty();
            select.append('<option value="">Selecciona un paciente</option>');
            $.each(data, function(index, paciente) {
                select.append('<option value="' + paciente.id + '">' +
                    paciente.primer_nombre + ' ' + paciente.primer_apellido +
                    ', ' + paciente.cedula + '</option>');
            });
        },
    });

    $('.paciente').change(function() {
        var selectedPaciente = $(this).val();
        if (selectedPaciente) {
            $.ajax({
                url: 'get-pacientes' + selectedPaciente,
                type: 'GET',
                success: function(response) {
                    console.log(response);
                }
            });
        }
    });
});