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
                            <i class="fas fa-lock"></i>
                            CAMBIAR CONTRASEÑA
                        </h1>
                    </div>
                    <?php
                    if (isset($_POST['update'])) {
                        $antiguo = $_POST['antiguo'];
                        $nuevo = $_POST['nuevo'];
                        if ($antiguo == $nuevo) {
                            $updateProveedor = new ControllerProveedor();
                            $updateProveedor->cambiarPassword($_POST);
                        }
                    }
                    ?>
                    <div class="box-body"> 
                        <form method="POST">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Usuario:</label>
                                <div class="col-sm-5">
                                    <input type="text" disabled="" class="form-control" value="<?php echo $_SESSION['nom_usuario']; ?>" placeholder="Nombre Usuario">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Contraseña Antigua:</label>
                                <div class="col-sm-5">
                                    <input type="password" name="antiguo" class="form-control" id="inputPassword" placeholder="Contraseña Antigua">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Contraseña Nueva:</label>
                                <div class="col-sm-5">
                                    <input type="password" name="nuevo" class="form-control" id="inputPassword" placeholder="Contraseña Nueva">
                                </div>
                            </div>
                            <button type="submit" name="update" class="btn btn-success">Cambiar</button>
                            <button type="resett" class="btn btn-danger">Cancelar</button>
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







