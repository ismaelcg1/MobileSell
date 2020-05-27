function verMensaje(idMensaje) {
  // Obtenemos la URL actual con window.location y añadimos el imei
  var paginaVerMensaje = "http://localhost/Mobile_Sell/PHP/miCuenta/ver_mensaje.php";
  var paginaDestino = paginaVerMensaje + "?idMensaje=" + idMensaje;

  window.location = paginaDestino;
}

function verCompra(idMensaje) {
  // Obtenemos la URL actual con window.location y añadimos el imei
  var paginaVerMensaje = "http://localhost/Mobile_Sell/PHP/miCuenta/ver_mensaje_compra.php";
  var paginaDestino = paginaVerMensaje + "?idMensaje=" + idMensaje;

  window.location = paginaDestino;
}
