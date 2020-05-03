<?php
  // Parámetros de conexión
  $host = "127.0.0.1";
  $bbdd = "mobile_sell";
  $user = "root";
  $pass = "";// bElw73eDWcl8r0UW

  // Conexión a nuestro gestor de base de datos
  $con = new mysqli($host, $user, $pass);

  // Control de errores de conexión
  if ($con->connect_errno) {
    echo "<h1>Ha fallado la conexión con la base de datos</h1>";
    exit();
  }

  // Seleccionamos la BBDD y el idioma
  $con->select_db($bbdd) or die ("<h1>Error al seleccionar la base de datos</h1>");
  $con->set_charset("UTF8");
?>
