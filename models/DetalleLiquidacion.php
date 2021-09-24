<?php

class DetalleLiquidacion {

    private $idInforme;
    private $desde;
    private $hasta;
    private $nombres;
    private $dni;
    private $tipoCambio;
    private $nombreSector;
    private $precioUnitario;
    private $idProveedor;

    function getIdInforme() {
        return $this->idInforme;
    }

    function getDesde() {
        return $this->desde;
    }

    function getHasta() {
        return $this->hasta;
    }

    function getNombres() {
        return $this->nombres;
    }

    function getDni() {
        return $this->dni;
    }

    function getTipoCambio() {
        return $this->tipoCambio;
    }

    function getNombreSector() {
        return $this->nombreSector;
    }

    function getPrecioUnitario() {
        return $this->precioUnitario;
    }

    function getIdProveedor() {
        return $this->idProveedor;
    }

    function setIdInforme($idInforme): void {
        $this->idInforme = $idInforme;
    }

    function setDesde($desde): void {
        $this->desde = $desde;
    }

    function setHasta($hasta): void {
        $this->hasta = $hasta;
    }

    function setNombres($nombres): void {
        $this->nombres = $nombres;
    }

    function setDni($dni): void {
        $this->dni = $dni;
    }

    function setTipoCambio($tipoCambio): void {
        $this->tipoCambio = $tipoCambio;
    }

    function setNombreSector($nombreSector): void {
        $this->nombreSector = $nombreSector;
    }

    function setPrecioUnitario($precioUnitario): void {
        $this->precioUnitario = $precioUnitario;
    }

    function setIdProveedor($idProveedor): void {
        $this->idProveedor = $idProveedor;
    }

    function mostrarLiquidacionPorProveedor($idProveedor,$idInforme) {
        require_once '../bd/Conexion-Sql-Server.php';
        $conexion = new PDO("sqlsrv:server=DESKTOP-2CQJBIO\SQLEXPRESS;database=Bs_ADMIN", "", "");
        $sql = "SELECT i.mesinforme,i.idinforme, i.fecha_inicial as desde,i.fecha as hasta, pr.nombres,pr.numdni,i.tipocambio,s.nombre,dl.preciouni,
        pr.idproveedor,i.montodolares FROM informequincenal
        AS i INNER JOIN proveedor_fruto AS pr on i.idproveedor=pr.idproveedor
        inner join liquidacioncompra as li on i.idliquidacion=li.idliquidacion inner join sector as s on pr.idsector=s.idsector
        inner join detalleliquidacion as dl on li.idliquidacion=dl.idliquidacion
        where pr.idproveedor='$idProveedor' and i.idinforme='$idInforme'";
        return $conexion->query($sql);
    }

}
