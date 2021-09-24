<?php
include '../bd/autoload.php';
include './header.php';
?>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header p-3 mb-2 bg-black-gradient text-white">
                        <h1 class="col-xs-12">
                            <i class="fas fa-balance-scale"></i>
                            CONSULTA DE PESO RFF
                        </h1>
                    </div>
                    <!--style="text-align: center"-->
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
                            $_SESSION['de']=$_POST['de'];
                            $_SESSION['hasta']=$_POST['hasta'];
                            ?>           
                            <?php
                            $controller = new ControllerPeso();
                            $ConsulPeso = $controller->mostrarPeso($idProveedor, $fechaIn, $fechaFin);
                            ?>
                            <div class="box-body">
                                <div class="col-xs-10">
                                    <p>REPORTE DE PESO RFF DE: <?php echo $fechaIn; ?> HASTA : <?php echo $fechaFin; ?></p>
                                </div>
                                <div class="col-xs-2">
                                    <form method="POST" action="ReportePeso.php" target="_black">
                                        <button type="submit" name="reporte" class="btn btn-success">GENERAR REPORTE</button>
                                    </form>                                   
                                </div>
                                
                            </div>
                            <div class="box-body" style="text-align: center">
                                <table id="example1" class="table table-bordered" >
                                    <thead>
                                        <tr>
                                            <th scope="col">N° Tiket</th>
                                            <th scope="col">Fecha</th>
                                            <th scope="col">Proveedor</th>
                                            <th scope="col">Peso Ingreso</th>
                                            <th scope="col">Peso Salida</th>
                                            <th scope="col">Peso Neto</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    foreach ($ConsulPeso as $Consulta) {
                                        ?>
                                        <tr>
                                            <th><?php echo $Consulta['numticket']; ?></th>
                                            <td><?php echo $Consulta['fecha']; ?></td>
                                            <td><?php echo $Consulta['proveedor']; ?></td>
                                            <td><?php echo $Consulta['pesoing']; ?></td>
                                            <td><?php echo $Consulta['pesosalida']; ?></td>
                                            <td><?php echo $Consulta['pesoneto']; ?></td>
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
                'excel',  'pdf', 'print'
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