$(document).ready(function() {
    $('#nombres').on('keyup', () =>{
        let input = $(this);
        let valor = input.val();
        if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/.test(valor)) {
            input.addClass('invalid-input');
            $('#nombresError').text('No se permiten número o caracteres especiales')
        } else {
            input.removeClass('invalid-input');
            $('#nombresError').text('')
        }
    })

    $('#apellidos').on('keyup', () =>{
        let input = $(this);
        let valor = input.val();
        if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/.test(valor)) {
            input.addClass('invalid-input');
            $('#apellidosError').text('No se permiten número o caracteres especiales')
        } else {
            input.removeClass('invalid-input');
            $('#apellidosError').text('')
        }
    })

    $('#cedula').on('keyup', function() {
        let input = $(this);
        let valor = parseInt(input.val());
        if (valor < 1000000 || valor > 99999999) {
            input.addClass('invalid-input');
            $('#cedulaError').text('Rango no válido')
        } else {
            input.removeClass('invalid-input');
            $('#cedulaError').text('')
        }
    });

    $('#fechaNacimiento').on('change', function() {
        let input = $(this);
        let fecha = new Date(input.val());
        let hoy = new Date();
        let unSigloAtras = new Date(hoy.getFullYear() - 100, hoy.getMonth(), hoy.getDate());
        if (fecha > hoy || fecha < unSigloAtras) {
            input.addClass('invalid-input');
            $('#fechaError').text('Ingrese una fecha válida')
        } else {
            input.removeClass('invalid-input');
            $('#fechaError').text('')
        }
    });

    $('#email').on('keyup', function() {
        let input = $(this);
        let valor = input.val();
        if (valor !== '' && !/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(valor)) {
            input.addClass('invalid-input');
            $('#emailError').text('Ingrese un email válido')
        } else {
            input.removeClass('invalid-input');
            $('#emailError').text('')
        }
    });

    $('#numero_telefono').on('keyup', function() {
        let input = $(this);
        let valor = input.val();
        if (!/^[0-4]{2}[1-6]{2}[0-9]{7}$/.test(valor)) {
            input.addClass('invalid-input');
            $('#telefonoError').text('Ingrese un número telefónico válido')
        } else {
            input.removeClass('invalid-input');
            $('#telefonoError').text('')
        }
    });

    $('#idGenero').on('change', function() {
        let select = $(this);
        if (select.val() === '') {
            select.addClass('invalid-input');
            $('#generoError').text('Seleccione una opción')
        } else {
            select.removeClass('invalid-input');
            $('#generoError').text('')
        }
    });

    $('#idRol').on('change', function() {
        let select = $(this);
        if (select.val() === '') {
            select.addClass('invalid-input');
            $('#rolError').text('Seleccione una opción')
        } else {
            select.removeClass('invalid-input');
            $('#rolError').text('')
        }
    });

    $('#idEstatus').on('change', function() {
        let select = $(this);
        if (select.val() === '') {
            select.addClass('invalid-input');
            $('#estatusError').text('Seleccione una opción')
        } else {
            select.removeClass('invalid-input');
            $('#estatusError').text('')
        }
    });
});
// $('#nombres, #apellidos').on('keyup', function() {
//     let input = $(this);
//     let valor = input.val();
//     if (valor !== '' && !/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/.test(valor)) {
//         input.addClass('invalid-input');
//         $('.textError').text('No se permiten número o caracteres especiales')
//     } else {
//         input.removeClass('invalid-input');
//     }
// });

// $('#cedula').on('keyup', function() {
//     let input = $(this);
//     let valor = parseInt(input.val());
//     if (valor !== '' && (valor < 1000000 || valor > 99999999)) {
//         input.addClass('invalid-input');
//         $('#cedulaError').text('Rango no válido')
//     } else {
//         input.removeClass('invalid-input');
//     }
// });

// $('#fechaNacimiento').on('change', function() {
//     let input = $(this);
//     let fecha = new Date(input.val());
//     let hoy = new Date();
//     let unSigloAtras = new Date(hoy.getFullYear() - 100, hoy.getMonth(), hoy.getDate());
//     if (input.val() !== '' && (fecha > hoy || fecha < unSigloAtras)) {
//         input.addClass('invalid-input');
//         $('#fechaError').text('Ingrese una fecha válida')
//     } else {
//         input.removeClass('invalid-input');
//     }
// });

// $('#email').on('keyup', function() {
//     let input = $(this);
//     let valor = input.val();
//     if (valor !== '' && !/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(valor)) {
//         input.addClass('invalid-input');
//         $('#emailError').text('Ingrese un email válido')
//     } else {
//         input.removeClass('invalid-input');
//     }
// });

// $('#numero_telefono').on('keyup', function() {
//     let input = $(this);
//     let valor = input.val();
//     if (valor !== '' && !/^[0-4]{2}[1-6]{2}[0-9]{7}$/.test(valor)) {
//         input.addClass('invalid-input');
//         $('#telefonoError').text('Ingrese un número telefónico válido')
//     } else {
//         input.removeClass('invalid-input');
//     }
// });

// $('#idGenero, #idRol, #estatus').on('change', function() {
//     let select = $(this);
//     if (select.val() === '') {
//         select.addClass('invalid-input');
//         $('.selectError').text('Seleccione una opción')
//     } else {
//         select.removeClass('invalid-input');
//     }
// });