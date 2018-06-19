window.onload = () => {
  let title = document.getElementById('titulo2');
  notLogged();
  Main();
  /*   setTimeout(()=>{
      title.className ='';
    }, 2000)
     */
}

function Main() {
  let titulo = document.querySelector('#titulo3');
  let spans = document.querySelectorAll('.word span');
  spans.forEach((span, idx) => {
    span.addEventListener('click', (e) => {
      e.target.classList.add('active');
    });
    span.addEventListener('animationend', (e) => {
      e.target.classList.remove('active');
    });

    // Initial animation
    setTimeout(() => {
      span.classList.add('active');
    }, 750 * (idx + 1))
  });

}

setInterval(Main, 10000);

function notLogged(){
  swal({
    title: 'No puedes acceder a esta ruta!',
    text: 'Nesitas iniciar sesion',
    type: 'info',
    showCloseButton: true,
    showCancelButton: true,
    focusConfirm:false,  
    cancelButtonText: 'No tengo cuenta',
    confirmButtonText: 'Iniciar session',
    footer: '<a href="javascript:void(0);">Iniciar session</a>'
  })
    .then( result => {
        let protocolo = window.location.protocol+'//';
        let host = window.location.hostname;
        console.log(result);
        if (result.value) { 
          console.log(`${protocolo}${host}/login`)
        } 
        else if( result.dismiss === swal.DismissReason.cancel ){
          console.log(`${protocolo}${host}/registro`)
        } else{
          console.log('nada que hacer');
        } 
    })
}

function info(){
  swal({
    title: '<i>HTML</i> <u>example</u>',
    showCloseButton: true,
    showCancelButton: true,
    focusConfirm: false,
    cancelButtonText:
    '<i class="fa fa-thumbs-down"></i>',
    cancelButtonAriaLabel: 'Thumbs down',
  })
}