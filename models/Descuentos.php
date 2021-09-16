<?php

class Descuentos {
    private $idDescuento;
    private $formaDescuento;
    private $montoDescontado;
    
    function getIdDescuento() {
        return $this->idDescuento;
    }

    function getFormaDescuento() {
        return $this->formaDescuento;
    }

    function getMontoDescontado() {
        return $this->montoDescontado;
    }

    function setIdDescuento($idDescuento): void {
        $this->idDescuento = $idDescuento;
    }

    function setFormaDescuento($formaDescuento): void {
        $this->formaDescuento = $formaDescuento;
    }

    function setMontoDescontado($montoDescontado): void {
        $this->montoDescontado = $montoDescontado;
    }

    function descuento($idProveedor,$fechaIn,$fechaFin) {
        require_once '../bd/Conexion-Sql-Server.php';
        $conexion = new PDO("sqlsrv:server=DESKTOP-2CQJBIO\SQLEXPRESS;database=Bs_ADMIN", "", "");
        $sql = "select formadescuento,montohaber from descuento
                where fechades between '$fechaIn' and '$fechaFin' and idproveedor='$idProveedor'";
        return $conexion->query($sql);
    }
}
