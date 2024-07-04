function antecedentesPersonalesForm (tipoAntecedente) {
    let idPersona = localStorage.getItem('idPersona')
    $.get(`/antecedentesFamiliares/${idPersona}`, (dataFamiliares) => {
        
        $('#fondoOscuro').css('display', 'block')

        $(`#${tipoAntecedente}`).on('show.bs.modal', () =>{
            $('input[name="idPersona"]').val(idPersona)
        })

        $('#antecedenteFamiliar').select2({
            dropdownParent: $('#Detalles'),
            width: 'element',
            placeholder: 'Seleccione un antecedente familiar',
            language: {'noResults': () => {return 'No encontraron antecedentes'}},
            data: dataFamiliares.map(item => {
                return {
                    id: item.id, 
                    text: item.tipo
                }
            })
        })
        // Borra el id de la persona del localStorage para que no persita en caso de que se desee abrir otro
        // modal de una persona diferente y consuma memoria del cliente
        $(`#${tipoAntecedente}`).modal('show')
    })

    $(`#${tipoAntecedente}`).on('hidden.bs.modal', function() {
        localStorage.removeItem('personaId');
        if($('#Detalles').hasClass('show')){
            $('#fondoOscuro').css('display', 'none')
        }
    });
}