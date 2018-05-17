/* const URL = () => {
  const config = {
    protocolo: 'http:',
    dominio: '//localhost/',
    archivo: 'game/data_info.php',
    url: () => {
      return `${this.protocolo}${this.dominio}${this.archivo}`;
    },
  };
  return config.url();
};
 */
window.onload = () => {
  Main();
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

function validateFrom() {

  return true;

}

function buscarUsuario(user) {

  console.log(user.value.length);
  const data = {
    user: user.value,
  };
  if (user.value.length > 0) {
    $.ajax({
      data,
      url:URL() ,
      type: 'GET',
      beforeSend: () => {
        $('#usuario').html('Procesando, espere por favor...');
      },
      success: response => {
        $('#usuario').html(response);
      },
    });

  } else {
    document.getElementById('usuario').innerHTML = '';
    return;
  }

}

function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav back-skie") {
        x.className += " responsive";
    } else {
        x.className = "topnav back-skie";
    }
}