function obtenerConsejo() {
  // Cogemos el párrafo donde queremos insertar el consejo
  var parrafoConsejo = document.getElementById("consejo");
  // Creamos un array con los consejos
  var consejos = [
    [1, "No se puede comparar la RAM de un dispotivo iOS, con la de un dispositivo Android, pues llevan sistemas operativos diferentes."],
    [2, "Una cámara con mayor número de megapixeles no significa que haga mejores fotos. Mejoraría la resolución (tamaño imagen) no la calidad de las fotos."],
    [3, "Cuanta más RAM tenga un dispotivo podremos utilizar más aplicaciones a la vez, sin que por ello se vea afectado el rendimiento del dispositivo."],
    [4, "Una pantalla con mayor resolución se verá mejor, pero hay que tener en cuenta el tamaño del dispotivo pues ofrecerá ppp (pixeles por pulgada) diferentes."],
    [5, "La batería se mide en miliamperios por hora (mAh), pero un mayor número no tiene porque indicar mayor duración, tenemos que tener en cuenta la optimización global, tamaño de pantalla, resolución..."],
    [6, "Debemos tener en cuenta el tipo de conector que lleva nuestro dispositvo, en móviles Android, USB tipo C sería el más moderno y soporta velocidades mayores."],
    [7, "Si somos un poco despistados y siempre tenemos el móvil bajo de batería o simplemente no tenemos tiempo, debemos valorar que tenga carga rápida. Hay dispositivos que en 30 minutos cargan hasta un 50%."],
    [8, "¿Sueles llevarte el móvil a la playa, la piscina o la ducha? Observa que tenga certificado de resistencia al agua, te ahorra más de un disgusto."],
    [9, "Antes de comprar un iPhone asegurate de que no está bloqueado por iCloud, puede que sea un móvil perdido o robado."]
  ];

  // Creamos un número aleatorio que nos dará un consejo entre 0 y 9
  var numAl = Math.floor((Math.random() * 9) + 0)

  var muestraConsejo = document.createTextNode(consejos[numAl][1]);
  /* Para que no se desborde el texto, debemos colocar está propiedad CSS word-wrap: break-word;*/
  parrafoConsejo.appendChild(muestraConsejo);


}
