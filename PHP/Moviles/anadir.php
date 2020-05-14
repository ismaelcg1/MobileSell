<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width" >
  <title>Mobile Sell - Añadir</title>
  <style>
    @import "../../CSS/Moviles/anadir.css";
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

<script type="text/JavaScript" src="../../JavaScript/Moviles/anadir.js"></script>

</head>


<body onload="cargarEstadoProducto(); cargarMarcas()">

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
            <a class="dropdown-item">Añadir</a>
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


  <div class="container-fluid" id="contenedorAnadir">

    <div class="row" id="tituloPagina">
        <div class="col-sm-12 d-flex justify-content-center">
            <h1 class="text-center">Añadir móvil</h1>
        </div>
    </div>

    <form id="formularioAddMovil" name="formularioAddMovil" action="" method="post">

    <div class="form-group row">
      <div class="col-11 col-sm-3 m-auto" id="divFoto">
        <label for="ingresar_foto" class="col-12 col-form-label font-weight-bold">Foto del producto (Sólo 1 foto):</label>
        <div class="col-12">
          <input type="file" name="ingresar_foto" id="ingresar_foto" accept="image/*" class="form-control">

        </div>
        <div id="imagenVistaPrevia">
          <!-- Aquí se mostrará la imagen al seleccionarla, lo hacemos con un script -->
          <script src="../../JavaScript/Moviles/visualizarImagen.js"></script>
        </div>
      </div>

    <div class="col-12 col-sm-8">
      <!-- Controlamos errores principales -->
      <div class="form-group row errores" >
          <div class="col-11 alert alert-warning m-auto" id="camposVacios" role="alert">
            <strong>Hay algún campo vacio.</strong> Por favor, revise y rellene correctamente todos los campos.
          </div>

          <div class="col-11 alert alert-warning m-auto" id="fotoVacia" role="alert">
            <strong>No ha seleccionado ninguna foto.</strong> Por favor, seleccione una foto del dispositivo.
          </div>

          <div class="col-11 alert alert-warning m-auto" id="modeloIncorrecto" role="alert">
            <strong>El modelo introducido es incorrecto.</strong> Puede tener letras y números. No puede tener caracteres especiales.
          </div>

          <div class="col-11 alert alert-warning m-auto" id="memoriaInternaIncorrecta" role="alert">
            <strong>Memoria interna incorrecta.</strong> Sólo puede contener números. Debe ser menor a 1024. Se introduce en GB. No se admiten decimales.
          </div>

          <div class="col-11 alert alert-warning m-auto" id="bateriaIncorrecta" role="alert">
            <strong>La bateria es incorrecta.</strong> Sólo puede contener números. Debe ser menor o igual a 50000. Se introduce en miliamperios. No se admiten decimales.
          </div>

          <div class="col-11 alert alert-warning m-auto" id="ramIncorrecta" role="alert">
            <strong>Memoria RAM incorrecta.</strong> Sólo puede contener números. Debe ser menor o igual a 32. Se introduce en GB. No se admiten decimales.
          </div>

          <div class="col-11 alert alert-warning m-auto" id="mpxCamaraIncorrectos" role="alert">
            <strong>Megapixeles de cámara incorrectos.</strong> Sólo puede contener números y coma (,) ó puntos (.) para decimales. Debe ser menor o igual a 100. Se introduce en Mpx. Se permiten 2 decimales.
          </div>

          <div class="col-11 alert alert-warning m-auto" id="precioIncorrecto" role="alert">
            <strong>Precio incorrecto.</strong> Sólo puede contener números y coma (,) ó punto (.) para decimales. Debe ser menor o igual a 3000. Se introduce en euros. Se permiten 2 decimales.
          </div>

          <div class="col-11 alert alert-warning m-auto" id="pulgadasIncorrectas" role="alert">
            <strong>Pulgadas incorrectas.</strong> Sólo puede contener números y coma (,) ó punto (.) para decimales. Debe ser menor o igual a 16. Se introduce en pulgadas ("). Se permiten 2 decimales.
          </div>

      </div>


        <div class="form-group row">

            <div class="col-12 col-md-6 ml-auto divCampos" id="divMarca">
              <label for="ingresar_marca" class="col-12 col-form-label font-weight-bold">Marca:</label>
              <div class="col-12">
                <select id="select_ingresar_marca" class="form-control" name="marca">
                  <option value="" disabled selected>Seleccione la marca del dispositivo</option>
                  <!-- Se cargan en Body -->
                </select>
              </div>
            </div>

            <div class="col-12 col-md-6 mr-auto divCampos" id="divModelo">
              <label for="ingresar_modelo" class="col-12 col-form-label font-weight-bold">Modelo:</label>
              <div class="col-12">
                <input onkeyup="verificarDatos('modelo')" value="" type="text" name="ingresar_modelo" class="form-control" id="ingresar_modelo" placeholder="Introduzca el modelo del dispositivo" maxlength="25">
              </div>
            </div>

            <div class="col-12 col-md-6 ml-auto divCampos" id="divMemoriaInterna">
              <label for="ingresar_memoria_interna" class="col-12 col-form-label font-weight-bold">Memoria interna:</label>
              <div class="col-12">
                <input value="" onkeyup="verificarDatos('memoria_interna')" type="number" name="ingresar_memoria_interna" class="form-control" id="ingresar_memoria_interna" placeholder="Memoria ROM. Ej.: 64" max="1024" step="1">
              </div>
            </div>

            <div class="col-12 col-md-6 mr-auto divCampos" id="divBateria">
              <label for="ingresar_bateria" class="col-12 col-form-label font-weight-bold">Batería:</label>
              <div class="col-12">
                <input value="" onkeyup="verificarDatos('bateria')" type="number" name="ingresar_bateria" class="form-control" id="ingresar_bateria" placeholder="Batería en miliAmperios. Ej.: 3120" max="50000" step="1">
              </div>
            </div>

            <div class="col-12 col-md-6 ml-auto divCampos" id="divRam">
              <label for="ingresar_ram" class="col-12 col-form-label font-weight-bold">Memoria RAM:</label>
              <div class="col-12">
                <input value="" onkeyup="verificarDatos('ram')" type="number" name="ingresar_ram" class="form-control" id="ingresar_ram" placeholder="Especifique RAM en GB. Ej.: 4" max="64" step="1">
              </div>
            </div>

            <div class="col-12 col-md-6 mr-auto divCampos" id="divCamara">
              <label for="ingresar_mpx_camara" class="col-12 col-form-label font-weight-bold">Megapixeles cámara:</label>
              <div class="col-12">
                <input value="" onkeyup="verificarDatos('mpx')" type="number" name="ingresar_mpx_camara" class="form-control" id="ingresar_mpx_camara" placeholder="Megapixeles cámara. Ej.: 12.20" max="100" step="0.01">
              </div>
            </div>

            <div class="col-12 col-md-6 ml-auto divCampos" id="divPrecio">
              <label for="ingresar_precio" class="col-12 col-form-label font-weight-bold">Precio:</label>
              <div class="col-12">
                <input value="" onkeyup="verificarDatos('precio')" type="number" name="ingresar_precio" class="form-control" id="ingresar_precio" placeholder="Posible precio de venta. Ej.: 320.50" min="1" step="0.01" max="3000">
              </div>
            </div>

            <div class="col-12 col-md-6 mr-auto divCampos" id="divPulgadas">
              <label for="ingresar_pulgadas" class="col-12 col-form-label font-weight-bold">Pulgadas de pantalla:</label>
              <div class="col-12">
                <input value="" onkeyup="verificarDatos('pulgadas')" type="number" name="ingresar_pulgadas" class="form-control" id="ingresar_pulgadas" placeholder="Tamaño pantalla en pulgadas. Ej.: 5.22" max="16" step="0.01">
              </div>
            </div>

            <div class="col-12 col-md-6 ml-auto divCampos" id="divColor">
              <label for="ingresar_color" class="col-12 col-form-label font-weight-bold">Color producto:</label>
              <div class="col-10 m-auto">
                <input value="" type="color" name="ingresar_color" class="form-control" id="ingresar_color" placeholder="Color del dispositivo">
              </div>
            </div>

            <div class="col-12 col-md-6 mr-auto divCampos" id="divEstado">
              <label for="ingresar_estado" class="col-12 col-form-label font-weight-bold">Estado del producto:</label>
              <div class="col-12">
                <select id="select_ingresar_estado" class="form-control" name="estado">
                  <option value="" disabled selected>Seleccione el estado del dispositivo</option>
                  <!-- Se cargan en Body -->
                </select>
              </div>
            </div>

            <div class="col-12 col-md-6 ml-auto divCampos" id="divVenta">
              <label for="en_venta" class="col-12 col-form-label font-weight-bold">Producto en venta:</label>
              <div class="col-12">
                <input value="" type="checkbox" name="en_venta" class="form-control" id="en_venta" placeholder="¿Quiere vender el producto?">
              </div>
            </div>
            <div class="col-12 col-md-6 mr-auto divCampos" id="divBoton">
              <br>
                <button type="button" onclick="comprobarCampos()" class="btn btn-dark btn-block">Subir producto</button>
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
