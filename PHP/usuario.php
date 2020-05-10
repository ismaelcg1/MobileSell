<?php
  class Usuario {
    private $password;
    private $email;
    private $uid;
    private $nombre;
    private $apellidos;
    private $fecha_nacimiento;
    private $ciudad;

    public function __construct($email, $password, $uid, $nombre, $apellidos,
                                $fecha_nacimiento, $ciudad) {
      $this->email = $email;
      $this->password = $password;
      $this->uid = $uid;
      $this->nombre = $nombre;
      $this->apellidos = $apellidos;
      $this->fecha_nacimiento = $fecha_nacimiento;
      $this->ciudad = $ciudad;
    }
    public function get_email(){
      return $this->email;
    }
    public function get_password(){
      return $this->password;
    }
    public function get_uid(){
      return $this->uid;
    }
    public function get_nombre(){
      return $this->nombre;
    }
    public function get_apellidos(){
      return $this->apellidos;
    }
    public function get_fecha_nacimiento(){
      return $this->fecha_nacimiento;
    }
    public function get_ciudad(){
      return $this->ciudad;
    }

  }


?>
