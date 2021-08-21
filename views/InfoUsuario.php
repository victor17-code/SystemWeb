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
                            <i class="fas fa-info-circle"></i>
                            INFORMACION DE USUARIO
                        </h1>
                    </div>

                    <?php
                    if (isset($_POST['update'])) {
                        $updateProveedor = new ControllerProveedor();
                        $updateProveedor->updateProveedor($_POST);
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
                                        <input type="hidden" name="idproveedor" value="<?php echo $usario['idproveedor'];  ?>" class="form-control" id="inputEmail4">                               
                                        <div class="form-group col-md-6">
                                            <label for="inputEmail4">Nombres Y Apellidos</label>
                                            <input type="text" disabled="" value="<?php  echo $usario['nombres']; ?>" class="form-control" id="inputEmail4">
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
                                            <input type="text" disabled="" value="<?php echo $usario['direccion']; ?>" class="form-control" id="inputPassword4">
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
                                            <input type="number" name="telefono" value="<?php echo $usario['telefono']; ?>" class="form-control" id="inputPassword4" placeholder="Ingrese Telefono">
                                        </div>
                                        <?php } ?>
                                        <div class="form-group col-md-8">
                                            <button type="submit" name="update" class="btn btn-primary">Guardar</button>
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





