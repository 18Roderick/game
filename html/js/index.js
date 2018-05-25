window.onload = () => {
  let title = document.getElementById('titulo2');

  title.className = ' shake-slow shake-constant';
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