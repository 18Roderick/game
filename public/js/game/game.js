let preguntas = "";
let repuestas = "";
let dataGame = "";
let containerDiv = "";
let puntaje = 0;
let anterior = 0;
let size = 0;
let inicio = 0;
let xp = 0;

const limitePregunta = 5;
const cargarPreguntas = "cargar_preguntas.php";

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
  let modulo = $('#modulo').text();
  containerDiv = $(".game");
  inicio = 0;
  size = containerDiv.length;

  getData(cargarPreguntas, { id: 1 });
  prepararDivs();

  $('.verificando').slideUp();
  $('#avance').text(`Pregunta ${inicio+1} de ${limitePregunta}`);
  $('#puntaje').text(`Puntaje ${puntaje}`);

  if(modulo == 1){
    xp = 10;
  }else if(modulo == 2){
    xp = 15;
  }else{
    xp = 20;
  }
  

});


function verificar_respuesta(){

}
function verificar() {
  console.log(preguntas);
 // console.log(getCookie('user'));
  
  let radio = containerDiv[inicio].querySelectorAll('input'); 
  let loader = containerDiv[inicio].querySelectorAll('.verificando'); 
  let label = 0;

  radio.forEach( elemen => {
   
    if(elemen.checked){

      $(loader).css('display','block');
      //console.log(elemen);
      label = $(`[for='${elemen.id}']`).text();
      let res = dataGame[parseInt(elemen.id)].correcta;
      let tituloPregunta = containerDiv[inicio].querySelectorAll('p')[0];
      let idPregunta = $(tituloPregunta).attr('value');
      tituloPregunta = $(tituloPregunta).text();
      
      if(res){

        
        console.log('Respuesta correcta id de pregunta '+idPregunta);
        success(tituloPregunta , elemen, label, idPregunta);
      }else{
        fail(tituloPregunta , elemen, label);
      }

      $(loader).css('display', 'none');      
 

    }
  });
}

function siguiente() {
  $(containerDiv[inicio]).slideUp(300, () => {
    inicio = (inicio < size-1) ? inicio + 1 : 0;

    if(inicio == limitePregunta){
      window.location.assign(`${window.location.href}`);
    }else{
      $(containerDiv[inicio]).slideDown(300);
      $('#avance').text(`Pregunta ${inicio+1} de ${limitePregunta}`);
      $('#puntaje').text(`Puntaje ${puntaje}`);

    }


  
  });
  
}

function prepararDivs() {

  for (let i = 0; i < containerDiv.length; i++) {
    $(containerDiv[i]).css("display", "none");
  }

  $(containerDiv[inicio]).css("display", "block");
}

function success(titulo , elemen, text, id){
  swal({
    title:'Bien hecho! ' + getCookie('user'),
    text:'Tu eleccion es la correcta!',
    type:'success',
    html: `
      <p>${titulo}</p>
      <ul> <li >${text}</li>   </ul>
      <h3>+${xp}</h3>
    `
  })
  .then( () => { 
    console.log(titulo, text);
    puntaje += xp;
    elemen.checked = false;
    siguiente();
    guardarProgreso(id);
  });
}

function fail(titulo, elemen, text){
  swal({
    type: 'error',
    title: 'Oops...',
    text: 'Respuesta incorrecta!',
    html: `
    <p>${titulo}</p>
    <ul> <li >${text}</li>   </ul>
  `
  })
  .then( () => { 
    console.log(titulo, text);
    elemen.checked = false;
    siguiente();
  });
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

function guardarProgreso(id){
  const actualizarFile = 'actualizar_puntaje.php';
  const data = {user : getCookie('user'), puntaje , id};
  $.ajax({
    data,
    url: URL(actualizarFile),
    type: "POST",
    beforeSend: () => { },
    dataFilter: (response, type) => {
      return JSON.parse(response);
    },
    success: response => {
      console.log(response)
     
      if (response.status) {
        console.log('puntaje actualizado');
      }
    },
    complete: () => {
      console.log("final de actualizacion");
    }
  });
}
function nextLevel(){
  
}

