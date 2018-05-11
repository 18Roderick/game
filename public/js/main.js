const url = () => {
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
      url,
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
