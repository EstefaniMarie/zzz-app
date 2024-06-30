const detallesClinicos = (idPersona) => {
    let url = `/historiaClinica/detalles/${idPersona}`

    $.get(url, async function(dataPersona) {
        
        $('#nombreCompleto').text(dataPersona.nombres + ' ' + dataPersona.apellidos)
        $('#cedula').text('C.I ' + dataPersona.cedula )
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