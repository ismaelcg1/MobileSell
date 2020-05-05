function comprobarDatos() {
  var correcto = false;

  var email = document.getElementById("ingresar_email").value;
  var iconoWarning = document.getElementsByClassName("icono_warning");
  var mostrarMensaje = document.getElementById("emailVacio");
  var mostrarEmailIncorrecto = document.getElementById("emailIncorrecto");

  if (comprobarTextoVacio(email)) {
    mostrarMensaje.style.display = "block";
    iconoWarning[0].style.visibility = "visible"; // OJO, con la clase va 0 (irá en un array seguramente)
    correcto = false;
    /* Ocultamos elementos del campo contraseña para que el usuario se centre en el email*/
    document.getElementById("passwordVacia").style.display = "none";
    document.getElementById("passwordLogitudIncorrecta").style.display = "none";
    document.getElementsByClassName("icono_warning")[1].style.visibility = "hidden";

  } else if (!comprobarEmail(email)){
    mostrarMensaje.style.display = "none";
    iconoWarning[0].style.visibility = "visible";
    mostrarEmailIncorrecto.style.display = "block";
    correcto = false;
    // Cambiamos color al input para que el usuario vea donde está el fallo
    document.getElementById("ingresar_email").style.borderColor = "red";
  } else {
    mostrarMensaje.style.display = "none";
    iconoWarning[0].style.visibility = "hidden";
    mostrarEmailIncorrecto.style.display = "none";
    correcto = true;
    document.getElementById("ingresar_email").style.borderColor = "green";
  }
    // Comprobamos la contraseña y depende de si el email esta bien o mal damos indicaciones o no al usuario sobre contraseña
    var passwordOK = comprobarPassword(correcto);
    if (passwordOK && correcto ) {
      // Si la contraseña es correcta se hace el submit
      // Enviamos los datos del formulario
      var formulario = document.forms['formularioInicial'];
      if (!formulario) {
        formulario = document.formularioInicial;
      }
      formulario.submit();
    }
}


function comprobarPassword(emailCorrecto) {
    var passwordCorrecta = false;

    var password = document.getElementById("ingresar_password").value;
    var mostrarMensaje2 = document.getElementById("passwordVacia");
    var mostrarMensaje3 = document.getElementById("passwordLogitudIncorrecta");
    var iconoWarning = document.getElementsByClassName("icono_warning");
    var mostrarPasswordIncorrecta = document.getElementById("passwordIncorrecta");

    if (!emailCorrecto) {
      // Mostramos icono indicando que algo está mal pero no indicando más nada pues quiero que primero se corrija el email
      mostrarMensaje2.style.display = "none";
      mostrarMensaje3.style.display = "none";
      mostrarPasswordIncorrecta.style.display = "none";
      document.getElementById("ingresar_email").style.borderColor = "red";
      if (comprobarTextoVacio(password)) {
          iconoWarning[1].style.visibility = "visible";
          document.getElementById("ingresar_password").style.borderColor = "red";
          passwordCorrecta = false;
      } else if (password.length < 8 || password.length > 16) {
          iconoWarning[1].style.visibility = "visible";
          document.getElementById("ingresar_password").style.borderColor = "red";
          passwordCorrecta = false;
      } else {
          iconoWarning[1].style.visibility = "hidden";
          passwordCorrecta = true;
      }
    } else {
      if (comprobarTextoVacio(password)) {
        mostrarMensaje2.style.display = "block";
        mostrarMensaje3.style.display = "none";
        mostrarPasswordIncorrecta.style.display = "none";
        iconoWarning[1].style.visibility = "visible"; // OJO, con la clase va número para identificar (irá en un array seguramente)
        document.getElementById("ingresar_password").style.borderColor = "red";
        passwordCorrecta = false;
      } else if (password.length < 8 || password.length > 16) {
          mostrarMensaje2.style.display = "none";
          mostrarMensaje3.style.display = "block";
          mostrarPasswordIncorrecta.style.display = "none";
          iconoWarning[1].style.visibility = "visible";
          document.getElementById("ingresar_password").style.borderColor = "red";
          passwordCorrecta = false;
      } else if (!comprobarSeguridadPassword(password)){
          iconoWarning[1].style.visibility = "visible";
          document.getElementById("ingresar_password").style.borderColor = "red";
          passwordCorrecta = false;
          mostrarMensaje2.style.display = "none";
          mostrarMensaje3.style.display = "none";
          mostrarPasswordIncorrecta.style.display = "block";
      } else {
        mostrarMensaje2.style.display = "none";
        mostrarMensaje3.style.display = "none";
        iconoWarning[1].style.visibility = "hidden";
        document.getElementById("ingresar_password").style.borderColor = "green";
        passwordCorrecta = true;
      }
    }
    return passwordCorrecta;
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

function comprobarSeguridadPassword(passwordIntroducida) {
  var passwordSegura = false;
  var formatoPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,16}/;

  if (formatoPassword.test(passwordIntroducida)) {
    passwordSegura = true;
  }
  return passwordSegura;
}
