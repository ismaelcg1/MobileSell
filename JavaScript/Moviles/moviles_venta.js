function verProducto(imei) {
  // Obtenemos la URL actual con window.location y añadimos el imei
  var paginaVerMovil = "http://localhost/Mobile_Sell/PHP/Moviles/ver_movil_venta.php";
  var paginaDestino = paginaVerMovil + "?im=" + imei;

  window.location = paginaDestino;
}

function regresarAtras() {
  var paginaMisMoviles = "http://localhost/Mobile_Sell/PHP/Moviles/consultar_comprar.php";
  window.location = paginaMisMoviles;
}

function quiereComprar() {
    // Enviamos los datos del formulario
    var formulario = document.forms['formularioMovilVenta'];
    if (!formulario) {
      formulario = document.formularioMovilVenta;
    }
    formulario.submit();
}
