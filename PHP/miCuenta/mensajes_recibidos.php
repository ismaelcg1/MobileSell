<?php
  require_once '../conexion.php';
  require_once '../usuario.php';
  // Inicializamos sesión y cogemos el usuario actual:
  session_start();

  // Tablas BBDD
  $tabla_moviles = 'moviles';
  $tabla_usuarios = 'usuarios';
  // Variables necesarias
  $hay_mensajes = false;
  $array_imeis_moviles;
  $array_ids_comprador;
  $array_ids_vendedor;
  $array_fechas;
  $array_marcas;
  $array_modelos;
  $array_nombres;
  $array_id_mensajes;

  $contadorMensajes = 0;
  $usuarioCreado = false;
  $usuario;
  $uidUsuarioActual;
  $opcionSeleccionada;

  $urlsinparametros= explode('?', $_SERVER['REQUEST_URI'], 2);
  $urlActualSinParametros = "https://". $_SERVER["HTTP_HOST"] . $urlsinparametros[0];

  // Comprobamos que la sesión existe:
  if (isset($_SESSION['usuarioActual']) ) {
    $usuario = $_SESSION['usuarioActual'];
    $usuarioCreado = true;
    $uidUsuarioActual = $usuario->get_uid();
  }
  // Ahora cogemos la opción que se ha seleccionado
  if (isset($_GET['Noleido']) ) {
      $opcionSeleccionada = "Noleido";

  } else if (isset($_GET['Leido']) ) {
      $opcionSeleccionada = "Leido";

  } else if (isset($_GET['Compras']) ) {
      $opcionSeleccionada = "Compras";

  } else {
      header($urlActualSinParametros."?Noleido=1");
      exit;
  }

  $obtenerDatosM = seleccionarMensajes ($opcionSeleccionada, $uidUsuarioActual);

  $queryObtenerMensaje = $con->query($obtenerDatosM);
  // Controlamos que la consulta tenga resultados
  if ($queryObtenerMensaje->num_rows > 0) {
    $hay_mensajes = true;
    while($row = $queryObtenerMensaje->fetch_assoc()) {
      $array_imeis_moviles[$contadorMensajes] = $row['imei_movil'];
      $array_ids_comprador[$contadorMensajes] = $row['id_usuario_comprador'];
      $array_ids_vendedor[$contadorMensajes] = $row['id_usuario_vendedor'];
      $array_fechas[$contadorMensajes] = $row['fecha_peticion'];
      $array_id_mensajes[$contadorMensajes] = $row['id_mensaje'];
      $contadorMensajes++;
    }

  } else {
    // No hay mensajes a mostrar
    $hay_mensajes = false;
  }

  if ($hay_mensajes && $opcionSeleccionada == 'Noleido' || $opcionSeleccionada == 'Leido' || $opcionSeleccionada == 'Compras') {
      // Cogemos los datos del nombre del usuario comprador
      for ($pos = 0; $pos < $contadorMensajes; $pos++) {
        $obtenerNombreComprador = "SELECT nombre FROM $tabla_usuarios WHERE uid = '$array_ids_comprador[$pos]'";
        $queryObtenerNombreComprador = $con->query($obtenerNombreComprador);
          // Guardamos los datos en el array correspondiente
          while($row = $queryObtenerNombreComprador->fetch_assoc()) {
            $array_nombres[$pos] = $row['nombre'];
          }
        }

        // Cogemos la marca y el modelo del movil referente
        for ($pos = 0; $pos < $contadorMensajes; $pos++) {
          $obtenerMarcaModelo = "SELECT marca, modelo FROM $tabla_moviles WHERE imei = '$array_imeis_moviles[$pos]'";
          $queryObtenerMarcaModelo = $con->query($obtenerMarcaModelo);
            // Guardamos los datos en el array correspondiente
            while($row = $queryObtenerMarcaModelo->fetch_assoc()) {
              $array_marcas[$pos] = $row['marca'];
              $array_modelos[$pos] = $row['modelo'];
            }
          }
  }



  function seleccionarMensajes($opcionSeleccionada, $uidUsuarioActual) {

    $tabla_historiales = 'historiales_ventas_mensajes';
    $obtenerDatosMensajes;

    switch ($opcionSeleccionada) {
      case "Noleido":
          $obtenerDatosMensajes = "SELECT * FROM $tabla_historiales WHERE id_usuario_vendedor = '$uidUsuarioActual' AND mensaje_leido = '0' AND movil_vendido = '0'";
        break;
      case "Leido":
          $obtenerDatosMensajes = "SELECT * FROM $tabla_historiales WHERE id_usuario_vendedor = '$uidUsuarioActual' AND mensaje_leido = '1' AND movil_vendido = '0'";
        break;
      case "Compras":
          $obtenerDatosMensajes = "SELECT * FROM $tabla_historiales WHERE id_usuario_comprador = '$uidUsuarioActual' AND movil_vendido = '1'";
          // Con está query cogemos los datos del mensaje de una compra que ha sido aceptada por el vendedor
          break;
      default :
          echo "Ninguna opción seleccionada";
          break;
    }
    return $obtenerDatosMensajes;
}


?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width" >
  <title>Mobile Sell - Enviar mensaje</title>
  <style>
    @import "../../CSS/miCuenta/mensajes_recibidos.css";
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

  <script type="text/JavaScript" src="../../JavaScript/miCuenta/mensajes_recibidos.js"></script>

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
            <a class="dropdown-item" href="../Moviles/mis_moviles.php">Mis móviles</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../Moviles/anadir.php">Añadir</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../Moviles/eliminar.php">Eliminar</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../Moviles/consultar_comprar.php">Consultar/Comprar</a>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="../../Iconos/cuenta.png" alt="Icono cuenta">
            Mi cuenta
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="ver_perfil.php">Ver perfil</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="editar_perfil.php">Editar perfil</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="mensajes_recibidos.php?Noleido=1">Mensajes recibidos</a>
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


  <div class="container-fluid" id="contenedorMensajes">

    <div class="row" id="tituloPagina">
        <div class="col-sm-12 d-flex justify-content-center">
            <h1 class="text-center">Mensajes recibidos</h1>
        </div>
    </div>

    <div class="col-12 d-flex justify-content-center">
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link <?php
            if ($opcionSeleccionada == "Noleido") {
              echo "active";
            }
          ?>" href="
            <?php echo $urlActualSinParametros."?Noleido=1" ?>
          ">No leídos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php
            if ($opcionSeleccionada == "Leido") {
              echo "active";
            }
          ?>" href="
            <?php echo $urlActualSinParametros."?Leido=1" ?>
          ">Leídos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php
            if ($opcionSeleccionada == "Compras") {
              echo "active";
            }
          ?>" href="
            <?php echo $urlActualSinParametros."?Compras=1" ?>
          ">Compras</a>
        </li>
      </ul>
    </div>

    <div class="container">

      <?php
      if (!$hay_mensajes && $opcionSeleccionada == "Noleido") {
        echo '
        <div class="row justify-content-center m-auto divNoMensajes">
          <h2 class="col-12 col-md-8 m-auto text-center">No hay mensajes NO LEÍDOS que mostrar</h2>
          <img class="col-8 col-sm-4 col-md-3 imagenNoMensajes m-auto" src="../../Iconos/cara_triste.png">
        </div>
        ';
      } else if (!$hay_mensajes && $opcionSeleccionada == "Leido") {
        echo '
        <div class="row justify-content-center m-auto divNoMensajes">
          <h2 class="col-12 col-md-8 m-auto text-center">No hay mensajes LEÍDOS que mostrar</h2>
          <img class="col-8 col-sm-4 col-md-3 imagenNoMensajes m-auto" src="../../Iconos/cara_triste.png">
        </div>
        ';
      } else if (!$hay_mensajes && $opcionSeleccionada == "Compras") {
        echo '
        <div class="row justify-content-center m-auto divNoMensajes">
          <h2 class="col-12 col-md-8 m-auto text-center">No hay mensajes referentes a compras que mostrar</h2>
          <img class="col-8 col-sm-4 col-md-3 imagenNoMensajes m-auto" src="../../Iconos/cara_triste.png">
        </div>
        ';
      } else {
        // Hacemos un bucle que recorrerá todas las posiciones, sabiendo los moviles que tenemos
        echo '<div class="row justify-content-center m-auto">';
        for ($a = 0; $a < $contadorMensajes; $a++) {
          echo '
              <div class="col-10 col-sm-6 col-lg-4 mensajeIndividual justify-content-center">
                  <h4 class="m-auto text-center mensajeNuevo">Mensaje referente a: <i>'?>
                    <?php
                    echo $array_marcas[$a]." ".$array_modelos[$a];
                    ?>
                    <?php echo ' </i></h4>
                  <img class="col-12 imgMensaje" src="../../Iconos/email.png"
                  '?> <?php
                  if ($opcionSeleccionada == "Compras") {
                      echo "onclick='verCompra($array_id_mensajes[$a])'";
                  } else {
                      echo "onclick='verMensaje($array_id_mensajes[$a])'";
                  }?>
                  <?php
                  echo '>
                  <h5 class="m-auto text-center fecha">Fecha mensaje: '?>
                    <?php
                    echo $array_fechas[$a];
                    ?>
                    <?php echo '</h5>
                  <h5 class="m-auto text-center enviadoPor">Enviado por: '?>
                    <?php
                    echo $array_nombres[$a];
                    ?>
                    <?php echo '</h5>
                  <hr class="separadorMoviles d-block d-sm-none"/>
              </div>
          ';
        }
        echo '</div>';
      }
      ?>
  </div>


</div>

  <div class="container-fluid" id="contenedorFooter">
    <iframe src="../../HTML/footer.html" scrolling="no"></iframe>
  </div>

</body>

</html>
