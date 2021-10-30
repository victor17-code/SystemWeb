<?php
include '../bd/autoload.php';
include './header.php';
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fas fa-balance-scale-left"></i>
            Consulta de Peso
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Consulta de Peso</li>
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
                    <!-- /.box-header -->
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
                            $_SESSION['de'] = $_POST['de'];
                            $_SESSION['hasta'] = $_POST['hasta'];
                            ?>           
                            <?php
                            $controller = new ControllerPeso();
                            $ConsulPeso = $controller->mostrarPeso($idProveedor, $fechaIn, $fechaFin);
                            ?>
                            <div class="box-body">
                                <div class="col-xs-12">
                                    <h4><i class="far fa-list-alt"></i><strong> Reporte de peso RFF De: <?php echo $fechaIn; ?> HASTA : <?php echo $fechaFin; ?></strong></h4>                                 
                                    <form method="POST" action="ReportePeso.php" target="_black">
                                        <button type="submit" name="reporte" class="btn btn-default pull-right-container"><i class="fas fa-clipboard"></i> GENERAR REPORTE</button>
                                    </form>
                                </div>
                                <!--                                <div class="col-xs-4" style="text-align: right">
                                                                    <form method="POST" action="ReportePeso.php" target="_black">
                                                                        <button type="submit" name="reporte" class="btn btn-default pull-left"><i class="fas fa-clipboard"></i> GENERAR REPORTE</button>
                                                                    </form>                                   
                                                                </div>                               -->
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
                                            <td><?php echo $Consulta['numticket']; ?></th>
                                            <td><?php echo $Consulta['fecha']; ?></td>
                                            <td><?php echo $Consulta['proveedor']; ?></td>
                                            <td><?php echo number_format($Consulta['pesoing']); ?></td>
                                            <td><?php echo number_format($Consulta['pesosalida']); ?></td>
                                            <td><?php echo number_format($Consulta['pesoneto']); ?></td>
                                        </tr>
                                    <?php } ?>
                                </table>                                                            
                            <?php } else { ?>
                                <div class="box-body">
                                    <div class="timeline-item col-md-6">
                                        <h3 class="timeline-header"><a href=""><i class="fab fa-youtube"></i> TUTORIAL</a></h3>

                                        <div class="timeline-body">
                                            <div class="embed-responsive embed-responsive-16by9">
                                                <iframe width="727" height="409" src="https://www.youtube.com/embed/ROpw-U3pdS0" 
                                                        title="YouTube video player" frameborder="0" allow="accelerometer;
                                                        autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                        allowfullscreen></iframe>
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
        //$('#peso').DataTable()
        $('#example1').DataTable({
            'buttons': [
                // 'excel',  'pdf', 'print'
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

<script>
    $(document).ready(function () {
        $('#peso').DataTable({
            'searching': false,
            "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
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
        });
    });
</script>
