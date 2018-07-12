$(() => {

    

    $(".dropdown-trigger").dropdown({ hover: false });
    $('.sidenav').sidenav();
    $('.datepicker').datepicker({
        autoClose: true,
        format: 'yyyy/m/d/',
        yearRange: [1950, 2018],
    });
    M.updateTextFields();
    
    $('#buttonDrop').click( function () {
        $('#myDropdown').toggleClass("show");
        console.log(this);
    });



    

});

const puntajeFile = 'consultar_puntaje.php';

function consultarPuntaje(data){
    $.ajax({
        data,
        url: URL(puntajeFile),
        type: "POST",
        beforeSend: () => { },
        dataFilter: (response, type) => {
          return JSON.parse(response);
        },
        success: response => {
          console.log(response)
         
          if (response.status) {
            console.log('puntaje actualizado');
            return response;
          }
        },
        complete: () => {
          console.log("final de actualizacion");
        }
      });

}


function notLogged() {
    swal({
            title: 'No puedes acceder a esta ruta!',
            text: 'Nessita iniciar sesion',
            type: 'info',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            cancelButtonText: 'No tengo cuenta',
            confirmButtonText: 'Iniciar session',
            footer: '<h3>Acceso denegado<h3>'
        })
        .then(result => {
            let protocolo = window.location.protocol + '//';
            let host = window.location.hostname;
            if (result.value) {
                window.location.assign(`${protocolo}${host}/game/views/login.php`);
            } else if (result.dismiss === swal.DismissReason.cancel) {
                window.location.assign(`${protocolo}${host}/game/views/registrar.php`);
            }
        })
}

function jugar(caja, id){

    console.log(caja, id);
    let protocolo = window.location.protocol + '//';
    let host = window.location.hostname;
        window.location.assign(`${protocolo}${host}/game/views/jugar.php?start=${id}`);
    
}