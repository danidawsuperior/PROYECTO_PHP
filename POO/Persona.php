<?php

    class Persona {
        private int $edad;
        private string $nombre;

        function mensajeEdad (int $años):string{
            if($años < 18){
                return "Precio infantil";
            } else if($años < 30){
                return "Precio joven";
            } else {
                return "Precio adulto";
            }
        }

        function cumplirAños ():void {
            $this->edad++;
        }

        function __construct(int $edad, string $nombre)
        {
            $this->nombre = $nombre;
            $this->edad = $edad;
        }

        function __toString()
        {
            return $this->nombre."(".$this->edad.")";
        }

        function __get(string $atributo)
        {
            if ($atributo == "nombre"){
                //return "Anónimo";
                return $this->nombre;
            }
            if ($atributo == "edad"){
                return $this->edad -2;
            }
        }

        function __set(string $name, mixed $value)
        {
            if ($name == "edad" && $value < 100){
                $this->edad = $value;
            }
        }


    }


    $pepe = new Persona(25,"Pepe Luis");
    // Esto funciona para los atributos publicos
    //$pepe->nombre = "Pepe";
    $pepe->cumplirAños();
    //print_r($pepe);
    echo $pepe."\n";
    echo "Nombre es ".$pepe->nombre."\n";
    echo "Edad es " .$pepe->edad."\n";
    $pepe->nombre = "Manuel";
    $pepe->edad = 320;
    echo $pepe."\n";
    $pepe->edad = 56;
    echo $pepe."\n";



