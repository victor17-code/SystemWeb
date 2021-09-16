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
                            <i class="fas fa-file-signature"></i>
                            Liquidación Detallada
                        </h1>
                    </div>
                    <div class="box-body">
                        <div class="box-header">
                            <div class="col-xs-10">
                                <h4 class="col-xs-12">
                                    <i class="fas fa-file-alt"></i>
                                    SEGUIMIENTO DE PLANILLA
                                </h4>
                            </div>
                            <div class="col-xs-2">
                                <a  class="btn btn-success" href="ConsultadeLiquidacion.php">NUEVA CONSULTA</a>
                            </div>
                        </div>
                        <?php
                        $planilla = new ControladorDetalleLiquidacion();
                        $newPlanilla = $planilla->mostrarLiquidacionPlanilla($id, $_GET['idI']);
                        foreach ($newPlanilla as $pla) {
                            ?>
                            <div class="mb-3 row" style="margin-top: 10px; margin-left: 10px;">
                                <label for="inputPassword" class="col-sm-2 col-form-label">FRUTA RECIBIDA:</label>
                                <div class="col-sm-4">
                                    <input type="text" disabled="" value="<?php echo "Del " . $pla['desde'] . " Al " . $pla['hasta']; ?>" class="form-control" id="inputPassword">
                                </div>
                            </div>
                            <div class="mb-3 row" style="margin-top: 10px;margin-left: 10px;">
                                <label for="inputPassword" class="col-sm-2 col-form-label">PALMICULTOR:</label>
                                <div class="col-sm-4">
                                    <input type="text" disabled="" value="<?php echo $pla['nombres']; ?>" class="form-control" id="inputPassword">
                                </div>
                            </div>
                            <div class="mb-3 row" style="margin-top: 10px;margin-left: 10px;">
                                <label for="inputPassword" class="col-sm-2 col-form-label">DNI/RUC:</label>
                                <div class="col-sm-4">
                                    <input type="text" disabled="" value="<?php echo $pla['numdni']; ?>" class="form-control" id="inputPassword">
                                </div>
                                <label for="inputPassword" class="col-sm-2 col-form-label">TIPO CAMBIO:</label>
                                <div class="col-sm-2">
                                    <input type="text" disabled="" value="<?php echo $pla['tipocambio']; ?>" class="form-control" id="inputPassword">
                                </div>
                            </div>
                            <div class="mb-3 row" style="margin-top: 10px;margin-left: 10px;">
                                <label for="inputPassword" class="col-sm-2 col-form-label">SECTOR:</label>
                                <div class="col-sm-4">
                                    <input type="text" disabled="" value="<?php echo $pla['nombre']; ?>" class="form-control" id="inputPassword">
                                </div>
                                <label for="inputPassword" class="col-sm-2 col-form-label">RFF $:</label>
                                <div class="col-sm-2">
                                    <input type="text" disabled="" value="<?php echo $pla['preciouni']; ?>" class="form-control" id="inputPassword">
                                </div>
                            </div>
                            <?php ?>
                            <div class="mb-3 row" style="margin-top: 10px; margin-left: 10px;">                            
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-secondary"><i class="fas fa-print"></i> IMPRIMIR</button>
                                </div>
                            </div>

                            <!--incio de tabla de pesado-->  
                            <?php
                            $pesoRFF = new ControllerPeso();
                            $newPeso = $pesoRFF->mostrarPesoPlanilla($id, $pla['desde'], $pla['hasta'], $_GET['idI']);
                            ?>
                            <div class="mb-3 row" style="margin-top: 10px; margin-left: 10px;">                            
                                <div class="col-sm-6">
                                    <table class="table table-bordered border-primary">
                                        <thead>
                                            <tr>
                                                <th scope="col">Fecha</th>
                                                <th scope="col">Tiket</th>
                                                <th scope="col">P.Neto</th>
                                                <th scope="col">Precio</th>
                                                <th scope="col">Monto S/</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        foreach ($newPeso as $RFF) {
                                            ?>
                                            <tr>
                                                <td><?php echo $RFF['fecha']; ?></td>
                                                <td><?php echo $RFF['numticket']; ?></td>
                                                <td><?php echo $RFF['pesoneto']; ?></td>
                                                <td><?php echo round($pla['montodolares']); ?></td>
                                                <td><?php echo round($RFF['importe']); ?></td>
                                            </tr>                                      
                                            <?php
                                        }
                                        ?>
                                    </table>
                                </div>
                                <?php
                                $descuent = new ControladorDescuento();
                                $newdescuent = $descuent->descuentos($id, $pla['desde'], $pla['hasta']);
                                ?>
                                <div class="col-sm-6">
                                    <table class="table table-bordered border-primary">
                                        <thead>
                                            <tr>
                                                <th scope="col">Descuentos</th>
                                                <th scope="col">Importe S/</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        foreach ($newdescuent as $des) {
                                            ?>
                                            <tr>
                                                <td><?php echo $des['formadescuento']; ?></td>
                                                <td><?php echo $des['montohaber']; ?></td>
                                            </tr>                                      
                                        <?php }
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>

                        <!--fin de tabla de pesado-->

                        <div class="mb-3 row" style="margin-top: 10px; margin-left: 10px;">
                            <label for="inputPassword" class="col-sm-4 col-form-label">PESO TOTAL:</label>
                            <div class="col-sm-2">
                                <input type="text" disabled="" value="<?php echo $RFF['pesototal']; ?>" class="form-control" id="inputPassword">
                            </div>
                            <label for="inputPassword" class="col-sm-4 col-form-label">TOTAL DESCUENTOS:</label>
                            <div class="col-sm-2">
                                <input type="text" disabled="" value="<?php echo round($RFF['descuentos'], 2); ?>" class="form-control" id="inputPassword">
                            </div>
                        </div>
                        <div class="mb-3 row" style="margin-top: 10px; margin-left: 10px;">
                            <label for="inputPassword" class="col-sm-4 col-form-label">MONTO INGRESOS:</label>
                            <div class="col-sm-2">
                                <input type="text" disabled="" value="<?php echo round($RFF['montototal'], 2); ?>" class="form-control" id="inputPassword">
                            </div>
                            <label for="inputPassword" class="col-sm-4 col-form-label">TOTAL A PAGAR:</label>
                            <div class="col-sm-2">
                                <input type="text" disabled="" value="<?php echo round($RFF['totalpagar'], 2); ?>" class="form-control" id="inputPassword">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
include './footer.php';
?>
