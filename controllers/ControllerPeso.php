<?php

include '../bd/autoload.php';

class ControllerPeso {

    public function mostrarPeso($idProveedor, $fechaIn, $fechaFin) {
        $peso = new PesoRFF();
        return $peso->mostrarPesoPorFecha($idProveedor, $fechaIn, $fechaFin);
    }

    public function mostrarPesoPlanilla($idProveedor, $fechaIn, $fechaFin, $idInforme) {
        $pesoPlanilla = new PesoRFF();
        return $pesoPlanilla->mostrarPesoPorPlanilla($idProveedor, $fechaIn, $fechaFin, $idInforme);
    }

}

?>
