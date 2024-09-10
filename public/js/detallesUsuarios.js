table.on('click', 'tbody tr', (e) => {
    let classList = e.currentTarget.classList;

    if (classList.contains('selected')) {
        classList.remove('selected');

        updateForm(false)
    } else {
        table.rows('.selected').nodes().each((row) => row.classList.remove('selected'));
        classList.add('selected');
        
        if($('#crearUsuarioBtn').attr('data-active') === 'true'){
            $('#crearUsuarioBtn').attr('data-active', 'false')
            $('#crearUsuarioBtn').text('Crear Usuario')
        }

        let idPersona = table.rows('.selected').data()[0][0];

        detallesUsuario(parseInt(idPersona))
    }
    
})

$('#crearUsuarioBtn').on('click', () => {
    let isActive = $('#crearUsuarioBtn').attr('data-active')
    let hasSelectedRow = table.rows('.selected').length > 0;

    if(isActive === 'false'){
        $('#crearUsuarioBtn').attr('data-active', 'true')
        updateForm(true, 'create')
        $('#crearUsuarioBtn').text('Cancelar')
        
        if(hasSelectedRow){
            table.rows('.selected').nodes().each((row) => row.classList.remove('selected'));
        }
    }

    if(isActive === 'true'){
        $('#crearUsuarioBtn').attr('data-active', 'false')
        updateForm(false)
        $('#crearUsuarioBtn').text('Crear Usuario')
    }
})

function detallesUsuario(idPersona){
    let url = `/usuarios/${idPersona}/get`

    updateForm(true)

    $.ajax({
        type: 'GET',
        url,
        success: function(detalles) {
            updateForm(true, 'edit', detalles[0])
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}

function updateForm(isSelected=false, action=null, data=[]) {
    //EDITAR DATOS
    if (isSelected && action === 'edit') {
        $('#confirmarUsuarioBtn').css('display', 'block')
        $('#tituloForm').text('Editar Usuario')

        $('#userForm').attr('action', `/usuarios/${action}`)

        // Se activan los campos
        $('#nombres').prop('disabled', false)
        $('#cedula').prop('disabled', false)
        $('#cedula').prop('readonly', true)
        $('#apellidos').prop('disabled', false)
        $('#email').prop('disabled', false)
        $('#idRol').prop('disabled', false)
        $('#estatus').prop('disabled', false)
        $('#estatusCol').prop('display', 'block')
        $('#password').css('display', 'none')
        $('#telefono_fecha').css('display', 'none')

        $('#nombres').prop('required', true)
        $('#cedula').prop('required', true)
        $('#apellidos').prop('required', true)
        $('#email').prop('required', true)
        $('#idRol').prop('required', true)
        $('#estatus').prop('required', true)
        $('#password').prop('required', true)

        $('#fecha_nacimiento').prop('required', false)
        $('#numero_telefono').prop('required', false)
        $('#idGenero').prop('required', false)
        
        $('#idPersona').val(data.idPersona)
        $('input#nombres').val(data.nombres)
        $('input#cedula').val(data.cedula)
        $('input#apellidos').val(data.apellidos)
        $('input#email').val(data.email)
        $(`#idRol option[value="${data.idRol}"`).prop('selected', true)
        $(`#estatus option[value="${data.Status}`).prop('selected', true)

        return
    }
    
    //CREAR USUARIO
    if(action === 'create'){
        $('#confirmarUsuarioBtn').css('display', 'block')
        $('#tituloForm').text('Crear Usuario')
        $('#userForm').attr('action', `/usuarios/${action}`)

        $('#nombres').prop('disabled', false)
        $('#cedula').prop('disabled', false)
        $('#cedula').prop('readonly', false)
        $('#apellidos').prop('disabled', false)
        $('#email').prop('disabled', false)
        $('#idRol').prop('disabled', false)
        $('#estatus').prop('disabled', true)
        $('#estatusCol').prop('display', 'none')
        $('#password').css('display', 'block')
        $('#telefono_fecha').css('display', 'block')

        $('#nombres').prop('required', true)
        $('#cedula').prop('required', true)
        $('#apellidos').prop('required', true)
        $('#email').prop('required', true)
        $('#idRol').prop('required', true)
        $('#password').prop('required', true)
        $('#fecha_nacimiento').prop('required', true)
        $('#numero_telefono').prop('required', true)
        $('#idGenero').prop('required', true)

        $('#idPersona').val('')
        $('input#nombres').val('')
        $('input#cedula').val('')
        $('input#apellidos').val('')
        $('input#email').val('')
        $(`#idRol option[value="${data.idRol}"`).prop('selected', false)
        $(`#estatus option[value="1`).prop('selected', true)
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
    $('#idRol').prop('disabled', true)
    $('#password').css('display', 'none')
    $('#estatus').prop('disabled', true)
    $('#estatus').prop('display', 'none')
    $('#telefono_fecha').css('display', 'none')

    $('#nombres').prop('required', false)
    $('#cedula').prop('required', false)
    $('#apellidos').prop('required', false)
    $('#email').prop('required', false)
    $('#idRol').prop('required', false)
    $('#estatus').prop('required', false)
    $('#password').prop('required', false)
    $('#fecha_nacimiento').prop('required', false)
    $('#numero_telefono').prop('required', false)
    $('#idGenero').prop('required', false)


    $('#idPersona').val('')
    $('input#nombres').val('')
    $('input#cedula').val('')
    $('input#apellidos').val('')
    $('input#email').val('')
    $(`#idRol option[value="${data.idRol}"`).prop('selected', false)
    $(`#estatus option[value="${data.Status}`).prop('selected', false)
    return
}