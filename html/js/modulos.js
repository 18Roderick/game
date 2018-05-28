window.onload = () => {
  let modulos = document.querySelectorAll('.modulos');
  modulos.forEach( modulo => {
    let barra = modulo.lastElementChild.lastElementChild;
    barra.style.width = (Math.floor(Math.random() * (100 - 0)) + 0) + '%' ;
  });
  console.log('bitches');
}
