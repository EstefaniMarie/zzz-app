$(document).ready(function() {
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