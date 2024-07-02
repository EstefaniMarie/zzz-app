function antecedentesFamiliaresForm (tipoAntecedente) {
    $(`#${tipoAntecedente}`).on('show.bs.modal', () =>{
        $('input[name="idPersona"]').val(localStorage.getItem('idPersona'))
    })

    $.get('/otrosAsegurados', (dataAsegurados) =>{
        $('#otroAsegurado').select2({
            dropdownParent: $('#Detalles'),
            placeholder: 'Seleccione un familiar',
            language: {'noResults': () => {return 'No existe ningún familiar registrado como asegurado'}},
            data: dataAsegurados.map(item => {
                return `${item.cedula} - ${item.nombres} ${item.apellidos}`
            })
        })
    })
    

    // Borra el id de la persona del localStorage para que no persita en caso de que se desee abrir otro
    // modal de una persona diferente y consuma memoria del cliente
    $(`#${tipoAntecedente}`).on('hidden.bs.modal', function() {
        localStorage.removeItem('personaId');
    });
}