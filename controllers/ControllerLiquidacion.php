<?php

include '../bd/autoload.php';

class ControllerLiquidacion {

    public function mostrarLiquidacion($idProveedor, $fechaIn, $fechaFin) {
        $liquidacion = new Liquidacion();
        return $liquidacion->mostrarLiquidacionPorFecha($idProveedor, $fechaIn, $fechaFin);
    }
    
    public function mostrarUltimoPago($idProveedor) {
        $pago = new Liquidacion();
        return $pago->mostrarUltimaLiquidacion($idProveedor);
    }

    public function mostrarLiquidacionSinDetalle($idProveedor, $fechaIn, $fechaFin) {
        $liquidacion = new Liquidacion();
        return $liquidacion->mostrarLiquidacionSinDetalle($idProveedor, $fechaIn, $fechaFin);
    }
    
    public function mostrarNombreLiquidacion($nombreLiquidacion, $idProveedor) {
        $liquidacion = new Liquidacion();
        return $liquidacion->mostrarFechaLiquidacion($nombreLiquidacion, $idProveedor);
    }
    public function ultimoPago($idProveedor, $fechaIn, $fechaFin,$nombreMes) {
        $liquidacion = new Liquidacion();
        return $liquidacion->ultimoPago($idProveedor, $fechaIn, $fechaFin, $nombreMes);
    }
    
    public function reporteEstadisticoIngresos($idProv, $fechaInicial, $fechaFinal) {
        $ingresos = new Liquidacion();
        return $ingresos->reporteEstadisticoIngresos($idProv, $fechaInicial, $fechaFinal);
    }
}
