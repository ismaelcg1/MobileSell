<?php
//$url= $_SERVER["REQUEST_URI"];
//$urlCompleta = $host . $url;
require_once '../conexion.php';
require_once 'movil.php';
//Variables que necesitamos:
$imei;
$arrayMovil = array();
$tabla_moviles = 'moviles';
$tabla_moviles_usuarios = 'moviles_usuarios';
$pagina_mis_moviles = 'mis_moviles.php';
// Como en JavaScript pusimos parámetro por 'GET', podemos obtenerlo de esta forma:
if (isset($_GET['im']) ) {
    $imei = $_GET['im'];
}

$busqueda_movil = "SELECT * FROM $tabla_moviles WHERE imei = '$imei'";

$result = $con->query($busqueda_movil);
$count = mysqli_num_rows($result);

if ($count == 1) {
  // Si es correcto guardamos el usuario completo
  $movilCreado = crearMovil($con, $busqueda_movil, $imei);
  if ($movilCreado == null){
    echo "<script type='text/javascript'>
    alert('Error al mostrar datos del móvil.');
    window.location.href='$pagina_mis_moviles';
    </script>";
    mysqli_close($con);
    exit;
  }
  $venta = comprobarEstadoVenta($con, $imei, $tabla_moviles_usuarios);
  mysqli_close($con);
}


  function crearMovil($conn, $busqueda_movil, $imei){
    $resultadoSQL = true;
    $movil = null;
    // Recorremos el array de la query para guardar los datos en $arrayMovil
    foreach ($conn->query($busqueda_movil) as $indiceFila => $value){
      $arrayMovil["m_marca"] = $value["marca"];
      $arrayMovil["m_modelo"] = $value["modelo"];
      $arrayMovil["m_memoria_interna"] = $value["memoria_interna"];
      $arrayMovil["m_bateria"] = $value["bateria"];
      $arrayMovil["m_ruta_foto"] = $value["ruta_foto"];
      $arrayMovil["m_ram"] = $value["ram"];
      $arrayMovil["m_color"] = $value["color"];
      $arrayMovil["m_camara_mpx"] = $value["camara_mpx"];
      $arrayMovil["m_precio"] = $value["precio"];
      $arrayMovil["m_pantalla_pulgadas"] = $value["pantalla_pulgadas"];
      $arrayMovil["m_estado_producto"] = $value["estado_producto"];
    }

    if (!empty($arrayMovil)){
      // Creamos un movil como objeto de la clase Movil
      $movil = new Movil($imei, $arrayMovil["m_marca"], $arrayMovil["m_modelo"], $arrayMovil["m_memoria_interna"],
                         $arrayMovil["m_bateria"], $arrayMovil["m_ram"], $arrayMovil["m_color"], $arrayMovil["m_camara_mpx"],
                         $arrayMovil["m_pantalla_pulgadas"], $arrayMovil["m_estado_producto"], $arrayMovil["m_precio"],
                         $arrayMovil["m_ruta_foto"]);
    }
    return $movil;
  }

  function comprobarEstadoVenta($con, $imei, $tabla_moviles_usuarios) {
    $resultadoVenta;
    $query_en_venta = "SELECT en_venta FROM $tabla_moviles_usuarios WHERE imei_movil = '$imei'";
    $result = $con->query($query_en_venta);
    $resultadoVenta = mysqli_fetch_array($result)[0];
    return $resultadoVenta;
  }
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width" >
  <title>Mobile Sell - Consultar / Comprar</title>
  <style>
    @import "../../CSS/Moviles/ver_moviles.css";
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

  <script src="../../JavaScript/Moviles/moviles_venta.js"></script>

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
            <a class="dropdown-item">Consultar/Comprar</a>
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


  <div class="container-fluid" id="contenedorVerMovil">

    <div class="row" id="tituloPagina">
        <div class="col-sm-12 d-flex justify-content-center">
            <h1 class="text-center">Ver móvil en venta</h1>
        </div>
    </div>


    <form enctype="multipart/form-data" id="formularioAddMovil" name="formularioAddMovil" action="anadir.php" method="post">

    <div class="form-group row">
      <div class="col-11 col-sm-9 col-md-5 m-auto" id="divFoto">
        <label class="col-12 col-form-label font-weight-bold">Foto del producto:</label>
        <div id="imagenVistaPrevia">
          <img id="file-preview" src="<?php echo $movilCreado->get_ruta_foto(); ?>"></img>
        </div>
      </div>

    <div class="col-12 col-md-7 col-lg-6">

        <div class="form-group row">

            <div class="col-12 col-md-6 ml-auto divCampos" id="divMarca">
              <label for="ingresar_marca" class="col-12 col-form-label font-weight-bold">Marca:</label>
              <div class="col-12">
                <select id="select_ingresar_marca" class="form-control" name="marca" disabled>
                  <option value="" disabled selected><?php echo $movilCreado->get_marca(); ?></option>
                </select>
              </div>
            </div>

            <div class="col-12 col-md-6 mr-auto divCampos" id="divModelo">
              <label for="ingresar_modelo" class="col-12 col-form-label font-weight-bold">Modelo:</label>
              <div class="col-12">
                <input disabled value="<?php echo $movilCreado->get_modelo(); ?>" type="text" name="ingresar_modelo" class="form-control" id="ingresar_modelo" placeholder="Introduzca el modelo del dispositivo" maxlength="25">
              </div>
            </div>

            <div class="col-12 col-md-6 ml-auto divCampos" id="divMemoriaInterna">
              <label for="ingresar_memoria_interna" class="col-12 col-form-label font-weight-bold">Memoria interna:</label>
              <div class="col-12">
                <input disabled value="<?php echo $movilCreado->get_memoria_interna(); ?> GB" name="ingresar_memoria_interna" class="form-control" id="ingresar_memoria_interna" placeholder="Memoria ROM. Ej.: 64" max="1024" step="1">
              </div>
            </div>

            <div class="col-12 col-md-6 mr-auto divCampos" id="divBateria">
              <label for="ingresar_bateria" class="col-12 col-form-label font-weight-bold">Batería:</label>
              <div class="col-12">
                <input disabled value="<?php echo $movilCreado->get_bateria(); ?> mAh" name="ingresar_bateria" class="form-control" id="ingresar_bateria" placeholder="Batería en miliAmperios. Ej.: 3120" max="50000" step="1">
              </div>
            </div>

            <div class="col-12 col-md-6 ml-auto divCampos" id="divRam">
              <label for="ingresar_ram" class="col-12 col-form-label font-weight-bold">Memoria RAM:</label>
              <div class="col-12">
                <input disabled value="<?php echo $movilCreado->get_ram(); ?> GB" name="ingresar_ram" class="form-control" id="ingresar_ram" placeholder="Especifique RAM en GB. Ej.: 4" max="64" step="1">
              </div>
            </div>

            <div class="col-12 col-md-6 mr-auto divCampos" id="divCamara">
              <label for="ingresar_mpx_camara" class="col-12 col-form-label font-weight-bold">Megapixeles cámara:</label>
              <div class="col-12">
                <input disabled value="<?php echo $movilCreado->get_camara_mpx(); ?> Mpx" name="ingresar_mpx_camara" class="form-control" id="ingresar_mpx_camara" placeholder="Megapixeles cámara. Ej.: 12.20" max="100" step="0.01">
              </div>
            </div>

            <div class="col-12 col-md-6 ml-auto divCampos" id="divPrecio">
              <label for="ingresar_precio" class="col-12 col-form-label font-weight-bold">Precio:</label>
              <div class="col-12">
                <input disabled value="<?php echo $movilCreado->get_precio(); ?> €" name="ingresar_precio" class="form-control" id="ingresar_precio" placeholder="Posible precio de venta. Ej.: 320.50" min="1" step="0.01" max="3000">
              </div>
            </div>

            <div class="col-12 col-md-6 mr-auto divCampos" id="divPulgadas">
              <label for="ingresar_pulgadas" class="col-12 col-form-label font-weight-bold">Pulgadas de pantalla:</label>
              <div class="col-12">
                <input disabled value="<?php echo $movilCreado->get_pantalla_pulgadas(); ?> &quot;" name="ingresar_pulgadas" class="form-control" id="ingresar_pulgadas" placeholder="Tamaño pantalla en pulgadas. Ej.: 5.22" max="16" step="0.01">
              </div>
            </div>

            <div class="col-12 col-md-6 ml-auto divCampos" id="divColor">
              <label for="ingresar_color" class="col-12 col-form-label font-weight-bold">Color producto:</label>
              <div class="col-10 m-auto">
                <input disabled value="<?php echo $movilCreado->get_color(); ?>" type="color" name="ingresar_color" class="form-control" id="ingresar_color" placeholder="Color del dispositivo">
              </div>
            </div>

            <div class="col-12 col-md-6 mr-auto divCampos" id="divEstado">
              <label for="ingresar_estado" class="col-12 col-form-label font-weight-bold">Estado del producto:</label>
              <div class="col-12">
                <select id="select_ingresar_estado" class="form-control" name="estado" disabled>
                  <option disabled selected><?php echo $movilCreado->get_estado_producto(); ?></option>
                  <!-- Se cargan en Body -->
                </select>
              </div>
            </div>

            <div class="col-12 col-md-6 m-auto divCampos">
                <br>
                  <button type="button" onclick="regresarAtras()" class="btn btn-secondary btn-block">Volver atrás</button>
            </div>

            <div class="col-12 col-md-6 m-auto divCampos">
              <br>
                <button type="button" onclick="quiereComprar()" class="btn btn-dark btn-block">Comprar</button>
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
