function antecedentesFamiliaresForm (tipoAntecedente) {
    $.get('/otrosAsegurados', (dataAsegurados) =>{
        $(`#${tipoAntecedente}`).on('show.bs.modal', () =>{
            $('input[name="idPersona"]').val(localStorage.getItem('idPersona'))
        })

        $('#fondoOscuro').css('display', 'block')

        $('#otroAsegurado').select2({
            dropdownParent: $('#Detalles'),
            width: 'style',
            placeholder: 'Seleccione un familiar',
            language: {'noResults': () => {return 'No existe ningún familiar registrado como asegurado'}},
            data: dataAsegurados.map(item => {
                return `${item.cedula} - ${item.nombres} ${item.apellidos}`
            })
        })

        $(`#${tipoAntecedente}`).modal('show')
        
    })
    // Borra el id de la persona del localStorage para que no persita en caso de que se desee abrir otro
    // modal de una persona diferente y consuma memoria del cliente
    $(`#${tipoAntecedente}`).on('hidden.bs.modal', function() {
        localStorage.removeItem('personaId');
        $('#fondoOscuro').css('display', 'none')
    });
}