function permitirModificar(campo) {
  var campoElegido;
  var botonGuardar = document.getElementById("btnGuardarCambios");
  switch (campo) {
    case 1:
      campoElegido = document.getElementById("nombre");
      activarCampoFocoBtnGuardar(campoElegido);
    break;
    case 2:
      campoElegido = document.getElementById("apellidos");
      activarCampoFocoBtnGuardar(campoElegido);
    break;
    case 3:
      campoElegido = document.getElementById("fecha_nacimiento");
      activarCampoFocoBtnGuardar(campoElegido);
    break;
    case 4:
      campoElegido = document.getElementById("email");
      activarCampoFocoBtnGuardar(campoElegido);
    break;
    case 5:
      campoElegido = document.getElementById("select_ingresar_ciudad");
      activarCampoFocoBtnGuardar(campoElegido);
    break;
    default: // Por defecto
    break;
  }
}

function activarCampoFocoBtnGuardar (campoElegido) {
  campoElegido.disabled = false;
  campoElegido.focus();
  document.getElementById("btnGuardarCambios").disabled = false;
}

function comprobarDatos() {
  var nombre = document.getElementById("nombre").value;
  var apellidos = document.getElementById("apellidos").value;
  var fechaNacimiento = document.getElementById("fecha_nacimiento").value;
  var correo = document.getElementById("email").value;
  var ciudad = document.getElementById("select_ingresar_ciudad").value;
  // Definimos los div para mostrar un mensaje de aviso
  var mensajeCamposVacios = document.getElementById("camposVacios");
  var nombreIncorrecto = document.getElementById("nombreIncorrecto");
  var apellidosIncorrectos = document.getElementById("apellidosIncorrectos");
  var fechaNIncorrecta = document.getElementById("fechaIncorrecta");
  var correoEIncorrecto = document.getElementById("correoIncorrecto");

  // Quitamos todos los mensajes para que no haya fallos y se 'solapen' mensajes
  quitarMensajes(mensajeCamposVacios, nombreIncorrecto, apellidosIncorrectos,
      fechaNIncorrecta, correoEIncorrecto);

  if (comprobarTextoVacio(nombre) || comprobarTextoVacio(apellidos) || comprobarTextoVacio(fechaNacimiento) ||
      comprobarTextoVacio(correo) || comprobarTextoVacio(ciudad)) {
      // Mostramos que hay campos vacios
      mensajeCamposVacios.style.display = "block";
  } else {

      if (!comprobarNombre(nombre)) {
          nombreIncorrecto.style.display = "block";
      } else {

          if (!comprobarNombre(apellidos)) {
              apellidosIncorrectos.style.display = "block";
          } else {

              if (fechaNacimiento.length > 10) {
                  fechaNIncorrecta.style.display = "block";
              } else {

                  if (!comprobarEmail(correo)) {
                      correoEIncorrecto.style.display = "block";
                  } else {
                    // Antes de nada para que coja los datos del usuario quitamos el disable a todos los campos
                    document.getElementById("nombre").disabled = false;
                    document.getElementById("apellidos").disabled = false;
                    document.getElementById("fecha_nacimiento").disabled = false;
                    document.getElementById("email").disabled = false;
                    document.getElementById("select_ingresar_ciudad").disabled = false;
                    // Tenemos que quitar el disabled también al option sino
                    //no se cogerá posteriormente este campo
                    document.getElementById("optionCiudad").disabled = false;

                    // Enviamos los datos del 'formulario'
                    var datosUsuario = document.forms['datosUsuario'];
                    if (!datosUsuario) {
                      datosUsuario = document.formularioInicial;
                    }
                    datosUsuario.submit();

                  }
              }
          }
      }
  }
}

function comprobarTextoVacio(texto) {
    var vacio = false;
    if (texto === "") { // Sería como isEmpty en Java
        vacio = true;
    } else {
        vacio = false;
    }
    return vacio;
}

function comprobarEmail(email) {
  var emailCorrecto = false;
  // Validamos que el email tenga un formato correcto
  var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

  if (regex.test(email) && email.length < 32){
      emailCorrecto = true;
  } else {
    emailCorrecto = false;
  }
    return emailCorrecto;
}

function quitarMensajes(m1, m2, m3, m4, m5) {
  m1.style.display = "none";
  m2.style.display = "none";
  m3.style.display = "none";
  m4.style.display = "none";
  m5.style.display = "none";
}
