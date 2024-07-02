const detallesClinicos = (datosPersona) => {
    $(document).ready(() => {
        let antecedentesFamiliaresSelect = $('#antecedentesFamiliares')
        let antecedentesPersonalesSelect = $('#antecedentesPersonales')
    
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
            antecedentesFamiliaresSelect.select2({
                dropdownParent: $('#Detalles'),
                placeholder: 'Busca los antecedentes familiares',
                language: {'noResults': () => {return 'No posee antecedentes'}},
                data : antecedentes.antecedentesFamiliares.map((item, index) => ({
                    id: index,
                    text: item.descripcion
                })),
                
            })
    
            antecedentesPersonalesSelect.select2({
                dropdownParent: $('#Detalles'),
                placeholder: 'Busca los antecedentes personales',
                language: {'noResults': 'No posee antecedentes'},
                data: antecedentes.antecedentesPersonales.map((items, index) => ({
                    id: index,
                    text: items.descripcion
                }))
            })
        })
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