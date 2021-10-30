<?php
include '../bd/autoload.php';
include './header.php';
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fas fa-lock"></i>
            Cambiar Contraseña
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Cambiar Contraseña</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header">
                        <i class="fas fa-unlock-alt"></i>
                        <h3 class="box-title">Ingreso de Datos</h3>                                      
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
                            <button type="submit" name="update" class="btn btn-success"><i class="fas fa-edit"></i> Cambiar</button>
                            <button type="resett" class="btn btn-danger"><i class="fas fa-window-close"></i> Cancelar</button>
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








