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