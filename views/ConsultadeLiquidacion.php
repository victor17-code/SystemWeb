<?php
include '../bd/autoload.php';
include './header.php';
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fas fa-file-alt"></i>
            Consulta de Liquidación
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Consulta de Liquidacion</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        <i class="ion ion-calendar"></i>
                        <h3 class="box-title">Ingreso de rango de fechas a buscar</h3>                                      
                    </div>
                    <div class="box-body"> 
                        <form class="form-inline" method="POST">
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="password" class="">De:  </label>
                                <input type="date" name="de" class="form-control" required="" placeholder="Password">
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="password" class="">Hasta:  </label>
                                <input type="date" name="hasta" class="form-control" required="" placeholder="Password">
                            </div>
                            <button type="submit" name="procesar" class="btn btn-success mb-2"><i class="fas fa-check-circle"></i> PROCESAR</button>
                        </form>

                        <?php
                        if (isset($_POST['procesar'])) {
                            $idProveedor = $id;
                            $fechaIn = $_POST['de'];
                            $fechaFin = $_POST['hasta'];
                            ?>           
                            <?php
                            $controller = new ControllerLiquidacion();
                            $CLiquidacion = $controller->mostrarLiquidacion($idProveedor, $fechaIn, $fechaFin);
                            ?>
                            <div class="col-xs-10" style="text-align:left">
                                <h4><i class="far fa-list-alt"></i><strong> REPORTE DE LIQUIDACION DE: <?php echo $fechaIn; ?> HASTA : <?php echo $fechaFin; ?></strong></h4>
                            </div>
                            <div class="col-xs-2" style="text-align:left">
                                <form method="GET" action="ReporteLiquidacionSinDetalle.php" target="_black">
                                    <input type="hidden" name="fechaIn" value="<?php echo $fechaIn; ?>" >
                                    <input type="hidden" name="fechaFin" value="<?php echo $fechaFin; ?>" >
                                    <input type="hidden" name="id" value="<?php echo $id; ?>" >
                                    <button type="submit" class="btn btn-success"><i class="fas fa-clipboard"></i> GENERAR REPORTE</button>
                                </form>
                            </div>
                            <div class="box-body" style="text-align: center">
                                <table id="example1" class="table table-bordered table-hover" >
                                    <thead>
                                        <tr>
                                            <th scope="col">Nombre Planilla</th>
                                            <th scope="col">Fecha Inicial</th>
                                            <th scope="col">Fecha Final</th>
                                            <th scope="col">Precio RFF</th>
                                            <th scope="col">Peso Neto</th>
                                            <th scope="col">Retenciones</th>
                                            <th scope="col">Neto a Pagar</th>
                                            <th scope="col">Ver Detalles</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    foreach ($CLiquidacion as $Consulta) {
                                        ?>
                                        <tr>
                                            <td><?php echo $Consulta['mesinforme']; ?></td>
                                            <td><?php echo $Consulta['fecha_inicial']; ?></td>
                                            <td><?php echo $Consulta['fecha']; ?></td>
                                            <td><?php echo number_format($Consulta['precio'],2); ?></td>
                                            <td><?php echo $Consulta['pesototal']; ?></td>
                                            <td><?php echo number_format($Consulta['descuentos'],2); ?></td>
                                            <td><?php echo number_format($Consulta['totalpagar'],2); ?></td>
                                            <td><center><a id="nomPla" href="DetalleLiquidacion.php?nomP=<?php echo $Consulta['mesinforme'] ?>" class="btn btn-success"><i class="far fa-eye"></i></a></center></td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            <?php } else { ?>
                                <div class="box-body"">
                                    <div class="timeline-item col-md-6">
                                        <h3 class="timeline-header"><a href="#"><i class="fab fa-youtube"></i> TUTORIAL</a></h3>

                                        <div class="timeline-body">
                                            <div class="embed-responsive embed-responsive-16by9">
                                                <iframe width="727" height="409" src="https://www.youtube.com/embed/cGueBlTni3I?list=RDcGueBlTni3I"
                                                        title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write;
                                                        encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            </div>
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

<script>
    $(function () {
        //$('#example1').DataTable()
        $('#example1').DataTable({
            'buttons': [
                // 'excel', 'pdf', 'print'
            ],
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true,
            'dom': 'Bfrtip',
            'language': {
                "lengthMenu": "Mostrar _MENU_ registros por página.",
                "zeroRecords": "Lo sentimos. No se encontraron registros.",
                "sInfo": "Mostrando: _START_ de _END_ - Total registros: _TOTAL_ ",
                "infoEmpty": "No hay registros aún.",
                "infoFiltered": "(filtrados de un total de _MAX_ registros)",
                "search": "Búsqueda",
                "LoadingRecords": "Cargando ...",
                "Processing": "Procesando...",
                "SearchPlaceholder": "Comience a teclear...",
                "paginate": {
                    "previous": "Anterior",
                    "next": "Siguiente",
                }}
        })
    })
</script>



