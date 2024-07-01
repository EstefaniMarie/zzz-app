const detallesClinicos = (datosPersona) => {

        const limpiarModal = () => {
        $('#nombreCompleto').empty();
        $('#cedula').empty();
        $('#antecedentesPersonales').empty();
        $('#antecedentesFamiliares').empty();
    };

    // Evento para cuando el modal se cierra
    $('#Detalles').on('hidden.bs.modal', function() {
        limpiarModal(); // Limpia el contenido del modal
    });

    // Asegúrate de llamar a limpiarModal también cuando abres el modal inicialmente,
    // para limpiar cualquier contenido previo si es necesario.
    limpiarModal();

    let url = `/historiaClinica/detalles/${datosPersona.id}`
    
    $('#nombreCompleto').text(datosPersona.nombres + ' ' + datosPersona.apellidos)
    $('#cedula').text('C.I ' + datosPersona.cedula )

    $.get(url, (antecedentes) => {
        if(antecedentes){
            if(!antecedentes.antecedentesFamiliares.length){
                $('#antecedentesFamiliares').append('<li>No posee antecedentes familiares</li>')
            }

            antecedentes.antecedentesFamiliares.forEach(item => {
                $('#antecedentesFamiliares').append(`<li>${item.descripcion}</li>`)
            })
    
            if(!antecedentes.antecedentesPersonales.length){
                $('#antecedentesPersonales').append('<li>No posee antecedentes personales</li>')
            }

            antecedentes.antecedentesPersonales.forEach(item => {
                $('#antecedentesPersonales').append(`<li>${item.descripcion}</li>`)
            })
        }
    })
}


// var userURL = "/game/" + preid
// console.log(userURL)
// $.get(userURL, async function(data) {
//     console.log(data[0].enunciado)
//     $('#enunciado').html(data[0].enunciado);
//     $("#iconpre").attr('src', src);
//     let opciones = ''
//     for (var x = 0; x < data.length; x++) {
//         var text = data[x].opcion
//         var correcta = data[x].correcta
//         opciones += '<button class="btn btn-block btn-primary" id="opcionu" style="width:100%; color:black; background-color:white; border-radius:15px; border:none; margin-bottom:15px;" value="' + correcta + '">' + text + '</button>'
//     }

//     $('#opciones').html(opciones);
//     await sleep(1000);
//     $(modalp).modal('show')
// }