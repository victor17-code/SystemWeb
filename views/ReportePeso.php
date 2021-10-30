<?php

session_start();
include '../bd/autoload.php';
require('../FPDF/fpdf.php');

class PDF extends FPDF {

// Cabecera de página
    function Header() {
//        // Logo
        $this->Image('../imagenes/olpasa-logo.PNG', 10, 8, 40);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 10);  //AQUI TAMAÑO DE LA LETRA
        // Movernos a la derecha
        $this->Cell(80);

        // Título
        $this->SetY(0);
        $this->SetX(70);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(80, 10, 'OLEAGINOSAS PADRE ABAD S.A.C', 0, 0, 'C');

        //////////////
        //DIRECCION
        $this->SetY(7);
        $this->SetX(70);
        $this->SetFont('Arial', '', 8);
        $this->Cell(80, 10, utf8_decode('CARR. FEDERICO BASADRE KM 178-BOQUERÓN'), 0, 0, 'C');
        //FIN DE DIRECCION
        //REPORTE DE INGRESO
        //REPORTE
        $this->SetY(15);
        $this->SetX(75);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(80, 10, 'REPORTE DETALLADO DE CARGA DE PROVEEDOR', 0, 0, 'C');
        //FIN DE INGRESO
        //DESDE
        $this->SetY(19);
        $this->SetX(70);
        $this->SetFont('Arial', '', 8);
        $this->Cell(80, 10, 'DEL  ' . $_SESSION['de'] . '  AL  ' . $_SESSION['hasta'], 0, 0, 'C');
        //FIN DESDE
        //TITULO
        $this->SetY(26);
        $this->SetX(0);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(80, 10, 'Proveedor      ' . $_SESSION['nombres'], 0, 0, 'C');


        $this->Ln(10);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(38, 10, 'Fecha', 1, 0, 'C', 0);
        $this->Cell(38, 10, utf8_decode('N° Tiket'), 1, 0, 'C', 0);
        $this->Cell(38, 10, 'Peso Ingreso', 1, 0, 'C', 0);
        $this->Cell(38, 10, 'P. Salida', 1, 0, 'C', 0);
        $this->Cell(38, 10, 'P. Neto', 1, 1, 'C', 0);
    }

// Pie de página
    function Footer() {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, utf8_decode('Página') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 10);

$total = 0;
$controller = new ControllerPeso();
$ConsulPeso = $controller->mostrarPeso($_SESSION['id_proveedor'], $_SESSION['de'], $_SESSION['hasta']);
foreach ($ConsulPeso as $report) {
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(38, 10, $report['fecha'], 1, 0, 'C', 0);
    $pdf->Cell(38, 10, $report['numticket'], 1, 0, 'C', 0);
    $pdf->Cell(38, 10, number_format($report['pesoing']), 1, 0, 'C', 0);
    $pdf->Cell(38, 10, number_format($report['pesosalida']), 1, 0, 'C', 0);
    $pdf->Cell(38, 10, $report['pesoneto'], 1, 1, 'C', 0);
    $total = $total + $report['pesoneto'];
}

$pdf->Cell(114, 10, '', 0, 0, 'C', 0);
$pdf->Cell(38, 10, 'Peso (KG)', 1, 0, 'C', 0);
$pdf->Cell(38, 10, number_format($total, 2), 1, 1, 'C', 0);


$pdf->Output();
?>


