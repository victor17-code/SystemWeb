<?php

include '../bd/autoload.php';

class ControllerPeso {

    public function mostrarPeso($idProveedor, $fechaIn, $fechaFin) {
        $peso = new PesoRFF();
        return $peso->mostrarPesoPorFecha($idProveedor, $fechaIn, $fechaFin);
    }

    public function generarPDFPeso($param) {
        require('../librerias/fpdf.php');

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(40, 10, '¡Hola, Mundo!');
        $pdf->Output();
    }

}

?>
