<?php
session_start();
if (isset($_POST['ingresar'])) {
    include '../models/Proveedor.php';
    $proveedor = new Proveedor();
    $proveedor->setNombreUsuario($_POST['nom_usuario']);
    $proveedor->setPassword($_POST['pass']);

    if ($proveedor->ValidarUsuario()) {
        $_SESSION['nombres'] = $proveedor->getNombres();
        $_SESSION['nom_usuario'] = $proveedor->getNombreUsuario();
        $_SESSION['id_proveedor'] = $proveedor->getIdProveedor();
        $_SESSION['dni'] = $proveedor->getNumDni();
        $_SESSION['ruc'] = $proveedor->getNumRuc();
        $_SESSION['sector'] = $proveedor->getSector();
        $_SESSION['accionista'] = $proveedor->getAccionista();
        $_SESSION['telefono'] = $proveedor->getTelefono();

        header("Location: ../views/index.php");
    } else {
        header("Location: ../views/login.php");       
    }
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Bienvenido a Olpasa</title>      
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="../lib/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../lib/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="../lib/bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../lib/dist/css/AdminLTE.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="../lib/plugins/iCheck/square/blue.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>    
    <body class="hold-transition login-page" style="background-image:url(../imagenes/fondo_login.jpg)">
        <!--        <div id="alertSi" class="alert alert-success alert-dismissable fade show">Login OK</div>
                <div id="alertNo" class="alert alert-danger" role="alert">complete los datos</div>-->
        <div class="login-box">
            <div class="login-logo">
                <a href="#"><b> <img src="../imagenes/olpasa-logo.PNG" style="width: 360px; height: 150px"> </a>
                        </div>
                        <div class="login-box-body">
                            <p class="login-box-msg">LOGIN</p>

                            <form action="" method="post">
                                <div class="form-group has-feedback">
                                    <input id="user" class="form-control" placeholder="Usuario" name="nom_usuario">
                                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <input id="pass" type="password" class="form-control" placeholder="Contraseña" name="pass">
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                </div>
                                <div class="row">
                                    <div class="col-xs-8">
                                        <div class="checkbox icheck">
                                            <label>
                                                <input type="checkbox"> Recordar Mis Datos
                                            </label>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-xs-4">
                                        <button type="submit" class="btn btn-primary btn-block btn-flat" name="ingresar">Ingresar</button>                           
                                    </div>                       
                                    <!-- /.col -->
                                </div>
                            </form>


                            <!--INICIO MODAL -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-exclamation-triangle"></i>Error</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h4>Usuario/Contraseña Incorrectos</h4>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--                   FIN MODAL-->

                        </div>
                        <!-- /.login-box-body -->
                        </div>

                        <!-- jQuery 3 -->
                        <script src="../lib/bower_components/jquery/dist/jquery.min.js"></script>
                        <!-- Bootstrap 3.3.7 -->
                        <script src="../lib/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
                        <!-- iCheck -->
                        <script src="../lib/plugins/iCheck/icheck.min.js"></script>
                        <script>
                            $(function () {
                                $('input').iCheck({
                                    checkboxClass: 'icheckbox_square-blue',
                                    radioClass: 'iradio_square-blue',
                                    increaseArea: '20%' /* optional */
                                });
                            });
                        </script>
                        </body>
                        </html>
