<?php
require_once "models/UserModel.php";
require_once "views/UserView.php";
require 'files/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use Dompdf\Dompdf;

class UserController
{
    //Metodo para insertar un nuevo usuario
    function insertUser()
    {
        //Obtener todos los atributos
        $name_user = $_POST['nombre'];
        $last_name_user = $_POST['apellido'];
        $id_doct_user = $_POST['tipo_documento'];
        $document_user = $_POST['documento'];
        $email_user = $_POST['email'];
        $password_user = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        $state_user = $_POST['estado'];
        $id_role_user = $_POST['rol'];


        $Connection = new Connection();
        $UserModel = new UserModel($Connection);

        //Validar si el documento que se esta ingresando ya le pertenece a una persona
        $array_documento = $UserModel->duplicateDocumento($document_user);
        $array_email = $UserModel->duplicateEmail($email_user);

        //Saber que si se llenaron los campos
        if (
            $name_user == "" || $last_name_user == "" || $id_doct_user == "Seleccionar" ||
            $document_user == "" || $email_user == "" || $password_user == "" || $confirmPassword == "" ||
            $state_user == 'Seleccionar' || $id_role_user == "Seleccionar"
        ) 
        {

            $array_message = ['message' => 'Hay campos por llenar'];
            exit(json_encode($array_message));

            //Validar que el numero de documento sea numerico y de 10 digitos
        } else if (!(ctype_digit($document_user)) || strlen($document_user) < 8) {
            $array_message = ['message' => 'Error en el numero de documento'];
            exit(json_encode($array_message));

            //Validar que las dos contraseñas coincidan    
        } else if ($password_user != $confirmPassword) {
            $array_message = ['message' => 'Las contraseñas no coinciden'];
            exit(json_encode($array_message));

            //Saber si el documento que se esta ingresando ya esta asignado
        } else if ($array_documento) {
            $array_message = ['message' => 'Ya existe un usuario con ese documento'];
            exit(json_encode($array_message));
            //Saber si el correo que se esta ingresando ya esta asignado
        } else if ($array_email) {
            $array_message = ['message' => 'Ya existe alguien con ese correo'];
            exit(json_encode($array_message));
        } else {
            // Encriptar la contraseña
$hashed_password = password_hash($password_user, PASSWORD_DEFAULT);

            //Obtener los codigo en tipo numerico
            $id_role_user = intval($id_role_user);
            $id_doct_user = intval($id_doct_user);

            $UserModel->insertUser(
                $name_user,
                $last_name_user,
                $id_role_user,
                $id_doct_user,
                $document_user,
                $hashed_password, // Utilizar la contraseña encriptada
                $email_user,
                $state_user
            );
        }

        $array_user = $UserModel->paginateUser();
        $UserView = new UserView();
        $UserView->paginateUsers($array_user);
    }

    //Metodo para insertar un acceso
    function insertHistorialAccesos($array)
    {
        //Obtener todos los atributos
        $nombre_user = 'hola';
        $apellido_user = 'beto';
        $documento_user = $array['docUser'];
        $id_rol = $array['rol'];

        $Connection = new Connection();
        $UserModel = new UserModel($Connection);

        //Obtener los codigo en tipo numerico
        $id_rol = intval($id_rol);

        $UserModel->insertHistorialAccesos(
            $nombre_user,
            $apellido_user,
            $documento_user,
            $id_rol 
        );

        $array_historialAccesos = $UserModel->paginateHistorialAccesos();

        $UserView = new UserView();
        $UserView->paginateHistorialAccesos($array_historialAccesos);
    }

    //MÉTODO QUE LISTA - (USUARIOS)
    function paginateUsers()
    {
        $Connection = new Connection();
        $UserModel = new UserModel($Connection);

        $array_user = $UserModel->paginateUser();
        //$array_estado = $UserModel->paginateEstado();
        $this->tableData = $array_user;

        $UserView = new UserView();
        $UserView->paginateUsers($array_user);
    }

    //MÉTODO QUE LISTA - (USUARIOS)
    function generarPDF2()
    {
        $Connection = new Connection();
        $UserModel = new UserModel($Connection);

        $array_user = $UserModel->paginateUser();

        $UserView = new UserView();
        $UserView->generatePDF2($array_user);
    }


    function generatePDF()
    {
        $Connection = new Connection();
        $UserModel = new UserModel($Connection);
    
        $array_user = $UserModel->paginateUser();
    
        // Verificar si el archivo PDF ya existe
        $pdfPath = 'files/reportes/pdf/usuarios.pdf';
        if (file_exists($pdfPath)) {
            $response = [
                'exists' => true,
                'message' => 'El archivo PDF ya existe.'
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
            return;
        }
    
        // Crear una instancia de FPDF
        require('fpdf185/fpdf.php');
        $pdf = new FPDF('L'); // 'L' para orientación horizontal
    
        // Agregar una página al PDF
        $pdf->AddPage();
    
        // Configurar la fuente y el tamaño del texto
        $pdf->SetFont('Arial', 'B', 12);
    
        // Agregar encabezados de columna
        $pdf->Cell(30, 10, 'ID Usuario', 1);
        $pdf->Cell(40, 10, 'Documento', 1);
        $pdf->Cell(100, 10, 'Nombre', 1);
        $pdf->Cell(30, 10, 'Estado', 1);
        $pdf->Cell(50, 10, 'Cargo', 1);
        $pdf->Ln();
    
        // Agregar filas de datos
        foreach ($array_user as $user) {
            $pdf->Cell(30, 10, $user->id_user, 1);
            $pdf->Cell(40, 10, $user->document_user, 1);
            $pdf->Cell(100, 10, $user->name_user . ' ' . $user->last_name_user, 1);
            $pdf->Cell(30, 10, ($user->state_user == 'Y') ? 'Activo' : 'Inactivo', 1);
            $pdf->Cell(50, 10, ($user->id_role_user == '1') ? 'Administrador' : 'Secretaria', 1);
            $pdf->Ln();
        }
    
        // Salida del PDF
        $pdf->Output($pdfPath, 'F');
    
        $response = [
            'exists' => false,
            'message' => 'Archivo PDF generado y guardado con éxito.'
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    
    
    public function generateExcel()
    {
        $Connection = new Connection();
        $UserModel = new UserModel($Connection);
    
        $array_user = $UserModel->paginateUser();
    
        // Verificar si el archivo Excel ya existe
        $excelPath = 'files/reportes/excel/usuarios.xlsx';
        if (file_exists($excelPath)) {
            $response = [
                'exists' => true,
                'message' => 'El archivo Excel ya existe.'
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
            return;
        }
    
        // Preparar los datos de la tabla en un formato adecuado para JSON
        $tableData = [];
        foreach ($array_user as $user) {
            $rowData = [
                'id_user' => $user->id_user,
                'document_user' => $user->document_user,
                'name_user' => $user->name_user . ' ' . $user->last_name_user,
                'state_user' => ($user->state_user == 'Y')? 'Activo' : 'Inactivo',
                'id_role_user' => ($user->id_role_user == '1') ? 'Administrador' : 'Secretaria'
            ];
            $tableData[] = $rowData;
        }
    
        // Crear un nuevo objeto Spreadsheet
        $spreadsheet = new Spreadsheet();
    
        // Seleccionar la hoja activa del archivo Excel
        $sheet = $spreadsheet->getActiveSheet();
    
        // Escribir los encabezados de las columnas
        $sheet->setCellValue('A1', 'ID Usuario');
        $sheet->setCellValue('B1', 'Documento');
        $sheet->setCellValue('C1', 'Nombre');
        $sheet->setCellValue('D1', 'Estado');
        $sheet->setCellValue('E1', 'Cargo');
    
        // Escribir los datos de los usuarios en el archivo Excel
        $row = 2;
        foreach ($tableData as $userData) {
            $sheet->setCellValue('A' . $row, $userData['id_user']);
            $sheet->setCellValue('B' . $row, $userData['document_user']);
            $sheet->setCellValue('C' . $row, $userData['name_user']);
            $sheet->setCellValue('D' . $row, $userData['state_user']);
            $sheet->setCellValue('E' . $row, $userData['id_role_user']);
    
            $row++;
        }
    
        // Crear un objeto Writer para guardar el archivo Excel
        $writer = new Xlsx($spreadsheet);
    
        // Guardar el archivo Excel en la ubicación seleccionada
        $writer->save($excelPath);
    
        $response = [
            'exists' => false,
            'message' => 'Archivo Excel generado y guardado con éxito.'
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    
    


    //MÉTODO QUE MUESTRA AUDITORIA DE ACCESOS
    function paginateHistorialAccesos()
    {
        $Connection = new Connection();
        $UserModel = new UserModel($Connection);

        $array_historialAccesos = $UserModel->paginateHistorialAccesos();

        $UserView = new UserView();
        $UserView->paginateHistorialAccesos($array_historialAccesos);
    }

    //MÉTODO QUE MUESTRA - (FORMULARIO - NUEVO USUARIO)
    function showFormUser()
    {
        $Connection = new Connection();
        $UserModel = new UserModel($Connection);

        $arrayTypeDocument = $UserModel->paginateDocumentType();
        $arrayRol = $UserModel->paginateRol();

        $UserView = new UserView();
        $UserView->showFormUser($arrayTypeDocument, $arrayRol);
    }

    

    //Metodo para mostrar un usuario
    function showUser(){

        $id_user = $_POST['id_user'];

        //Metodo para conectarme a la base de datos
        $Connection = new Connection();
        $UserModel = new UserModel($Connection);

        $user = $UserModel->selectUser($id_user);
        $array_rol = $UserModel->paginateRol();
        $array_type_document = $UserModel->paginateDocumentType();

        //Cargar y mostrar vistas
        $UserView = new UserView();
        $UserView->showUser($user, $array_type_document, $array_rol);

    }

    function updateUser(){
        //Obtener todos los atributos
       $id_user = $_POST['id_user'];
       $name_user = $_POST['nombre'];
       $last_name_user = $_POST['apellido'];
       $id_doct_user = $_POST['tipo_documento'];
       $document_user = $_POST['documento'];
       $email_user = $_POST['email'];
       $password_user = $_POST['password'];
       $confirmPassword = $_POST['confirmPassword'];
       $state_user = $_POST['estado'];
       $id_role_user = $_POST['rol'];



        $Connection = new Connection();
        $UserModel = new UserModel($Connection);

        //Validar si el documento que se esta ingresando ya le pertenece a una persona
        $array_documento = $UserModel->duplicateDocumentoUpdate($document_user, $id_user);
        $array_email = $UserModel->duplicateEmailUpdate($email_user, $id_user);

        //Saber que si se llenaron los campos
        if (
            $name_user == "" || $last_name_user == "" || $id_doct_user == "Seleccionar" ||
            $document_user == "" || $email_user == "" || $password_user == "" || $confirmPassword == "" ||
            $state_user == 'Seleccionar' || $id_role_user == "Seleccionar"
        ) 
        {

            $array_message = ['message' => 'Hay campos por llenar'];
            exit(json_encode($array_message));

            //Validar que el numero de documento sea numerico y de 10 digitos
        } else if (!(ctype_digit($document_user)) || strlen($document_user) < 8) {
            $array_message = ['message' => 'Error en el numero de documento'];
            exit(json_encode($array_message));

            //Validar que las dos contraseñas coincidan    
        } else if ($password_user != $confirmPassword) {
            $array_message = ['message' => 'Las contraseñas no coinciden'];
            exit(json_encode($array_message));

            //Saber si el documento que se esta ingresando ya esta asignado
        } else if ($array_documento) {
            $array_message = ['message' => 'Ya existe un usuario con ese documento'];
            exit(json_encode($array_message));
            //Saber si el correo que se esta ingresando ya esta asignado
        } else if ($array_email) {
            $array_message = ['message' => 'Ya existe alguien con ese correo'];
            exit(json_encode($array_message));
        } else {
            //Obtener los codigo en tipo numerico
            $id_role_user = intval($id_role_user);
            $id_doct_user = intval($id_doct_user);
            $id_user = intval($id_user);
    
                $UserModel->updateUser(
                    $id_user,
                    $name_user,
                    $last_name_user,
                    $id_role_user,
                    $id_doct_user,
                    $document_user,
                    $password_user,
                    $email_user,
                    $state_user
                );
        }

        $array_user = $UserModel->paginateUser();
        $UserView = new UserView();
        $UserView->paginateUsers($array_user);
    }
    //--------------------------------------------------------------------
    //MÉTODO QUE LISTA - (HORARIOS)
    function paginateProcessPosition()
    {
        require_once "models/RequestModel.php";
        require_once "views/RequestView.php";
    
        $id_user = $_POST['id_user'];
    
        $Connection = new Connection();
        $UserModel = new UserModel($Connection);
    
        $array_position = $UserModel->validatePosition($id_user);
    
        if ($array_position[0]->id_pos_user === '2') {
            require_once "models/InterviewModel.php";
            require_once "views/InterviewView.php";
    
            $Connection = new Connection();
            $InterviewModel = new InterviewModel($Connection);
    
            $array_interview = $InterviewModel->paginateProcesoTotal_ver($id_user);
    
            if (!empty($array_interview)) {
                $array_interview = $InterviewModel->paginateIntervieAcudiente();
            
                $InterviewView = new InterviewView();
                $InterviewView->paginateIntervieAcudiente($array_interview, $id_user);
            }else {
                $array_interview2 = $InterviewModel->paginateSchedule2();
    
                $state_sche = $array_interview2[0]->state_sche;
    
                if ($state_sche == 'N') {
                    $UserModel = new UserModel($Connection);
    
                    $array_user = $UserModel->selectUser($id_user);
                    $array_schedule = $InterviewModel->paginateSchedule();
                    $array_hour = $InterviewModel->paginateHour();
    
                    // Cargar y mostrar vistas
                    $InterviewView = new InterviewView();
                    $InterviewView->paginateSchedule($array_schedule, $array_hour, $array_user);
                }
            }
        }
    }
    
    
    

    function paginateProcessPosition_A()
    {
        require_once "models/RequestModel.php";
        require_once "views/RequestView.php";

        $Connection = new Connection();
        $RequestModel = new RequestModel($Connection);

        $array_request = $RequestModel->paginateRequestCurrent();

        if (empty($array_request)) {
            $Connection = new Connection();
            $RequestModel = new RequestModel($Connection);

            $RequestView = new RequestView();
            $RequestView->paginateRequestSpace();
        } else {
            $Connection = new Connection();

            $array_RequestCurrent = $RequestModel->paginateRequestCurrent();

            foreach ($array_RequestCurrent as $request)
            {
                $state_req = $request->state_req;

                if ($state_req == 'C')
                {
                    $RequestView = new RequestView();
                    $RequestView->paginateRequestSpace();
                }else{
                    if ($state_req == 'N')
                    {
                        $array_request = $RequestModel->paginateRequestCurrent();
                        $RequestView = new RequestView();
                        $RequestView->paginateRequestCurrent_mod($array_RequestCurrent);
                    }else{
                            if ($state_req == 'Y')
                        {
                            $array_request = $RequestModel->paginateRequestCurrent();
                            $RequestView = new RequestView();
                            $RequestView->paginateRequestCurrent_acep($array_RequestCurrent);
                        }else{
                            $array_request = $RequestModel->paginateRequestCurrent();
                            $RequestView = new RequestView();
                            $RequestView->paginateRequestCurrent($array_RequestCurrent);
                        }
                    }
                }
            }
        }
    }

        //Metodo para insertar un nuevo usuario
        function insertUserAcudiente()
        {
            //Obtener todos los atributos
            $id_curr = $_POST['id_curr'];

            require_once "models/RequestModel.php";
            require_once "views/RequestView.php";
    
            $Connection = new Connection();
            $RequestModel = new RequestModel($Connection);

            $array_request = $RequestModel->paginateConsultarAcudiente($id_curr);
            
    
            require_once "models/RequestModel.php";
            require_once "views/RequestView.php";

            $Connection = new Connection();
            $RequestModel = new RequestModel($Connection);

            foreach ($array_request as $request) {
                $name_curr = $request->name_curr;
                $last_name_curr = $request->last_name_curr;
                $document_curr = $request->document_curr;
                $email_curr = $request->email_curr;
                $id_doct_curr = $request->id_doct_curr;
                $id_role_curr = $request->id_role_curr;

                $array_req = $RequestModel->paginateConsultarAcudiente_p($id_curr);

                foreach ($array_req as $req) {
                    $document_stud = $req->document_stud;
                }

                $Connection = new Connection();
                $UserModel = new UserModel($Connection);

                $id_doct_curr = intval($id_doct_curr);
                $id_role_curr = intval($id_role_curr);

                $UserModel->insertUserAcudiente(
                    $name_curr,
                    $last_name_curr,
                    $document_curr,
                    $document_stud,
                    $email_curr,
                    $id_doct_curr,
                    $id_role_curr
                );

                $array_request_Acu = $RequestModel->paginateConsultarAcudiente_acept($id_curr);

                foreach ($array_request_Acu as $req) {
                    $id_req = $req->id_req;
                }

                $RequestModel->aceptRequest($id_req);
            }
            $array_RequestTotal = $RequestModel->paginateRequestTotal();
        $array_RequestCancel = $RequestModel->paginateRequestCancel2();
        $array_RequestAcept = $RequestModel->paginateRequestAcept();

        $RequestView = new RequestView();
        $RequestView->paginateRequest($array_RequestTotal, $array_RequestCancel, $array_RequestAcept);
    
        }
    
}
?>