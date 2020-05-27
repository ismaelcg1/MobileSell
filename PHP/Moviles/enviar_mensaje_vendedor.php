<?php
  require_once '../conexion.php';
  require_once '../usuario.php';
  // Inicializamos sesión y cogemos el usuario actual:
  session_start();
  // Variables a utilizar posteriormente
  $usuarioCreado = false;
  $usuario;
  $uidUsuarioComprador;
  $uidVendedor;
  $imeiMovil;
  $mensaje;
  $VenimosEnviar = false;
  // Comprobamos que la sesión existe:
  if (isset($_SESSION['usuarioActual']) ) {
    $usuario = $_SESSION['usuarioActual'];
    $usuarioCreado = true;
    $uidUsuarioComprador = $usuario->get_uid();
  }
  // Ahora cogemos por get, el usuario vendedor y el imei del movil
  if (isset($_POST['idV']) && isset($_POST['im'])) {
    $imeiMovil = $_POST['im'];
    $uidVendedor = $_POST['idV'];
  }

  // Ahora comprobamos si se ha enviado el mensaje
  if (isset($_POST['mensaje'])) {
    $mensaje = $_POST['mensaje'];
    // Si le hemos dado a enviar mensaje, insertamos los datos:
    $VenimosEnviar = enviarMensaje($con, $uidUsuarioComprador, $uidVendedor, $imeiMovil, $mensaje);
  }



  function enviarMensaje($conn, $idC, $idV, $imei, $mensaje) {
    $todoCorrecto = false;
    $tabla_historiales_ventas_mensajes = 'historiales_ventas_mensajes';
    $fecha_peticion = date('Y-m-d');

    $queryInsertarMensaje = "INSERT INTO $tabla_historiales_ventas_mensajes (id_usuario_comprador, id_usuario_vendedor, imei_movil, fecha_peticion, mensaje_leido, movil_vendido, mensaje)
      VALUES ('$idC', '$idV', '$imei', '$fecha_peticion', FALSE, FALSE, '$mensaje')";

      $insertarMensaje = $conn->query($queryInsertarMensaje);

      if ($insertarMensaje) { // Si el resultado que devuelve es true...
        $todoCorrecto = true;
      } else {
        $todoCorrecto = false;
      }
      return $todoCorrecto;
  }

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width" >
  <title>Mobile Sell - Enviar mensaje</title>
  <style>
    @import "../../CSS/Moviles/mensaje_vendedor.css";
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

  <script src="../../JavaScript/Moviles/enviar_mensaje.js"></script>

</head>

<body>

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

        <li class="nav-item dropdown active"> <!-- Con active indicamos que en que sección del menú estamos -->
          <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="../../Iconos/movil.png" alt="Icono móviles">
            <u>Móviles</u>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="mis_moviles.php">Mis móviles</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="anadir.php">Añadir</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="eliminar.php">Eliminar</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="consultar_comprar.php">Consultar/Comprar</a>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="../../Iconos/cuenta.png" alt="Icono cuenta">
            Mi cuenta
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="../miCuenta/ver_perfil.php">Ver perfil</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../miCuenta/editar_perfil.php">Editar perfil</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../miCuenta/mensajes_recibidos.php?Noleido=1">Mensajes recibidos</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../miCuenta/cerrar_sesion.php">Cerrar sesión</a>
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


  <div class="container-fluid" id="contenedorEnviarMensaje">

    <div class="row" id="tituloPagina">
        <div class="col-sm-12 d-flex justify-content-center">
            <h1 class="text-center">Enviar mensaje a vendedor</h1>
        </div>
    </div>


    <form id="formularioMensaje" name="formularioMensaje" action="enviar_mensaje_vendedor.php" method="post">

    <div class="col-12">

        <div class="form-group row">



          <div class="col-12 col-md-10 m-auto">
            <!-- Controlamos errores principales -->
            <div class="form-group row" >

              <?php
              if ($VenimosEnviar) {
                  echo '
                    <div class="col-10 col-md-8 alert alert-primary alert-dismissible m-auto">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                      <strong>¡Bien!</strong> Su mensaje se ha enviado correctamente.
                    </div>
                  ';
              }
              ?>
            </div>
          </div>

            <div class="col-12 col-md-9 m-auto divCampos">
              <label for="ingresar_mensaje" class="col-12 col-form-label font-weight-bold"><h3>Mensaje:</h3></label>
              <div class="col-12 col-md-11 m-auto">
                <textarea name="mensaje" class="form-control" id="mensaje" rows="10" cols="40" maxlength="400"
                placeholder="¡Hola vendedor! Me gustaría comprar el móvil que tiene a la venta. Acepto sus condiciones. Un saludo."></textarea>
              </div>
            </div>

            <div class="col-10 col-md-4 m-auto divCampos">
              <br>
                <button type="reset" class="btn-lg btn-outline-info btn-block">Limpiar mensaje</button>
            </div>

            <!-- Para pasar parametros a la siguiente página -->
            <input type="hidden" name="idV" value="<?php echo $uidVendedor ?>">
            <input type="hidden" name="im" value="<?php echo $imeiMovil ?>">

            <div class="col-10 col-md-4 m-auto divCampos">
              <br>
                <button type="button" onclick="enviarMensaje()" class="btn-lg btn-outline-dark btn-block">Enviar mensaje</button>
            </div>

        </div>

    </div>
    </form>

  </div>

  </div>

  <div class="container-fluid" id="contenedorFooter">
    <iframe src="../../HTML/footer.html" scrolling="no"></iframe>
  </div>

</body>

</html>
