<?php

class PesoRFF {
    private $idCarga;
    private $idProveedor;
    private $numTiket;
    private $fechaEntrega;
    private $horaEntrada;
    private $horaSalida;
    private $pesoIngreso;
    private $pesoSalida;
    private $pesoNeto;
    
    
    function getIdCarga() {
        return $this->idCarga;
    }

    function getIdProveedor() {
        return $this->idProveedor;
    }

    function getNumTiket() {
        return $this->numTiket;
    }

    function getFechaEntrega() {
        return $this->fechaEntrega;
    }

    function getHoraEntrada() {
        return $this->horaEntrada;
    }

    function getHoraSalida() {
        return $this->horaSalida;
    }

    function getPesoIngreso() {
        return $this->pesoIngreso;
    }

    function getPesoSalida() {
        return $this->pesoSalida;
    }

    function getPesoNeto() {
        return $this->pesoNeto;
    }

    function setIdCarga($idCarga): void {
        $this->idCarga = $idCarga;
    }

    function setIdProveedor($idProveedor): void {
        $this->idProveedor = $idProveedor;
    }

    function setNumTiket($numTiket): void {
        $this->numTiket = $numTiket;
    }

    function setFechaEntrega($fechaEntrega): void {
        $this->fechaEntrega = $fechaEntrega;
    }

    function setHoraEntrada($horaEntrada): void {
        $this->horaEntrada = $horaEntrada;
    }

    function setHoraSalida($horaSalida): void {
        $this->horaSalida = $horaSalida;
    }

    function setPesoIngreso($pesoIngreso): void {
        $this->pesoIngreso = $pesoIngreso;
    }

    function setPesoSalida($pesoSalida): void {
        $this->pesoSalida = $pesoSalida;
    }

    function setPesoNeto($pesoNeto): void {
        $this->pesoNeto = $pesoNeto;
    }


    function mostrarPesoPorFecha($idProveedor,$fechaIn,$fechaFin) {
        require_once '../bd/Conexion-Sql-Server.php';
        $conexion = new PDO("sqlsrv:server=DESKTOP-2CQJBIO\SQLEXPRESS;database=Bs_ADMIN", "user", "user");
        $sql = "select c.numticket,convert(date,c.fechacarga) as fecha, pro.nombres as proveedor,c.pesoing,c.pesosalida,c.pesoneto
                from proveedor_fruto as pro inner join cargas as c on pro.idproveedor=c.idproveedor
                where pro.idproveedor='$idProveedor' and c.fechacarga between 
                '$fechaIn' and '$fechaFin' order by c.fechacarga desc";
        return $conexion->query($sql);
    }
    
    function mostrarPesoPorPlanilla($idProveedor,$fechaIn,$fechaFin,$idInforme) {
        require_once '../bd/Conexion-Sql-Server.php';
        $conexion = new PDO("sqlsrv:server=DESKTOP-2CQJBIO\SQLEXPRESS;database=Bs_ADMIN", "user", "user");
        $sql = "select convert(date,c.fechacarga) as fecha,c.numticket,c.pesoneto,round(iq.precio*c.pesoneto,2) as importe,iq.montodolares,
        iq.pesototal,iq.montototal,iq.descuentos,iq.totalpagar from cargas as c inner join informequincenal as iq on c.idproveedor=iq.idproveedor
        where c.fechacarga between '$fechaIn' and '$fechaFin'
        and c.idproveedor='$idProveedor' and iq.idinforme='$idInforme'";
        return $conexion->query($sql);
    }
    
    function mostrarPesoDePlanilla($fechaInicial,$fechaFinal,$idProv) {
        require_once '../bd/Conexion-Sql-Server.php';
        $conexion = new PDO("sqlsrv:server=DESKTOP-2CQJBIO\SQLEXPRESS;database=Bs_ADMIN", "user", "user");
        $sql = "Select convert(date,fechacarga) as fecha,numticket,pesoneto From cargas Where fechacarga >='$fechaInicial' and fechacarga <='$fechaFinal' And idproveedor='$idProv' and idproducto=1 ORDER BY fechacarga";
        return $conexion->query($sql);
    }
    
    function reporteEstadistico($idProv, $fechaInicial,$fechaFinal) {
        require_once '../bd/Conexion-Sql-Server.php';
        $conexion = new PDO("sqlsrv:server=DESKTOP-2CQJBIO\SQLEXPRESS;database=Bs_ADMIN", "user", "user");
        $sql = "SELECT DATEPART(month, fechacarga) as mes, sum(convert(int, pesoneto)) as pesototal
               FROM [Bs_Admin].[dbo].[cargas]where idproveedor= '$idProv' and fechacarga between '$fechaInicial' and '$fechaFinal'
               GROUP BY DATEPART(month, fechacarga)";
        return $conexion->query($sql);
    }
    
}
