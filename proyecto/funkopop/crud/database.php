<?php

class Database{
    private $con;
    private $dbhost="localhost";
    private $dbuser="root";
    private $dbpass="";
    private $dbname="tuto_poo";
    
	//__construct(): Constructor de la clase que llama al método connect_db() para establecer una conexión con la base de datos.
    function __construct(){
        $this->connect_db();
    }
    
	//connect_db(): Establece la conexión con la base de datos utilizando las credenciales definidas en las propiedades de la clase.
    public function connect_db(){
        $this->con = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
        if(mysqli_connect_error()){
            die("Conexión a la base de datos falló " . mysqli_connect_error() . mysqli_connect_errno());
        }
    }
    
	//sanitize($var): Recibe una variable como parámetro y la sanitiza utilizando mysqli_real_escape_string() para evitar posibles ataques de inyección SQL.
    //La función mysqli_real_escape_string() es una función de la extensión mysqli de PHP que se utiliza para escapar los caracteres especiales en una cadena de texto antes de insertarla en una consulta SQL. 
	public function sanitize($var){
        $return = mysqli_real_escape_string($this->con, $var);
        return $return;
    }
    
	//create($nombre, $stock, $precio, $descripcion, $img): Inserta un nuevo registro en la tabla "productos" con los valores proporcionados. Retorna true si la operación fue exitosa, de lo contrario, retorna false.
    public function create($nombre,$stock,$precio,$descripcion,$img){
        $sql = "INSERT INTO `productos` (nombre, stock, precio, descripcion, img) VALUES ('$nombre', '$stock', '$precio', '$descripcion', '$img')";
        $res = mysqli_query($this->con, $sql);
        if($res){
            return true;
        }else{
            return false;
        }
    }
    
	//read(): Realiza una consulta a la tabla "productos" para obtener todos los registros. Retorna el resultado de la consulta.
    public function read(){
        $sql = "SELECT * FROM productos";
        $res = mysqli_query($this->con, $sql);
        return $res;
    }
    
	//readLimited($start, $itemsPerPage): Realiza una consulta a la tabla "productos" con una limitación en el número de registros a obtener. Los parámetros $start y $itemsPerPage definen el rango de registros a seleccionar. Retorna el resultado de la consulta.
    public function readLimited($start, $itemsPerPage){
        $sql = "SELECT * FROM productos LIMIT $start, $itemsPerPage";
        $res = mysqli_query($this->con, $sql);
        return $res;
    }
    
	//single_record($id): Obtiene un único registro de la tabla "productos" basado en el ID proporcionado. Retorna el registro como un objeto.
    public function single_record($id){
        $sql = "SELECT * FROM productos WHERE id='$id'";
        $res = mysqli_query($this->con, $sql);
        $return = mysqli_fetch_object($res);
        return $return;
    }
    
	//update($nombre, $stock, $precio, $descripcion, $img, $id): Actualiza un registro existente en la tabla "productos" con los valores proporcionados. Retorna true si la operación fue exitosa, de lo contrario, retorna false.
    public function update($nombre,$stock,$precio,$descripcion,$img, $id){
        $sql = "UPDATE productos SET nombre='$nombre', stock='$stock', precio='$precio', descripcion='$descripcion', img='$img' WHERE id=$id";
        $res = mysqli_query($this->con, $sql);
        if($res){
            return true;
        }else{
            return false;
        }
    }
    
	//delete($id): Elimina un registro de la tabla "productos" basado en el ID proporcionado. Retorna true si la operación fue exitosa, de lo contrario, retorna false.
    public function delete($id){
        $sql = "DELETE FROM productos WHERE id=$id";
        $res = mysqli_query($this->con, $sql);
        if($res){
            return true;
        }else{
            return false;
        }
    }
}

?>

