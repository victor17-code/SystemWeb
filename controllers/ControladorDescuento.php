<?php

include '../bd/autoload.php';

class ControladorDescuento {

    public function descuentos($idProveedor, $nomPlanilla) {
        $descuento = new Descuentos();
        return $descuento->descuento($idProveedor, $nomPlanilla);
    }

}
