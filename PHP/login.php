<?php
  // Requerimos el fichero para que sino está se interrumpa el flujo de ejecucion
  require 'conexion.php';

  // Cogemos las variables a insertar en la BBDD
  $email_usuario = $_POST['email'];
  $password_usuario = $_POST['password'];
  $tabla_usuarios = 'usuarios';

  $busqueda_usuario = "SELECT email FROM $tabla_usuarios WHERE email = '$email_usuario' ";

  $result = $con->query($busqueda_usuario);
  $count = mysqli_num_rows($result);

  if ($count == 1) {
    // Entramos en la página principal
    // PRUEBAS
    echo "<div class='contenido'> <h1>Los datos introducidos son correctos<br/></h1>";
    echo "Email: $email_usuario";
    echo "Password: $password_usuario";
  } else {
    // El usuario o contraseña introducidos no son válidos.
    // PRUEBAS
    echo "<div class='contenido'> <h1>El usuario o contraseña introducidos no son válidos.<br/></h1>";
    echo "Email: $email_usuario";
    echo "Password: $password_usuario";
  }
  mysqli_close($con);
?>
