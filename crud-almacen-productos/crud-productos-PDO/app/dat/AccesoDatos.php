<?php
include_once "app/dat/Productos.php";
include_once "app/config.php";

/*
 * Acceso a datos con BD Produsctos y Patrón Singleton 
 * Un único objeto para la clase
 * VERSION 1:  las sentencias precompiladas ser crean en cada función
 */
class AccesoDatos {
    
    private static $modelo = null;
    private $dbh = null;
    
    
    public static function getModelo(){
        // Si no existe lo crea el acceso de a la BD
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }
    
    

   // Constructor privado  Patron singleton, se accede por getModelo
   
    private function __construct(){
        
        try {
            $dsn = "mysql:host=".SERVER_DB.";dbname=".DATABASE.";charset=utf8";
            // Creo el objeto PDO estableciendo la conexión a la BD
            $this->dbh = new PDO($dsn,DB_PRODU,DB_PASSWD);
            // Si falla genera una excepción
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }   
    }

    // Cierro la conexión anulando todos los objectos relacioanado con la conexión PDO (stmt)
    public static function closeModelo(){
        if (self::$modelo != null){
            $obj = self::$modelo;
            $obj->dbh = null;     // Cierro la conexión
            self::$modelo = null; // Borro el objeto.
        }
    }


    // Devuelvo un array de objeto de Productos
    public function getProductos ():array {
        $tprodus = [];
        // Sobre la conexión PDO prepara la consulta;
        $stmt_productos  = $this->dbh->prepare("select * from Productos");
        // Los resultados se devuelven como objetos de la clase Usuarios
        $stmt_productos->setFetchMode(PDO::FETCH_CLASS, 'Productos');
        
        // Ejecuto la sentencias 
        if ( $stmt_productos->execute() ){
            //$tprodus = $stmt_productos->fetchAll();
            // Mientra $productos no sea false, sea un objeto
            while ( $productos = $stmt_productos->fetch()){
               // añado ese objeto a la tabla
               $tprodus[]= $productos;
            }
        }
        

        return $tprodus;
    }
    
    // Devuelvo un producto o false
    public function getProducto (String $codigo) {
        $producto = false;
        $stmt_producto   = $this->dbh->prepare("select * from Productos where codigo=:codigo");
        $stmt_producto->setFetchMode(PDO::FETCH_CLASS, 'Productos');
        $stmt_producto->bindParam(':codigo', $codigo);
        if ( $stmt_producto->execute() ){
             // Solo hay un objeto
             if ( $obj = $stmt_producto->fetch()){
                $producto= $obj;
            }
        }
        return $producto;
    }
    
    // UPDATE
    public function modProducto($producto):bool{
      
        $stmt_modprodu   = $this->dbh->prepare("update Productos set nombre=:nombre, stock=:stock, stock_min=:stock_min, precio=:precio where codigo=:codigo");
        $stmt_modprodu->bindValue(':codigo',$producto->codigo);
        $stmt_modprodu->bindValue(':nombre',$producto->nombre);
        $stmt_modprodu->bindValue(':stock',$producto->stock);
        $stmt_modprodu->bindValue(':stock_min',$producto->stock_min);
        $stmt_modprodu->bindValue(':precio',$producto->precio); 
        $stmt_modprodu->execute();
        // El número de filas modificadas debe ser 1
        $resu = ($stmt_modprodu->rowCount () == 1);
        return $resu;
    }

    //INSERT
    public function addProducto($producto):bool{
        $stmt_creaprodu  = $this->dbh->prepare("insert into Productos (codigo,nombre,stock,stock_min,precio) Values(?,?,?,?,?)");
        //$stmt_creaprodu->bindValue(1,$producto->codigo);
        $stmt_creaprodu->execute( [$producto->codigo, $producto->nombre, $producto->stock, $producto->stock_min, $producto->precio]);
        $resu = ($stmt_creaprodu->rowCount () == 1);
        return $resu;
    }

    //DELETE
    public function borrarProducto(String $nombre):bool {
        $stmt_borproducto = $this->dbh->prepare("delete from Productos where nombre =:nombre");
        $stmt_borproducto->bindValue(':nombre', $nombre);
        $stmt_borproducto->execute();
        $resu = ($stmt_borproducto->rowCount () == 1);
        return $resu;
    }   
    
     // Evito que se pueda clonar el objeto. (SINGLETON)
    public function __clone()
    { 
        trigger_error('La clonación no permitida', E_USER_ERROR); 
    }
}

