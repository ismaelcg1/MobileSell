function cargarMarcas() {
  var marcas = ['Samsung', 'Apple', 'Xiaomi', 'Huawei', 'Lenovo', 'LG', 'Google',
  'Sony', 'Nokia', 'Microsoft', 'Motorola', 'HTC', 'BlackBerry', 'Asus','ZTE',
  'Meizu', 'Lanix', 'Oppo'];
  marcas.sort();

  addOpciones("marcasSelect", marcas, "select_ingresar_marca");
}


function verificarDatos(datoRevisar) {
  switch (datoRevisar) {

    case 'modelo':
      var modelo = document.getElementById("ingresar_modelo").value;
      var mensajeModeloIncorrecto = document.getElementById('modeloIncorrecto');
      if (verificarModelo(modelo)) {
        mensajeModeloIncorrecto.style.display = "none";
      } else {
        mensajeModeloIncorrecto.style.display = "block";
      }
      break;

    case 'memoria_interna':
      var memoriaInterna = document.getElementById("ingresar_memoria_interna").value;
      var mensajeMemoriaInternaIncorrecta = document.getElementById('memoriaInternaIncorrecta');
      if (verificarMemoriaInterna(memoriaInterna)) {
        mensajeMemoriaInternaIncorrecta.style.display = "none";
      } else {
        mensajeMemoriaInternaIncorrecta.style.display = "block";
      }
      break;

    case 'bateria':
        var bateria = document.getElementById("ingresar_bateria").value;
        var mensajeBateriaIncorrecta = document.getElementById('bateriaIncorrecta');
        if (verificarBateria(bateria)) {
          mensajeBateriaIncorrecta.style.display = "none";
        } else {
          mensajeBateriaIncorrecta.style.display = "block";
        }
        break;

    case 'ram':
        var ram = document.getElementById("ingresar_ram").value;
        var mensajeRamIncorrecta = document.getElementById('ramIncorrecta');
        if (verificarRam(ram)) {
          mensajeRamIncorrecta.style.display = "none";
        } else {
          mensajeRamIncorrecta.style.display = "block";
        }
        break;

    case 'mpx':
          var mpx = document.getElementById("ingresar_mpx_camara").value;
          var mensajeMpxIncorrecta = document.getElementById('mpxCamaraIncorrectos');
          if (verificarMegaPixelesCamara(mpx)) {
            mensajeMpxIncorrecta.style.display = "none";
          } else {
            mensajeMpxIncorrecta.style.display = "block";
          }
          break;

    case 'precio':
            var precio = document.getElementById("ingresar_precio").value;
            var mensajePrecioIncorrecto = document.getElementById('precioIncorrecto');
            if (verificarPrecio(precio)) {
              mensajePrecioIncorrecto.style.display = "none";
            } else {
              mensajePrecioIncorrecto.style.display = "block";
            }
            break;

      case 'pulgadas':
              var pulgadas = document.getElementById("ingresar_pulgadas").value;
              var mensajePulgadasIncorrectas = document.getElementById('pulgadasIncorrectas');
              if (verificarPulgadasPantalla(pulgadas)) {
                mensajePulgadasIncorrectas.style.display = "none";
              } else {
                mensajePulgadasIncorrectas.style.display = "block";
              }
              break;

      default:
          // Por defecto
          break;
  }
}


function verificarModelo(modelo) {
  var modeloCorrecto = false;
  var formatoModelo = /^[A-Za-z0-9\s]+$/; // Valida letras, números y espacios en blanco

  if (formatoModelo.test(modelo)) {
    modeloCorrecto = true;
  }
  return modeloCorrecto;
}


function verificarMemoriaInterna(memoriaInterna) {
  var memoriaCorrecta = false;
  var formatoMemoriaInterna = /^[0-9]{1,4}$/;
  var memoriaFloat = parseFloat(memoriaInterna);

  if (formatoMemoriaInterna.test(memoriaInterna)) {
    memoriaCorrecta = true;
  }
  if (memoriaFloat > 1024) {
    memoriaCorrecta = false;
  }
  return memoriaCorrecta;
}


function verificarBateria(bateria) {
  var bateriaCorrecta = false;
  var formatoBateria = /^[0-9]{2,5}$/;
  var bateriaFloat = parseFloat(bateria);

  if (formatoBateria.test(bateria)) {
    bateriaCorrecta = true;
  }
  if (bateriaFloat > 50000) {
    bateriaCorrecta = false;
  }
  return bateriaCorrecta;
}


function verificarRam(ram) {
  var ramCorrecta = false;
  var formatoRam = /^[1-9]{1,3}$/;
  var ramFloat = parseFloat(ram);

  if (formatoRam.test(ram)) {
    ramCorrecta = true;
  }
  if (ramFloat > 64) {
    ramCorrecta = false;
  }
  return ramCorrecta;
}


function verificarMegaPixelesCamara(mpx) {
  var mpxCamaraCorrectos = false;
  var formatoMpxCamara = /^[0-9]{1,3}([,.][0-9]{0,2})?$/;
  var mpxFloat = parseFloat(mpx);

  if (formatoMpxCamara.test(mpx)) {
    mpxCamaraCorrectos = true;
  }
  if (mpxFloat > 64) {
    mpxCamaraCorrectos = false;
  }
  return mpxCamaraCorrectos;
}


function verificarPrecio(precio) {
  var precioCorrecto = false;
  var formatoPrecio = /^[0-9]{1,4}([,.][0-9]{0,2})?$/;
  var precioFloat = parseFloat(precio);

  if (formatoPrecio.test(precio)) {
    precioCorrecto = true;
  }
  if (precioFloat > 3000) {
    precioCorrecto = false;
  }
  return precioCorrecto;
}


function verificarPulgadasPantalla(pulgadas){
  var pulgadasCorrectas = false;
  var formatoPulgadas = /^[0-9]{1,2}([,.][0-9]{0,2})?$/;
  var pulgadasFloat = parseFloat(pulgadas);

  if (formatoPulgadas.test(pulgadas)) {
    pulgadasCorrectas = true;
  }
  if (pulgadasFloat > 16) {
    pulgadasCorrectas = false;
  }
  return pulgadasCorrectas;
}


function cargarEstadoProducto() {
  var estados = ['Nuevo', 'Seminuevo', 'Segunda mano', 'Reacondicionado'];
  estados.sort();

  addOpciones("estadoProductoSelect", estados, "select_ingresar_estado");
}

// Agregamos las opciones al select
function addOpciones(domElement, arrayInsercion, idSelect) {
  var select = document.getElementById(idSelect);

  for (valor in arrayInsercion) {
    var option = document.createElement("option");
    option.text = arrayInsercion[valor];
    select.add(option);
  }
}


function comprobarCampos() {
  var marca = document.getElementById("select_ingresar_marca").value;
  var modelo = document.getElementById("ingresar_modelo").value;
  var memoria_interna = document.getElementById("ingresar_memoria_interna").value;
  var bateria = document.getElementById("ingresar_bateria").value;
  var memoria_ram = document.getElementById("ingresar_ram").value;
  var mpx_camara = document.getElementById("ingresar_mpx_camara").value;
  var precio = document.getElementById("ingresar_precio").value;
  var pulgadas_pantalla = document.getElementById("ingresar_pulgadas").value;
  var color = document.getElementById("ingresar_color").value;
  var estado_producto = document.getElementById("select_ingresar_estado").value;
  var foto = document.getElementById("file-preview");

  var fotoNoSubida = document.getElementById('fotoVacia');
  var mensajeCamposVacios = document.getElementById('camposVacios');

  if (comprobarTextoVacio(marca) || comprobarTextoVacio(modelo) || comprobarTextoVacio(memoria_interna) ||
      comprobarTextoVacio(bateria) || comprobarTextoVacio(memoria_ram) || comprobarTextoVacio(mpx_camara) ||
      comprobarTextoVacio(precio) || comprobarTextoVacio(pulgadas_pantalla) || comprobarTextoVacio(color) ||
      comprobarTextoVacio(estado_producto)){
        // Mostramos que hay campos vacios
        mensajeCamposVacios.style.display = "block";
      } else if (noExisteFoto()) {
        mensajeCamposVacios.style.display = "none";
        fotoNoSubida.style.display = "block";
      } else {
        mensajeCamposVacios.style.display = "none";
        fotoNoSubida.style.display = "none";

        verficarCheckBox();
        // Enviamos los datos del formulario
        var formulario = document.forms['formularioAddMovil'];
        if (!formulario) {
          formulario = document.formularioAddMovil;
        }
        formulario.submit();
      }
}

// Aquí comprobamos si existe el ID de la foto (es decir, si se ha insertado).
function noExisteFoto() {
  if (typeof ( document.getElementById("file-preview") ) == undefined ||
      document.getElementById("file-preview")  == null) {
        return true;
   } else {
        return false;
   }
}

function verficarCheckBox() {
  var checkboxVenta = document.getElementById("venta");
  if (checkboxVenta.checked == true) {
    checkboxVenta.value = 1;
  } else {
    checkboxVenta.value = 0;    
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
