<?php
require_once "Vuelo.php";
/*
 * Acceso a datos con BD y Patrón Singleton
 */
class AccesoDatos {
    
    private static $modelo = null;
    private $dbh = null;
    private $stmt = null;
    
    public static function initModelo(){
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }
    
    
    private function __construct(){
        // Cambiar le password !!!!!
        try {
            $dsn = "mysql:host=localhost;dbname=VuelosDB;charset=utf8";
            $this->dbh = new PDO($dsn, "root", "");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }
          
    }

     // Evito que se pueda clonar el objeto.
    public function __clone()
    { 
        trigger_error('La clonación no permitida', E_USER_ERROR); 
    }

    public function hayVuelo (string $destino): bool{
        $resu = false;
        $stmt = $this->dbh->prepare("Select * from Vuelos where destino = :destino limit 1");
        $stmt->bindValue(":destino", $destino);
        $stmt->setFetchMode(PDO::FETCH_CLASS,"Vuelo");
        if($stmt->execute()){
            if($stmt->fetch()){
                $resu = true;
            }
        }
        return $resu;
    }

    // ACTUALIZO EL COOKIE
   /* $nconsultas = 0;
    if (isset($_COOKIE['consultas'])){
        $nconsultas = $_COOKIE['consultas'];
    }
    $nconsultas++;
    setcookie();*/

    public function getVuelos (string $destino, int $plazas):array {
        $tresu = [];
        $stmt = $this->dbh->prepare("Select * from Vuelos where destino = :destino and asientos_libres >= :plazas");
        $stmt->bindValue(":destino", $destino);
        $stmt->bindValue(":plazas", $plazas);
        $stmt->setFetchMode(PDO::FETCH_CLASS,"Vuelo");
        if($stmt->execute()){
            $tresu = $stmt->fetchAll();
        }
        return $tresu;
    }



  
}

