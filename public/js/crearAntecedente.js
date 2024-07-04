import detallesClinicos from '../js/detallesClinicos.js'

function crearAntecedente (tipoAntecedente) {
    $(document).ready(function() {
        // Agrega un controlador de eventos al botón de envío
        $('#botonAñadir').click(function(event) {
            event.preventDefault(); // Evita el envío tradicional del formulario
    
            // Realiza la petición AJAX
            $.ajax({
                url: $("#formularioAñadirAntecedente").attr("action"),
                type: "POST",
                data: new FormData($("#formularioAñadirAntecedente")[0]),
                success: function(response) {
                    // Verifica el estado de respuesta (ajuste según el estado que tu controlador retorna)
                    if (response.status === 200) {
                        let dataPersona = {...response}

                        window.detallesClinicos(dataPersona)
                        setTimeout(() =>{
                            $(`#${tipoAntecedente}`).modal('hide');
                        }, 2000)
                    } else {
                        // Manejo de errores
                        console.error("Error al añadir antecedente:", response);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Manejo de errores
                    console.error("Error al añadir antecedente:", textStatus, errorThrown);
                }
            });
        });
    });
}