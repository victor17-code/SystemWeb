<?php

class Proveedor {

    private $idProveedor;
    private $codigProveedor;
    private $nombres;
    private $numDni;
    private $estado;
    private $telefono;
    private $nombreUsuario;
    private $password;
    private $numRuc;
    private $sector;
    private $accionista;

    function getIdProveedor() {
        return $this->idProveedor;
    }

    function getCodigProveedor() {
        return $this->codigProveedor;
    }

    function getNombres() {
        return $this->nombres;
    }

    function getNumDni() {
        return $this->numDni;
    }

    function getEstado() {
        return $this->estado;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getNombreUsuario() {
        return $this->nombreUsuario;
    }

    function getPassword() {
        return $this->password;
    }

    function setIdProveedor($idProveedor): void {
        $this->idProveedor = $idProveedor;
    }

    function setCodigProveedor($codigProveedor): void {
        $this->codigProveedor = $codigProveedor;
    }

    function setNombres($nombres): void {
        $this->nombres = $nombres;
    }

    function setNumDni($numDni): void {
        $this->numDni = $numDni;
    }

    function setEstado($estado): void {
        $this->estado = $estado;
    }

    function setTelefono($telefono): void {
        $this->telefono = $telefono;
    }

    function setNombreUsuario($nombreUsuario): void {
        $this->nombreUsuario = $nombreUsuario;
    }

    function setPassword($password): void {
        $this->password = $password;
    }

    function getNumRuc() {
        return $this->numRuc;
    }

    function getSector() {
        return $this->sector;
    }

    function getAccionista() {
        return $this->accionista;
    }

    function setNumRuc($numRuc): void {
        $this->numRuc = $numRuc;
    }

    function setSector($sector): void {
        $this->sector = $sector;
    }

    function setAccionista($accionista): void {
        $this->accionista = $accionista;
    }

    public function ValidarUsuario() {
        include '../bd/Conexion-Sql-Server.php';
        $conexion = new PDO("sqlsrv:server=DESKTOP-2CQJBIO\SQLEXPRESS;database=Bs_ADMIN", "", "");
        try {
            $result = $conexion->prepare('SELECT idproveedor, codigopro, nombres, numdni, estado, telefono, nom_usuario, password, numruc, direccion, accionista '
                    . ' FROM proveedor_fruto '
                    . ' where nom_usuario=:nombre'
                    . ' AND password=:password');
            $result->bindParam(":nombre", $this->nombreUsuario);
            $result->bindParam(":password", $this->password);
            $result->execute();
            $usu = $result->fetch(PDO::FETCH_ASSOC);
            $this->setNombres($usu['nombres']);
            $this->setNombreUsuario($usu['nom_usuario']);
            $this->setIdProveedor($usu["idproveedor"]);
            $this->setNumDni($usu["numdni"]);
            $this->setNumRuc($usu["numruc"]);
            $this->setSector($usu["direccion"]);
            $this->setAccionista($usu["accionista"]);
            $this->setTelefono($usu["telefono"]);
            return $result->rowcount();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function UpdateProveedorFruto() {
        $serverName = "DESKTOP-2CQJBIO\SQLEXPRESS";
        $connectionInfo = array("Database" => "Bs_ADMIN", "UID" => "", "PWD" => "");
        $conn = sqlsrv_connect($serverName, $connectionInfo);
        $sql = "UPDATE proveedor_fruto SET telefono=(?), nom_usuario=(?) where idproveedor=(?)";
        $params = array($this->telefono, $this->nombreUsuario, $this->idProveedor);
        $stmt = sqlsrv_query($conn, $sql, $params);
    }

    function mostrarUsuario($idProveedor) {
        require_once '../bd/Conexion-Sql-Server.php';
        $conexion = new PDO("sqlsrv:server=DESKTOP-2CQJBIO\SQLEXPRESS;database=Bs_ADMIN", "", "");
        $sql = "select * from proveedor_fruto where idproveedor= $idProveedor";
        return $conexion->query($sql);
    }
    
    public function cambiarPassword() {
        $serverName = "DESKTOP-2CQJBIO\SQLEXPRESS";
        $connectionInfo = array("Database" => "Bs_ADMIN", "UID" => "", "PWD" => "");
        $conn = sqlsrv_connect($serverName, $connectionInfo);
        $sql = "UPDATE proveedor_fruto SET password=(?)where idproveedor=(?)";
        $params = array($this->password,$this->idProveedor);
        $stmt = sqlsrv_query($conn, $sql, $params);
    }

}
