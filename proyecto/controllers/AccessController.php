<?php
require_once "models/AccessModel.php";
require_once "views/AccessView.php";

class AccessController
{
    //FUNCIÓN QUE MUESTRA - (LOGIN)
    function validateClient()
    {
        $AccessView = new AccessView(); //CREA - *OBJETO* VISTA (LOGIN)
        $AccessView->showFormSession(); //MUESTRA - (LOGIN)
    }
    //---------------------------------------------------------------//
    //FUNCIÓN QUE VALIDA LOS DATOS - *LOGIN*
    function validateFormSession($array)
    {
        $document = $array['docUser']; //TOMA - CÓDIGO (LOGIN)
        $password = $array['password']; //TOMA - CONTRASEÑA (LOGIN)
        $role = $array['role']; //TOMA - ROL (LOGIN)
        
            //CREA - CONEXIÓN
            $Connection = new Connection(); 
            $AccessModel = new AccessModel($Connection); //CREA - ACCES MODEL

            //OBTIENE RESULTADO DE CONSULTA - POR ACCESS MODEL
            $array_access = $AccessModel->validateFormSession($document,$password,$role);
            
            if($array_access[0]->document_user = $document && $array_access[0]->password_user = $password)
            {
                if ($array_access[0]->state_user = 'Y') 
                {
                    $_SESSION['id_user'] = $array_access[0]->id_user;
                    $_SESSION['id_role_user'] = $array_access[0]->id_role_user;
                    $_SESSION['auth'] = 'OK';
                    /*
                    if ($role == '1') {
                        // Mostrar vista para el rol de administrador
                        // Ejemplo:
                        require_once "views/AdminView.php";
                        require_once "models/AccessModel.php";
                        require_once "views/AccessView.php";
                        $AdminView = new AdminView();
                        $AdminView->showAdminPage();
                    } elseif ($role == '2') {
                        // Mostrar vista para el rol de secretaria
                        // Ejemplo:
                        require_once "views/UserView.php";
                        $UserView = new UserView();
                        $UserView->showUserPage();
                    }*/
                }
            }
            header('location:index.php');
        
    }
//-------------------------------------------------------------------//
    //FUNCIÓN QUE CIERRA - SESION
    function closeSession()
    {
        $response=array();

        session_unset();
        session_destroy();
        $_SESSION = array();

        $response['message']="QUE TENGA UN BUEN DÍA";

        exit(json_encode($response));
    }
}
?>