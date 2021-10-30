<?php
include '../bd/autoload.php';
include './header.php';
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Liquidacion Detallada
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Liquidacion Detallada</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        <i class="ion ion-calendar"></i>
                        <h3 class="box-title">Seguimiento de Planilla</h3> 
                        <a class="btn btn-success pull-right" href="ConsultadeLiquidacion.php"><i class="fas fa-plus"></i> NUEVA CONSULTA</a>
                    </div>
                    <div class="box-body">                  
                        <?php
                        $usuario = new ControllerProveedor();
                        $newUsuario = $usuario->mostrarUsuario($id);
                        $fecha = new ControllerLiquidacion();
                        $newFecha = $fecha->mostrarNombreLiquidacion($_GET['nomP'], $id);
                        foreach ($newFecha as $fec) {
                            $inicio = $fec['fecha_inicial'];
                            $fin = $fec['fecha'];
                            ?>
                            <div class="mb-3 row" style="margin-top: 10px; margin-left: 10px;">
                                <label class="col-sm-2 col-form-label">FRUTA RECIBIDA:</label>
                                <div class="col-sm-4">
                                    <input type="text" disabled="" value="<?php echo "DEL: " . $fec['fecha_inicial'] . " AL " . $fec['fecha']; ?>" class="form-control">
                                </div>
                            </div>
                            <?php
                            break;
                        }
                        ?>
                        <div class="mb-3 row" style="margin-top: 10px;margin-left: 10px;">
                            <label for="inputPassword" class="col-sm-2 col-form-label">PALMICULTOR:</label>
                            <div class="col-sm-4">
                                <input type="text" disabled="" value="<?php echo $_SESSION['nombres']; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3 row" style="margin-top: 10px;margin-left: 10px;">
                            <label for="inputPassword" class="col-sm-2 col-form-label">DNI/RUC:</label>
                            <div class="col-sm-4">
                                <input type="text" disabled="" value="<?php echo $_SESSION['dni']; ?>" class="form-control">
                            </div>
                            <?php
                            $fecha = new ControllerLiquidacion();
                            $newFecha = $fecha->mostrarNombreLiquidacion($_GET['nomP'], $id);
                            foreach ($newFecha as $tipoCambio) {
                                ?>
                                <label for="inputPassword" class="col-sm-2 col-form-label">TIPO DE CAMBIO:</label>
                                <div class="col-sm-2">
                                    <input type="text" disabled="" value="<?php echo "S/ " . $tipoCambio['tipocambio'] ?>" class="form-control">
                                </div>
                                <?php
                                break;
                            }
                            ?>
                        </div>
                        <div class="mb-3 row" style="margin-top: 10px;margin-left: 10px;">  
                            <?php foreach ($newUsuario as $usu) { ?>
                                <label for="inputPassword" class="col-sm-2 col-form-label">SECTOR:</label>                            
                                <div class="col-sm-4">
                                    <input type="text" disabled="" value="<?php echo $usu["nombre"] ?>" class="form-control">
                                </div>
                                <?php
                            }
                            $fecha = new ControllerLiquidacion();
                            $newFecha = $fecha->mostrarNombreLiquidacion($_GET['nomP'], $id);
                            foreach ($newFecha as $precioRFF) {
                                $precio = $precioRFF['montodolares'];
                                $tipoCambio = $tipoCambio['tipocambio'];
                                $vic = round($tipoCambio * $precio, 2);
                                ?>
                                <label for="inputPassword" class="col-sm-2 col-form-label">RFF $:</label>
                                <div class="col-sm-2">
                                    <input type="text" disabled="" value="<?php echo "$ " . round($precio); ?>" class="form-control">
                                </div>
                                <?php
                                break;
                            }
                            ?>
                        </div>
                        <div class="mb-3 row" style="margin-top: 10px;  margin-left: 10px;">                   
                            <div class="col-sm-3">
                                <form method="get" action="ReporteLiquidacion.php" target="_black">                                  
                                    <input type="hidden" name="inicio" value="<?php echo $inicio; ?>">
                                    <input type="hidden" name="fin" value="<?php echo $fin; ?>">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <input type="hidden" name="nom" value="<?php echo $_GET['nomP'] ?>">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-print"></i> IMPRIMIR</button>
                                </form>
                            </div>
                        </div>                           
                        <div class="mb-3 row" style="margin-top: 10px; margin-left: 10px;">                            
                            <div class="col-sm-6">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Fecha</th>
                                            <th scope="col">Tiket</th>
                                            <th scope="col">P.Neto</th>
                                            <th scope="col">Precio</th>
                                            <th scope="col">Monto S/</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $totalPeso = 0;
                                        $montoIngreso = 0.0;
                                        $carga = new ControllerPeso();
                                        $newCarga = $carga->mostrarPesoDePlanilla($inicio, $fin, $id);
                                        foreach ($newCarga as $carg) {
                                            ?>
                                            <tr>
                                                <td><?php echo $carg['fecha'] ?></td>
                                                <td><?php echo $carg['numticket'] ?></td>
                                                <td><?php echo $carg['pesoneto'] ?></td>                                               
                                                <td><?php echo round($precio); ?></td>
                                                <td><?php echo $monto = round($carg['pesoneto'] / 1000 * $vic, 2); ?></td>
                                                <?php
                                                $totalPeso = $totalPeso + $carg['pesoneto'];
                                                $montoIngreso = $montoIngreso + $monto;
                                                ?>
                                            </tr>   
                                        <?php }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                            $descuento = new ControladorDescuento();
                            $newDescuento = $descuento->descuentos($id, $_GET['nomP']);
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
                                    $totalDescuento = 0;
                                    foreach ($newDescuento as $des) {
                                        ?>
                                        <tr>
                                            <td><?php echo $des['nombrecredito'] ?></td>
                                            <td><?php echo $des['montohaber'] ?></td>
                                            <?php $totalDescuento = $totalDescuento + $des['montohaber']; ?>
                                        </tr>                                      
                                    <?php } ?>
                                </table>
                            </div>
                        </div>

                        <!--fin de tabla de pesado-->

                        <div class="mb-3 row" style="margin-top: 10px; margin-left: 10px;">
                            <label for="inputPassword" class="col-sm-4 col-form-label">PESO TOTAL:</label>
                            <div class="col-sm-2">
                                <input type="text" disabled="" value="<?php echo $totalPeso; ?>" class="form-control" id="inputPassword">
                            </div>
                            <label for="inputPassword" class="col-sm-4 col-form-label">TOTAL DESCUENTOS:</label>
                            <div class="col-sm-2">
                                <input type="text" disabled="" value="<?php echo $totalDescuento; ?>" class="form-control" id="inputPassword">
                            </div>
                        </div>
                        <div class="mb-3 row" style="margin-top: 10px; margin-left: 10px;">
                            <label for="inputPassword" class="col-sm-4 col-form-label">MONTO INGRESOS:</label>
                            <div class="col-sm-2">
                                <input type="text" disabled="" value="<?php echo round($montoIngreso, 2); ?>" class="form-control" id="inputPassword">
                            </div>
                            <label for="inputPassword" class="col-sm-4 col-form-label">TOTAL A PAGAR:</label>
                            <div class="col-sm-2">
                                <input type="text" disabled="" value="<?php echo $netoPagar = $montoIngreso - $totalDescuento; ?>" class="form-control">
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
