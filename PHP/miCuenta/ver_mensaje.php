<?php
  require_once '../conexion.php';

  // Tablas BBDD
  $tabla_moviles = 'moviles';
  $tabla_usuarios = 'usuarios';
  $tabla_historiales = 'historiales_ventas_mensajes';
  $tabla_moviles_usuarios = 'moviles_usuarios';

  // Variables que necesitamos:
  $marca;
  $modelo;
  $comprador;
  $precio;
  $mensaje;
  $fecha;
  $ruta_foto;
  $imeiMovil;
  $idMensaje;
  $id_comprador;
  $marcadoLeido = false;
  $movilVendido = false;
  // Ahora cogemos el id del mensaje del movil a vender
  if (isset($_GET['idMensaje']) ) {
      $idMensaje = $_GET['idMensaje'];
  } else {
    echo "Error idMensaje";
  }

// Ahora con el id del mensaje, podemos coger el mensaje y la fecha de solicitud
$obtenerDatosMensaje = "SELECT fecha_peticion, mensaje, id_usuario_comprador, imei_movil FROM $tabla_historiales WHERE id_mensaje = '$idMensaje'";

$queryObtenerMensaje = $con->query($obtenerDatosMensaje);
// Controlamos que la consulta tenga resultados
if ($queryObtenerMensaje->num_rows > 0) {

  while($row = $queryObtenerMensaje->fetch_assoc()) {
    $fecha[0] = $row['fecha_peticion'];
    $mensaje[0] = $row['mensaje'];
    $id_comprador[0] = $row['id_usuario_comprador'];
    $imeiMovil[0] = $row['imei_movil'];
  }
}

// Ahora cogemos los datos del usuario que nos lo quiere comprar:
$obtenerNombreComprador = "SELECT nombre FROM $tabla_usuarios WHERE uid = '$id_comprador[0]'";
$queryObtenerNombreComprador = $con->query($obtenerNombreComprador);
// Controlamos que la consulta tenga resultados
if ($queryObtenerNombreComprador->num_rows > 0) {
  while($row = $queryObtenerNombreComprador->fetch_assoc()) {
    $comprador[0] = $row['nombre'];
  }
}

// Por último, obtenemos los datos del móvil correspondiente
$obtenerDatosMovil = "SELECT marca, modelo, ruta_foto, precio FROM $tabla_moviles WHERE imei = '$imeiMovil[0]'";
$queryObtenerDatosMovil = $con->query($obtenerDatosMovil);
// Controlamos que la consulta tenga resultados
if ($queryObtenerDatosMovil->num_rows > 0) {
  while($row = $queryObtenerDatosMovil->fetch_assoc()) {
    $marca[0] = $row['marca'];
    $modelo[0] = $row['modelo'];
    $ruta_foto[0] = $row['ruta_foto'];
    $precio[0] = $row['precio'];
  }
}

// Vemos si le hemos dado a marcar como leído
if (isset($_POST['marcarComoLeido']) &&  $_POST['marcarComoLeido'] == '1') {
    // En este caso, actualizamos los datos de la tabla historiales_ventas_mensajes
    $actualizarTablaHistoriales = "UPDATE $tabla_historiales SET mensaje_leido=TRUE WHERE id_mensaje='$idMensaje'";
    $result = $con->query($actualizarTablaHistoriales);
    $marcadoLeido = true;
}

// Vemos si el usuario quiere vender el móvil
if (isset($_POST['venderMovil']) && $_POST['venderMovil'] == '1' ) {
    // En este caso, actualizamos los datos de la tabla historiales_ventas_mensajes
    $actualizarTablaHistoriales = "UPDATE $tabla_historiales SET movil_vendido=TRUE WHERE id_mensaje='$idMensaje'";
    $result = $con->query($actualizarTablaHistoriales);
    // Eliminamos el móvil
    eliminarMovil($con, $tabla_moviles_usuarios, $tabla_moviles, $imeiMovil);

    $movilVendido = true;
}

// Ahora vemos si le hemos dado a vender móvil, para eliminarlo de la sección Mis móviles y poner su atributo movil_vendido a 1

function eliminarMovil($con, $tabla_moviles_usuarios, $tabla_moviles, $imeiEliminar) {
  // Primero quitamos la revisión de las claves foráneas
  $quitarRevisionClavesForaneas= "SET FOREIGN_KEY_CHECKS=0";
  $result = $con->query($quitarRevisionClavesForaneas);
  // Ejecutamos varias querys para que se elimine sin tener claves foráneas
  $eliminar_movil1 = "DELETE FROM $tabla_moviles_usuarios WHERE imei_movil = '$imeiEliminar[0]'";
  //$eliminar_movil2 = "DELETE FROM $tabla_moviles WHERE imei = '$imeiEliminar[0]'"; NO SE ELIMININA PORQUE SINO DESPUÉS NO LE SALE EL MENSAJE A EL COMPRADOR

  $result1 = $con->query($eliminar_movil1);
  //$result2 = $con->query($eliminar_movil2);

  // Volvemos a habilitar la revisión de claves foráneas
  $habilitarRevisionClavesForaneas= "SET FOREIGN_KEY_CHECKS=1";
  $result3 = $con->query($habilitarRevisionClavesForaneas);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width" >
  <title>Mobile Sell - Ver mensaje</title>
  <style>
    @import "../../CSS/miCuenta/ver_mensaje.css";
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

  <script type="text/JavaScript" src="../../JavaScript/miCuenta/ver_mensaje.js"></script>

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
            <h1 class="text-center">Ver mensaje</h1>
        </div>
    </div>

    <?php
    if ($marcadoLeido) {
        echo '
        <div class="form-group row" id="alertaRemovible">
          <div class="col-1 col-md-2"></div>
          <div class="col-10 col-md-8 alert alert-primary alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>¡Mensaje marcado como leído!</strong>
          </div>
          <div class="col-1 col-md-2"></div>
        </div>
        ';
    }
    if ($movilVendido) {
        echo '
        <div class="form-group row" id="alertaRemovible">
          <div class="col-1 col-md-3"></div>
          <div class="col-10 col-md-7 alert alert-primary alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>¡Excelente!</strong> El móvil se ha dado por vendido. No aparecerá más en su sección móviles.<br>
            El comprador recibirá un mensaje para ponerse en contacto con usted a traves de su email.<br>
            ¡Muchas gracias por usar la aplicación!
          </div>
          <div class="col-1 col-md-2"></div>
        </div>
        ';
    }
    ?>

    <form enctype="multipart/form-data" id="formularioVerMensaje" name="formularioVerMensaje" action="ver_mensaje.php?idMensaje=<?php echo $idMensaje; ?>" method="post">

    <div class="form-group row">
      <div class="col-9 col-md-8 col-lg-5 m-auto" id="divFoto">
        <label class="col-12 col-form-label font-weight-bold">Foto del producto:</label>
        <div id="imagenVistaPrevia" class="justify-content-center col-12 col-md-8">
          <img id="file-preview" src="
          <?php
            echo $ruta_foto[0];
          ?>
          "></img>
        </div>

      </div>

    <div class="col-12 col-lg-6">

        <div class="form-group row">

            <div class="col-12 col-md-6 m-auto divCampos" id="divMarca">
              <label for="marca" class="col-12 col-form-label font-weight-bold">Marca:</label>
              <div class="col-12">
                  <input disabled value="
                  <?php
                  echo $marca[0];
                  ?>
                  " type="text" name="marca" class="form-control text-left" id="marca">
              </div>
            </div>

            <div class="col-12 col-md-6 m-auto divCampos" id="divModelo">
              <label for="modelo" class="col-12 col-form-label font-weight-bold">Modelo:</label>
              <div class="col-12">
                <input disabled value="
                <?php
                echo $modelo[0];
                ?>
                " type="text" name="modelo" class="form-control text-left" id="modelo">
              </div>
            </div>

            <div class="col-12 col-md-6 m-auto divCampos" id="divComprador">
              <label for="comprador" class="col-12 col-form-label font-weight-bold">Comprador:</label>
              <div class="col-12">
                  <input disabled value="
                  <?php
                  echo $comprador[0];
                  ?>
                  " type="text" name="comprador" class="form-control text-left" id="comprador">
                </div>
            </div>

            <div class="col-12 col-md-6 m-auto divCampos" id="divPrecio">
              <label for="precio" class="col-12 col-form-label font-weight-bold">Precio:</label>
              <div class="col-12">
                <input disabled value="
                <?php
                echo $precio[0]." €";
                ?>
                " type="text" name="precio" class="form-control text-left" id="precio">
              </div>
            </div>

            <div class="col-12 m-auto divCampos" id="divMensaje">
              <label for="mensaje" class="col-12 col-form-label font-weight-bold">Mensaje:</label>
              <div class="col-12 col-md-11 m-auto">
                <textarea disabled type="text" name="mensaje" class="form-control" rows="8" cols="40" maxlength="400" id="mensaje"><?php
                  echo $mensaje[0];
                  ?>
                </textarea>
              </div>
            </div>

            <div class="col-12 m-auto divCampos" id="divFecha">
              <label for="fecha" class="col-12 col-form-label font-weight-bold">Fecha solicitud:</label>
              <div class="col-12">
                <div class="col-10 m-auto">
                  <input disabled value="
                  <?php
                  echo $fecha[0];
                  ?>
                  " type="text" name="fecha" class="form-control text-center" id="fecha">
                </div>
              </div>
            </div>

            <!-- Para pasar parametros a la siguiente página -->
            <input type="hidden" name="marcarComoLeido" id="marcarComoLeido" value="">
            <input type="hidden" name="venderMovil" id="venderMovil" value="">

            <div class="col-12 col-md-6 m-auto divCampos" id="divMarcarLeido">
                <br>
                  <button type="button" onclick="marcarLeido()" class="btn-lg btn-outline-secondary btn-block">Marcar como leído</button>
            </div>

            <div class="col-12 col-md-6 m-auto divCampos" id="divVenderMovil">
                <br>
                  <button type="button" onclick="venderProducto()" class="btn-lg btn-outline-dark btn-block">Vender móvil</button>
            </div>

            <div class="col-12 col-md-8 col-lg-6 divCampos m-auto" id="divVolverAtras">
                <br><br><br>
                  <button type="button" onclick="regresarAtras()" class="btn-lg btn-secondary btn-block">Volver a mensajes recibidos</button>
            </div>

          </div>
    </div>

    </div>
    </form>



  </div>

  <div class="container-fluid" id="contenedorFooter">
    <iframe src="../../HTML/footer.html" scrolling="no"></iframe>
  </div>

</body>

</html>
