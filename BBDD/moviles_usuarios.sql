CREATE TABLE IF NOT EXISTS moviles_usuarios (
    id_usuario INT NOT NULL,
    imei_movil INT NOT NULL,
    en_venta BOOLEAN NOT NULL DEFAULT 0,
    PRIMARY KEY (id_usuario, imei_movil),
    FOREIGN KEY (id_usuario) REFERENCES usuarios (uid),
    FOREIGN KEY (imei_movil) REFERENCES moviles (imei)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
