<?php

include '../bd/autoload.php';

class ControllerPeso {

    public function mostrarPeso($idProveedor, $fechaIn, $fechaFin) {
        $peso = new PesoRFF();
        return $peso->mostrarPesoPorFecha($idProveedor, $fechaIn, $fechaFin);
    }

    

}

?>
