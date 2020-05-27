<?php
// Requerimos el fichero para que sino está se interrumpa el flujo de ejecucion
require_once '../conexion.php';
require_once 'movil.php';
require_once '../usuario.php';

session_start();
// Variables que necesitamos:
$hay_moviles = false; // Para ver si se han añadido móviles o no.
$id_usuario;
$array_imei;
$array_marcas;
$array_modelos;
$array_memoria_interna;
$array_ruta_foto;
$imeiEliminar;
$movilEliminado = false;
$contadorMoviles = 0;
// Comprobamos que la sesión existe:
if (isset($_SESSION['usuarioActual']) ) {
  $usuario = $_SESSION['usuarioActual'];
  $id_usuario = $usuario->get_uid();
}
// Tablas BBDD
$tabla_moviles = 'moviles';
$tabla_moviles_usuarios = 'moviles_usuarios';
$tabla_historiales = 'historiales_ventas_mensajes';

$obtenerImei = "SELECT imei_movil FROM $tabla_moviles_usuarios WHERE id_usuario = '$id_usuario'";


$queryObtenerImei = $con->query($obtenerImei);
// Controlamos que la consulta tenga resultados
if ($queryObtenerImei->num_rows > 0) {
  $hay_moviles = true;
  while($row = $queryObtenerImei->fetch_assoc()) {
    $array_imei[$contadorMoviles] = $row['imei_movil'];
    $contadorMoviles++;
  }

// Ahora cogemos los datos que nos interesan de los moviles

for ($pos = 0; $pos < $contadorMoviles; $pos++) {
  $obtenerDatosMoviles = "SELECT marca, modelo, memoria_interna, ruta_foto FROM $tabla_moviles WHERE imei = '$array_imei[$pos]'";
  $queryObtenerDatosMoviles = $con->query($obtenerDatosMoviles);

    // Guardamos los datos en el array correspondiente
    while($row = $queryObtenerDatosMoviles->fetch_assoc()) {
      $array_marcas[$pos] = $row['marca'];
      $array_modelos[$pos] = $row['modelo'];
      $array_memoria_interna[$pos] = $row['memoria_interna'];
      $array_ruta_foto[$pos]= $row['ruta_foto'];
    }
  }

  // Ahora vemos si se le ha dado al botón eliminar:
  if (isset($_GET['imEliminar']) ) {
    $imeiEliminar = $_GET['imEliminar'];

    // Primero quitamos la revisión de las claves foráneas
    $quitarRevisionClavesForaneas= "SET FOREIGN_KEY_CHECKS=0";
		$result = $con->query($quitarRevisionClavesForaneas);
    // Ejecutamos varias querys para que se elimine sin tener claves foráneas
    $eliminar_movil1 = "DELETE FROM $tabla_moviles_usuarios WHERE imei_movil = '$imeiEliminar'";
    $eliminar_movil2 = "DELETE FROM $tabla_moviles WHERE imei = '$imeiEliminar'";
    $eliminar_movil3 = "DELETE FROM $tabla_historiales WHERE imei = '$imeiEliminar'";

    $result1 = $con->query($eliminar_movil1);
    $result2 = $con->query($eliminar_movil2);
    $result3 = $con->query($eliminar_movil3);

    // Volvemos a habilitar la revisión de claves foráneas
    $habilitarRevisionClavesForaneas= "SET FOREIGN_KEY_CHECKS=1";
		$result4 = $con->query($habilitarRevisionClavesForaneas);

    if ($result2) { // Si el resultado de la consulta es correcto...
      $movilEliminado = true;
    }
}
}
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width" >
  <title>Mobile Sell - Eliminar moviles</title>
  <style>
    @import "../../CSS/Moviles/mis_moviles.css";
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

  <script type="text/JavaScript" src="../../JavaScript/Moviles/eliminar.js"></script>
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
            <a class="dropdown-item">Eliminar</a>
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


  <div class="container-fluid" id="contenedorMisMoviles">

    <div class="row" id="tituloPagina">
        <div class="col-sm-12 d-flex justify-content-center">
            <h1 class="text-center">Eliminar móviles</h1>
        </div>
    </div>


    <div class="container">
      <?php
      if ($movilEliminado) {
        echo '
        <div class="col-10 col-md-8 alert alert-danger alert-dismissible m-auto">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>¡El móvil se eliminó correctamente!</strong> Ya no aparecerá más en su sección "Móviles".
        </div>
        ';
      }

      if (!$hay_moviles) {
        echo '
        <div class="row justify-content-center m-auto divNoMovil">
          <h2 class="col-12 col-md-8 m-auto text-center">No se ha añadido ningún móvil</h2>
          <img class="col-8 col-sm-4 col-md-3 imagenNoMovil m-auto" src="../../Iconos/cara_triste.png">
        </div>
        ';
      }
      ?>

      <div class="row align-items-start">

        <?php
          if ($hay_moviles) {
            // Hacemos un bucle que recorrerá todas las posiciones, sabiendo los moviles que tenemos
            for ($a = 0; $a < $contadorMoviles; $a++) {
              echo '
              <div class="col-10 col-sm-6 col-md-4 col-lg-3 movilIndividual justify-content-center">
                    <img class="col-12 imagenMovil" src="'?>
                       <?php echo $array_ruta_foto[$a] ?> <?php echo '">
                  <hr class="separador"/>
                    <h4 class="m-auto text-center">'?> <?php echo $array_marcas[$a] ?> <?php echo '</h4>
                    <h6 class="m-auto text-center">'?> <?php echo $array_modelos[$a]?> <?php echo '</h6>
                    <p class="m-auto text-center">'?>  <?php echo $array_memoria_interna[$a] ?> <?php echo ' GB</p>
                    <button type="button" class="btn-lg btn-outline-danger btn-block botonVerMovil" onclick="eliminarProducto('?>
                      <?php echo $array_imei[$a] ?>
                      <?php echo ')">Eliminar móvil</button>
                  <hr class="separadorMoviles d-block d-sm-none"/>
              </div>
              ';
            }
          }

        ?>

      </div>

    </div>

  </div>

  <div class="container-fluid" id="contenedorFooter">
    <iframe src="../../HTML/footer.html" scrolling="no"></iframe>
  </div>

</body>

</html>
