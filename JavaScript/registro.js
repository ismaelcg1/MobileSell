function comprobarDatosIntroducidos() {
  var todosDatosCorrectos = false;
  // Guardamos los datos introducidos en los input...
  var nombre = document.getElementById("ingresar_nombre").value;
  var apellidos = document.getElementById("ingresar_apellidos").value;
  var fechaNacimiento = document.getElementById("ingresar_fecha_nacimiento").value;
  var correo = document.getElementById("ingresar_email").value;
  var password = document.getElementById("ingresar_password").value;
  var passwordRepetida = document.getElementById("ingresar_password2").value;
  var ciudad = document.getElementById("select_ingresar_ciudad").value;
  var terminos_condiciones = document.getElementById("checkbox_terminos_condiciones");
  var usuarioCreado;
  // Definimos los div para mostrar un mensaje de aviso
  var mensajeCamposVacios = document.getElementById("camposVacios");
  var longitudNombreIncorrecta = document.getElementById("nombreIncorrecto");
  var longitudApellidosIncorrecta = document.getElementById("apellidosIncorrectos");
  var fechaNIncorrecta = document.getElementById("fechaIncorrecta");
  var longitudCorreoIncorrecta = document.getElementById("logintudCorreoIncorrecta");
  var correoEIncorrecto = document.getElementById("correoIncorrecto");
  var longitudDePasswordIncorrecta = document.getElementById("longitudPasswordIncorrecta");
  var passwordNoCoincidentes = document.getElementById("PasswordDistintas");
  var passwordNoSeguras = document.getElementById("passwordInsegura");
  var terminosCondiciones = document.getElementById("terminosYCondiciones");

  // Quitamos todos los mensajes para que no haya fallos y se 'solapen' mensajes
  quitarTodosMensajes(mensajeCamposVacios, longitudNombreIncorrecta, longitudApellidosIncorrecta,
    fechaNIncorrecta, longitudCorreoIncorrecta, correoEIncorrecto, longitudDePasswordIncorrecta,
    passwordNoCoincidentes, passwordNoSeguras, terminosCondiciones);

  if (comprobarTextoVacio(nombre) || comprobarTextoVacio(apellidos) || comprobarTextoVacio(fechaNacimiento) ||
    comprobarTextoVacio(correo) || comprobarTextoVacio(password) || comprobarTextoVacio(passwordRepetida) ||
    comprobarTextoVacio(ciudad)) {
    // Mostramos que hay campos vacios
    mensajeCamposVacios.style.display = "block";
  } else {
    /* Ahora vamos a comprobar los campos en orden descendente, una vez se comprueba el campo superior
       y esta correcto, dentro del else del mismo campo hacemos la comprobación del siguiente y así sucesivamente
    */
    if (nombre.length > 20 || !comprobarNombre(nombre)) {
      longitudNombreIncorrecta.style.display = "block";
      document.getElementById("ingresar_nombre").style.borderColor = "red";
    } else {
      document.getElementById("ingresar_nombre").style.borderColor = "green";

      if (apellidos.length > 30 || !comprobarNombre(apellidos)) {
        longitudApellidosIncorrecta.style.display = "block";
        document.getElementById("ingresar_apellidos").style.borderColor = "red";
      } else {
        document.getElementById("ingresar_apellidos").style.borderColor = "green";

        if (fechaNacimiento.length > 10) {
          fechaNIncorrecta.style.display = "block";
          document.getElementById("ingresar_fecha_nacimiento").style.borderColor = "red";
        } else {
          document.getElementById("ingresar_fecha_nacimiento").style.borderColor = "green";

          if (correo.length > 32) {
            longitudCorreoIncorrecta.style.display = "block";
            document.getElementById("ingresar_email").style.borderColor = "red";
          } else if (!comprobarEmail(correo)) {
            correoIncorrecto.style.display = "block";
            document.getElementById("ingresar_email").style.borderColor = "red";
          } else {
            document.getElementById("ingresar_email").style.borderColor = "green";

            if (password.length > 16 || password.length < 8) {
              longitudDePasswordIncorrecta.style.display = "block";
              document.getElementById("ingresar_password").style.borderColor = "red";
              document.getElementById("ingresar_password2").style.borderColor = "red";
            } else if (password.localeCompare(passwordRepetida) != 0) {
              // Se comparan las contraseñas y si coinciden localeCompare dará 0
              passwordNoCoincidentes.style.display = "block";
              document.getElementById("ingresar_password").style.borderColor = "red";
              document.getElementById("ingresar_password2").style.borderColor = "red";
            } else if (!comprobarSeguridadPassword(password)) {
              passwordNoSeguras.style.display = "block";
              document.getElementById("ingresar_password").style.borderColor = "red";
              document.getElementById("ingresar_password2").style.borderColor = "red";
            } else {
              document.getElementById("ingresar_password").style.borderColor = "green";
              document.getElementById("ingresar_password2").style.borderColor = "green";

              if (!terminos_condiciones.checked) {
                terminosCondiciones.style.display = "block";

              } else {
                todosDatosCorrectos = true;
                usuarioCreado = new Usuario (nombre, apellidos, fechaNacimiento, correo, password, ciudad);

                // Enviamos los datos del formulario
                var formulario = document.forms['formularioInicial'];
                if (!formulario) {
                  formulario = document.formularioInicial;
                }
                formulario.submit();
              }
            }
          }
        }
      }
    }
  }

  if (todosDatosCorrectos) {
    alert("Todo correcto socio. Cambia el botón por tipo submit y andando...");
  }
}

function quitarTodosMensajes(m1, m2, m3, m4, m5, m6, m7, m8, m9, m10) {
  m1.style.display = "none";
  m2.style.display = "none";
  m3.style.display = "none";
  m4.style.display = "none";
  m5.style.display = "none";
  m6.style.display = "none";
  m7.style.display = "none";
  m8.style.display = "none";
  m9.style.display = "none";
  m10.style.display = "none";
}

function cargarProvincias() {
  var provincias = ['Alava', 'Albacete', 'Alicante', 'Almería', 'Asturias', 'Avila', 'Badajoz', 'Barcelona', 'Burgos', 'Cáceres', 'Cádiz', 'Cantabria', 'Castellón', 'Ciudad Real', 'Córdoba', 'La Coruña', 'Cuenca', 'Gerona', 'Granada', 'Guadalajara', 'Guipúzcoa', 'Huelva', 'Huesca', 'Islas Baleares', 'Jaén', 'León', 'Lérida', 'Lugo', 'Madrid', 'Málaga', 'Murcia', 'Navarra', 'Orense', 'Palencia', 'Las Palmas', 'Pontevedra', 'La Rioja', 'Salamanca', 'Segovia', 'Sevilla', 'Soria', 'Tarragona', 'Santa Cruz de Tenerife', 'Teruel', 'Toledo', 'Valencia', 'Valladolid', 'Vizcaya', 'Zamora', 'Zaragoza'];
  provincias.sort();

  addOpciones("provinciasSelect", provincias);
}

// Agregamos las opciones al select
function addOpciones(domElement, arrayProvincias) {
  var select = document.getElementById("select_ingresar_ciudad");

  for (valor in arrayProvincias) {
    var option = document.createElement("option");
    option.text = arrayProvincias[valor];
    select.add(option);
  }
}

function comprobarNombre(nombre) {
  var nombreCorrecto = false;
  var formatoNombre = /^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+$/;

  if (formatoNombre.test(nombre)) {
    nombreCorrecto = true;
  }
  return nombreCorrecto;
}

function comprobarSeguridadPassword(passwordIntroducida) {
  var passwordSegura = false;
  var formatoPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,16}/;

  if (formatoPassword.test(passwordIntroducida)) {
    passwordSegura = true;
  }
  return passwordSegura;
}

function cambiarBordesLimpiar() {
  document.getElementById("ingresar_nombre").style.borderColor = "grey";
  document.getElementById("ingresar_apellidos").style.borderColor = "grey";
  document.getElementById("ingresar_fecha_nacimiento").style.borderColor = "grey";
  document.getElementById("ingresar_email").style.borderColor = "grey";
  document.getElementById("ingresar_password").style.borderColor = "grey";
  document.getElementById("ingresar_password2").style.borderColor = "grey";
  document.getElementById("select_ingresar_ciudad").style.borderColor = "grey";
}
