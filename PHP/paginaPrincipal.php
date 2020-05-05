<?php
require_once 'conexion.php';
require_once 'usuario.php';
// Inicializamos sesión y cogemos el usuario actual:
session_start();
$usuario = $_SESSION['usuarioActual'];
// Variables nombre tablas
$tabla_usuarios = 'usuarios';
$tabla_moviles_usuario = 'moviles_usuarios';

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Mobile Sell</title>
  <style>
    @import "../CSS/paginaPrincipal.css";
    @import "../CSS/estiloFooter.css";
    @import "../CSS/menuPrincipal.css";
  </style>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <!-- Optional JavaScript -->
  <!-- jQuery, Popper.js, Bootstrap JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

  <!-- Para navbar -->
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>


<body>

  <header class="col-12">
    <link rel="shortcut icon" type="image/png" href="../Iconos/logo5.png" />
  </header>

  <!-- MENÚ RESPONSIVE -->
  <nav class="navbar navbar-expand-md navbar-light bg-light">
    <img class="imagenMenu" src="../Iconos/logo5.png" />
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="paginaPrincipal.php">
            <img src="../Iconos/casa.png" alt="Icono inicio">
            <u>Inicio</u>
            <span class="sr-only">(actual)</span>
          </a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="../Iconos/movil.png" alt="Icono móviles">
            Móviles
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Mis móviles</a>
            <a class="dropdown-item" href="Moviles/anadir.html">Añadir</a>
            <a class="dropdown-item" href="#">Eliminar</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Consultar/Comprar</a>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="../Iconos/cuenta.png" alt="Icono cuenta">
            Mi cuenta
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="miCuenta/ver_perfil.html">Ver perfil</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Editar perfil</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Cerrar sesión</a> <!-- session_destroy(); -->
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="" id="navbarDropdown3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="../Iconos/ayuda.png" alt="Icono ayuda">
            Ayuda
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="ayuda/como_usar.html">Como usar</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Desarrollador</a>
          </div>
        </li>

      </ul>
    </div>
  </nav>



  <div class="container-fluid" id="contenedorLogin">
    <div class="container col-12">
      <h1 class="col-12">¡Hola <?php echo $usuario->get_nombre(); ?>!</h1>
      <br>
      <p class="col-12">Has añadido un total de <u>0</u> móvil/es</p>

<br><br><br><br>

      <div class="row align-items-center">
        <div class="col-6 col-md-3 m-auto" id="sabias">
          <h5>¿Sabías que...?</h5>
        </div>
        <div class="col-12 col-md-6" id="textoConsejos">
          <p class="col-10 col-md-8 m-auto" id="consejo">
            No se puede comparar la RAM de un dispotivo iOS,
            con la de un dispositivo Android, pues llevan sistemas
             operativos diferentes.
           </p>
        </div>
      </div>

    </div>
  </div>



  <div class="container-fluid" id="contenedorFooter">
    <iframe src="../HTML/footer.html" scrolling="no"></iframe>
  </div>

</body>


</html>
