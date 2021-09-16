<?php

include '../bd/autoload.php';

class ControladorDescuento {

    public function descuentos($idProveedor, $fechaIn, $fechaFin) {
        $descuento = new Descuentos();
        return $descuento->descuento($idProveedor, $fechaIn, $fechaFin);
    }

}
