<?php
include '../bd/autoload.php';
include './header.php';
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fas fa-info"></i>
            Informacion del Palmicultor
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Informacion del Palmicultor</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        <i class="fas fa-folder-open"></i>
                        <h3 class="box-title">Datos del Palmicultor</h3>                                      
                    </div>
                    <?php
                    if (isset($_POST['update'])) {
                        $updateProveedor = new ControllerProveedor();
                        $updateProveedor->updateProveedor($_POST);
                        echo "<script>window.setTimeout(function() { window.location = '../views/login.php' }, 3000);</script>";
                        session_destroy();
                    }
                    ?>

                    <div class="box-body"> 
                        <form method="POST">
                            <?php
                            $idProvedor = new ControllerProveedor();
                            $Prov = $idProvedor->mostrarUsuario($id);
                            foreach ($Prov as $usario) {
                                ?>
                                <div class="form-row">                           
                                    <input type="hidden" name="idproveedor" value="<?php echo $usario['idproveedor']; ?>" class="form-control" id="inputEmail4">                               
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Nombres Y Apellidos</label>
                                        <input type="text" disabled="" value="<?php echo $usario['nombres']; ?>" class="form-control" id="inputEmail4">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Dni</label>
                                        <input type="number" disabled="" value="<?php echo $usario['numdni']; ?>" class="form-control" id="inputPassword4">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Ruc</label>
                                        <input type="text" disabled="" value="<?php echo $usario['numruc']; ?>" class="form-control" id="inputEmail4">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Sector</label>
                                        <input type="text" disabled="" value="<?php echo $usario['nombre']; ?>" class="form-control" id="inputPassword4">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Accionista</label>
                                        <input type="text" disabled="" value="<?php echo $usario['accionista']; ?>" class="form-control" id="inputPassword4">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Nombre Usuario</label>
                                        <input type="text" name="usuario" value="<?php echo $usario['nom_usuario']; ?>" class="form-control" id="inputPassword4" placeholder="Ingrese Nombre usuario">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Telefono</label>
                                        <input type="text" minlength="9" maxlength="9" name="telefono" value="<?php echo $usario['telefono']; ?>" class="form-control" id="inputPassword4" placeholder="Ingrese Telefono">
                                    </div>                                  
                                <?php } ?>
                                <div class="form-group col-md-8">
                                    <button type="submit" name="update" class="btn btn-primary"><i class="fas fa-user-edit"></i> ACTUALIZAR</button>
                                </div>
                            </div>                           
                        </form>
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





