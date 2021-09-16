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
                            <i class="fas fa-book"></i>
                            CONSULTA DE LIQUIDACIÓN
                        </h1>
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
                            <div class="box-body" style="text-align: center">
                                <p>REPORTE DE LIQUIDACION DE: <?php echo $fechaIn; ?> HASTA : <?php echo $fechaFin; ?></p>
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
                                            <td><?php echo $Consulta['precio']; ?></td>
                                            <td><?php echo $Consulta['pesototal']; ?></td>
                                            <td><?php echo round($Consulta['descuentos'], 2); ?></td>
                                            <td><?php echo round($Consulta['totalpagar'], 2); ?></td>
                                            <td><a id="idInforme" href="DetalleLiquidacion.php?idI=<?php echo $Consulta['idinforme'] ?>" class="btn btn-success"><i class="far fa-eye"></i></a></td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            <?php } else { ?>
                                <div class="box-body" style="text-align: center">
                                    <p>Por favor ingrese fecha</p>
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
                'excel', 'pdf', 'print'
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



