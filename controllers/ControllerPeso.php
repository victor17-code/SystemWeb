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
    
    public function mostrarPesoDePlanilla($fechaInicial, $fechaFinal, $idProv) {
        $pesoPlanilla = new PesoRFF();
        return $pesoPlanilla->mostrarPesoDePlanilla($fechaInicial, $fechaFinal, $idProv);
    }
    
    public function reporteEstadistico($idProveedor, $fechaIn, $fechaFin) {
        $reporte = new PesoRFF();
        return $reporte->reporteEstadistico($idProveedor, $fechaIn, $fechaFin);
    }

}

?>
