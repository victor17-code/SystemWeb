<?php
include '../bd/autoload.php';
include './header.php';
?>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h1 class="col-xs-12">
                            <i class="fas fa-tachometer-alt"></i>
                            DASHBOARD
                        </h1>
                    </div>

                    <div class="box-body">
                        <div class="col-md-12">                           
                            <h4><i class="fas fa-signal"></i> INFORME DEL ULTIMO PAGO</h4>
                        </div>
                        <?php
                        $controllerPago = new ControllerLiquidacion();
                        $ultimoPago = $controllerPago->mostrarUltimoPago($id);
                        foreach ($ultimoPago as $pagoU) {
                        ?>
                        <div class="form-group col-md-4">
                            <div class="card" style="width: 25rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Total Toneladas:</h5>
                                    <p class="card-text"><?php echo $pagoU['pesototal']; ?> Toneladas</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card" style="width: 25rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Total de Ingreso:</h5>                                   
                                    <p class="card-text"><?php echo round($pagoU['totalpagar'], 2); ?> Soles</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="card" style="width: 25rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Total de Descuento:</h5>
                                    <p class="card-text"><?php echo round($pagoU['descuentos'], 2); ?> Soles</p>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
include './footer.php';
?>
