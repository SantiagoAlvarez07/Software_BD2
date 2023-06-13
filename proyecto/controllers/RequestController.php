<?php
require_once "models/RequestModel.php";
require_once "views/RequestView.php";

class RequestController
{
    //Metodo para insertar un nuevo usuario
    function insertRequest()
    {
        //Obtener todos los atributos del ACUDIENTE
        $name_curr = $_POST['name_curr'];
        $last_name_curr = $_POST['last_name_curr'];
        $id_doct_curr = $_POST['documentType_curr'];
        $document_curr = $_POST['document_curr'];
        $phone_curr = $_POST['phone_curr'];
        $email_curr = $_POST['email_curr'];

        //Obtener todos los atributos del ASPIRANTE
        $name_stud = $_POST['name_stud'];
        $last_name_stud = $_POST['last_name_stud'];
        $id_doct_stud = $_POST['documentType_stud'];
        $document_stud = $_POST['document_stud'];
        $id_grade_stud = $_POST['grade_stud'];
        $condition_stud = $_POST['condition_stud'];
        $file = $_FILES['condition_document_stud'];

        // Obtener la información del archivo
        $fileName = $file['name'];
        $fileTmpPath = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileType = $file['type'];

        // Obtener la extensión del archivo
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $Connection = new Connection();
        $RequestModel = new RequestModel($Connection);

        //Validar si el documento que se esta ingresando ya le pertenece a una persona
        $array_email_curr = $RequestModel->duplicateEmailCurrent($email_curr);
        $array_document_stud = $RequestModel->duplicateDocumentStudent($document_stud);
        $array_document_curr = $RequestModel->duplicateDocumentCurrent($document_curr);

        //Saber que si se llenaron los campos
        if (
            $name_curr == "" || $last_name_curr == "" || $id_doct_curr == "Tipo de documento" ||
            $document_curr == "" || $phone_curr == "" || $email_curr == "" ||
            
            $name_stud == "" || $last_name_stud == "" || $id_doct_stud == "Tipo de documento" ||
            $document_stud == "" || $id_grade_stud == "Grado a cursar" || $condition_stud == "Seleccionar" /*||
            $condition_document_stud == "Seleccionar archivo"*/ 
        ) 
        {
            $array_message = ['message' => 'Hay campos por llenar'];
            exit(json_encode($array_message));

            //Validar que el numero de documento sea numerico y de 10 digitos
        } else if (!(ctype_digit($document_curr)) || strlen($document_curr) < 8) {
            $array_message = ['message' => 'Error en el numero de documento'];
            exit(json_encode($array_message));

            //Saber si el documento que se esta ingresando ya esta asignado
        }  else if ($array_document_stud) {
            $array_message = ['message' => 'Ya existe un aspirante con ese documento'];
            exit(json_encode($array_message));

        } else if ($array_email_curr) {
            $array_message = ['message' => 'Ya existe un acudiente con ese correo'];
            exit(json_encode($array_message));
            
        } else if($fileExtension !== 'pdf'){
                // Verificar si el archivo es un PDF
                $array_message = ['message' => 'El archivo debe ser en formato PDF'];
                exit(json_encode($array_message));
        } else {
            // Definir la carpeta de destino para guardar el archivo
            $targetDirectory = 'files/condition/condition_';

            // Generar un nombre único para el archivo
            $uniqueFileName = uniqid('file_') . '.' . $fileExtension;

            // Construir la ruta completa del archivo de destino
            $targetFilePath = $targetDirectory . $uniqueFileName;

            // Mover el archivo a la carpeta de destino
            if (!move_uploaded_file($fileTmpPath, $targetFilePath)) {
                $array_message = ['message' => 'Error al cargar el archivo'];
                exit(json_encode($array_message));
            }


            //Obtener los codigo en tipo numerico
            $id_doct_curr = intval($id_doct_curr);

            $id_doct_stud = intval($id_doct_stud);
            $id_grade_stud = intval($id_grade_stud);

            $RequestModel->insertCurrent(
                $name_curr,
                $last_name_curr,
                $document_curr,
                $email_curr,
                $phone_curr,
                $id_doct_curr
            );

            if($condition_stud == 1)
            {
                $condition_stud = 'Y';
            }else{
                $condition_stud = 'N';
            }

            $RequestModel->insertStudent(
                $name_stud,
                $last_name_stud,
                $document_stud,
                $condition_stud,
                $targetFilePath,
                $id_grade_stud,
                $id_doct_stud
            );

            $RequestModel->insertRequest();
        }
        
        $array_RequestCurrent = $RequestModel->paginateRequestCurrent();

        $RequestView = new RequestView();
        $RequestView->paginateRequestCurrent($array_RequestCurrent);
    }
    //------------------------------------------------------------------
    //MÉTODO QUE LISTA - (SOLICITUDES)
    function paginateRequest()
    {
        $Connection = new Connection();
        $RequestModel = new RequestModel($Connection);

        $array_RequestTotal = $RequestModel->paginateRequestTotal();
        $array_RequestCancel = $RequestModel->paginateRequestCancel2();
        $array_RequestAcept = $RequestModel->paginateRequestAcept();

        $RequestView = new RequestView();
        $RequestView->paginateRequest($array_RequestTotal, $array_RequestCancel, $array_RequestAcept);
    }
    //------------------------------------------------------------------
    //MÉTODO QUE LISTA - (SOLICITUDES)
    function paginateRequest_a()
    {
        $Connection = new Connection();
        $RequestModel = new RequestModel($Connection);

        $array_RequestCurrent = $RequestModel->paginateRequestCurrent();

        $RequestView = new RequestView();
        $RequestView->paginateRequestCurrent($array_RequestCurrent);
    }
    //------------------------------------------------------------------
    //MÉTODO QUE MUESTRA INFORMACIÓN - (SOLICITAR CUPO)
    function paginateRequestSpace()
    {
        $Connection = new Connection();
        $RequestModel = new RequestModel($Connection);

        $RequestView = new RequestView();
        $RequestView->paginateRequestSpace();
    }
    //------------------------------------------------------------------
    //MÉTODO QUE LISTA - (SOLICITUD ACUDIENTE)
    function paginateRequestSpaceCurrent()
    {
        $Connection = new Connection();
        $RequestModel = new RequestModel($Connection);

        $array_Request = $RequestModel->paginateRequest();

        $RequestView = new RequestView();
        $RequestView->paginateRequestSpaceCurrent($array_Request);
    }
    //------------------------------------------------------------------
    function cancelRequest()
    {
        $id_req = $_POST['id_req'];

        $Connection = new Connection();
        $RequestModel = new RequestModel($Connection);

        $array_Request = $RequestModel->paginateRequestTotal2($id_req);
        foreach ($array_Request as $recuest)
        {
            $id_curr = $recuest->id_curr;
            $id_stud = $recuest->id_stud;
        }
        //$RequestModel->cancelRequest($id_req);
        $RequestModel->deleteRequest($id_req);
        //$RequestModel->deleteCuerrent($id_curr);
        //$RequestModel->deleteStudent($id_stud);

        $RequestView = new RequestView();
        $RequestView->paginateRequestSpace();
    }
    //------------------------------------------------------------------
    function showFormRequest()
    {
        $Connection = new Connection();
        $RequestModel = new RequestModel($Connection);

        $arrayDocumentType = $RequestModel->paginateDocumentType();
        $arrayGrade = $RequestModel->paginateGrade();

        $RequestView = new RequestView();
        $RequestView->showFormRequest($arrayDocumentType, $arrayGrade);
    }

    function showModificarRequest()
    {
        //Obtener todos los atributos
        $id_req = $_POST['id_req'];

        $Connection = new Connection();
        $RequestModel = new RequestModel($Connection);

        $array_request = $RequestModel->selectRequest($id_req);

        $RequestView = new RequestView();
        $RequestView->showModificarRequest($array_request);
    }

    function updateRequest_Acu(){
        //Obtener todos los atributos
        $id_req = $_POST['id_req'];
        $observation_req = $_POST['observation_req'];

        $Connection = new Connection();
        $RequestModel = new RequestModel($Connection);

        $array_consultarRequestTotal = $RequestModel->modificarPaginateRequestCurrent();
        $array_Request = $RequestModel->paginateRequestCurrent();

        foreach ($array_Request as $recuest)
        {
            $state_req = $recuest->state_req;
        }

        foreach ($array_consultarRequestTotal as $recuest)
        {
            $observation_req_T = $recuest->observation_req;

            //Saber si la fecha y hora que se esta ingresando ya esta asignado
            while ($observation_req_T == $observation_req)
            {
                $array_message = ['message' => 'No ha hecho modificaciones'];
                exit(json_encode($array_message));
            }
            
        }
        
        //Saber que si se llenaron los campos
        if ($observation_req == "Sin Observation") 
        {
            $array_message = ['message' => 'No ha hecho modificaciones'];
            exit(json_encode($array_message));
        } else {

            $RequestModel->updateRequest_Acu(
                $id_req,
                $observation_req,
                $state_req
            );
        }

        $array_RequestTotal = $RequestModel->paginateRequestTotal();
        $array_RequestCancel = $RequestModel->paginateRequestCancel();
        $array_RequestAcept = $RequestModel->paginateRequestAcept();

        $RequestView = new RequestView();
        $RequestView->paginateRequest($array_RequestTotal, $array_RequestCancel, $array_RequestAcept);
    }
}
?>