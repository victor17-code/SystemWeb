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

}
