<?php

class Vuelo {
    private string $cod_vuelo;
    private string $destino;
    private string $aerolinea;
    private int $clase;
    private float $precio_billete;
    private int $asientos_libres;

    public function __get(string $name) {
        if (property_exists($this,$name)){
            return $this->$name;
        } else {
            return "Atributo ERROR";
        }
    }

    public function __set(string $name, $value){
        if(property_exists($this,$name)){
            $this->$name = $value;
        }
    }
}
