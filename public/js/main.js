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
                window.location.assign(`${protocolo}${host}/game/login.php`);
            } else if (result.dismiss === swal.DismissReason.cancel) {
                window.location.assign(`${protocolo}${host}/game/registrar.php`);
            }
        })
}