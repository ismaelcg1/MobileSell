<?php
require_once '../conexion.php';
require_once '../usuario.php';

$usuario;
$usuarioCreado = false;
$vieneDePost = false;

// Comprobamos si nos ha llegado por POST variables, si es así es que se ha echo un UPDATE
// Solamente compruebo el nombre, por ejemplo, pues se enviarán todos los datos de nuevo.
if (isset($_POST["nombre"])) {
    // Iniciamos sesion para 'aprovechar datos antiguos'
    session_start();
    $usuarioCreado = false;
    $usuarioAnterior;
    $usuarioActualizado;
    // Comprobamos que la sesión existe:
    if (isset($_SESSION['usuarioActual']) ) {
      $usuarioAnterior = $_SESSION['usuarioActual'];
      $usuarioCreado = true;
      $vieneDePost = true;
    }

    if ($usuarioCreado) {
      $email_usuario = $_POST['email'];
      $password_usuario = $usuarioAnterior->get_password();
      $uid_usuario = $usuarioAnterior->get_uid();
      $nombre_usuario = $_POST['nombre'];
      $apellidos_usuario = $_POST['apellidos'];
      $fecha_nacimiento_usuario = $_POST['fecha_nacimiento'];
      $ciudad_usuario = $_POST['ciudad'];
      // Variables nombre tablas
      $tabla_usuarios = 'usuarios';

      // Actualizamos las variables de sesion, primero creamos un usuario con la nueva info
      $usuarioActualizado = new Usuario($email_usuario, $password_usuario, $uid_usuario, $nombre_usuario,
                                        $apellidos_usuario, $fecha_nacimiento_usuario, $ciudad_usuario);

      if ($usuarioActualizado != null) {
        $_SESSION['usuarioActual'] = $usuarioActualizado;
        $usuario = $_SESSION['usuarioActual'];
        $usuarioCreado = true;
      }
      // Ahora modificamos el usuario en la BBDD
      $modificar_usuario = "UPDATE $tabla_usuarios SET nombre='$nombre_usuario', apellidos='$apellidos_usuario',
                            email='$email_usuario', f_nacimiento='$fecha_nacimiento_usuario',
                            localidad='$ciudad_usuario' WHERE uid='$uid_usuario'";
      $result = $con->query($modificar_usuario);
    } else {
      echo "Error al actualizar usuario";
    }
} else {
  // Inicializamos sesión y cogemos el usuario actual:
  session_start();
  // Comprobamos que la sesión existe:
  if (isset($_SESSION['usuarioActual']) ) {
    $usuario = $_SESSION['usuarioActual'];
    $usuarioCreado = true;
  }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Mobile Sell - Editar perfil</title>
  <style>
    @import "../../CSS/miCuenta/ver_perfil.css";
    @import "../../CSS/miCuenta/editar_perfil.css";
    @import "../../CSS/estiloFooter.css";
    @import "../../CSS/menuPrincipal.css";
  </style>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <!-- Optional JavaScript -->
  <!-- jQuery, Popper.js, Bootstrap JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

  <script type="text/javascript" src="../../JavaScript/miCuenta/editar_perfil.js"></script>
  <script type="text/javascript" src="../../JavaScript/registro.js"></script>
</head>


<body onload="cargarProvincias()">

  <header class="col-12">
    <link rel="shortcut icon" type="image/png" href="../../Iconos/logo5.png" />
  </header>

  <!-- MENÚ RESPONSIVE -->
  <nav class="navbar navbar-expand-md navbar-light bg-light">
    <img class="imagenMenu" src="../../Iconos/logo5.png" />
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="../paginaPrincipal.php">
            <img src="../../Iconos/casa.png" alt="Icono inicio">
            Inicio
          </a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="../../Iconos/movil.png" alt="Icono móviles">
            Móviles
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="../Moviles/mis_moviles.php">Mis móviles</a>
            <a class="dropdown-item" href="../Moviles/anadir.php">Añadir</a>
            <a class="dropdown-item" href="../Moviles/eliminar.php">Eliminar</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../Moviles/consultar_comprar.php">Consultar/Comprar</a>
          </div>
        </li>

        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle" href="" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="../../Iconos/cuenta.png" alt="Icono cuenta">
            <u>Mi cuenta</u>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="ver_perfil.php">Ver perfil</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item">Editar perfil</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="cerrar_sesion.php">Cerrar sesión</a>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="" id="navbarDropdown3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="../../Iconos/ayuda.png" alt="Icono ayuda">
            Ayuda
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="../../HTML/ayuda/como_usar.html">Como usar</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../../HTML/ayuda/desarrollador.html">Desarrollador</a>
          </div>
        </li>

      </ul>
    </div>
  </nav>

  <div class="container-fluid" id="contenedorVerPerfil">
    <form id="datosUsuario" name="datosUsuario" action="editar_perfil.php" method="post">

      <div class="form-group row" id="contenedorTextoPerfil">
        <h1 id="textoPerfil">Editar perfil</h1>
      </div>
      <div class="form-group row" id="contenedorimgPerfil">
        <!-- Centrar imagen con bootstrap: .mx-auto .d-block -->
        <img src="../../Iconos/avatar.png" id="imgPerfil" class="img-fluid rounded-circle mx-auto d-block">
      </div>

      <?php
      if ($vieneDePost) {
          echo '
          <div class="form-group row" id="alertaRemovible">
            <div class="col-1 col-md-2"></div>
            <div class="col-10 col-md-8 alert alert-primary alert-dismissible">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong>¡Todo correcto!</strong> Sus datos se han modificado correctamente.
            </div>
            <div class="col-1 col-md-2"></div>
          </div>
          ';
      }
      ?>

      <div class="form-group row">
        <div class="col-1"></div>
        <label for="nombre" class="col-12 col-md-4 col-form-label">Nombre:</label>
        <div class="col-10 col-md-4">
          <input type="text" class="form-control" id="nombre" name="nombre" maxlength="20" disabled value="<?php
          if ($usuarioCreado) {
            echo $usuario->get_nombre();
          }?>">
        </div>
        <div class="col-1">
          <img class="editar" src="../../Iconos/editar.png" onclick="permitirModificar(1)" alt="Icono editar">
        </div>
      </div>

      <div class="form-group row">
        <div class="col-1"></div>
        <label for="apellidos" class="col-12 col-md-4 col-form-label">Apellidos:</label>
        <div class="col-10 col-md-4">
          <input type="text" class="form-control" id="apellidos" name="apellidos" maxlength="30" disabled value="<?php
          if ($usuarioCreado) {
            echo $usuario->get_apellidos();
          }?>">
        </div>
        <div class="col-1">
          <img class="editar" src="../../Iconos/editar.png" onclick="permitirModificar(2)" alt="Icono editar">
        </div>
      </div>

      <div class="form-group row">
        <div class="col-1"></div>
        <label for="fecha_nacimiento" class="col-12 col-md-4 col-form-label">Fecha de nacimiento:</label>
        <div class="col-10 col-md-4">
          <input type="date" class="form-control" id="fecha_nacimiento"  name="fecha_nacimiento" disabled value="<?php
          if ($usuarioCreado) {
            echo $usuario->get_fecha_nacimiento();
          }?>">
        </div>
        <div class="col-1">
          <img class="editar" src="../../Iconos/editar.png" onclick="permitirModificar(3)" alt="Icono editar">
        </div>
      </div>

      <div class="form-group row">
        <div class="col-1"></div>
        <label for="email" class="col-12 col-md-4 col-form-label">Email:</label>
        <div class="col-10 col-md-4">
          <input type="email" class="form-control" id="email" name="email" disabled value="<?php
          if ($usuarioCreado) {
            echo $usuario->get_email();
          }?>">
        </div>
        <div class="col-1">
          <img class="editar" src="../../Iconos/editar.png" onclick="permitirModificar(4)" alt="Icono editar">
        </div>
      </div>

      <div class="form-group row">
        <div class="col-1"></div>
        <label id="labelCiudad" class="col-12 col-md-4 col-form-label">Ciudad:</label>
        <div class="col-10 col-md-4">
          <select id="select_ingresar_ciudad" name="ciudad" disabled>
            <option value="<?php
            if ($usuarioCreado) {
              echo $usuario->get_ciudad();
            }?>" id="optionCiudad" disabled selected><?php
            if ($usuarioCreado) {
              echo $usuario->get_ciudad();
            }?></option>
          </select>
        </div>
        <div class="col-1">
          <img class="editar" src="../../Iconos/editar.png" onclick="permitirModificar(5)" alt="Icono editar">
        </div>
      </div>
<!--
      <div class="form-group row">
        <div class="col-1"></div>
        <a class="col-6 col-md-5 col-form-label">Cambiar foto de perfil</a>
        <a class="col-6 col-md-5 col-form-label">Cambiar contraseña</a>
        <div class="col-1"></div>
      </div>
    -->

<!-- MENSAJE EXCEPCIONES -->
    <div class="form-group row">
      <div class="col-1 col-md-4"></div>
      <br>
      <div class="col-10 col-md-5 alert alert-warning mensajesAdvertencia" id="camposVacios" role="alert">
        <strong>Hay algún campo vacio.</strong> Por favor, revise y rellene correctamente todos los campos.
      </div>

      <div class="col-10 col-md-5 alert alert-warning mensajesAdvertencia" id="nombreIncorrecto" role="alert">
        <strong>Formato de nombre incorrecto.</strong> El nombre introducido no debe tener números ni caracteres especiales.
      </div>

      <div class="col-10 col-md-5 alert alert-warning mensajesAdvertencia" id="apellidosIncorrectos" role="alert">
        <strong>Formato de los apellidos erróneo.</strong> No deben tener números ni caracteres especiales.
      </div>

      <div class="col-10 col-md-5 alert alert-warning mensajesAdvertencia" id="fechaIncorrecta" role="alert">
        <strong>Formato de fecha introducido incorrecto.</strong> El formato debe ser dd/mm/aaaa.
      </div>

      <div class="col-10 col-md-5 alert alert-warning mensajesAdvertencia" id="correoIncorrecto" role="alert">
        <strong>Formato de correo electrónico incorrecto.</strong> Formato no reconocido.
      </div>

    </div>

      <div class="boton form-group row">
        <div class="col-1 col-sm-6"></div>
        <div class="col-10 col-sm-5 col-md-3" id="DivBtnGuardarCambios">
          <button type="button" id="btnGuardarCambios" onclick="comprobarDatos()"
           class="btn btn-dark btn-block" disabled>Guardar cambios</button>
        </div>
        <div class="col-1 col-sm-3"></div>
      </div>

    </form>
  </div>



  <div class="container-fluid" id="contenedorFooter">
    <iframe src="../../HTML/footer.html" scrolling="no"></iframe>
  </div>

</body>


</html>
