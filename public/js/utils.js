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