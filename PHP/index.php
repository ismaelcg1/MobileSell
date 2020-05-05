<?php
// Requerimos el fichero para que sino está se interrumpa el flujo de ejecucion
require_once 'conexion.php';
require_once 'usuario.php';

$vieneDeRegistro = false;
$registradoAnteriormente = false;
// Cogemos la cookie si el usuario viene de registrarse:
// Comprobamos que la variable de la cookie está definida
if (isset($_COOKIE['emailRegistradoAnteriormente'])) {
  // Hacemos la operación inversa, 'des' serailizamos y decodificamos lo que habiamos codificado y serializado
  $usuario = unserialize(base64_decode($_COOKIE['emailRegistradoAnteriormente']));
  $vieneDeRegistro = false;
  $registradoAnteriormente = true;
} else if (isset($_COOKIE['registroAhora'])) {
  $usuario = unserialize(base64_decode($_COOKIE['registroAhora']));
  $vieneDeRegistro = true;
  $registradoAnteriormente = false;
} else {
  $vieneDeRegistro = false;
  $registradoAnteriormente = false;
}


?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Mobile Sell</title>
  <style>
    @import "../CSS/estilosLogin.css";
  </style>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <!-- Optional JavaScript -->
  <!-- jQuery, Popper.js, Bootstrap JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

  <script type="text/javascript" src="../JavaScript/index.js"></script>
</head>

<body>

  <header class="col-12">
    <link rel="shortcut icon" type="image/png" href="../Iconos/logo5.png" />
    <!-- <img class="imagenMenu" src="../Iconos/logo6.png" /> -->
  </header>

  <div class="container-fluid" id="contenedorLogin">
      <div class="container">

        <form id="formularioInicial" name="formularioInicial" action="../PHP/login.php" method="post">

          <div class="form-group row">
            <!-- LOGO -->
            <img class="imagenRegistroInicial" src="../Iconos/logo5.png" />
          </div>



          <div class="form-group row">
            <div class="col-sm-1 col-md-2"></div>

            <div class="col-11 col-sm-9 col-md-7 alert alert-warning" id="emailVacio" role="alert">
              <strong>Campo email vacio.</strong> Por favor, introduzca su email.
            </div>

            <div class="col-11 col-sm-9 col-md-7 alert alert-warning" id="emailIncorrecto" role="alert">
              <strong>Campo email incorrecto.</strong> El email puede contener letras, numeros, tildes..., pero no espacios en blanco o caracteres especiales. El tamaño máximo debe ser de 32 caracteres.
            </div>

            <div class="col-11 col-sm-9 col-md-7 alert alert-warning" id="passwordVacia" role="alert">
              <strong>Campo contraseña vacio.</strong> Por favor, introduzca su contraseña.
            </div>

            <div class="col-11 col-sm-9 col-md-7 alert alert-warning" id="passwordLogitudIncorrecta" role="alert">
              <strong>Longitud de contraseña incorrecta.</strong> Debe tener un mínimo de 8 y un máximo de 16 caracteres.
            </div>

            <div class="col-11 col-sm-9 col-md-7 alert alert-warning" id="passwordIncorrecta" role="alert">
              <strong>El formato de contraseña no es correcta.</strong> Debe seguir las siguientes políticas:
              <br>-Mínimo de 8 caracteres.
              <br>-Máximo de 16 caracteres.
              <br>-Al menos una letra mayúscula.
              <br>-Al menos una letra minúscula.
              <br>-Al menos un dígito.
              <br>-No debe contener espacios en blanco.
              <br>-Al menos 1 caracter especial (!@%&$?).
            </div>

          </div>



          <div class="form-group row">
            <div class="col-sm-1"></div>
            <label for="ingresar_email" class="col-12 col-sm-2 col-form-label">Email:</label>
            <div class="col-10 col-sm-6">
              <input value="<?php
              if ($vieneDeRegistro || $registradoAnteriormente) {
                echo $usuario->get_email();
              }
              ?>" type="email" name="email" class="form-control" id="ingresar_email" placeholder="Introduzca su email" maxlength="32">
            </div>
            <div class="col-1">
              <img class="icono_warning" src="../Iconos/warning.png"/>
            </div>
          </div>

          <div class="form-group row" id="divIngresarPassword">
            <div class="col-sm-1"></div>
            <label for="ingresar_password" class="col-12 col-sm-2 col-form-label">Contraseña:</label>
            <div class="col-10 col-sm-6">
              <input value="<?php
              if ($vieneDeRegistro) {
                echo $usuario->get_password();
              }
              ?>" type="password" name="password" class="form-control" id="ingresar_password" placeholder="Introduzca su contraseña" maxlength="16">
            </div>
            <div class="col-1">
              <img class="icono_warning" src="../Iconos/warning.png"/>
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-3 order-sm-first"></div>
            <div class="col-11 col-sm-3" id="btnAcceder">
              <button type="button" class="btn btn-dark btn-block" onclick="comprobarDatos()">Acceder</button>
            </div>
            <!-- Con order-sm-first ordenamos el orden dependiendo del tamaño -->
            <div class="col-11 col-sm-3 order-sm-first">
              <a href="otraPagina.html">Olvidé mi contraseña</a>
            </div>
            <div class="col-sm-3"></div>
          </div>

          <div class="form-group row" id="divNoCuenta">
            <div class="col-sm-1 col-md-3"></div>
            <div class="col-11 col-sm-8 col-md-6">
              <a href="../HTML/registro.html">¿No tienes cuenta? <b>Crear una cuenta</b></a>
            </div>
            <div class="col-sm-2 col-md-3"></div>
          </div>

        </form>
      </div>

  </div>

</body>



</html>
