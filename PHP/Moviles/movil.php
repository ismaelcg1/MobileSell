<?php

  class Movil {
    private $imei;
    private $marca;
    private $modelo;
    private $memoria_interna;
    private $bateria;
    private $ram;
    private $color;
    private $camara_mpx;
    private $pantalla_pulgadas;
    private $estado_producto;
    private $precio;
    private $ruta_foto;

    public function __construct($imei, $marca, $modelo, $memoria_interna,
                    $bateria, $ram, $color, $camara_mpx, $pantalla_pulgadas,
                    $estado_producto, $precio, $ruta_foto) {

        $this->imei = $imei;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->memoria_interna = $memoria_interna;
        $this->bateria = $bateria;
        $this->ram = $ram;
        $this->color = $color;
        $this->camara_mpx = $camara_mpx;
        $this->pantalla_pulgadas = $pantalla_pulgadas;
        $this->estado_producto = $estado_producto;
        $this->precio = $precio;
        $this->ruta_foto = $ruta_foto;
    }

    public function get_imei(){
      return $this->imei;
    }
    public function get_marca(){
      return $this->marca;
    }
    public function get_modelo(){
      return $this->modelo;
    }
    public function get_memoria_interna(){
      return $this->memoria_interna;
    }
    public function get_bateria(){
      return $this->bateria;
    }
    public function get_ram(){
      return $this->ram;
    }
    public function get_color(){
      return $this->color;
    }
    public function get_camara_mpx(){
      return $this->camara_mpx;
    }
    public function get_pantalla_pulgadas(){
      return $this->pantalla_pulgadas;
    }
    public function get_estado_producto(){
      return $this->estado_producto;
    }
    public function get_precio(){
      return $this->precio;
    }
    public function get_ruta_foto(){
      return $this->ruta_foto;
    }
  }



?>
