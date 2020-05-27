CREATE TABLE IF NOT EXISTS historiales_ventas_mensajes (
	id_mensaje INT NOT NULL AUTO_INCREMENT,
    id_usuario_comprador INT NOT NULL,
    id_usuario_vendedor INT NOT NULL,
    imei_movil INT NOT NULL,
    fecha_peticion DATE NOT NULL,
    mensaje_leido BOOLEAN NOT NULL,
    movil_vendido BOOLEAN NOT NULL,
    mensaje VARCHAR (400) NOT NULL,
    PRIMARY KEY (id_mensaje),
    FOREIGN KEY (id_usuario_comprador) REFERENCES usuarios (uid),
    FOREIGN KEY (id_usuario_vendedor) REFERENCES usuarios (uid),
    FOREIGN KEY (imei_movil) REFERENCES moviles (imei)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
