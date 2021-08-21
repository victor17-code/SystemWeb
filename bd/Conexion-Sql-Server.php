<?php

//$serverName = "DESKTOP-2CQJBIO\SQLEXPRESS";
//
//$connectionInfo = array("Database"=>"Bs_ADMIN");
//$conn = sqlsrv_connect($serverName, $connectionInfo);
//
//if($conn){
//    echo "connecion establecida";
//}else{
//    echo "conexion no se pudo establecer";
//    die(print_r( sqlsrv_errors(), true));
//}
//class ConexionDB{
//    private $dsn = "sqlsrv:server=DESKTOP-2CQJBIO\SQLEXPRESS;database=Bs_ADMIN";
//    private $user = "";   
//    private $password = "";
//    protected $conn = null;
//    
//    public function abrirConexion() {
//        try {
//            $this->$conn = new PDO($this->dsn,$this->user, $this->password);
//        } catch (PDOException $e) {
//            echo $e->getMessage();
//        }
//    }
//    
//    public function cerrarConexion() {
//        return $this->conn = null;
//    }
//}
//$conexion = new PDO("sqlsrv:server=DESKTOP-2CQJBIO\SQLEXPRESS;database=Bs_ADMIN", "", "");
//
//$consulta = $conexion->prepare("select * from proveedor_fruto");
//$consulta->execute();
//$datos=$consulta->fetchAll(PDO::FETCH_ASSOC);
//var_dump($datos);


//$serverName = "DESKTOP-2CQJBIO\SQLEXPRESS";
//$connectionInfo = array("Database" => "Bs_ADMIN", "UID" => "", "PWD" => "");
//$conn = sqlsrv_connect($serverName, $connectionInfo);
//$sql = "UPDATE proveedor_fruto SET telefono=(?), nom_usuario=(?) where idproveedor=(?)";
//$params = array('1234121', 'julia@hotmail.com', 504);
//$stmt = sqlsrv_query($conn, $sql, $params);
//if($stmt){echo 'registrado correctamente';}





