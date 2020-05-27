function verProducto(imei) {
  // Obtenemos la URL actual con window.location y añadimos el imei
  var paginaVerMovilEliminar = "http://localhost/Mobile_Sell/PHP/Moviles/ver_movil_eliminar.php";
  var paginaDestino = paginaVerMovilEliminar + "?im=" + imei;

  window.location = paginaDestino;
}

function eliminarProducto(imei) {
  // Obtenemos la URL actual con window.location y añadimos el imei
  var paginaVerMovilEliminar = "http://localhost/Mobile_Sell/PHP/Moviles/eliminar.php";
  var paginaDestino = paginaVerMovilEliminar + "?imEliminar=" + imei;

  window.location = paginaDestino;
}

function regresarAtras() {
  var paginaMisMoviles = "http://localhost/Mobile_Sell/PHP/Moviles/eliminar.php";
  window.location = paginaMisMoviles;
}
