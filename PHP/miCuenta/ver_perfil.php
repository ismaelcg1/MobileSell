<?php
require_once '../conexion.php';
require_once '../usuario.php';
// Inicializamos sesión y cogemos el usuario actual:
session_start();
$usuarioCreado = false;
$usuario;
// Comprobamos que la sesión existe:
if (isset($_SESSION['usuarioActual']) ) {
  $usuario = $_SESSION['usuarioActual'];
  $usuarioCreado = true;
}
// Variables nombre tablas
$tabla_usuarios = 'usuarios';

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Mobile Sell - Ver perfil</title>
  <style>
    @import "../../CSS/miCuenta/ver_perfil.css";
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
            <a class="dropdown-item">Ver perfil</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="editar_perfil.php">Editar perfil</a>
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
    <form id="datosUsuario">

      <div class="form-group row" id="contenedorTextoPerfil">
        <h1 id="textoPerfil">Perfil de <?php
        if ($usuarioCreado) {
          echo $usuario->get_nombre();
        }
        ?></h1>
      </div>
      <div class="form-group row" id="contenedorimgPerfil">
        <!-- Centrar imagen con bootstrap: .mx-auto .d-block -->
        <img src="../../Iconos/avatar.png" id="imgPerfil" class="img-fluid rounded-circle mx-auto d-block">
      </div>


      <div class="form-group row">
        <div class="col-1"></div>
        <label for="nombre" class="col-12 col-md-4 col-form-label">Nombre:</label>
        <div class="col-12 col-md-4">
          <input type="text" class="form-control" id="nombre" disabled value="<?php
          if ($usuarioCreado) {
            echo $usuario->get_nombre();
          }?>">
        </div>
      </div>

      <div class="form-group row">
        <div class="col-1"></div>
        <label for="apellidos" class="col-12 col-md-4 col-form-label">Apellidos:</label>
        <div class="col-12 col-md-4">
          <input type="text" class="form-control" id="apellidos" disabled value="<?php
          if ($usuarioCreado) {
            echo $usuario->get_apellidos();
          }?>">
        </div>
      </div>

      <div class="form-group row">
        <div class="col-1"></div>
        <label for="fecha_nacimiento" class="col-12 col-md-4 col-form-label">Fecha de nacimiento:</label>
        <div class="col-12 col-md-4">
          <input type="date" class="form-control" id="fecha_nacimiento" disabled value="<?php
          if ($usuarioCreado) {
            echo $usuario->get_fecha_nacimiento();
          }?>">
        </div>
      </div>

      <div class="form-group row">
        <div class="col-1"></div>
        <label for="email" class="col-12 col-md-4 col-form-label">Email:</label>
        <div class="col-12 col-md-4">
          <input type="email" class="form-control" id="email" disabled value="<?php
          if ($usuarioCreado) {
            echo $usuario->get_email();
          }?>">
        </div>
      </div>

      <div class="form-group row">
        <div class="col-1"></div>
        <label id="labelCiudad" class="col-12 col-md-4 col-form-label">Ciudad:</label>
        <div class="col-12 col-md-4">
          <select id="select_ingresar_ciudad" disabled>
            <option value="<?php
            if ($usuarioCreado) {
              echo $usuario->get_ciudad();
            }?>" disabled selected><?php
            if ($usuarioCreado) {
              echo $usuario->get_ciudad();
            }?></option>
          </select>
        </div>
      </div>

    </form>
  </div>



  <div class="container-fluid" id="contenedorFooter">
    <iframe src="../../HTML/footer.html" scrolling="no"></iframe>
  </div>

</body>


</html>
