const emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
const userFile = 'validar_usuario.php';
const correoFile = 'validar_correo.php';
let validator = {
  user: false,
  correo: false
}
window.onload = function () {
  
  $('#registrar').attr('disabled', true);
  inputCorreo = this.document.querySelector('#email');
  inputUser = document.querySelector('#userName');

  if (inputCorreo.value.length > 0 && inputUser.value.length > 0) {
    buscarCorreo(inputCorreo);
    buscarUsuario(inputUser);
    $('#usuario').fadeOut();
    $('#correo').fadeOut();
  }

}

const URL = (archivo) => {
  const config = {
    protocolo: 'http:',
    dominio: '//localhost/game/api/',
    archivo,
    url: function () {
      return `${this.protocolo}${this.dominio}${this.archivo}`;
    },
  };

  return config.url();

};


function validateFrom(form) {
  var nombre = document.forms['formulario']['nombre'];
  var apellido = document.forms['formulario']['apellido'];
  console.log('hola');
  return false;

}

function getData(data, file, procces, target) {
  $.ajax({
    data,
    url: URL(file),
    type: 'POST',
    beforeSend: () => {
      $(target).html('Procesando, espere por favor...');
    },
    dataFilter: (response, type) => {
      console.log(response);
      return JSON.parse(response);
    },
    success: procces,
    complete: () => {
      if (validator.user == true && validator.correo == true) {
        $('#registrar').attr('disabled', false);
      } else {
        $('#registrar').attr('disabled', true);
      }
    }
  });
}

function onUser(response) {
  if (response.result) {
    $('#usuario').addClass('succes');
    $('#usuario').html('Disponible');
    validator.user = true;
  } else {
    $('#usuario').addClass('warning').removeClass('succes');
    $('#usuario').html('Ya existe este usuario');
    validator.user = false;
  }

}

function onCorreo(response) {
  if (response.result) {
    $('#correo').addClass('succes');
    $('#correo').html('Disponible');
    validator.correo = true;
  } else {
    $('#correo').addClass('warning').removeClass('succes');
    $('#correo').html('este correo ya esta siendo utilizado');
    validator.correo = false;
  }

}

function buscarUsuario(user) {

  const data = {
    username: user.value,
  };
  if (user.value.length > 0) {
    $('#usuario').fadeIn();
    getData(data, userFile, onUser, '#usuario');

  } else {
    $('#usuario').fadeOut().html = '';

  }

}

function buscarCorreo({
  value: correo
}) {
  const data = {
    correo: correo,
  };
  if (emailRegex.test(correo)) {
    $('#correo').fadeIn();
    getData(data, correoFile, onCorreo, '#correo');

  } else {
    $('#correo').fadeOut().html = '';

  }

}