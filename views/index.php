<?php
include '../bd/autoload.php';
include './header.php';
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fas fa-tachometer-alt"></i>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <?php
            $controllerPago = new ControllerLiquidacion();
            $ultimoPago = $controllerPago->mostrarUltimoPago($id);
            foreach ($ultimoPago as $pagoU) {
                $inicio = $pagoU['fecha_inicial'];
                $fin = $pagoU['fecha'];
                $nombre = $pagoU['mesinforme'];
            }

            $controllerUltimoPago = new ControllerLiquidacion();
            $finalPago = $controllerUltimoPago->ultimoPago($id, $inicio, $fin, $nombre);
            foreach ($finalPago as $pagoUltimo) {
                ?>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-blue">
                        <div class="inner">
                            <h3><?php echo $pagoUltimo['pesototal'] ?></h3>

                            <p>PESO TOTAL</p>
                        </div>
                        <!--                        <div class="icon">
                                                    <i class="fas fa-weight-hanging"></i>
                                                </div>-->
                        <a href="" class="small-box-footer">Ultimo Peso <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3><?php echo number_format($pagoUltimo['totalpagar'], 2); ?></h3>

                            <p>TOTAL DE INGRESO</p>
                        </div>
                        <!--                        <div class="icon">
                                                    <i class="ion ion-stats-bars"></i>
                                                </div>-->
                        <a href="#" class="small-box-footer">Ultimo Deposito <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3><?php echo number_format($pagoUltimo['descuentos'], 2); ?></h3>

                            <p>DESCUENTO</p>
                        </div>
                        <!--                        <div class="icon">
                                                    <i class="ion ion-person-add"></i>
                                                </div>-->
                        <a href="#" class="small-box-footer">Ultimo Descuento <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>   
            <?php } ?>


            <div class="col-md-6">
                <!-- DONUT CHART -->
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fas fa-balance-scale-right"></i> REPORTE POR MESES DE PESO DE RFF</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
                        </div>
                    </div>
                    <div class="box-body bg-black-gradient">
                        <canvas id="pieChart" style="height:230px;"></canvas>
                    </div>
                </div>
            </div>
            <!-- BAR CHART -->
            <div class="col-md-6">
                <!-- DONUT CHART -->
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fas fa-chart-line"></i> REPORTE DE  POR MESES</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
                        </div>
                    </div>
                    <div class="box-body bg-black-gradient">
                        <canvas id="myChart" style="height:230px;"></canvas>
                    </div>
                </div>
            </div>
        </div>      
    </section>   
</div>
<?php
include './footer.php';
?>
<script>
    var ctx = document.getElementById('pieChart').getContext('2d');
    var myChart = new Chart(ctx, {
    type: 'bar',
            data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Setiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    datasets: [{
                    label: ' Peso RFF',
<?php
$startDate = (new DateTime('first day of january', new DateTimeZone("America/Lima")));
$endDate = (new DateTime('next year, first day of january, -1 second', new DateTimeZone("America/Lima")));

$fecha1 = date_format($startDate, "Y-m-d");
$fecha2 = date_format($endDate, "Y-m-d");
$report = new ControllerPeso();
$newReport = $report->reporteEstadistico($id, $fecha1, '2021-12-31');
//foreach ($newReport as $rep) {
?>
                    data: [<?php foreach ($newReport as $rep) {
    echo $rep['pesototal'] . ",";
} ?>],
<?php //}  ?>
                    backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                    ],
                            borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 2
                    }]
            },
            options: {
            scales: {
            y: {
            beginAtZero: true
            }
            }
            }
    });</script>
<script>
<?php
$ingresos = new ControllerLiquidacion();
$newIngreso = $ingresos->reporteEstadisticoIngresos($id, '2021-01-01', '2021-12-31');
?>

    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
    type: 'bar',
            data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Setiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    datasets: [{
                    label: 'S/ ',
                            data: [<?php foreach ($newIngreso as $ingreso) {
    echo $ingreso['montototal'] . ",";
} ?>],
                            backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 2
                    }]
            },
            options: {
            scales: {
            y: {
            beginAtZero: true
            }
            }
            }
    });
</script>


