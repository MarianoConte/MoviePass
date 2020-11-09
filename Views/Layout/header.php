<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img//apple-icon.png">
    <link rel="icon" type="image/png" href="./assets/img//favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        MoviePass
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="<?php echo CSS_PATH ?>/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo CSS_PATH ?>/paper-kit.css?v=2.2.0" rel="stylesheet" />
    <link href="<?php echo CSS_PATH ?>/plugins/datatables.min.css" rel="stylesheet" />
    <link href="<?php echo CSS_PATH ?>/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Core JS Files -->
    <script src="<?php echo JS_PATH ?>/core/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo JS_PATH ?>/core/popper.min.js" type="text/javascript"></script>
    <script src="<?php echo JS_PATH ?>/core/bootstrap.min.js" type="text/javascript"></script>

    <!-- Plugins -->
    <script src="<?php echo JS_PATH ?>/plugins/datatables.min.js"></script>
    <script src="<?php echo JS_PATH ?>/plugins/bootstrap-switch.js"></script>
    <script src="<?php echo JS_PATH ?>/plugins/nouislider.min.js" type="text/javascript"></script>
    <script src="<?php echo JS_PATH ?>/plugins/moment.min.js"></script>
    <script src="<?php echo JS_PATH ?>/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="<?php echo JS_PATH ?>/paper-kit.js?v=2.2.0" type="text/javascript"></script>

    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?php echo FRONT_ROOT ?>">MoviePass</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- Menu administrador -->
                    <?php if(isset($_SESSION['user']) && $_SESSION['user']->getRole() == 'ADMIN') { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo FRONT_ROOT ?>/Theater/ShowListView">Administrar cines</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo FRONT_ROOT ?>/Show/ShowListView">Administrar
                            funciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo FRONT_ROOT ?>/Movie/ShowSearchView">Buscar película</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo FRONT_ROOT ?>/User/Logout">Cerrar sesión</a>
                    </li>
                    <!-- Menu cliente -->
                    <?php } else if(isset($_SESSION['user']) && $_SESSION['user']->getRole() == 'CUSTOMER') { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo FRONT_ROOT ?>/User/Logout">Cerrar sesión</a>
                    </li>
                    <!-- Menu anonimo -->
                    <?php } else if(!isset($_SESSION['user'])) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo FRONT_ROOT ?>/User/ShowLoginView">Iniciar sesión</a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>