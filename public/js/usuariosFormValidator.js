$(document).ready(function() {
    // Función para validar un campo de texto
    function validateText(input, regex, errorMessage) {
      if (!regex.test(input.val())) {
        input.addClass('invalid-input');
        $(`#${input.attr('id')}Error`).text(errorMessage).show();
      } else {
        input.removeClass('invalid-input');
        $(`#${input.attr('id')}Error`).text('').hide();
      }
    }
  
    // Función para validar un campo de número
    function validateNumber(input, min, max, errorMessage) {
      const value = parseInt(input.val());
      if (value < min || value > max) {
        input.addClass('invalid-input');
        $(`#${input.attr('id')}Error`).text(errorMessage).show();
      } else {
        input.removeClass('invalid-input');
        $(`#${input.attr('id')}Error`).text('').hide();
      }
    }
  
    // Función para validar un campo de fecha
    function validateDate(input, errorMessage) {
      const fecha = new Date(input.val());
      const hoy = new Date();
      const unSigloAtras = new Date(hoy.getFullYear() - 100, hoy.getMonth(), hoy.getDate());
      if (fecha > hoy || fecha < unSigloAtras) {
        input.addClass('invalid-input');
        $(`#${input.attr('id')}Error`).text(errorMessage).show();
      } else {
        input.removeClass('invalid-input');
        $(`#${input.attr('id')}Error`).text('').hide();
      }
    }
  
    // Función para validar un campo de selección
    function validateSelect(select, errorMessage) {
      if (select.val() === '') {
        select.addClass('invalid-input');
        $(`#${select.attr('id')}Error`).text(errorMessage).show();
      } else {
        select.removeClass('invalid-input');
        $(`#${select.attr('id')}Error`).text('').hide();
      }
    }

    // Función para validar un campo de teléfono
  function validatePhone(input, errorMessage) {
        if (!/^[0-4]{2}[1-6]{2}[0-9]{7}$/.test(input.val())) {
            input.addClass('invalid-input');
            $(`#${input.attr('id')}Error`).text(errorMessage).show();
        } else {
            input.removeClass('invalid-input');
            $(`#${input.attr('id')}Error`).text('').hide();
        }
    }

  // Función para validar un campo de email
  function validateEmail(input, errorMessage) {
        if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(input.val())) {
            input.addClass('invalid-input');
            $(`#${input.attr('id')}Error`).text(errorMessage).show();
        } else {
            input.removeClass('invalid-input');
            $(`#${input.attr('id')}Error`).text('').hide();
        }
    }

  // Función para validar un campo de contraseña
    function validatePassword(input, errorMessage) {
        if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/.test(input.val())) {
            input.addClass('invalid-input');
            $(`#${input.attr('id')}Error`).text(errorMessage).show();
        } else {
            input.removeClass('invalid-input');
            $(`#${input.attr('id')}Error`).text('').hide();
        }
    }   
  
    // Agregar eventos de input a cada campo
    $('#nombres').on('input', function() {
      validateText($(this), /^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/, 'No se permiten número o caracteres especiales');
    });
  
    $('#apellidos').on('input', function() {
      validateText($(this), /^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/, 'No se permiten número o caracteres especiales');
    });
  
    $('#cedula').on('input', function() {
      validateNumber($(this), 1000000, 99999999, 'Rango no válido');
    });
  
    $('#fechaNacimiento').on('input', function() {
      validateDate($(this), 'Ingrese una fecha válida');
    });
  
    $('#email').on('input', function() {
      validateText($(this), /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/, 'Ingrese un email válido');
    });
  
    $('#numero_telefono').on('input', function() {
      validatePhone($(this), 'Ingrese un número telefónico válido');
    });
  
    $('#idGenero').on('change', function() {
      validateSelect($(this), 'Seleccione una opción');
    });
  
    $('#idRol').on('change', function() {
      validateSelect($(this), 'Seleccione una opción');
    });
  
    $('#estatus').on('change', function() {
      validateSelect($(this), 'Seleccione una opción');
    });

    $('#email').on('input', function() {
        validateEmail($(this), 'Ingrese un email válido');
    });

    $('#passwordInput').on('input', function() {
        validatePassword($(this), 'La contraseña debe tener al menos 6 caracteres, una mayúscula, una minúscula y un número');
    });
    
    //VALIDA QUE LOS CAMPOS SEAN VÁLIDOS
    $('#userForm').on('submit', function(event) {
        const invalidInputs = $(this).find('.invalid-input');
        if (invalidInputs.length > 0) {
          event.preventDefault();
          alert('Por favor, revise los campos marcados en rojo');
        }
      });
  });