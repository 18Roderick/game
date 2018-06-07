window.onload = () => {
  let modulos = document.querySelectorAll('.modulos');
  modulos.forEach(modulo => {
    let barra = modulo.lastElementChild.lastElementChild;
    let message = modulo.firstElementChild.lastElementChild;
    let porcentaje = Math.floor(Math.random() * (100 - 0)) + 0;
    message.innerHTML = porcentaje + '% de 100%'
    barra.style.width = porcentaje + '%';
  });
  console.log('bitches');
}