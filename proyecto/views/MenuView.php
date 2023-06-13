<?php

class MenuView
{

    function showMenuAdmin($user, $num_register, $num_register_req)
    {

?>
        <!DOCTYPE html>
        <html lang="es">

        <head>

            <title>GM_MAS</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <title>SIMAT - MAS</title>
            <link rel="shorcut icon" href="img/Logo_FAVICON.png">

            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" 
            integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
            crossorigin="anonymous"></script>

    
            <!-- Google Font: Source Sans Pro -->
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
            <!-- Toastr -->
            <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
            <!-- Theme style -->
            <link rel="stylesheet" href="dist/css/adminlte.min.css">
            <script src="https://kit.fontawesome.com/d2ec2ed15a.js" crossorigin="anonymous"></script>

            <link rel="stylesheet" href="assets/css/EstiloMenu.css">

        </head>

        <body class="hold-transition sidebar-mini" id="matriculas">
        <br>
            <div class="wrapper">
                <!------------------------------------------- Barra de navegacion ----------------------------------------->
                <nav class="main-header navbar navbar-expand navar-superior">

                    <!-- Botones izquierdos -->
                    <ul class="navbar-nav ">
                        <li class="nav-item">
                            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                        </li>
                        <li class="nav-item d-none d-sm-inline-block">
                            <a onclick="Menu.menu('MenuController/showHome')" class="nav-link">Inicio</a>
                        </li>
                    </ul>


                    <!--  Botones de la derecha -->
                    <ul class="navbar-nav ml-auto">

                        <!-- COLOCAR LA PANTALLA GRANDE -->
                        <li class="nav-item">
                            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                                <i class="fas fa-expand-arrows-alt"></i>
                            </a>
                        </li>

                        <!-- COLOCAR LA PANTALLA GRANDE -->
                        <li class="nav-item">
                            <a onclick="Menu.menu('MenuController/showManual')" class="nav-link" href="#" role="button">
                                <i class="fa-sharp fa-solid fa-file"></i>
                            </a>
                        </li>

                        <!-- Boton para cerrar sesion -->
                        

                        <!-- INICIO DE SESIÓN -->
                        <li>
                        <div  class="flex-shrink-0 dropdown">
                                <a href="3_login.html" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="img/administrador.jpg" width="40" height="40" class="rounded-circle">
                                    <?php echo $user[0]->name_user; ?>
                                    <?php echo $user[0]->last_name_user; ?>    
                                </a>
                                <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                                    <li><hr class="dropdown-divider"></li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" role="button" onclick="Menu.closeSession()">
                                            <i class="fas fa-power-off"></i>    Cerar Sesión
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- /.navbar -->
                
                

                <!------------------------------------------- contenedor MENU  ----------------------------------------->
                <aside class="main-sidebar elevation-4 contenedor-botones">
                    <!-- Brand Logo -->
                    <div class="contenedorLogo">
                        <img src="img/Logo_favicon2.png" class="logo" alt="">
                    </div>

                    <!-- Perfil -->
                    <div class="sidebar">
                        <!-- Opciones  Menu -->
                        <nav class="mt-5">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                <li class="nav-item">

                                    <a href="#" onclick="Menu.menu('UserController/paginateUsers')" class="nav-link boton">
                                        <i class="fa-solid fa-users-gear"></i>
                                        <p class="ml-2">Administrar Usuarios</p>
                                    </a>
                                    <a href="#"  class="nav-link boton">
                                        <i class="fa-sharp fa-solid fa-business-time"></i>
                                        <p class="ml-2">Historial de Accesos</p>
                                    </a>
                                    <br></br>
                                    <a href="#" onclick="Menu.menu('RequestController/paginateRequest')" class="nav-link boton">
                                        <i class="fa-solid fa-layer-group"></i>
                                        <p class="ml-2">Solicitudes</p>
                                    </a>
                                    <a href="#" onclick="Menu.menu('InterviewController/paginateFormSchedule')" class="nav-link boton">
                                        <i class="fa-sharp fa-solid fa-calendar-days"></i>
                                        <p class="ml-2">Horarios de entrevista</p>
                                    </a>
                                    <a href="#" onclick="" class="nav-link boton">
                                        <i class="fa-sharp fa-solid fa-circle-check"></i>
                                        <p class="ml-2">Admitir</p>
                                    </a>
                                    <a href="#" onclick="" class="nav-link boton">
                                        <i class="fa-sharp fa-solid fa-file"></i>
                                        <p class="ml-2">Validar documentos</p>
                                    </a>
                                    <a href="#" onclick="" class="nav-link boton">
                                        <i class="fa-sharp fa-solid fa-user-plus"></i>
                                        <p class="ml-2">Matricular</p>
                                    </a>
                                    <br></br>
                                    <a href="#" onclick="Menu.menu('UserController/paginateProcessPosition_A')" class="nav-link boton">
                                        <i class="fa-sharp fa-solid fa-business-time"></i>
                                        <p class="ml-2">MATRICULAS</p>
                                    </a>
                                    
                                </li>
                            </ul>
                        </nav>
                        <!-- /.sidebar-menu -->
                    </div>
                    <!-- /.sidebar -->
                </aside>




                <!-- Content Wrapper. Contains page content -->
                <center >
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="container-fluid">

                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1 class="m-0"></h1>
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content-header -->

                    <!-- Main content -->
                    <div class="content">
                        <div class="container-fluid">

                            <!-- Aqui se carga el contenido que es requerido -->
                            <div id="content">
                                <div class="container-fluid py-4">
                                
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                                            <div class="card">
                                                <div class="card-header p-3 pt-2">
                                                    <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                                                        <i class="material-icons opacity-10">USUARIOS</i>
                                                    </div>
                                                    <div class="text-end pt-1">
                                                        <p class="text-lg mb-0 text-capitalize">Número</p>
                                                        <h3><?php echo $num_register ?></h3>
                                                    </div>
                                                </div>
                                                    <hr class="dark horizontal my-0">
                                                    <div class="card-footer p-3">
                                                    <p class="mb-0"><span class="text-success text-lg font-weight-bolder">ACTIVOS</span></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                                        <div class="card">
                                            <div class="card-header p-3 pt-2">
                                                <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                                                    <i class="material-icons opacity-10">SOLICITUDES</i>
                                                </div>
                                                <div class="text-end pt-1">
                                                    <p class="text-lg mb-0 text-capitalize">Número</p>
                                                    <h3><?php echo $num_register_req ?></h3>
                                                </div>
                                            </div>
                                                <hr class="dark horizontal my-0">
                                                <div class="card-footer p-3">
                                                <p class="mb-0"><span class="text-success text-lg font-weight-bolder">RECIBIDAS</span></p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content -->
                </div>
                </center>
                <!-- /.content-wrapper -->

                <div id="my_modal" class="modal" tabindex="-1">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal_title"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div id="modal_content" class="modal-body">

                            </div>
                        </div>
                    </div>
                </div>

                <div id="my_modal_solicitud" class="modal" tabindex="-1">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal_title"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div id="modal_content" class="modal-body">

                            </div>
                        </div>
                    </div>
                </div>

                <div id="my_modal_schedule" class="modal" tabindex="-1">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal_title"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div id="modal_content" class="modal-body">

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Footer -->
                <footer class="main-footer">

                </footer>
            </div>
            <!-- ./wrapper -->

            <!-- REQUIRED SCRIPTS -->

            <!-- jQuery -->
            <script src="plugins/jquery/jquery.min.js"></script>
            <!-- Bootstrap 4 -->
            <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
            <!-- Toastr -->
            <script src="plugins/toastr/toastr.min.js"></script>
            <!-- AdminLTE App -->
            <script src="dist/js/adminlte.min.js"></script>

            <script src="js/Menu.js"></script>
            <script src="js/js/User.js"></script>
            <script src="js/Request.js"></script>
            <script src="js/Interview.js"></script>
            <script src="js/Matriculas.js"></script>
            <script src="js/Principal.js"></script>
            <script src="js/Login.js"></script>

            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        </body>

        </html>
    <?php
    }
    function showHome($num_register, $num_register_req)
{
?>
    <!-- Content Wrapper. Contains page content -->
    <center >
                


                        <div class="container-fluid">

                            <!-- Aqui se carga el contenido que es requerido -->
                            <div id="content">
                                <div class="container-fluid py-4">
                                
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                                            <div class="card">
                                                <div class="card-header p-3 pt-2">
                                                    <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                                                        <i class="material-icons opacity-10">USUARIOS</i>
                                                    </div>
                                                    <div class="text-end pt-1">
                                                        <p class="text-lg mb-0 text-capitalize">Número</p>
                                                        <h3><?php echo $num_register ?></h3>
                                                    </div>
                                                </div>
                                                    <hr class="dark horizontal my-0">
                                                    <div class="card-footer p-3">
                                                    <p class="mb-0"><span class="text-success text-lg font-weight-bolder">ACTIVOS</span></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                                        <div class="card">
                                            <div class="card-header p-3 pt-2">
                                                <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                                                    <i class="material-icons opacity-10">SOLICITUDES</i>
                                                </div>
                                                <div class="text-end pt-1">
                                                    <p class="text-lg mb-0 text-capitalize">Número</p>
                                                    <h3><?php echo $num_register_req ?></h3>
                                                </div>
                                            </div>
                                                <hr class="dark horizontal my-0">
                                                <div class="card-footer p-3">
                                                <p class="mb-0"><span class="text-success text-lg font-weight-bolder">RECIBIDAS</span></p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content -->
                </center>
                <!-- /.content-wrapper -->
<?php

}


    function showMenuSecretaria($user, $num_register, $num_register_req)
    {

?>
        <!DOCTYPE html>
        <html lang="es">

        <head>

            <title>GM_MAS</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <title>SIMAT - MAS</title>
            <link rel="shorcut icon" href="img/Logo_FAVICON.png">

            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" 
            integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
            crossorigin="anonymous"></script>

    
            <!-- Google Font: Source Sans Pro -->
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
            <!-- Toastr -->
            <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
            <!-- Theme style -->
            <link rel="stylesheet" href="dist/css/adminlte.min.css">
            <script src="https://kit.fontawesome.com/d2ec2ed15a.js" crossorigin="anonymous"></script>

            <link rel="stylesheet" href="assets/css/EstiloMenu.css">

        </head>

        <body class="hold-transition sidebar-mini" id="matriculas">

            <div class="wrapper">
                <!------------------------------------------- Barra de navegacion ----------------------------------------->
                <nav class="main-header navbar navbar-expand navar-superior">

                    <!-- Botones izquierdos -->
                    <ul class="navbar-nav ">
                        <li class="nav-item">
                            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                        </li>
                        <li class="nav-item d-none d-sm-inline-block">
                            <a onclick="Menu.menu('MenuController/validateHome')" class="nav-link">Inicio</a>
                        </li>
                    </ul>


                    <!--  Botones de la derecha -->
                    <ul class="navbar-nav ml-auto">

                        <!-- COLOCAR LA PANTALLA GRANDE -->
                        <li class="nav-item">
                            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                                <i class="fas fa-expand-arrows-alt"></i>
                            </a>
                        </li>

                        <!-- Boton para cerrar sesion -->
                        

                        <!-- INICIO DE SESIÓN -->
                        <li>
                        <div  class="flex-shrink-0 dropdown">
                                <a href="3_login.html" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="img/administrador.jpg" width="40" height="40" class="rounded-circle">
                                    <?php echo $user[0]->name_user; ?>
                                    <?php echo $user[0]->last_name_user; ?>    
                                </a>
                                <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                                    <li><hr class="dropdown-divider"></li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" role="button" onclick="Menu.closeSession()">
                                            <i class="fas fa-power-off"></i>    Cerar Sesión
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- /.navbar -->
                
                

                <!------------------------------------------- contenedor MENU  ----------------------------------------->
                <aside class="main-sidebar elevation-4 contenedor-botones">
                    <!-- Brand Logo -->
                    <div class="contenedorLogo">
                        <img src="img/Logo_favicon2.png" class="logo" alt="">
                    </div>

                    <!-- Perfil -->
                    <div class="sidebar">
                        <!-- Opciones  Menu -->
                        <nav class="mt-5">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                <li class="nav-item">
                                    <a href="#" onclick="Menu.menu('RequestController/paginateRequest')" class="nav-link boton">
                                        <i class="fa-solid fa-layer-group"></i>
                                        <p class="ml-2">Solicitudes</p>
                                    </a>
                                    <a href="#" onclick="Menu.menu('InterviewController/paginateFormSchedule')" class="nav-link boton">
                                        <i class="fa-sharp fa-solid fa-calendar-days"></i>
                                        <p class="ml-2">Horarios de entrevista</p>
                                    </a>
                                    <a href="#" onclick="" class="nav-link boton">
                                        <i class="fa-sharp fa-solid fa-circle-check"></i>
                                        <p class="ml-2">Admitir</p>
                                    </a>
                                    <a href="#" onclick="" class="nav-link boton">
                                        <i class="fa-sharp fa-solid fa-file"></i>
                                        <p class="ml-2">Validar documentos</p>
                                    </a>
                                    <a href="#" onclick="" class="nav-link boton">
                                        <i class="fa-sharp fa-solid fa-user-plus"></i>
                                        <p class="ml-2">Matricular</p>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <!-- /.sidebar-menu -->
                    </div>
                    <!-- /.sidebar -->
                </aside>

                <!-- Content Wrapper. Contains page content -->
                <center >
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="container-fluid">

                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1 class="m-0"></h1>
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content-header -->

                    <!-- Main content -->
                    <div class="content">
                        <div class="container-fluid">

                            <!-- Aqui se carga el contenido que es requerido -->
                            <div id="content">
                                <div class="container-fluid py-4">
                                
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                                            <div class="card">
                                                <div class="card-header p-3 pt-2">
                                                    <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                                                        <i class="material-icons opacity-10">USUARIOS</i>
                                                    </div>
                                                    <div class="text-end pt-1">
                                                        <p class="text-lg mb-0 text-capitalize">Número</p>
                                                        <h3><?php echo $num_register ?></h3>
                                                    </div>
                                                </div>
                                                    <hr class="dark horizontal my-0">
                                                    <div class="card-footer p-3">
                                                    <p class="mb-0"><span class="text-success text-lg font-weight-bolder">ACTIVOS</span></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                                        <div class="card">
                                            <div class="card-header p-3 pt-2">
                                                <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                                                    <i class="material-icons opacity-10">SOLICITUDES</i>
                                                </div>
                                                <div class="text-end pt-1">
                                                    <p class="text-lg mb-0 text-capitalize">Número</p>
                                                    <h3><?php echo $num_register_req ?></h3>
                                                </div>
                                            </div>
                                                <hr class="dark horizontal my-0">
                                                <div class="card-footer p-3">
                                                <p class="mb-0"><span class="text-success text-lg font-weight-bolder">RECIBIDAS</span></p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content -->
                </div>
                </center>
                <!-- /.content-wrapper -->

                <div id="my_modal" class="modal" tabindex="-1">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal_title"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div id="modal_content" class="modal-body">

                            </div>
                        </div>
                    </div>
                </div>

                <div id="my_modal_solicitud" class="modal" tabindex="-1">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal_title"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div id="modal_content" class="modal-body">

                            </div>
                        </div>
                    </div>
                </div>

                <div id="my_modal_schedule" class="modal" tabindex="-1">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal_title"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div id="modal_content" class="modal-body">

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Footer -->
                <footer class="main-footer">

                </footer>
            </div>
            <!-- ./wrapper -->

            <!-- REQUIRED SCRIPTS -->

            <!-- jQuery -->
            <script src="plugins/jquery/jquery.min.js"></script>
            <!-- Bootstrap 4 -->
            <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
            <!-- Toastr -->
            <script src="plugins/toastr/toastr.min.js"></script>
            <!-- AdminLTE App -->
            <script src="dist/js/adminlte.min.js"></script>

            <script src="js/Menu.js"></script>
            <script src="js/js/User.js"></script>
            <script src="js/Request.js"></script>
            <script src="js/Interview.js"></script>
            <script src="js/Matriculas.js"></script>
            <script src="js/Principal.js"></script>
            <script src="js/Login.js"></script>

            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        </body>

        </html>
    <?php
    }

    function showMenuAcudiente($user, $num_register, $num_register_req)
    {


?>
        <!DOCTYPE html>
        <html lang="es">

        <head>

            <title>GM_MAS</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <title>SIMAT - MAS</title>
            <link rel="shorcut icon" href="img/Logo_FAVICON.png">

            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" 
            integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
            crossorigin="anonymous"></script>

    
            <!-- Google Font: Source Sans Pro -->
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
            <!-- Toastr -->
            <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
            <!-- Theme style -->
            <link rel="stylesheet" href="dist/css/adminlte.min.css">
            <script src="https://kit.fontawesome.com/d2ec2ed15a.js" crossorigin="anonymous"></script>

            <link rel="stylesheet" href="assets/css/EstiloMenu.css">

        </head>

        <body class="hold-transition sidebar-mini" id="matriculas">
        <header>
            
            <header class="py-3 mb-3 border-bottom">
                <div class="container-fluid d-grid gap-3 align-items-center" style="grid-template-columns: 1fr 2fr;">
                    
                  <!-- LOGO_PRINCIPAL -->
                  <a href="" id="icon_logo_prin"> <img src="img/Icon_logo_prin_3.png" width="500px"></a>
                    
                    <!-- BARRA DE BUSQUEDA -->
                    <div class="d-flex align-items-center">
                      
                        <form class="w-100 me-3">
                          <input type="Buscar" class="form-control_buscador" placeholder="Buscar..." aria-label="Buscar" >
                        </form>
                        
                         <!-- INICIO DE SESIÓN -->
                         <div  class="flex-shrink-0 dropdown">
                                <a href="3_login.html" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="img/administrador.jpg" width="40" height="40" class="rounded-circle">
                                    <?php echo $user[0]->name_user; ?>
                                    <?php echo $user[0]->last_name_user; ?>    
                                </a>
                                <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                                    <li><hr class="dropdown-divider"></li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" role="button" onclick="Menu.closeSession()">
                                            <i class="fas fa-power-off"></i>    Cerar Sesión
                                        </a>
                                    </li>
                                </ul>
                            </div>
                      
                    </div>
                </div>
            </header>

            <div id="menu_principal" class="px-3 py-2 bg-secondary text-white">
                <div class="container">
                    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                        <a href="/" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
                        <svg class="bi me-2" width="30" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
                        </a>
                        
                        <ul  class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                            <li>
                                <a href=""  class="nav-link text-white"><center><img src="img/img_prin/Icon_inicio.png" width="32px"></center>Inicio</a>
                            </li>

                            <li>
                                <a  href="#" onclick="User.paginateProcessPosition('<?php echo $user[0]->id_user ?>');" style="color: #b32323;cursor:pointer;" class="nav-link text-white"><center><img src="img/img_prin/Icon_matriculas.png" width="27px" ></center>Matrículas</a>
                            </li>

                            <li>
                                <a href="#" onclick="Menu.menu('RequestController/paginateRequest')" class="nav-link text-white"><center><img src="img/img_prin/Icon_contactanos_sii.png" width="26px"></center>Contáctanos</a>
                            </li>
                        </ul>

                  </div>
                </div>
              </div>
              
        </header>
        <br>
            <div class="wrapper">

                <!-- Content Wrapper. Contains page content -->
                <center >
                    <!-- Main content -->
                    <div class="content">
                        <div class="container-fluid">

                            <!-- Aqui se carga el contenido que es requerido -->
                            <div id="content">
                                <div class="container-fluid py-4">
                                
                                    <!-- CARRUSEL - (ACÁ ESTÁ DONDE PASAN LAS IMÁGENES) -->
                                    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-indicators">
                                            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                        </div>
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <a class="bd-placeholder-img" href=""></a><center><img src="img//carusel_1.jpeg" height="700px" width="1200px"></a></center>
                                                <!-- 
                                                <div class="container">
                                                    <div class="carousel-caption text-start">
                                                        <h1>SOMOS CALIDAD</h1>
                                                        <p>Todos nuestras ayudas estás calficadas con altos índices de educación</p>
                                                        <p><a class="btn btn-lg btn-primary" href="#">Experimenta ya...</a></p>
                                                    </div>
                                                </div>
                                                -->
                                            </div>
                                            
                                            <div class="carousel-item">
                                                <a class="bd-placeholder-img" href=""></a><center><img src="img//carusel_2.jpg"  height="700px" width="1200px"></a></center>
                                                <!-- 
                                                <div class="container">
                                                    <div class="carousel-caption">
                                                        <h1>SOMOS ECONOMÍA</h1>
                                                        <p>Todos nuestros precios son adecuados para tu bolsillo</p>
                                                        <p><a class="btn btn-lg btn-primary" href="#">Cotiza ya...</a></p>
                                                    </div>
                                                </div>
                                                -->
                                            </div>

                                            <div class="carousel-item">
                                            <a class="bd-placeholder-img" href=""><center></a><img src="img//carusel_3.jpeg"  height="700px" width="1200px"></a></center>
                                            <!-- 
                                            <div class="container">
                                                <div class="carousel-caption">
                                                    <h1>SOMOS ECONOMÍA</h1>
                                                    <p>Todos nuestros precios son adecuados para tu bolsillo</p>
                                                    <p><a class="btn btn-lg btn-primary" href="#">Cotiza ya...</a></p>
                                                </div>
                                            </div>
                                            -->
                                        </div>

                                        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon bg-dark" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                                        <span class="carousel-control-next-icon bg-dark" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>

                                    <!-- OPCIONES DE INFORMACIÓN  -->

                <hr class="featurette-divider">

<div class="row featurette">
    <div class="col-md-7">
        <h2 class="featurette-heading">MISIÓN <span class="text-muted"></span></h2>
        <p class="lead">La educación sexual es un proceso educativo enfocado a los niños y adolescentes. La misma está diseñada con el fin de otorgarle al joven conocimientos e información sexual, con el fin de ayudar a tomar decisiones saludables en la sexualidad y el sexo. Además, en cada edad se debe abordar temas de manera distinta, por eso es necesario establecer una buena comunicación con los niños y usar el vocabulario adecuado. Asimismo, hoy en día podemos encontrar material de todo tipo, el cual nos puede ayudar como apoyo en los aspectos de sexualidad.</p>
    </div>
    <div class="col-md-5">
        <a class="bd-placeholder-img" href="1_categorias.html"></a><img src="img/Icon_mision.png" height="350px" width="400px"></a>

    </div>
</div>

<hr class="featurette-divider">
<div class="row featurette">
  <div class="col-md-5">
    <a class="bd-placeholder-img" href="1_categorias.html"></a><center><img src="img/Icon_vision.jpg" height="350px" width="400x"></center></a>
  </div> 

  <div class="col-md-7">
      <h2 class="featurette-heading">VISIÓN <span class="text-muted"></span></h2>
      <p class="lead">La educación sexual es un proceso educativo enfocado a los niños y adolescentes. La misma está diseñada con el fin de otorgarle al joven conocimientos e información sexual, con el fin de ayudar a tomar decisiones saludables en la sexualidad y el sexo. Además, en cada edad se debe abordar temas de manera distinta, por eso es necesario establecer una buena comunicación con los niños y usar el vocabulario adecuado. Asimismo, hoy en día podemos encontrar material de todo tipo, el cual nos puede ayudar como apoyo en los aspectos de sexualidad.</p>
  </div>    
</div>


<hr class="featurette-divider">

<!-- VIDEO - YOUTUBE -->
<center>
<div class="wpb_single_image wpb_content_element vc_align_center  wpb_animate_when_almost_visible wpb_bounceInLeft bounceInLeft">
<figure class="wpb_wrapper vc_figure">
<div class="vc_single_image-wrapper   vc_box_border_grey"><img width="505" height="64" 
  src="https://colegiodelapresentacion.edu.co/wp-content/uploads/2019/08/open-house-2019-exalumnos-6.png" class="vc_single_image-img attachment-full" 
  alt srcset="https://colegiodelapresentacion.edu.co/wp-content/uploads/2019/08/open-house-2019-exalumnos-6.png 505w, https://colegiodelapresentacion.edu.co/wp-content/uploads/2019/08/open-house-2019-exalumnos-6-300x38.png 300w" 
  sizes="(max-width: 505px) 100vw, 505px" /></div>
</figure>
</div>
</center>

<center>
<div class="vc_row wpb_row vc_row-fluid vc_custom_1579814731018 vc_row-has-fill"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner"><div class="wpb_wrapper">
<div class="wpb_raw_code wpb_content_element wpb_raw_html">
<div class="wpb_wrapper">
  <iframe width="580" height="314" src="https://www.youtube.com/embed/AOC2pR4g7gU?rel=0&amp;showinfo=0" 
    title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
  </iframe>
  <iframe width="580" height="314" src="https://www.youtube.com/embed/jLiVYXSfmOo?rel=0&amp;showinfo=0" 
    title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
  </iframe>
</div>
</div>
</div>
</center>

<hr class="featurette-divider">

<!-- SUSCRIPCIÓN -->
<header class="p-3 bg-secondary text-white">
<div class="container">
  <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
    <center>
      <h4>"Formando líderes competitivos para el futuro"</h4>
    </center>
  </div>
</div>
</header>

<!-- ================================================================================================ -->

<!-- FOOTER - (PIÉ DE PÁGINA, DE LyTA) -->
<div class="container">
<footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top" class="py-5">
  <div class="row">
    <div class="col-2">
      <h5>Institución</h5>
      <ul class="nav flex-column">
        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Inicios</a></li>
        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Mision</a></li>
        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Visión</a></li>
      </ul>
    </div>

    <div class="col-3">
      <h5>Políticas de privacidad</h5>
      <ul class="nav flex-column">
        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Sobre Estudiantes</a></li>
        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Sobre Sdministrativos</a></li>
        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Sobre Docentes</a></li>
      </ul>
    </div>

    <div class="col-2">
      <h5>Otros</h5>
      <ul class="nav flex-column">
        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Sobre Campus</a></li>
        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Sobre Pagos</a></li>
        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Sobre Garantías</a></li>
      </ul>  
    </div>
    

    <div class="col-4 offset-1">
      <form>
        <h5>Introduce, si ya leíste</h5>
        <p>Nos aseguramos que leas y estés al tanto de nuestras políticas</p>
        <div class="d-flex w-100 gap-2">
          <label for="newsletter1" class="visually-hidden">Correo...</label>
          <input id="newsletter1" type="text" class="form-control" placeholder="Correo...">
          <button class="btn btn-primary" type="button">Enviar</button>
        </div>
      </form>
    </div>
  </div>

  <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
    <li>
      <a href="https://web.facebook.com/MANOSAMORYSEMILLA" class="nav-link text-white"><img src="img/Icon_face.png" width="35px"></a>
    </li>

    <li>
      <a href="https://www.instagram.com/luzytecnoaccess/?hl=es-la"class="nav-link text-white"><img src="img/Icon_insta.png" width="40px"></a>
    </li> 
  </ul>           

<div class="d-flex justify-content-between py-4 my-4 border-top">
  <p> Colombia, para Cristo</p>
</div>

<div class="d-flex justify-content-between py-4 my-4 border-top">
  <p> "Formando líderes competitivos para el futuro"</p>
</div>

<!-- CHAT FLOTANTE -->
<script type="text/javascript">
  (function () {
      var options = {
          facebook: "100063690034538", // Facebook page ID
          whatsapp: "+57 3126901519", // WhatsApp number
          call_to_action: "Hablemos...!", // Call to action
          button_color: "#FF6550", // Color of button
          position: "right", // Position may be 'right' or 'left'
          order: "whatsapp,facebook", // Order of buttons
      };
      var proto = 'https:', host = "getbutton.io", url = proto + '//static.' + host;
      var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
      s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
      var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
  })();
</script>


</footer>
</div>

                                </div>
                            </div>
                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content -->
                </div>
                </center>
                <!-- /.content-wrapper -->
                
            <!-- ================================================================================================ -->

                

                <!-- Main Footer -->
                <footer class="main-footer">

                </footer>
            
            <!-- ./wrapper -->

            <!-- REQUIRED SCRIPTS -->
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <!-- jQuery -->
            <script src="plugins/jquery/jquery.min.js"></script>
            <!-- Bootstrap 4 -->
            <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
            <!-- Toastr -->
            <script src="plugins/toastr/toastr.min.js"></script>
            <!-- AdminLTE App -->
            <script src="dist/js/adminlte.min.js"></script>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script src="plugins/jquery/jquery.min.js"></script>
            <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="plugins/toastr/toastr.min.js"></script>
            <script src="dist/js/adminlte.min.js"></script>


            <script src="js/Menu.js"></script>
            <script src="js/js/User.js"></script>
            <script src="js/Pdf.js"></script>
            <script src="js/js/Request.js"></script>
            <script src="js/Interview.js"></script>
            <script src="js/Matriculas.js"></script>
            <script src="js/Principal.js"></script>
            <script src="js/Login.js"></script>
            <script src="js/js/Request.js"></script>
            
        </body>

        </html>
    <?php
    }
}
?>