<?php

include '../bd/autoload.php';

class ControladorDetalleLiquidacion {

    public function mostrarLiquidacionPlanilla($idProveedor, $idInforme) {
        $detalleLiquidsacion = new DetalleLiquidacion();
        return $detalleLiquidsacion->mostrarLiquidacionPorProveedor($idProveedor, $idInforme);
    }

}
