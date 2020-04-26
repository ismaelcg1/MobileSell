CREATE TABLE IF NOT EXISTS historiales_ventas (
    id_usuario_comprador INT NOT NULL,
    imei_movil INT NOT NULL,
    fecha_venta DATE NOT NULL,
    PRIMARY KEY (id_usuario_comprador, imei_movil),
    FOREIGN KEY (id_usuario_comprador) REFERENCES usuarios (uid),
    FOREIGN KEY (imei_movil) REFERENCES moviles (imei)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
