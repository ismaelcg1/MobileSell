<?php
  // Requerimos el fichero para que sino está se interrumpa el flujo de ejecucion
  require_once 'conexion.php';
  require_once 'usuario.php';

  // Cogemos las variables a insertar en la BBDD
  $email_usuario = $_POST['email'];
  $password_usuario = $_POST['password'];
  $tabla_usuarios = 'usuarios';
  $resultado = array();

  $pagina_principal = 'paginaPrincipal.php';
  $pagina_login = 'index.php';

  $busqueda_usuario = "SELECT * FROM $tabla_usuarios WHERE email = '$email_usuario' AND contrasena = '$password_usuario' ";

  $result = $con->query($busqueda_usuario);
  $count = mysqli_num_rows($result);

  if ($count == 1) {
    // Si es correcto guardamos el usuario completo
    $usuarioCreado = crearUsuario($con, $busqueda_usuario);
    if ($usuarioCreado != null){
      // Inicializamos la sesion
      session_start();
      // Guardamos el objeto Usuario que hemos creado en la variable de sesión 'usuarioActual'
      $_SESSION['usuarioActual'] = $usuarioCreado;

      // Entramos en la página principal
      header("Location: $pagina_principal");
      exit;
    } else {
      echo "<script type='text/javascript'>
      alert('Error al almacenar usuario.');
      window.location.href='$pagina_login';
      </script>";
    }
  } else {
    // El usuario o contraseña introducidos no son válidos. Redireccionamos con javascript
    // Para que nos redireccione una vez cerremos el alert.
    echo "<script type='text/javascript'>
    alert('El usuario o contraseña introducidos no son correctos. Vuelva a intentarlo.');
    window.location.href='$pagina_login';
    </script>";
    mysqli_close($con);
  }

  function crearUsuario($conn, $busqueda_usuario){
    $resultadoSQL = true;
    $usuario = null;
    // Recorremos el array de la query para guardar los datos en $resultado
    foreach ($conn->query($busqueda_usuario) as $indiceFila => $value){
      $resultado["u_email"] = $value["email"];
      $resultado["u_pass"] = $value["email"];
      $resultado["u_uid"] = $value["uid"];
      $resultado["u_nombre"] = $value["nombre"];
      $resultado["u_apellidos"] = $value["apellidos"];
      $resultado["u_f_nacmiento"] = $value["f_nacimiento"];
      $resultado["u_localidad"] = $value["localidad"];
    }

    if (!empty($resultado)){
      // Creamos un usuario como objeto de la clase Usuario, definida la variable arriba
      $usuario = new Usuario($resultado["u_email"], $resultado["u_pass"],
                             $resultado["u_uid"], $resultado["u_nombre"],
                             $resultado["u_apellidos"], $resultado["u_f_nacmiento"],
                             $resultado["u_localidad"]);
    }
    return $usuario;
  }
?>
