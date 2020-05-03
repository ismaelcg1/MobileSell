<?php
  // Requerimos el fichero para que sino está se interrumpa el flujo de ejecucion
  require 'conexion.php';

  // Cogemos las variables a insertar en la BBDD
  $nombre_usuario = $_POST['nombre'];
  $apellidos_usuario = $_POST['apellidos'];
  $fecha_nacimiento_usuario = $_POST['fecha_nacimiento'];
  $email_usuario = $_POST['email'];
  $password_usuario = $_POST['password'];
  $ciudad_usuario = $_POST['ciudad'];

  $tabla_usuarios = 'usuarios';

  $busqueda_usuario = "SELECT email FROM $tabla_usuarios WHERE email = '$email_usuario' ";

  $result = $con->query($busqueda_usuario);
  $count = mysqli_num_rows($result);

  if ($count == 1) {
      echo "<div class='contenedorPrincipal'>";
      echo "<div class='contenido'> <h1>El email introducido ya existe en la base de datos<br/></h1>";
      echo "<h2>Pulse el siguiente enlace e inicie sesión: <a href='../HTML/index.html'>Iniciar sesión</a></h2>";
      echo "</div>";
      echo "</div>";
  } else {
      $query = "INSERT INTO $tabla_usuarios (nombre, apellidos, f_nacimiento, email, contrasena, localidad)
      VALUES ('$nombre_usuario', '$apellidos_usuario', '$fecha_nacimiento_usuario', '$email_usuario',
      '$password_usuario', '$ciudad_usuario')";

      if($con->query($query) === TRUE) {
          echo "<div class='contenedorPrincipal'>";
          echo "<div class='contenido'> <h1>¡Registro realizado correctamente!<br/></h1>";
          echo "<h2>Ya puede iniciar sesión en la página de inicio: <a href='../HTML/index.html'>Iniciar sesión</a></h2>";
          echo "</div>";
          echo "</div>";
      } else {
          echo "<script type='text/javascript'>
          alert('Error al registrar.');
          </script>";
      }
  }
  mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Mobile Sell - Registro</title>
    <style>
      @import "../CSS/registro_usuario.css";
    </style>
  </head>
  <body>

  </body>
</html>
