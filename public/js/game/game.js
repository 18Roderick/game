const cargarPreguntas = "cargar_preguntas.php";
let preguntas = "";
let repuestas = "";
let dataGame = "";
let containerDiv = "";
let anterior = 0;
let size = 0;
let inicio = 0;
const URL = archivo => {
  const protocolo = window.location.protocol + "//";
  const host = window.location.hostname;
  const config = {
    protocolo,
    dominio: `${host}/game/api/`,
    archivo,
    url: function() {
      return `${this.protocolo}${this.dominio}${this.archivo}`;
    }
  };

  return config.url();
};

function getData(file, data) {
  $.ajax({
    data,
    url: URL(file),
    type: "POST",
    beforeSend: () => { },
    dataFilter: (response, type) => {
      return JSON.parse(response);
    },
    success: response => {
      console.log(response.data);
     
      if (response.status) {
        dataGame = response.data;
      }
    },
    complete: () => {
      console.log("Ya llegaron todos los registros");
    }
  });
}

$(() => {
  getData(cargarPreguntas, { id: 1 });
  $('.verificando').slideUp();
  containerDiv = $(".game");
  inicio = 0;
  size = containerDiv.length;
  prepararDivs();
});


function verificar_respuesta(){

}
function verificar(id) {
  console.log(preguntas);
 // console.log(getCookie('user'));
  
  let radio = containerDiv[inicio].querySelectorAll('input'); 
  let loader = containerDiv[inicio].querySelectorAll('.verificando'); 
  
  radio.forEach( elemen => {
   
    if(elemen.checked){

      $(loader).css('display','block');
      console.log(elemen);
      let res = dataGame[parseInt(elemen.id)].correcta;

      if(res){
        console.log('Respuesta correcta');
        success();
      }else{
        fail();
      }

      $(loader).css('display', 'none');
      
      setTimeout(() => {
      },500);

    }
  });
}

function siguiente() {
  $(containerDiv[inicio]).slideUp(300, () => {
    inicio = (inicio < size-1) ? inicio + 1 : 0;
    $(containerDiv[inicio]).slideDown(300);
  });

}

function prepararDivs() {

  for (let i = 0; i < containerDiv.length; i++) {
    $(containerDiv[i]).css("display", "none");
  }

  $(containerDiv[inicio]).css("display", "block");
}

function success(){
  swal(
    'Bien hecho! '+getCookie('user'),
    'Tu eleccion es la correcta!',
    'success'
  )
}

function fail(){
  swal({
    type: 'error',
    title: 'Oops...',
    text: 'Respuesta incorrecta!',
  })
}
function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
          c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
          return c.substring(name.length, c.length);
      }
  }
  return "";
}