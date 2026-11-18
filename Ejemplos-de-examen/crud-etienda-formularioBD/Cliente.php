<?php 
class Cliente{

    private string $cod_cliente;
    private string $nombre;
    private string $clave;
    private int $veces;

    public function __get(string $name){
       if ( property_exists($this,$name)){
         return $this->$name;
       } else {
         return " ERROR ATRIBUTO ";
       }
   }

   public function __set($name, $value){
       if ( property_exists($this,$name)){
         $this->$name = $value;
       } else {
         throw new Exception(" SET error de atributo");
       }
   }

}