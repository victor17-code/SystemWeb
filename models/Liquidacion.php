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

    function mostrarLiquidacionPorFecha($idProveedor, $fechaIn, $fechaFin) {
        require_once '../bd/Conexion-Sql-Server.php';
        $conexion = new PDO("sqlsrv:server=DESKTOP-2CQJBIO\SQLEXPRESS;database=Bs_ADMIN", "user", "user");
        $sql = "Select informequincenal.idproveedor, mesinforme ,sum(convert(decimal(10,3), pesototal)) as pesototal ,sum(convert(money,descuentos)) as descuentos ,
        sum(convert(money,  montototal)) as  montototal,sum(convert(money, totalpagar)) as totalpagar ,fecha,fecha_inicial,liquidacioncompra.tipo_documento,
        liquidacioncompra.numserie,liquidacioncompra.numero,liquidacioncompra.fechaliquidacion,liquidacioncompra.idrepresentante,representante.nombresrepre,
        representante.numdnirepre,informequincenal.precio FROM informequincenal left outer join liquidacioncompra on liquidacioncompra.idliquidacion=informequincenal.idliquidacion 
        left outer join representante on liquidacioncompra.idrepresentante=representante.idrepresentante
        where fecha >='$fechaIn' and fecha<='$fechaFin'and informequincenal.idproveedor ='$idProveedor'
        group by informequincenal.idproveedor, mesinforme,fecha,fecha_inicial,liquidacioncompra.tipo_documento,liquidacioncompra.numserie,liquidacioncompra.numero,
        liquidacioncompra.fechaliquidacion,liquidacioncompra.idrepresentante,representante.nombresrepre,representante.numdnirepre,informequincenal.precio order by fecha";
        return $conexion->query($sql);
    }

    function mostrarUltimaLiquidacion($idProveedor) {
        require_once '../bd/Conexion-Sql-Server.php';
        $conexion = new PDO("sqlsrv:server=DESKTOP-2CQJBIO\SQLEXPRESS;database=Bs_ADMIN", "user", "user");
        $sql = "select top 1* from informequincenal where idproveedor= $idProveedor order by idinforme desc";
        return $conexion->query($sql);
    }

    function mostrarLiquidacionSinDetalle($idProveedor, $desde,$hasta) {
        require_once '../bd/Conexion-Sql-Server.php';
        $conexion = new PDO("sqlsrv:server=DESKTOP-2CQJBIO\SQLEXPRESS;database=Bs_ADMIN", "user", "user");
        $sql = "SELECT iq.mesinforme,iq.pesototal,iq.montototal,iq.descuentos,iq.totalpagar,lc.tipo_documento,
                lc.numserie,lc.numero,convert(date,lc.fechaliquidacion) as fecha FROM informequincenal AS iq inner join liquidacioncompra
                as lc on iq.idliquidacion=lc.idliquidacion WHERE lc.fechaliquidacion between '$desde' and '$hasta'
                and iq.idproveedor='$idProveedor' ORDER BY iq.idinforme DESC";
        return $conexion->query($sql);
    }
    
    function mostrarFechaLiquidacion($nombrePlanilla, $idProveedor) {
        require_once '../bd/Conexion-Sql-Server.php';
        $conexion = new PDO("sqlsrv:server=DESKTOP-2CQJBIO\SQLEXPRESS;database=Bs_ADMIN", "user", "user");
        $sql = "select * from informequincenal where mesinforme='$nombrePlanilla' AND idproveedor='$idProveedor'";
        return $conexion->query($sql);
    }
    
    function ultimoPago($idProveedor, $fechaIn, $fechaFin,$nombreMes) {
        require_once '../bd/Conexion-Sql-Server.php';
        $conexion = new PDO("sqlsrv:server=DESKTOP-2CQJBIO\SQLEXPRESS;database=Bs_ADMIN", "user", "user");
        $sql = "Select informequincenal.idproveedor, mesinforme ,sum(convert(decimal(10,3), pesototal)) as pesototal ,sum(convert(money,descuentos)) as descuentos ,
        sum(convert(money,  montototal)) as  montototal,sum(convert(money, totalpagar)) as totalpagar ,fecha,fecha_inicial,liquidacioncompra.tipo_documento,
        liquidacioncompra.numserie,liquidacioncompra.numero,liquidacioncompra.fechaliquidacion,liquidacioncompra.idrepresentante,representante.nombresrepre,
        representante.numdnirepre,informequincenal.precio FROM informequincenal left outer join liquidacioncompra on liquidacioncompra.idliquidacion=informequincenal.idliquidacion 
        left outer join representante on liquidacioncompra.idrepresentante=representante.idrepresentante
        where fecha >='$fechaIn' and fecha<='$fechaFin'and informequincenal.idproveedor ='$idProveedor' AND mesinforme='$nombreMes'
        group by informequincenal.idproveedor, mesinforme,fecha,fecha_inicial,liquidacioncompra.tipo_documento,liquidacioncompra.numserie,liquidacioncompra.numero,
        liquidacioncompra.fechaliquidacion,liquidacioncompra.idrepresentante,representante.nombresrepre,representante.numdnirepre,informequincenal.precio order by fecha";
        return $conexion->query($sql);
    }
    
    function reporteEstadisticoIngresos($idProv, $fechaInicial,$fechaFinal) {
        require_once '../bd/Conexion-Sql-Server.php';
        $conexion = new PDO("sqlsrv:server=DESKTOP-2CQJBIO\SQLEXPRESS;database=Bs_ADMIN", "user", "user");
        $sql = "select DATEPART(month, fecha_inicial) as mes, sum(convert(money,montototal)) as montototal  from informequincenal 
               where idproveedor='$idProv' and fecha_inicial >= '$fechaInicial' and fecha <= '$fechaFinal'
               GROUP BY DATEPART(month, fecha_inicial)";
        return $conexion->query($sql);
    }
    

}
