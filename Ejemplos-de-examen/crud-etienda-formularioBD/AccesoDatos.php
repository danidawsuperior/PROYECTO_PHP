<?php
require_once "Cliente.php";
require_once "Pedido.php";
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
            $dsn = "mysql:host=localhost;dbname=etienda;charset=utf8";
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

    public function hayCliente (string $nombre_cliente, string $clave_cliente){
        $resu = null;
        $stmt = $this->dbh->prepare("select * from clientes where nombre =:nombre_cliente and clave =:clave_cliente ");
        $stmt->bindValue(":nombre_cliente",$nombre_cliente);
        $stmt->bindValue(":clave_cliente",$clave_cliente);
    
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Cliente');
        if ( $stmt->execute()) {
            $resu = $stmt->fetch();
        }
        return $resu;
    }

    public function getPedidos(string $codigo_cliente):array{
        $resu = [];
        $stmt = $this->dbh->prepare("select * from pedidos where cod_cliente =:codigo_cliente");
        $stmt->bindValue(":codigo_cliente",$codigo_cliente);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Pedido');
        if ( $stmt->execute()) {
            $resu = $stmt->fetchAll();    
        }
        return $resu;  
    }

    public function incrementarVeces(int $codigo){
        $stmt = $this -> dbh ->prepare("update clientes set veces = veces + 1 where cod_cliente =:codigo");
        $stmt -> bindValue(":codigo",$codigo);
        $stmt -> execute();
    }


  
}

