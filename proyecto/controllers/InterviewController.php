<?php
require_once "models/InterviewModel.php";
require_once "views/InterviewView.php";

class InterviewController
{
    //Metodo para insertar un nuevo horario
    function insertSchedule()
    {
        //Obtener todos los atributos
        $date_sche = $_POST['date'];
        $id_hour_sche = $_POST['hour_sche'];

        $Connection = new Connection();
        $InterviewModel = new InterviewModel($Connection);

        $array_schedule = $InterviewModel->paginateSchedule();

        foreach ($array_schedule as $schedule)
        {
            $date_sche_d = $schedule->date_sche;
            $id_hour_sche_d = $schedule->id_hour_sche;

            //Saber si la fecha y hora que se esta ingresando ya esta asignado
            while ($date_sche == $date_sche_d && $id_hour_sche == $id_hour_sche_d)
            {
            $array_message = ['message' => 'Ya existe el horario'];
            exit(json_encode($array_message));
            }
        }
        
        //Saber que si se llenaron los campos
        if ($date_sche == "" || $id_hour_sche == "Seleccionar") 
        {
            $array_message = ['message' => 'Hay campos por llenar'];
            exit(json_encode($array_message));
        }             
         else {
            //Obtener los codigos en tipo numerico
            $id_hour_sche = intval($id_hour_sche);

            $InterviewModel->insertSchedule(
                $date_sche,
                $id_hour_sche
            );
        }

        $array_schedule = $InterviewModel->paginateSchedule();
        $array_hour = $InterviewModel->paginateHour();

        $array_interview = $InterviewModel->paginateIntervieTotal();

        $InterviewView = new InterviewView();
        $InterviewView->paginateFormSchedule($array_schedule, $array_hour, $array_interview);
    }
    //--------------------------------------------------------------------
    //MÉTODO QUE LISTA - (HORARIOS)
    function paginateFormSchedule()
    {
        $Connection = new Connection();
        $InterviewModel = new InterviewModel($Connection);

        $array_schedule = $InterviewModel->paginateSchedule2();
        $array_hour = $InterviewModel->paginateHour();

        $array_interview = $InterviewModel->paginateIntervieTotal();

        $InterviewView = new InterviewView();
        $InterviewView->paginateFormSchedule($array_schedule, $array_hour,$array_interview);
    }
    //--------------------------------------------------------------------
    //MÉTODO QUE ELIMINA - (HORARIOS)
    function deleteSchedule()
    {
        $id_sche = $_POST['id_sche'];

        $Connection = new Connection();
        $InterviewModel = new InterviewModel($Connection);

        $InterviewModel->deleteSchedule($id_sche);

        $array_schedule = $InterviewModel->paginateSchedule();
        $array_hour = $InterviewModel->paginateHour();
        $array_interview = $InterviewModel->paginateIntervieTotal();

        $InterviewView = new InterviewView();
        $InterviewView->paginateFormSchedule($array_schedule, $array_hour, $array_interview);
    }
      //--------------------------------------------------------------------
    //MÉTODO QUE ELIMINA - (HORARIOS)
    function cambiarEstadoInterview()
    {
        $id_user = $_POST['id_user'];

        $Connection = new Connection();
        $InterviewModel = new InterviewModel($Connection);

        $array_interview = $InterviewModel->paginateProcesoTotal_ver($id_user);

        $id_inter = $array_interview[0]->id_inter;
                        
        $InterviewModel->updateEstadoInterview($id_inter);

        require_once "models/UserModel.php";
        require_once "views/UserView.php";
        $Connection = new Connection();
        $UserModel = new UserModel($Connection);

        $array_user = $UserModel->selectUser($id_user);   
        $array_schedule = $InterviewModel->paginateSchedule();
        $array_hour = $InterviewModel->paginateHour();
        
        // Cargar y mostrar vistas
        $InterviewView = new InterviewView();
        $InterviewView->paginateSchedule($array_schedule, $array_hour, $array_user);
        
                        
    }

    function cancelarProceso()
    {
        $id_inter = $_POST['id_inter'];

        $Connection = new Connection();
        $InterviewModel = new InterviewModel($Connection);

        $array_procesoTotal = $InterviewModel->paginateProcesoTotal($id_inter);

        foreach($array_procesoTotal as $user)
        {
            $id_user_inter = $user->id_user_inter;
            $id_user = $user->id_user;
        }
        $InterviewModel->deleteInterview($id_inter);

        if($id_user_inter == $id_user) 
        {
            $InterviewModel->deleteUser($id_user);
            $response=array();
            session_destroy();
            $_SESSION = array();
    
            $response['message']="QUE TENGA UN BUEN DÍA";
    
            exit(json_encode($response));
        }    
    }
    //--------------------------------------------------------------------
    //Metodo para mostrar un horario
    function showSchedule()
    {
        $id_sche = $_POST['id_sche'];
    
        // Método para conectarme a la base de datos
        $Connection = new Connection();
        $InterviewModel = new InterviewModel($Connection);
    
        $schedule = $InterviewModel->selectSchedule($id_sche);
    
        foreach($schedule as $sc)
        {
            $array_interview2 = $InterviewModel->paginateSchedule2();
    
            $state_sche = $array_interview2[0]->state_sche; // Corregido: Eliminé el símbolo de dólar ($) redundante

            if ($state_sche == 'N') { // Corregido: Eliminé el símbolo de dólar ($) redundante
                $UserModel = new UserModel($Connection);

                $array_hour = $InterviewModel->paginateHour();
    
                // Cargar y mostrar vistas
                $InterviewView = new InterviewView();
                $InterviewView->showSchedule($schedule, $array_hour);
    
                break; // Salir del bucle foreach una vez que se ha mostrado el horario
            }
        
    }
    
    }
    //--------------------------------------------------------------------
    //Metodo para mostrar un horario
    function insertInterview()
    {
        // Verificar si los campos están definidos
        if (!isset($_POST['id_user']) || !isset($_POST['selectionInterview'])) {
            $array_message = ['message' => 'Hay campos por llenar'];
            exit(json_encode($array_message));
        }
    
        // Obtener los atributos
        $id_user = $_POST['id_user'];
        $id_sche = $_POST['selectionInterview'];
    
        $Connection = new Connection();
        $InterviewModel = new InterviewModel($Connection);
    
        $array_schedule = $InterviewModel->selectSchedule($id_sche);
    
        // Verificar si se llenaron los campos requeridos
        if ($id_sche == "") {
            $array_message = ['message' => 'Hay campos por llenar'];
            exit(json_encode($array_message));
        } else {
            // Obtener los códigos en tipo numérico
            $id_sche = intval($id_sche);
            $id_user = intval($id_user);
    
            $array_interview = $InterviewModel->paginateInterview();
            foreach($array_interview as $interview)
            {
                $id_user_inter = $interview->id_user_inter; // Corregido: Se utiliza $interview en lugar de $array_interview
            }
            
            if($id_user_inter > 0)
            {
                if ($id_user == $id_user_inter) // Corregido: Se utiliza el operador de comparación (==) en lugar del operador de asignación (=)
                {
                    $array_interview2 = $InterviewModel->paginateProcesoTotal_ver($id_user);
                    $state_inter = $array_interview2[0]->state_inter;

                    $InterviewModel->updateInterviewPendiente($state_inter);
                    $InterviewModel->updateScheduleState($id_sche);
                }
                else{  
                    $InterviewModel->insertInterview($id_sche, $id_user);
                }
            }else{
                $InterviewModel->insertInterview($id_sche, $id_user);
            }
           
        }
    
        $array_interview = $InterviewModel->paginateIntervieAcudiente();
    
        $InterviewView = new InterviewView();
        $InterviewView->paginateIntervieAcudiente($array_interview, $id_user);
    }
    
    

    //--------------------------------------------------------------------
    function updateSchedule(){
        //Obtener todos los atributos
        $id_sche = $_POST['id_sche'];
        $date_sche = $_POST['date'];
        $id_hour_sche = $_POST['hour_sche'];

        $Connection = new Connection();
        $InterviewModel = new InterviewModel($Connection);

        $array_schedule = $InterviewModel->paginateSchedule();
        foreach ($array_schedule as $schedule)
        {
            $date_sche_d = $schedule->date_sche;
            $id_hour_sche_d = $schedule->id_hour_sche;

            //Saber si la fecha y hora que se esta ingresando ya esta asignado
            while ($date_sche == $date_sche_d && $id_hour_sche == $id_hour_sche_d)
            {
            $array_message = ['message' => 'Ya existe el horario'];
            exit(json_encode($array_message));
            }
        }
        
        //Saber que si se llenaron los campos
        if ($date_sche == "" || $id_hour_sche == "Seleccionar") 
        {
            $array_message = ['message' => 'Hay campos por llenar'];
            exit(json_encode($array_message));
        } else {
            //Obtener los codigo en tipo numerico
            $id_hour_sche = intval($id_hour_sche);

            $InterviewModel->updateSchedule(
                $id_sche,
                $date_sche,
                $id_hour_sche
            );
        }

        $array_schedule = $InterviewModel->paginateSchedule();
        $array_hour = $InterviewModel->paginateHour();
        $array_interview = $InterviewModel->paginateIntervieTotal();

        $InterviewView = new InterviewView();
        $InterviewView->paginateFormSchedule($array_schedule, $array_hour, $array_interview);
    }
}
?>