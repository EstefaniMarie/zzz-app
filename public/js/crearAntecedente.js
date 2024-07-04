// function crearAntecedente(tipoAntecedente) {
    $(document).ready(function() {
        $('#formularioAñadirAntecedente').submit(function(event) {
            event.preventDefault();
            let formData = $(this).serialize();
            // var tipoAntecedente = $(this).find('input[name="tipo"]').val();
            let url = '{{ url("/antecedentes". $tipoAntecedente. "/nuevo") }}';
    
            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                success: function(data) {
                    $('#Detalles').modal('hide');
                    detallesClinicos(localStorage.getItem('idPersona'));
                    $('#fondoOscuro').removeClass('show');
                    $('#' + tipoAntecedente).modal('hide');
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });
    });
// }