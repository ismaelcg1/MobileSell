<?php
  // Destruimos la sesión actual:
  session_start();
  session_destroy();
  //Redirigimos a la página principal de Mobile Sell
  header('Location: ../index.php');
  exit();

?>
