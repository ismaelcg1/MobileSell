// Propiedades
Usuario.prototype.nombre = null;
Usuario.prototype.apellidos = null;
Usuario.prototype.fecha_nacimiento = null;
Usuario.prototype.email = null;
Usuario.prototype.password = null;
Usuario.prototype.ciudad = null;

// Constructores

function Usuario() {
}

function Usuario(nombre, apellidos, fecha_nacimiento, email, password, ciudad){
  this.nombre = nombre;
  this.apellidos = apellidos;
  this.fecha_nacimiento = fecha_nacimiento;
  this.email = email;
  this.password = password;
  this.ciudad = ciudad;
}

// Métodos

Usuario.prototype.setNombre = function (nombre) {
  this.nombre = nombre;
}
Usuario.prototype.getNombre = function () {
  return this.nombre;
}

Usuario.prototype.setApellidos = function (apellidos) {
  this.apellidos = apellidos;
}
Usuario.prototype.getApellidos = function () {
  return this.apellidos;
}

Usuario.prototype.setFechaNacimiento = function (fecha_nacimiento) {
  this.fecha_nacimiento = fecha_nacimiento;
}
Usuario.prototype.getFechaNacimiento = function () {
  return this.fecha_nacimiento;
}

Usuario.prototype.setEmail = function (email) {
  this.email = email;
}
Usuario.prototype.getEmail = function () {
  return this.email;
}

Usuario.prototype.setPassword = function (password) {
  this.password = password;
}
Usuario.prototype.getPassword = function () {
  return this.password;
}

Usuario.prototype.setCiudad = function (ciudad) {
  this.ciudad = ciudad;
}
Usuario.prototype.getCiudad = function () {
  return this.ciudad;
}

// Método toString
Usuario.prototype.toString = function usuarioToString() {
  var salidaDatos = "Nombre: " + this.nombre;
  salidaDatos += "\nApellidos: " + this.apellidos;
  salidaDatos += "\nFecha nacimiento: " + this.fecha_nacimiento;
  salidaDatos += "\nEmail: " + this.email;
  salidaDatos += "\nPassword: " + this.password;
  salidaDatos += "\nCiudad: " + this.ciudad;
  return salidaDatos;
}
