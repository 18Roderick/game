const emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
const cedulaRegex= /^P$|^(?:PE|E|N|[23456789]|[23456789](?:A|P)?|1[0123]?|1[0123]?(?:A|P)?)$|^(?:PE|E|N|[23456789]|[23456789](?:AV|PI)?|1[0123]?|1[0123]?(?:AV|PI)?)-?$|^(?:PE|E|N|[23456789](?:AV|PI)?|1[0123]?(?:AV|PI)?)-(?:\d{1,4})-?$|^(PE|E|N|[23456789](?:AV|PI)?|1[0123]?(?:AV|PI)?)-(\d{1,4})-(\d{1,5})$/i

window.onload = function(){
  var form = document.querySelector('form');
  //$('#registrar').attr('disabled', true);

}

const URL = () => {
  const config = {
    protocolo: 'http:',
    dominio: '//localhost/',
    archivo: 'game/data_info.php',
    url: function() {
      return `${this.protocolo}${this.dominio}${this.archivo}`;
    },
  };
  return config.url();
};


function validateFrom(form) {
  var nombre = document.forms['formulario']['nombre'];
  var apellido = document.forms['formulario']['apellido'];

  return false;

}

function buscarUsuario(user) {

  const data = {
    user: user.value,
  };
  if (user.value.length > 0) {
    $('#usuario').fadeIn();
    $.ajax({
      data,
      url:URL() ,
      type: 'GET',
      beforeSend: () => {
        $('#usuario').html('Procesando, espere por favor...');
      },
      success: response => {
        $('#usuario').html(response);
        setTimeout(()=>{
          $('#usuario').fadeOut();
        },3000);
        $('#registrar').css('visibility', 'visible');
        $("#registrar").slideDown(1000);
      },
    });

  } else {
    document.getElementById('usuario').innerHTML = '';
    return;
  }

}

function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav back-skie") {
        x.className += " responsive";
    } else {
        x.className = "topnav back-skie";
    }
}