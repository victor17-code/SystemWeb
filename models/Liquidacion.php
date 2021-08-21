<?php

class Liquidacion {
    private $idInforme;
    private $fechaInicial;
    private $fechaFinal;
    private $precioRFF;
    private $pesoNeto;
    private $pesoBruto;
    private $descuento;
    private $netoPagar;
    
    function getIdInforme() {
        return $this->idInforme;
    }

    function getFechaInicial() {
        return $this->fechaInicial;
    }

    function getFechaFinal() {
        return $this->fechaFinal;
    }

    function getPrecioRFF() {
        return $this->precioRFF;
    }

    function getPesoNeto() {
        return $this->pesoNeto;
    }

    function getPesoBruto() {
        return $this->pesoBruto;
    }

    function getDescuento() {
        return $this->descuento;
    }

    function getNetoPagar() {
        return $this->netoPagar;
    }

    function setIdInforme($idInforme): void {
        $this->idInforme = $idInforme;
    }

    function setFechaInicial($fechaInicial): void {
        $this->fechaInicial = $fechaInicial;
    }

    function setFechaFinal($fechaFinal): void {
        $this->fechaFinal = $fechaFinal;
    }

    function setPrecioRFF($precioRFF): void {
        $this->precioRFF = $precioRFF;
    }

    function setPesoNeto($pesoNeto): void {
        $this->pesoNeto = $pesoNeto;
    }

    function setPesoBruto($pesoBruto): void {
        $this->pesoBruto = $pesoBruto;
    }

    function setDescuento($descuento): void {
        $this->descuento = $descuento;
    }

    function setNetoPagar($netoPagar): void {
        $this->netoPagar = $netoPagar;
    }


    function mostrarLiquidacionPorFecha($idProveedor,$fechaIn,$fechaFin) {
        require_once '../bd/Conexion-Sql-Server.php';
        $conexion = new PDO("sqlsrv:server=DESKTOP-2CQJBIO\SQLEXPRESS;database=Bs_ADMIN", "", "");
        $sql = "select idinforme, mesinforme, fecha_inicial, fecha, precio, pesototal, descuentos, totalpagar, idproveedor from informequincenal
                where  idproveedor='$idProveedor' and  fecha between '$fechaIn' and '$fechaFin'
                order by idinforme desc";
        return $conexion->query($sql);
    }
    
    function mostrarUltimaLiquidacion($idProveedor) {
        require_once '../bd/Conexion-Sql-Server.php';
        $conexion = new PDO("sqlsrv:server=DESKTOP-2CQJBIO\SQLEXPRESS;database=Bs_ADMIN", "", "");
        $sql = "select top 1* from informequincenal where idproveedor= $idProveedor order by idinforme desc";
        return $conexion->query($sql);
    }
}
