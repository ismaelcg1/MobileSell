function comprobarTextAreaVacia () {
  var textoVacio = false;
  var texto_a_enviar = document.getElementById("mensaje");

  if (texto_a_enviar.value == '') {
    textoVacio = true;
    texto_a_enviar.style.borderColor = "red";
  } else {
    texto_a_enviar.style.borderColor = "green";
  }
  return textoVacio;
}

function enviarMensaje () {
  var texto_a_enviar = document.getElementById("mensaje");
  if (comprobarTextAreaVacia()) {
    alert("No se puede enviar un mensaje sin contenido. Por favor, agrege un mensaje.");
  } else if (texto_a_enviar.value.length > 400) {
      alert("No se puede enviar un mensaje con más de 200 caracteres.");
  } else {
    // Se enviaría el mensaje
    // Enviamos los datos del formulario
    var formulario = document.forms['formularioMensaje'];
    if (!formulario) {
      formulario = document.formularioMensaje;
    }
    formulario.submit();
  }
}
