function cargarMarcas() {
  var marcas = ['Samsung', 'Apple', 'Xiaomi', 'Huawei', 'Lenovo', 'LG', 'Google',
  'Sony', 'Nokia', 'Microsoft', 'Motorola', 'HTC', 'BlackBerry', 'Asus','ZTE',
  'Meizu', 'Lanix', 'Oppo'];
  marcas.sort();

  addOpciones("marcasSelect", marcas, "select_ingresar_marca");
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

  if (formatoMemoriaInterna.test(memoriaInterna)) {
    memoriaCorrecta = true;
  }
  return memoriaCorrecta;
}

function verificarBateria(bateria) {
  var bateriaCorrecta = false;
  var formatoBateria = /^[1-9]{1}[0-9]{2,4}$/;

  if (formatoBateria.test(bateria)) {
    bateriaCorrecta = true;
  }
  return bateriaCorrecta;
}

function verificarRam(ram) {
  var ramCorrecta = false;
  var formatoRam = /^[1-9]{1,3}$/;

  if (formatoRam.test(ram)) {
    ramCorrecta = true;
  }
  return ramCorrecta;
}

function verificarMegaPixelesCamara(mpx) {
  var mpxCamaraCorrectos = false;
  var formatoMpxCamara = /^[0-9]{1,3}([,.][0-9]{0,1})?$/;

  if (formatoMpxCamara.test(mpx)) {
    mpxCamaraCorrectos = true;
  }
  return mpxCamaraCorrectos;
}

function verificarPrecio(precio) {
  var precioCorrecto = false;
  var formatoPrecio = /^[0-9]{1,4}([,.][0-9]{0,2})?$/;

  if (formatoPrecio.test(precio)) {
    precioCorrecto = true;
  }
  return precioCorrecto;
}

function verificarPulgadasPantalla(pulgadas){
  var pulgadasCorrectas = false;
  var formatoPulgadas = /^[0-9]{1,2}([,.][0-9]{0,1})?$/;

  if (formatoPulgadas.test(pulgadas)) {
    pulgadasCorrectas = true;
  }
  return pulgadasCorrectas;
}

/*
function verificarColor() {

}
*/
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

function comprobarCamposVacios() {

}
