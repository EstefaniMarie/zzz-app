table.on('click', 'tbody tr', (e) => {
    let classList = e.currentTarget.classList;

    if (classList.contains('selected')) {
        classList.remove('selected');

        updateForm(false)
    } else {
        table.rows('.selected').nodes().each((row) => row.classList.remove('selected'));
        classList.add('selected');

        let idPersona = table.rows('.selected').data()[0][0];

        detallesUsuario(parseInt(idPersona))
    }
    
})

function detallesUsuario(idPersona){
    let url = `/usuarios/${idPersona}/get`

    updateForm(true)

    $.ajax({
        type: 'GET',
        url,
        success: function(detalles) {
            console.log(detalles)
            updateForm(true, detalles[0], 'edit')
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}

function updateForm(isSelected, data=[], action) {
    if (isSelected) {
        //AÑADIR DATOS
        $('#confirmarUsuarioBtn').css('display', 'block')
        $('#tituloForm').text('Editar Usuario')
        $('#userForm').attr('action', `/usuarios/${action}`)

        $('#nombres').prop('disabled', false)
        $('#cedula').prop('disabled', false)
        $('#apellidos').prop('disabled', false)
        $('#email').prop('disabled', false)
        $('#rol').prop('disabled', false)
        
        $('#idPersona').val(data.idPersona)
        $('input#nombres').val(data.nombres)
        $('input#cedula').val(data.cedula)
        $('input#apellidos').val(data.apellidos)
        $('input#email').val(data.email)
        $(`#rol option[value="${data.idRol}"`).prop('selected', true)
    } else {
        //BORRAR DATOS
        $('#confirmarUsuarioBtn').css('display', 'none');
        $('#tituloForm').text('Detalles');
        $('#userForm').attr('action', '')

        $('#nombres').prop('disabled', true);
        $('#cedula').prop('disabled', true);
        $('#apellidos').prop('disabled', true);
        $('#email').prop('disabled', true);
        $('#rol').prop('disabled', true);

        $('#idPersona').val('')
        $('input#nombres').val('')
        $('input#cedula').val('')
        $('input#apellidos').val('')
        $('input#email').val('')
        $(`#rol option[value="${data.idRol}"`).prop('selected', false)

    }
}