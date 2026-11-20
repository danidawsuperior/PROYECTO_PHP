<?php 
class Pedido {
   private int $numped;
   private int $cod_cliente;
   private String $producto;
   private float $precio;
   
   // Métodos mágicos para setter y getter
   
   public function __set(string  $nombre,$valor){
       $class = get_class($this);
       if ( property_exists($class, $nombre)){
           $this->$nombre = $valor; // Ojo $nombre
       }       
   }
   
   public function __get(string $nombre){
       $class = get_class($this);
       if ( property_exists($class, $nombre)){
           return  $this->$nombre;
       }
   }
   
}
