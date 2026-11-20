<?php
require_once "Producto.php";


class AccesoDatos
{
    private static $modelo = null;
    private $dbh = null;
    private $stmt = null;

    public static function initModelo()
    {
        if (self::$modelo == null) {
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }


    private function __construct()
    {
        // Cambiar le password !!!!!
        try {
            $dsn = "mysql:host=localhost;dbname=almacendb;charset=utf8";
            $this->dbh = new PDO($dsn, "root", "");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error de conexión " . $e->getMessage();
            exit();
        }
    }

    // Evito que se pueda clonar el objeto.
    public function __clone()
    {
        trigger_error('La clonación no permitida', E_USER_ERROR);
    }

    public function getProductos():array{
        $resu = [];
        $stmt = $this->dbh->prepare("select * from productos where stock_disponible > 10");
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Producto');
        if ( $stmt->execute()) {
            $resu = $stmt->fetchAll();    
        }
        return $resu;  
    }

    public function actualizarPrecios(array $producto_no){
        $stmt = $this -> dbh -> prepare("update productos set precio_actual = precio_actual - (precio_actual * 0.1) where producto_no =:pro_no and stock_disponible > 10");
        
        foreach($producto_no as $pro_no){
            $stmt -> bindValue(":pro_no",$pro_no);
            $stmt -> execute();
        }
    }






}
