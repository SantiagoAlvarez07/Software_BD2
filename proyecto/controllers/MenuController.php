<?php
require_once "views/MenuView.php";
require_once "models/MenuModel.php";

class MenuController 
{ 
    // FUNCIÓN QUE MUESTRA - (MENÚ DE USUARIOS)
    function validateMenu()
    {
        // Verificar el rol del usuario
        if ($_SESSION['id_role_user'] === '1') {
            // Mostrar vista para el rol de administrador
            $Connection = new Connection();
            $MenuModel = new MenuModel($Connection);
        
            $user = $MenuModel->listUser($_SESSION["id_user"]);
            $num_register = $MenuModel->numRegister()[0]->count;
            $num_register_req = $MenuModel->numRegister_req()[0]->count;

            $MenuView = new MenuView();  
            $MenuView->showMenuAdmin($user,$num_register, $num_register_req);
        } elseif ($_SESSION['id_role_user'] === '2') {
            // Mostrar vista para el rol de usuario
            $Connection = new Connection();
            $MenuModel = new MenuModel($Connection);
        
            $user = $MenuModel->listUser($_SESSION["id_user"]);
            $num_register = $MenuModel->numRegister()[0]->count;
            $num_register_req = $MenuModel->numRegister_req()[0]->count;

            $MenuView = new MenuView();  
            $MenuView->showMenuSecretaria($user,$num_register, $num_register_req);
        }elseif ($_SESSION['id_role_user'] === '3') {
            // Mostrar vista para el rol de usuario
            $Connection = new Connection();
            $MenuModel = new MenuModel($Connection);
        
            $user = $MenuModel->listUser($_SESSION["id_user"]);
            $num_register = $MenuModel->numRegister()[0]->count;
            $num_register_req = $MenuModel->numRegister_req()[0]->count;

            $MenuView = new MenuView();  
            $MenuView->showMenuAcudiente($user,$num_register, $num_register_req);
        }
    }

    //MÉTODO QUE MUESTRA - (FORMULARIO - NUEVO USUARIO)
    function showManual()
    {
        require_once "views/UserView.php";
        $UserView = new UserView();
        $UserView->showManual();
    }

    //MÉTODO QUE MUESTRA - (FORMULARIO - NUEVO USUARIO)
    function showHome()
    {
        $Connection = new Connection();
        $MenuModel = new MenuModel($Connection);
        
        $num_register = $MenuModel->numRegister()[0]->count;
        $num_register_req = $MenuModel->numRegister_req()[0]->count;

        $MenuView = new MenuView();  
        $MenuView->showHome($num_register, $num_register_req);
    
    }


}
?>