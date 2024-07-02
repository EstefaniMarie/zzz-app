function antecedentesPersonalesForm (tipoAntecedente) {
    let idPersona = localStorage.getItem('idPersona')
    $(`#${tipoAntecedente}`).on('show.bs.modal', () =>{
        $('input[name="idPersona"]').val(idPersona)
    })

    $.get(`/antecedentesFamiliares/persona/${idPersona}`, {'idPersona': idPersona}, (dataFamiliares) => {
        $('#antecedenteFamiliar').select2({
            dropdownParent: $('#Detalles'),
            placeholder: 'Seleccione un antecedente familiar',
            language: {'noResults': () => {return 'No existen antecedentes familiares'}},
            data: dataFamiliares.map(item => {
                return `${item.tipo}`
            })
        })
    })

    // Borra el id de la persona del localStorage para que no persita en caso de que se desee abrir otro
    // modal de una persona diferente y consuma memoria del cliente
    $(`#${tipoAntecedente}`).on('hidden.bs.modal', function() {
        localStorage.removeItem('personaId');
    });
}