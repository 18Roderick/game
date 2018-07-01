const cargarPreguntas = 'cargar_preguntas.php';
let dataGame = "";
const URL = (archivo) => {
  const protocolo = window.location.protocol + '//';
  const host = window.location.hostname;
  const config = {
    protocolo,
    dominio: `${host}/game/api/`,
    archivo,
    url: function () {
      return `${this.protocolo}${this.dominio}${this.archivo}`;
    },
  };

  return config.url();

};

function getData(file, data) {
  $.ajax({
    data,
    url: URL(file),
    type: 'POST',
    beforeSend: () => {
      console.log('Procesando, espere por favor...');
      console.log( URL(cargarPreguntas) );
    },
    dataFilter: (response, type) => {
      return JSON.parse(response);
    },
    success: response => {
      
      console.log(response);
      if(response.status){
        dataGame = response;
        cargarModulos();
      }
      
    },
    complete: () => {
      console.log('Ya llegaron todos los registros');
    }
  });
}


$(()=>{
  getData( cargarPreguntas,  {id:1} );
});

function cargarModulos(){
    dataGame.data.forEach(data => {
      console.log(data);
      let h1 = $('<h1></h1>').text(data.titulo);
      let p = $('<p></p>').text(data.descripcion);
      let div = $('<div class="modulos col s12"> </div>');
      div.append(h1, p);
      $("#app").append(div);
    
    });
  
}