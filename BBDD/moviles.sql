CREATE TABLE IF NOT EXISTS moviles (
    imei INT NOT NULL AUTO_INCREMENT, /*DEBERÍA SER VARCHAR (15) PERO PARA AHORRAR A LA HORA DE CREACIÓN Y PRUEBAS*/
    marca VARCHAR (12) NOT NULL,
    modelo VARCHAR (25) NOT NULL,
    memoria_interna INT NOT NULL,
    bateria INT NOT NULL,
    ruta_foto VARCHAR(250) NOT NULL,
    ram INT NOT NULL,
    color VARCHAR(10) NOT NULL,
    camara_mpx FLOAT(4,2) NOT NULL,
    precio FLOAT(6,2) NOT NULL, /*EL PRECIO PODRÍA TENER 4 DÍGITOS ENTEROS Y 2 DECIMALES*/
    pantalla_pulgadas FLOAT(3,1) NOT NULL,
    estado_producto VARCHAR(15) NOT NULL, /*NUEVO, SEMINUEVO, SEGUNDA MANO, REACONDICIONADO */
    PRIMARY KEY (imei)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
