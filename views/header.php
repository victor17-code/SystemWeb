<?php
session_start();
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Consulta de Peso y Liquidacion de RFF</title>
        <!-- Tell the browser to be responsive to screen width -->

        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/w/dt/jszip-2.5.0/dt-1.10.18/af-2.3.3/b-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-2.0.0/sl-1.3.0/datatables.min.css"/>
        <link rel="stylesheet" href="../lib/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../lib/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="../lib/bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../lib/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="../lib/dist/css/skins/_all-skins.min.css">
        <!-- Morris chart -->
        <link rel="stylesheet" href="../lib/bower_components/morris.js/morris.css">
        <!-- jvectormap -->
        <link rel="stylesheet" href="../lib/bower_components/jvectormap/jquery-jvectormap.css">
        <!-- Date Picker -->
        <link rel="stylesheet" href="../lib/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="../lib/bower_components/bootstrap-daterangepicker/daterangepicker.css">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="../lib/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="index2.html" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>O.S.A</b></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>OLPASA </b>S.A</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- Messages: style can be found in dropdown.less-->

                            <!-- Notifications: style can be found in dropdown.less -->

                            <!-- Tasks: style can be found in dropdown.less -->

                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="../imagenes/FotoTamañoCarnet.jpg" class="user-image" alt="User Image">
                                    <span class="hidden-xs"><?php echo $_SESSION['nombres'];
$id = $_SESSION['id_proveedor'];
?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="../imagenes/FotoTamañoCarnet.jpg" class="img-circle" alt="User Image">

                                        <p>
<?php echo $_SESSION['nombres']; ?>
                                            <small>Member since Nov. 2012</small>
                                        </p>
                                    </li>
                                    <!-- Menu Body -->

                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="InfoUsuario.php" class="btn btn-default btn-flat">Perfil</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="login.php" class="btn btn-default btn-flat">Salir</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
<!--                            <li>
                                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                            </li>-->
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="../imagenes/FotoTamañoCarnet.jpg" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p><?php echo $_SESSION['nom_usuario'];?></p>
                            <a href="#"><i class="fa fa-circle text-success"></i> En Linea</a>                          
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu" data-widget="tree">
                        <li class="header">MENU PRINCIPAL</li>
                        <li class="active treeview">
                        </li>

                        <li>
                            <a href="../views/index.php">
                                <i class="fas fa-tachometer-alt"></i>
                                <span> Dashboard</span>
                                <span class="pull-right-container"></span>
                            </a>
                            <!--                            <ul class="treeview-menu">
                                                            <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
                                                            <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
                                                            <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
                                                            <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
                                                        </ul>-->
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fas fa-weight-hanging"></i>
                                <span> Consultas</span>
                                <span class="pull-right-container"></span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="ConsultadePeso.php"><i class="fa fa-circle-o"></i> Consulta de peso RFF</a></li>
                                <li><a href="ConsultadeLiquidacion.php"><i class="fa fa-circle-o"></i> Consulta de Liquidación</a></li>                               
                            </ul>
                        </li>
                        <!--                        <li class="treeview">
                                                    <a href="#">
                                                        <i class="far fa-clipboard"></i>
                                                        <span>Consulta de Liquidación</span>
                                                        <span class="pull-right-container"></span>
                                                    </a>
                                                    <ul class="treeview-menu">
                                                        <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
                                                        <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
                                                        <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
                                                        <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
                                                    </ul>
                                                </li>-->
                        <li class="treeview">
                            <a href="#">
                                <i class="fas fa-cogs"></i>
                                <span>Configuración</span>
                                <span class="pull-right-container"></span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="InfoUsuario.php"><i class="fa fa-circle-o"></i> Conf. Usuario</a></li>
                                <li><a href="ConfigurarPassword.php"><i class="fa fa-circle-o"></i> Cambiar Contraseña</a></li>                               
                            </ul>
                        </li>
                        <li>
                            <a href="login.php">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Cerrar Sesión</span>
                                <span class="pull-right-container"></span>
                            </a>
                        </li>
                    </ul>          
                </section>
            </aside>

