<?php

session_start();
include '../bd/autoload.php';
require('../FPDF/fpdf.php');

class PDF extends FPDF {

// Cabecera de página
    function Header() {
        // Logo       
        $this->Image('../imagenes/olpasa-logo.PNG', 11, 11, 50);
        $this->SetFont('Arial', 'B', 10);  //AQUI TAMAÑO DE LA LETRA  
        //TITULO
        $this->SetY(10);
        $this->SetX(70);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(100, 8, 'REPORTE DE PAGO - RFF DE PALMA', 0, 0, '');
        //PERIODO
        $this->SetY(22);
        $this->SetX(70);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(30, 6, 'Periodo:', 0, 0, '');
        //DETALLE PERIODO
        $this->SetY(22);
        $this->SetX(110);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(100, 6, 'Desde el  '.$_GET['fechaIn'].'  hasta  '.$_GET['fechaFin'], 0, 0, '');
        // PROVEEDOR
        $this->SetY(30);
        $this->SetX(70);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(30, 6, 'Proveedor:', 0, 0, '');
        //DETALLE PROVEEDOR
        $this->SetY(30);
        $this->SetX(110);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(100, 6, $_SESSION['nombres'], 0, 0, '');
        // DNI
        $this->SetY(38);
        $this->SetX(70);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(30, 6, utf8_decode('N° Documento'), 0, 0, '');
        //N° DNI
        $this->SetY(38);
        $this->SetX(110);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(100, 6, $_SESSION['dni'], 0, 0, '');
        
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
$pdf->AddPage('LANDSCAPE', 'A4');
$pdf->SetFont('Arial', '', 9);

//ENCABEZADO
$pdf->SetY(50);
$pdf->Cell(40, 8, 'Quincena', 1, 0, 'C', 0);
$pdf->Cell(25, 8, 'Peso (TM)', 1, 0, 'C', 0);
$pdf->Cell(25, 8, 'Monto Total', 1, 0, 'C', 0);
$pdf->Cell(25, 8, 'Retenciones', 1, 0, 'C', 0);
$pdf->Cell(30, 8, 'Neto Pagar', 1, 0, 'C', 0);
$pdf->Cell(30, 8, 'T. Doc', 1, 0, 'C', 0);
$pdf->Cell(30, 8, 'Serie', 1, 0, 'C', 0);
$pdf->Cell(30, 8, 'Numero', 1, 0, 'C', 0);
$pdf->Cell(40, 8, 'Fecha Comprobante', 1, 1, 'C', 0);

$sumaPesoTotal = 0;
$montoTotal = 0;
$retenciones = 0;
$netoPagar = 0;
$liquidacion = new ControllerLiquidacion();
$newLiquidacion = $liquidacion->mostrarLiquidacion($_GET['id'], $_GET['fechaIn'], $_GET['fechaFin']);
foreach ($newLiquidacion as $rff) {   
    $pdf->Cell(40, 7, $rff['mesinforme'], 0, 0, '', 0);
    $pdf->Cell(25, 7, $rff['pesototal'], 0, 0, 'C', 0);
    $pdf->Cell(25, 7, $rff['montototal'], 0, 0, 'C', 0);
    $pdf->Cell(25, 7, $rff['descuentos'], 0, 0, 'C', 0);    
    $pdf->Cell(30, 7, $rff['totalpagar'], 0, 0, 'C', 0); 
    $pdf->Cell(30, 7, $rff['tipo_documento'], 0, 0, 'C', 0);
    $pdf->Cell(30, 7, $rff['numserie'], 0, 0, 'C', 0);
    $pdf->Cell(30, 7, $rff['numero'], 0, 0, 'C', 0);    
    $pdf->Cell(40, 7, $rff['fechaliquidacion'], 0, 1, 'C', 0);
    $sumaPesoTotal  = $sumaPesoTotal+$rff['pesototal'];
    $montoTotal = $montoTotal + $rff['montototal'];
    $retenciones = $retenciones + $rff['descuentos'];
    $netoPagar = $netoPagar + $rff['totalpagar'];
}
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(40, 7, 'Totales: ', 0, 0, 'C', 0);
$pdf->Cell(25, 7, $sumaPesoTotal, 0, 0, 'C', 0);
$pdf->Cell(25, 7, $montoTotal, 0, 0, 'C', 0);
$pdf->Cell(25, 7, $retenciones, 0, 0, 'C', 0);
$pdf->Cell(30, 7, $netoPagar, 0, 0, 'C', 0);

$pdf->Output();
?>


