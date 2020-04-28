function comprobarDatos() {
  var correcto = false;

  var email = document.getElementById("ingresar_email").value;
  var iconoWarning = document.getElementsByClassName("icono_warning");
  var mostrarMensaje = document.getElementById("emailVacio");

  if (comprobarTextoVacio(email)) {
    mostrarMensaje.style.display = "block";
    iconoWarning[0].style.visibility = "visible"; // OJO, con la clase va 0 (irá en un array seguramente)
    correcto = false;
    /* Ocultamos elementos del campo contraseña para que el usuario se centre en el email*/
    document.getElementById("passwordVacia").style.display = "none";
    document.getElementById("passwordLogitudIncorrecta").style.display = "none";
    document.getElementsByClassName("icono_warning")[1].style.visibility = "hidden";
  } else {
    mostrarMensaje.style.display = "none";
    iconoWarning[0].style.visibility = "hidden";
    correcto = true;
  }

  if (correcto) {
    comprobarPassword();
  }
}

function comprobarPassword() {
    var password = document.getElementById("ingresar_password").value;
    var mostrarMensaje2 = document.getElementById("passwordVacia");
    var mostrarMensaje3 = document.getElementById("passwordLogitudIncorrecta");
    var iconoWarning = document.getElementsByClassName("icono_warning");

    if (comprobarTextoVacio(password)) {
      mostrarMensaje2.style.display = "block";
      mostrarMensaje3.style.display = "none";
      iconoWarning[1].style.visibility = "visible"; // OJO, con la clase va 0 (irá en un array seguramente)
    } else if (password.length < 8 || password.length > 16) {
        mostrarMensaje2.style.display = "none";
        mostrarMensaje3.style.display = "block";
        iconoWarning[1].style.visibility = "visible";
    } else {
      mostrarMensaje2.style.display = "none";
      iconoWarning[1].style.visibility = "hidden";
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
