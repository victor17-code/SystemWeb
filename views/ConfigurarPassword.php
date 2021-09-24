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
                            <i class="fas fa-lock"></i>
                            CAMBIAR CONTRASEÑA
                        </h1>
                    </div>
                    <?php
                    if (isset($_POST['update'])) {
                        $idProvedor = new ControllerProveedor();
                        $Prov = $idProvedor->mostrarUsuario($id);
                        foreach ($Prov as $usario) {
                            $idProv = $usario['idproveedor'];
                            $passwordAntigua = $usario['password'];
                        }
                        if ($passwordAntigua == $_POST['antiguo']) {
                            if($_POST['nuevo1'] == $_POST['nuevo2']) {
                                $updateProveedor = new ControllerProveedor();
                                $updateProveedor->cambiarPassword($idProv, $_POST['nuevo1']);
                                echo "<script>window.setTimeout(function() { window.location = '../views/login.php' }, 3000);</script>";
                                session_destroy();                                
                            }else{
                                echo 'LA NUEVA CONTRASEÑA NO COINCIDEN';
                            }
                        } else {
                            echo "CONTRASEÑA ANTIGUA NO COINCIDE";
                        }
                    }
                    ?>
                    <div class="box-body"> 
                        <form method="POST" action="">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Contraseña Antigua:</label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="antiguo" placeholder="Contraseña Antigua">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Contraseña Nueva:</label>
                                <div class="col-sm-5">
                                    <input type="password" name="nuevo1" class="form-control" id="inputPassword" placeholder="Contraseña Nueva">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Confirmar Contraseña:</label>
                                <div class="col-sm-5">
                                    <input type="password" name="nuevo2" class="form-control" id="inputPassword" placeholder="Confirmar Contraseña">
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








