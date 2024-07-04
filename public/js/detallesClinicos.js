const detallesClinicos = (datosPersona) => {
    $(document).ready( () => {
        localStorage.setItem('idPersona', datosPersona.id) // Almacena id de persona para usarlo en función antecedentesForm()
    
        limpiarModal();
    
        let url = `/historiaClinica/detalles/${datosPersona.id}`
        
        
        $.get(url, (antecedentes) => {
            $('#nombreCompleto').text(datosPersona.nombres + ' ' + datosPersona.apellidos)
            $('#cedula').text('C.I ' + datosPersona.cedula )

            cargarAntecedentes(antecedentes.antecedentesFamiliares, '#antecedentesFamiliares');
            cargarAntecedentes(antecedentes.antecedentesPersonales, '#antecedentesPersonales');
            
            $('#Detalles').modal('show')
        })
    })
}

function cargarAntecedentes(antecedentes, selector) {
    $(selector).select2({
        dropdownParent: $('#Detalles'),
        width: 'style',
        placeholder: 'Busca los antecedentes',
        language: {'noResults': () => { return 'No posee antecedentes'; }},
        data: antecedentes.map((item, index) => ({
            id: index,
            text: item.descripcion
        })),
    });
}

    
const limpiarModal = () => {
    $('#nombreCompleto').empty();
    $('#cedula').empty();
    $('#antecedentesPersonales').empty();
    $('#antecedentesFamiliares').empty();
};