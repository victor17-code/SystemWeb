<?php

session_start();
include '../bd/autoload.php';
require('../FPDF/fpdf.php');

class PDF extends FPDF {

// Cabecera de página
    function Header() {

        $this->Cell(190, 30, '', 1, 1, 'C');
        $this->Cell(95, 8, '', 1, 0, 'C');
        $this->Cell(95, 8, '', 1, 1, 'C');
        $this->Cell(95, 80, '', 1, 0, 'C');
        $this->Cell(95, 80, '', 1, 1, 'C');
        $this->Cell(95, 8, '', 1, 0, 'C');
        $this->Cell(95, 8, '', 1, 1, 'C');
        $this->Cell(95, 8, '', 0, 0, 'C');
        $this->Cell(95, 8, '', 1, 1, 'C');
        // Logo       
        $this->Image('../imagenes/olpasa-logo.PNG', 11, 11, 40);
        $this->SetFont('Arial', 'B', 10);  //AQUI TAMAÑO DE LA LETRA   

        $this->SetY(10);
        $this->SetX(70);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(80, 10, $_GET['nom'], 0, 0, 'C');

        $this->SetY(14);
        $this->SetX(70);
        $this->SetFont('Arial', '', 10);
        $this->Cell(80, 10, '(Fruta recibida desde ' . $_GET['inicio'] . ' AL ' . $_GET['fin'] . ')', 0, 0, 'C');

//Palmicultor
        $this->SetY(22);
        $this->SetX(52);
        $this->SetFont('Arial', '', 8);
        $this->Cell(25, 5, 'PALMICULTOR: ', 0, 0, 'L');
//detalle palmicultor
        $this->SetY(22);
        $this->SetX(80);
        $this->SetFont('Arial', '', 8);
        $this->Cell(70, 5, $_SESSION['nombres'], 0, 0, 'L');
//DNI
        $this->SetY(28);
        $this->SetX(52);
        $this->SetFont('Arial', '', 8);
        $this->Cell(10, 5, 'DNI: ', 0, 0, 'L');
//DETALLE DNI 
        $this->SetY(28);
        $this->SetX(80);
        $this->SetFont('Arial', '', 8);
        $this->Cell(20, 5, $_SESSION['dni'], 0, 0, 'L');
//sector
        $this->SetY(34);
        $this->SetX(52);
        $this->SetFont('Arial', '', 8);
        $this->Cell(15, 5, 'SECTOR: ', 0, 0, 'L');
//DETALLE SECTOR
        $this->SetY(34);
        $this->SetX(80);
        $this->SetFont('Arial', '', 8);
        $usuario = new ControllerProveedor();
        $newUsuario = $usuario->mostrarUsuario($_GET['id']);
        foreach ($newUsuario as $usua) {
            $this->Cell(30, 5, $usua['nombre'], 0, 0, 'L');
        }
//FECHA       
        $this->SetY(22);
        $this->SetX(160);
        $this->SetFont('Arial', '', 8);
        $this->Cell(13, 5, 'FECHA: ', 0, 0, 'L');
//DETALLE FECHA
        $this->SetY(22);
        $this->SetX(180);
        $this->SetFont('Arial', '', 8);
        $this->Cell(18, 5, date("Y-m-d"), 0, 0, 'L');
//TIPO DE CAMBIO
        $this->SetY(28);
        $this->SetX(160);
        $this->SetFont('Arial', '', 8);
        $this->Cell(17, 5, 'Tip Cambio: ', 0, 0, 'L');
//DETALLE TIPO DE CAMBIO
        $fecha = new ControllerLiquidacion();
        $newFecha = $fecha->mostrarNombreLiquidacion($_GET['nom'], $_GET['id']);
        foreach ($newFecha as $tipoCambio) {
            $this->SetY(28);
            $this->SetX(180);
            $this->SetFont('Arial', '', 8);
            $this->Cell(10, 5, $tipoCambio['tipocambio'], 0, 0, 'L');
            break;
        }
//precio
        $this->SetY(34);
        $this->SetX(160);
        $this->SetFont('Arial', '', 8);
        $this->Cell(20, 5, 'Precio TM Rff: ', 0, 0, 'L');
//DETALLE PRECIO RFF
        $fecha = new ControllerLiquidacion();
        $newFecha = $fecha->mostrarNombreLiquidacion($_GET['nom'], $_GET['id']);
        foreach ($newFecha as $precioRFF) {
            $precio = $precioRFF['montodolares'];
            $tipoCambio = $tipoCambio['tipocambio'];
            $vic = round($tipoCambio * $precio, 2);
            $this->SetY(34);
            $this->SetX(180);
            $this->SetFont('Arial', '', 8);
            $this->Cell(15, 5, round($precio), 0, 0, 'L');
            break;
        }
        $this->SetY(34);
        $this->SetX(12);
        $this->SetFont('Arial', '', 10);
        $this->Cell(35, 6, utf8_decode('Liquidación de Pago'), 0, 0, 'L');
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
$pdf->SetFont('Arial', '', 9);


//OBTENER DATOS EXTRA PARA LA SUMA
$fecha = new ControllerLiquidacion();
$newFecha = $fecha->mostrarNombreLiquidacion($_GET['nom'], $_GET['id']);
foreach ($newFecha as $precioRFF) {
    $pdf->SetY(70);
    $precio = $precioRFF['montodolares'];
    $tipoCambio = $precioRFF['tipocambio'];
    $vic = round($tipoCambio * $precio, 2);
    break;
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
$pdf->SetY(40);
$pdf->Cell(20, 8, 'Fecha', 0, 0, 'C', 0);
$pdf->Cell(18, 8, utf8_decode('N° Tiket'), 0, 0, 'C', 0);
$pdf->Cell(18, 8, 'P. Neto', 0, 0, 'C', 0);
$pdf->Cell(19, 8, 'Precio', 0, 0, 'C', 0);
$pdf->Cell(20, 8, 'Monto s/', 0, 1, 'C', 0);
$pesoTotal = 0;
$totalMonto = 0;
$carga = new ControllerPeso();
$newCarga = $carga->mostrarPesoDePlanilla($_GET['inicio'], $_GET['fin'], $_GET['id']);
foreach ($newCarga as $rff) {
    $pdf->Cell(20, 7, $rff['fecha'], 0, 0, 'C', 0);
    $pdf->Cell(18, 7, $rff['numticket'], 0, 0, 'C', 0);
    $pdf->Cell(18, 7, $rff['pesoneto'], 0, 0, 'C', 0);
    $pdf->Cell(19, 7, round($precio), 0, 0, 'C', 0);
    $monto = round($rff['pesoneto'] / 1000 * $vic, 2);
    $pdf->Cell(20, 7, $monto, 0, 1, 'C', 0);
    $pesoTotal = $pesoTotal + $rff['pesoneto'];
    $totalMonto = $totalMonto + $monto;
}
$pdf->SetY(128);
$pdf->Cell(30, 8, 'Peso Total:', 0, 0, 'R', 0);
$pdf->Cell(17, 8, $pesoTotal, 0, 0, 'C', 0);
$pdf->Cell(26, 8, 'Ing. Total:', 0, 0, 'R', 0);
$pdf->Cell(22, 8, $totalMonto, 0, 0, 'C', 0);


//DESCUENTOS
$pdf->SetY(40);
$pdf->SetX(105);
$pdf->Cell(60, 8, 'Descuentos', 0, 0, 'L', 0);
$pdf->Cell(35, 8, 'Importe s/', 0, 1, 'R', 0);
$totalDesc = 0;
$descuento = new ControladorDescuento();
$newDescuento = $descuento->descuentos($_GET['id'], $_GET['nom']);
foreach ($newDescuento as $des) {
    $pdf->SetX(105);
    $pdf->Cell(60, 7, $des['nombrecredito'], 0, 0, '', 0);
    $pdf->Cell(35, 7, $des['montohaber'], 0, 1, 'R', 0);
    $totalDesc = $totalDesc + $des['montohaber'];
}

$netoPagar = $totalMonto - $totalDesc;
$pdf->SetY(128);
$pdf->SetX(105);
$pdf->Cell(60, 8, 'TOTAL DESCUENTOS:', 0, 0, 'R', 0);
$pdf->Cell(35, 8, $totalDesc, 0, 0, 'R', 0);
//TOTAL A PAGAR
$pdf->SetY(136);
$pdf->SetX(105);
$pdf->Cell(60, 8, 'TOTAL PAGAR     :', 0, 0, 'R', 0);
$pdf->Cell(35, 8, $netoPagar, 0, 0, 'R', 0);





$pdf->Output();
?>


