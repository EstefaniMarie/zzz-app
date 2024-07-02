const detallesClinicos = (datosPersona) => {
    $(document).ready(() => {
        localStorage.setItem('idPersona', datosPersona.id) // Almacena id de persona para usarlo en función antecedentesForm()
        
        let antecedentesFamiliaresSelect = $('#antecedentesFamiliares')
        let antecedentesPersonalesSelect = $('#antecedentesPersonales')
    
        const limpiarModal = () => {
            $('#nombreCompleto').empty();
            $('#cedula').empty();
            $('#antecedentesPersonales').empty();
            $('#antecedentesFamiliares').empty();
        };
    
        // Evento para cuando el modal se cierra
        // $('#Detalles').on('hidden.bs.modal', function() {
        //     limpiarModal(); // Limpia el contenido del modal
        // });
    
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
