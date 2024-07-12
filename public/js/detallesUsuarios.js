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

$('#crearUsuarioBtn').on('click', () => {
    updateForm(true, 'create')
})

function detallesUsuario(idPersona){
    let url = `/usuarios/${idPersona}/get`

    updateForm(true)

    $.ajax({
        type: 'GET',
        url,
        success: function(detalles) {
            console.log(detalles)
            updateForm(true, 'edit', detalles[0])
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}

function updateForm(isSelected=false, action='create', data=[]) {
    //EDITAR DATOS
    if (isSelected && action === 'edit') {
        $('#confirmarUsuarioBtn').css('display', 'block')
        $('#tituloForm').text('Editar Usuario')

        $('#userForm').attr('action', `/usuarios/${action}`)

        // Se activan los campos
        $('#nombres').prop('disabled', false)
        $('#cedula').prop('disabled', false)
        $('#apellidos').prop('disabled', false)
        $('#email').prop('disabled', false)
        $('#rol').prop('disabled', false)
        $('#password').css('display', 'none')
        $('#telefono_fecha').css('display', 'none')

        $('#nombres').prop('required', true)
        $('#cedula').prop('required', true)
        $('#apellidos').prop('required', true)
        $('#email').prop('required', true)
        $('#rol').prop('required', true)
        
        $('#idPersona').val(data.idPersona)
        $('input#nombres').val(data.nombres)
        $('input#cedula').val(data.cedula)
        $('input#apellidos').val(data.apellidos)
        $('input#email').val(data.email)
        $(`#rol option[value="${data.idRol}"`).prop('selected', true)

        return
    }
    
    //CREAR USUARIO
    if(action === 'create'){
        $('#confirmarUsuarioBtn').css('display', 'block')
        $('#tituloForm').text('Crear Usuario')
        $('#userForm').attr('action', `/usuarios/${action}`)

        $('#nombres').prop('disabled', false)
        $('#cedula').prop('disabled', false)
        $('#apellidos').prop('disabled', false)
        $('#email').prop('disabled', false)
        $('#rol').prop('disabled', false)
        $('#password').css('display', 'block')
        $('#telefono_fecha').css('display', 'block')

        $('#nombres').prop('required', true)
        $('#cedula').prop('required', true)
        $('#apellidos').prop('required', true)
        $('#email').prop('required', true)
        $('#rol').prop('required', true)
        $('#password').prop('required', true)

        $('#idPersona').val('')
        $('input#nombres').val('')
        $('input#cedula').val('')
        $('input#apellidos').val('')
        $('input#email').val('')
        $(`#rol option[value="${data.idRol}"`).prop('selected', false)
        
        return 
    }

    // NO ACTION
    $('#confirmarUsuarioBtn').css('display', 'none')
    $('#tituloForm').text('Detalles')
    $('#userForm').attr('action', ``)

    $('#nombres').prop('disabled', true)
    $('#cedula').prop('disabled', true)
    $('#apellidos').prop('disabled', true)
    $('#email').prop('disabled', true)
    $('#rol').prop('disabled', true)
    $('#password').css('display', 'none')
    $('#telefono_fecha').css('display', 'none')


    $('#nombres').prop('required', false)
    $('#cedula').prop('required', false)
    $('#apellidos').prop('required', false)
    $('#email').prop('required', false)
    $('#rol').prop('required', false)
    $('#password').prop('required', false)

    $('#idPersona').val('')
    $('input#nombres').val('')
    $('input#cedula').val('')
    $('input#apellidos').val('')
    $('input#email').val('')
    $(`#rol option[value="${data.idRol}"`).prop('selected', false)

    return
}