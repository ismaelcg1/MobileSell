function regresarAtras(){
  // Obtenemos la URL actual con window.location y añadimos el imei
  var paginaVerMensajes = "http://localhost/Mobile_Sell/PHP/miCuenta/mensajes_recibidos.php";
  var paginaDestino = paginaVerMensajes + "?Noleido=1";

  window.location = paginaDestino;
}

function marcarLeido() {
  var marcarComoLeido = document.getElementById("marcarComoLeido");
  marcarComoLeido.value= "1";
  // Enviamos los datos del formulario oculto
  var formulario = document.forms['formularioVerMensaje'];
  if (!formulario) {
    formulario = document.formularioVerMensaje;
  }
  formulario.submit();
}

function venderProducto(){
  var venderMovil = document.getElementById("venderMovil");
  venderMovil.value = "1";
  // Enviamos los datos del formulario oculto
  var formulario = document.forms['formularioVerMensaje'];
  if (!formulario) {
    formulario = document.formularioVerMensaje;
  }
  formulario.submit();
}

function enviarMensajillo(){
  var enviarMensaje = document.getElementById("enviarMensaje");
  if (enviarMensaje.value == '') {
    enviarMensaje.style.border = "3px solid #FF0000";
    alert("No se puede enviar un mensaje vacío. Por favor, rellene el cuerpo del mensaje.");
  } else {
      enviarMensaje.style.border = "none";
    // Enviamos los datos del formulario oculto
    var formulario = document.forms['formularioVerMensaje'];
    if (!formulario) {
      formulario = document.formularioVerMensaje;
    }
    formulario.submit();
  }

}
