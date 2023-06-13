<?php
class AccessView
{
    function showFormSession()
    {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - Manos Amor y Semilla</title>
        <link rel="shorcut icon" href="img/Logo_favicon.png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
        crossorigin="anonymous">
            
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
        crossorigin="anonymous"></script>

        
        <link href="assets/CSS/carousel.css" rel="stylesheet">
    </head>

    <body class="text-center" background="img/background_login.jpg" width="10" height="90">
        <header class='encabezado'>
            <header  class='encabezadoAdentro' class="py-3 mb-3 border-bottom">
                    </br>
                    </br>
                    </br>
                    <center>
                        <header class="cabezalTitulo">
                            <h1 class='tituloCuenta'>Mi Cuenta</h1>
                        </header>
                    </center>
                    
                
                <div id="menu" class='menu' class="px-3 py-2 bg-primary text-white">
                    <div class="container">
                        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                            <ul  class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 ">
                                <li>
                                    <a href="principal.php" class="nav-link text-white">
                                        <img class='imagenInicio' src="img/Icon_inicio.png" width="40px">Inicio
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
        </header>
            
                <main >
                    <div class="form-signin">
                        <!-- FPRMULARIO -->
                        <form  id="formLogin" method="POST" class="form">
                            <img class="mb-4" src="img/icon_user.png" alt="" width="136" height="130">
                            <h1 class="h3 mb-3 fw-normal">Iniciar sesión</h1>

                            <!-- DOCUMENTO -->
                            <div class="form-floating">
                                <input type="text" class="form-control" name="docUser" id="docUser" placeholder="Ingresar Documento">
                                <label for="floatingInput">Documento</label>  
                            </div>

                            <!-- CONTRASEÑA -->
                            <div class="form-floating">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Ingresar Contraseña">
                                <label for="floatingPassword">Contraseña</label>
                            </div>

                            <!-- ROL -->
                            <select class="form-select fieldlabels" id='role' name='role' aria-label="Default select example">
                                <option value="1">Administrador</option>
                                <option value="2">Secretaria</option>
                                <option value="3">Acudiente</option>
                                <option value="4">Estudiante</option>
                            </select>

                            <div class="checkbox mb-3">
                                <label>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col">
                                                <button class="d-block btn btn-primary mx-auto ingresar" type="submit">Ingresar</button>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </form>
                    </div>
                </main>    
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
        <script src="js/LoginV.js"></script>
    </body>
    </html>

<?php
    }
}
?>