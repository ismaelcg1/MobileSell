CREATE TABLE IF NOT EXISTS usuarios (
    uid INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR (20) NOT NULL,
    apellidos VARCHAR (30) NOT NULL,
    f_nacimiento DATE NOT NULL,
    email VARCHAR (32) NOT NULL,
    contrasena VARCHAR (16) NOT NULL,
    localidad VARCHAR (25) NOT NULL,
    PRIMARY KEY(uid),
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
