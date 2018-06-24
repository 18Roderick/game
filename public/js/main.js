
window.onload = function(){
  var form = document.querySelector('form');
  $('#registrar').attr('disabled', true);

}

const URL = ( () => {
  const config = {
    protocolo: 'http:',
    dominio: '//localhost/',
    archivo: 'game/api/validar_usuario.php',
    url: function() {
      return `${this.protocolo}${this.dominio}${this.archivo}`;
    },
  };

  return config.url();
  
} ) ();


function validateFrom(form) {
  var nombre = document.forms['formulario']['nombre'];
  var apellido = document.forms['formulario']['apellido'];
  console.log('hola');
  return false;

}

function buscarUsuario(user) {
  console.log(URL);
  const data = {
    username: user.value,
  };
  if (user.value.length > 0) {
    $('#usuario').fadeIn();
    $.ajax({
      data,
      url:URL ,
      type: 'POST',
      beforeSend: () => {
        $('#usuario').html('Procesando, espere por favor...');
      },
      success: response => {
        let json = JSON.parse(response);
        
        if(json.result){
          $('#usuario').addClass('succes');
          $('#usuario').html('Disponible');
          $('#registrar').attr('disabled', false);
        }else{
          $('#usuario').addClass('warning').removeClass('succes');
          $('#usuario').html('Ya existe este usuario');
          $('#registrar').attr('disabled', true);
        }
        console.log(json);
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

function notLogged(){
  swal({
    title: 'No puedes acceder a esta ruta!',
    text: 'Nessita iniciar sesion',
    type: 'info',
    showCloseButton: true,
    showCancelButton:true,
    focusConfirm:false,  
    cancelButtonText: 'No tengo cuenta',
    confirmButtonText: 'Iniciar session',
    footer: '<h3>Acceso denegado<h3>'
  })
    .then( result => {
        let protocolo = window.location.protocol+'//';
        let host = window.location.hostname;
        if (result.value) { 
          window.location.assign(`${protocolo}${host}/game/login.php`);
        } 
        else if( result.dismiss === swal.DismissReason.cancel ){
          window.location.assign(`${protocolo}${host}/game/registrar.php`);
        }
    })
}