<?php

session_start();
include '../bd/autoload.php';
require('../FPDF/fpdf.php');

class PDF extends FPDF {

// Cabecera de página
    function Header() {
//        // Logo
        $this->Image('../imagenes/olpasa-logo.PNG', 10, 8, 40);
        $this->SetFont('Arial', 'B', 10);  //AQUI TAMAÑO DE LA LETRA   

        $this->SetY(0);
        $this->SetX(70);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(80, 10, $_SESSION['mesinforme'], 0, 0, 'C');

        $this->SetY(5);
        $this->SetX(70);
        $this->SetFont('Arial', '', 8);
        $this->Cell(80, 10, '(Fruta recibida desde ' . $_SESSION['deL'] . ' AL' . $_SESSION['hastaL'] . ')', 0, 0, 'C');
        //Palmicultor
        $this->SetY(10);
        $this->SetX(43);
        $this->SetFont('Arial', '', 8);
        $this->Cell(80, 10, 'PALMICULTOR: ' . $_SESSION['palmicultor'], 0, 0, 'C');
        //DNI
        $this->SetY(14);
        $this->SetX(22);
        $this->SetFont('Arial', '', 8);
        $this->Cell(80, 10, 'DNI:  ' . $_SESSION['dni'], 0, 0, 'C');
        //sector
        $this->SetY(18);
        $this->SetX(30);
        $this->SetFont('Arial', '', 8);
        $this->Cell(80, 10, 'SECTOR: ' . $_SESSION['sector'], 0, 0, 'C');
        //FECHA       
        $this->SetY(10);
        $this->SetX(140);
        $this->SetFont('Arial', '', 8);
        $this->Cell(80, 10, 'FECHA: ' . date("Y-m-d"), 0, 0, 'C');
        //TIPO DE CAMBIO
        $this->SetY(14);
        $this->SetX(140);
        $this->SetFont('Arial', '', 8);
        $this->Cell(80, 10, 'Tip Cambio: ' . $_SESSION['TipoCambio'], 0, 0, 'C');
        //precio
        $this->SetY(18);
        $this->SetX(142);
        $this->SetFont('Arial', '', 8);
        $this->Cell(80, 10, 'Precio TM Rff: ' . $_SESSION['PrecioUnitario'], 0, 0, 'C');

        $this->SetY(26);
        $this->SetX(0);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(80, 10, utf8_decode('LIQUIDACIÓN DE COMPRA'), 0, 0, 'C');

        $this->Ln(10);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(33, 10, 'Fecha', 1, 0, 'C', 0);
        $this->Cell(33, 10, utf8_decode('N° Tiket'), 1, 0, 'C', 0);
        $this->Cell(33, 10, 'P. Neto', 1, 0, 'C', 0);
        $this->Cell(33, 10, 'Precio', 1, 0, 'C', 0);
        $this->Cell(60, 10, 'Monto s/', 1, 1, 'C', 0);
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
$pdf->SetFont('Arial', '', 10);


$pesoRFF = new ControllerPeso();
$newPeso = $pesoRFF->mostrarPesoPlanilla($_SESSION['id_proveedor'], $_SESSION['deL'], $_SESSION['hastaL'], $_SESSION['getif']);
foreach ($newPeso as $rff) {
    $pdf->Cell(33, 10, $rff['fecha'], 1, 0, 'C', 0);
    $pdf->Cell(33, 10, $rff['numticket'], 1, 0, 'C', 0);
    $pdf->Cell(33, 10, $rff['pesoneto'], 1, 0, 'C', 0);
    $pdf->Cell(33, 10, round($rff['montodolares']), 1, 0, 'C', 0);
    $pdf->Cell(60, 10, number_format(round($rff['importe'], 2)), 1, 1, 'C', 0);
}
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(99, 10, ' ', 0, 0, 'C', 0);
$pdf->Cell(33, 10, 'PESO NETO ', 1, 0, '', 0);
$pdf->Cell(60, 10, $_SESSION['pesototal'], 1, 1, 'C', 0);
$pdf->Cell(99, 10, ' ', 0, 0, 'C', 0);
$pdf->Cell(33, 10, 'MONTO INGRESO ', 1, 0, '', 0);
$pdf->Cell(60, 10, $_SESSION['montototal'], 1, 1, 'C', 0);


//DESCUENTOS
$pdf->Ln(10);
$pdf->Cell(128, 10, 'Descuentos', 1, 0, '', 0);
$pdf->Cell(64, 10, 'Importe s/', 1, 1, 'C', 0);
$descuent = new ControladorDescuento();
$newdescuent = $descuent->descuentos($_SESSION['id_proveedor'], $_SESSION['deL'], $_SESSION['hastaDesc']);
foreach ($newdescuent as $des) {
    $pdf->Cell(128, 10, $des['formadescuento'], 1, 0, '', 0);
    $pdf->Cell(64, 10, $des['montohaber'], 1, 1, 'C', 0);
}
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(69, 10, ' ', 0, 0, 'C', 0);
$pdf->Cell(59, 10, 'TOTAL DESCUENTO ', 1, 0, '', 0);
$pdf->Cell(64, 10, $_SESSION['descuentos'], 1, 1, 'C', 0);
//
$pdf->Cell(69, 10, ' ', 0, 0, 'C', 0);
$pdf->Cell(59, 10, 'MONTO A PAGAR ', 1, 0, '', 0);
$pdf->Cell(64, 10, $_SESSION['totalpagar'], 1, 1, 'C', 0);

$pdf->Output();
?>


