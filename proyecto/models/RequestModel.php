<?php
class RequestModel
{
    private $Connection;
    
    //Metodo constrcutor
    function __construct($Connection) {
        $this->Connection = $Connection;
    }


    //Metodo para insertar un ACUDIENTE
    function insertCurrent($name_curr,$last_name_curr,$document_curr,$email_curr,$phone_curr,$id_doct_curr)
    {
        $sql = "INSERT INTO SIMAT_MASS.CURRENT(id_curr,name_curr,last_name_curr,document_curr,email_curr,phone_curr,id_doct_curr,id_role_curr)
        VALUES (DEFAULT,'$name_curr','$last_name_curr','$document_curr','$email_curr','$phone_curr', $id_doct_curr, DEFAULT)";
        $this->Connection->query($sql);
    }

    //Metodo para insertar un ASPIRANTE
    function insertStudent($name_stud,$last_name_stud,$document_stud,$condition_stud,$targetFilePath,$id_grade_stud,$id_doct_stud)
    {
        $sql = "INSERT INTO SIMAT_MASS.STUDENT(id_stud,name_stud,last_name_stud,document_stud,condition_stud,condition_document_stud,id_grade_stud,id_doct_stud,id_role_stud)
        VALUES (DEFAULT,'$name_stud','$last_name_stud','$document_stud','$condition_stud','$targetFilePath', $id_grade_stud, $id_doct_stud, DEFAULT)";
        $this->Connection->query($sql);
    }

    //Metodo para insertar una SOLICITUD
    function insertRequest()
    {
        $sql = "INSERT INTO SIMAT_MASS.REQUEST(id_req,id_curr_req,id_stud_req,state_req,registration_req,admission_req,observation_req)
        VALUES (DEFAULT,DEFAULT,DEFAULT,DEFAULT,DEFAULT,DEFAULT,DEFAULT)";
        $this->Connection->query($sql);
    }
    //------------------------------------------------------------------
    //Metodo para insertar una SOLICITUD
    /*function cancelRequest($id_req)
    {
        $sql = "UPDATE SIMAT_MASS.REQUEST   
        SET state_req = 'C'
        WHERE id_req = '$id_req'";
        $this->Connection->query($sql);
    }*/
    function deleteRequest($id_req)
    {
        $sql = "DELETE FROM SIMAT_MASS.REQUEST 
        WHERE id_req = $id_req";
        $this->Connection->query($sql);
    }
    /*function deleteCuerrent($id_curr)
    {
        $sql = "DELETE FROM SIMAT_MASS.CURRENT
        WHERE id_curr = $id_curr";
        $this->Connection->query($sql);
    }
    function deleteStudent($id_stud)
    {
        $sql = "DELETE FROM SIMAT_MASS.STUDENT
        WHERE id_stud = $id_stud";
        $this->Connection->query($sql);
    }*/
    //------------------------------------------------------------------
    //Metodo para insertar una SOLICITUD
    function aceptRequest($id_req)
    {
        $sql = "UPDATE SIMAT_MASS.REQUEST   
        SET state_req = 'Y'
        WHERE id_req = '$id_req'";
        $this->Connection->query($sql);
    }
    //------------------------------------------------------------------
    function updateUser($id_user,$nombre_user,$apellido_user,$id_rol,$id_tdoc,$documento_user,$password_user,$email_user,$id_estado)
    {
        $sql = "UPDATE SIMAT_MAS.USUARIOS
        SET nombre_user = '$nombre_user', apellido_user = '$apellido_user',
        id_rol = '$id_rol', id_tdoc = '$id_tdoc', documento_user = '$documento_user',
        password_user = '$password_user', email_user = '$email_user', id_estado = '$id_estado' 
        WHERE id_user = '$id_user'";
        $this->Connection->query($sql);
    }
    //------------------------------------------------------------------
    function updateRequest_Acu($id_req, $observation_req, $state_req)
    {
        $sql = "UPDATE SIMAT_MASS.REQUEST
        SET observation_req = '$observation_req', state_req = 'N'
        WHERE id_req = '$id_req'";
        $this->Connection->query($sql);
    }
    //------------------------------------------------------------------
    function paginateRequestTotal()
    {
        $sql = "SELECT r.id_req, c.name_curr, c.last_name_curr,
                        s.name_stud, s.last_name_stud, 
                        c.document_curr, s.document_stud, c.phone_curr, s.id_grade_stud, 
                        s.condition_stud, r.state_req, c.id_curr, r.observation_req

        FROM SIMAT_MASS.CURRENT c INNER JOIN SIMAT_MASS.REQUEST r
        ON (c.id_curr=r.id_curr_req)
        INNER JOIN SIMAT_MASS.STUDENT s
        ON (r.id_stud_req=s.id_stud)
        WHERE r.state_req = 'P' or r.state_req = 'N'";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    function paginateRequestTotal2($id_req)
    {
        $sql = "SELECT r.id_req, c.name_curr, c.last_name_curr,
                        s.name_stud, s.last_name_stud, 
                        c.document_curr, s.document_stud, c.phone_curr, s.id_grade_stud, 
                        s.condition_stud, r.state_req, c.id_curr, r.observation_req, s.id_stud

        FROM SIMAT_MASS.CURRENT c INNER JOIN SIMAT_MASS.REQUEST r
        ON (c.id_curr=r.id_curr_req)
        INNER JOIN SIMAT_MASS.STUDENT s
        ON (r.id_stud_req=s.id_stud)
        WHERE r.id_req = $id_req";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    //-----------------------------------------------------------------
    function paginateRequestCancel()
    {
        $sql = "SELECT r.id_req, c.name_curr, c.last_name_curr,
                        s.name_stud, s.last_name_stud, 
                        c.document_curr, s.document_stud, c.phone_curr, s.id_grade_stud, 
                        s.condition_stud, r.state_req

        FROM SIMAT_MASS.CURRENT c INNER JOIN SIMAT_MASS.REQUEST r
        ON (c.id_curr=r.id_curr_req)
        INNER JOIN SIMAT_MASS.STUDENT s
        ON (r.id_stud_req=s.id_stud)
        WHERE r.state_req = 'C'";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }
    function paginateRequestCancel2()
    {
        $sql = "SELECT r.id_req, c.name_curr, c.last_name_curr,
        s.name_stud, s.last_name_stud, 
        c.document_curr, s.document_stud, c.phone_curr, s.id_grade_stud, 
        s.condition_stud, r.state_req, r.register_date

        FROM SIMAT_MASS.CURRENT c INNER JOIN SIMAT_MASS.AUDI_REQUEST r
        ON (c.id_curr=r.id_curr_req)
        INNER JOIN SIMAT_MASS.STUDENT s
        ON (r.id_stud_req=s.id_stud)
        WHERE r.id_req > 0";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }
    //-----------------------------------------------------------------
    function paginateRequestAcept()
    {
        $sql = "SELECT r.id_req, c.name_curr, c.last_name_curr,
                        s.name_stud, s.last_name_stud, 
                        c.document_curr, s.document_stud, c.phone_curr, s.id_grade_stud, 
                        s.condition_stud, r.state_req

        FROM SIMAT_MASS.CURRENT c INNER JOIN SIMAT_MASS.REQUEST r
        ON (c.id_curr=r.id_curr_req)
        INNER JOIN SIMAT_MASS.STUDENT s
        ON (r.id_stud_req=s.id_stud)
        WHERE r.state_req = 'Y'";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }
    //-----------------------------------------------------------------
    function paginateConsultarAcudiente_acept($id_curr)
    {
        $sql = "SELECT r.id_req, c.name_curr, c.last_name_curr,
                        s.name_stud, s.last_name_stud, 
                        c.document_curr, s.document_stud, c.phone_curr, s.id_grade_stud, 
                        s.condition_stud, r.state_req

        FROM SIMAT_MASS.CURRENT c INNER JOIN SIMAT_MASS.REQUEST r
        ON (c.id_curr=r.id_curr_req)
        INNER JOIN SIMAT_MASS.STUDENT s
        ON (r.id_stud_req=s.id_stud)
        WHERE r.id_curr_req = $id_curr";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    function paginateConsultarAcudiente_p($id_curr)
    {
        $sql = "SELECT r.id_req, c.name_curr, c.last_name_curr,
                        s.name_stud, s.last_name_stud, 
                        c.document_curr, s.document_stud, c.phone_curr, s.id_grade_stud, 
                        s.condition_stud, r.state_req

        FROM SIMAT_MASS.CURRENT c INNER JOIN SIMAT_MASS.REQUEST r
        ON (c.id_curr=r.id_curr_req)
        INNER JOIN SIMAT_MASS.STUDENT s
        ON (r.id_stud_req=s.id_stud)
        WHERE r.id_curr_req > 0";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }
    
    //------------------------------------------------------------------
    //MÉTODO QUE CONSULTA - (SOLICITUDES)
    function paginateCurrent()
    {
        $sql = "SELECT * FROM SIMAT_MASS.REQUEST";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }
    //MÉTODO QUE CONSULTA - (SOLICITUDES)
    function paginateStudent()
    {
        $sql = "SELECT * FROM SIMAT_MASS.REQUEST";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }
    //-----------------------------------------------------------------
    //MÉTODO QUE CONSULTA - (ÚLTIMA SOLICITUD)
    function paginateRequestCurrent()
    {
        $sql = "SELECT r.id_req, c.name_curr, c.last_name_curr,
                        s.name_stud, s.last_name_stud, 
                        c.document_curr, s.document_stud, c.phone_curr, s.id_grade_stud, 
                        s.condition_stud, r.state_req, observation_req

        FROM SIMAT_MASS.CURRENT c INNER JOIN SIMAT_MASS.REQUEST r
        ON (c.id_curr=r.id_curr_req)
        INNER JOIN SIMAT_MASS.STUDENT s
        ON (r.id_stud_req=s.id_stud)
        WHERE id_req > 0
        ORDER BY r.id_req DESC LIMIT 1";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }
    //-----------------------------------------------------------------
    //MÉTODO QUE CONSULTA - (ÚLTIMA SOLICITUD)
    function modificarPaginateRequestCurrent()
    {
        $sql = "SELECT r.id_req, c.name_curr, c.last_name_curr,
                        s.name_stud, s.last_name_stud, 
                        c.document_curr, s.document_stud, c.phone_curr, s.id_grade_stud, 
                        s.condition_stud, r.state_req, observation_req

        FROM SIMAT_MASS.CURRENT c INNER JOIN SIMAT_MASS.REQUEST r
        ON (c.id_curr=r.id_curr_req)
        INNER JOIN SIMAT_MASS.STUDENT s
        ON (r.id_stud_req=s.id_stud)
        WHERE id_req > 0
        ORDER BY r.id_req DESC";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }
    //-----------------------------------------------------------------
    //MÉTODO QUE CONSULTA - (ÚLTIMA SOLICITUD)
    function paginateConsultarAcudiente($id_curr)
    {
        $sql = "SELECT * FROM SIMAT_MASS.CURRENT
        WHERE id_curr = $id_curr";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }
    //-----------------------------------------------------------------
    //MÉTODO QUE CONSULTA - (TIPOS DE DOCUMENTO)
    function paginateDocumentType()
    {
        $sql = "SELECT * FROM SIMAT_MASS.DOCUMENT_TYPE ";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    //MÉTODO QUE CONSULTA - (GRADOS)
    function paginateGrade()
    {
        $sql = "SELECT * FROM SIMAT_MASS.GRADE";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    function validate_r($id_user,$id_stud_req)
    {
        $sql = "SELECT * FROM SIMAT_MASS.REQUEST
        WHERE id_curr_req = $id_curr_req
        AND id_stud_req = $id_stud_req";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }
    //-----------------------------------------------------------------
    //Metodo para buscar por documento
    function searchUserDocument($document_number){
        $sql = "SELECT * FROM ODONTOK.USER WHERE DOCUMENT_NUMBER = '$document_number'";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    //Metodo para buscar por estado
    function searchUserState($cod_state){
        $sql = "SELECT * FROM ODONTOK.USER WHERE COD_STATE = $cod_state";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    //Metodo para seleccionar un usuario en concreto
    function selectUser($id_user)
    {
        $sql = "SELECT * FROM SIMAT_MAS.USUARIOS 
        WHERE id_user = $id_user";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }
    //Metodo para seleccionar un usuario en concreto
    function selectRequest($id_req)
    {
        $sql = "SELECT * FROM SIMAT_MASS.REQUEST
        WHERE id_req = $id_req";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }
    //-----------------------------------------------------------------
    //---------------- METODOS  PARA REALIZAR VALIDACIONES
    //Saber si un documento ya existe en la base de datos
    function duplicateDocumentStudent($document_stud) 
    {
        $sql="SELECT * FROM SIMAT_MASS.STUDENT
        WHERE document_stud = '$document_stud'";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    } 
    function duplicateDocumentCurrent($document_curr) 
    {
        $sql="SELECT * FROM SIMAT_MASS.CURRENT
        WHERE document_curr = '$document_curr'";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    } 
    //------------------------------------------------------------------
    //Saber si un numero de documento no es repetido
    function duplicateDocumentoUpdate($documento_user,$id_user_update)
    {
        $sql="SELECT * FROM SIMAT_MAS.USUARIOS
        WHERE documento_user = '$documento_user'
        AND id_user<> '$id_user_update'";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }
    //-----------------------------------------------------------------
    //Saber si un nombre de usuario esta en la base de datos 
    function duplicateEmailCurrent($email_curr)
    {
        $sql="SELECT * FROM SIMAT_MASS.CURRENT
        WHERE email_curr = '$email_curr'";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    //Saber que el nuevo usuario no esta dupli
    function duplicateEmailUpdate($email_user,$id_user_update)
    {
        $sql="SELECT * FROM SIMAT_MAS.USUARIOS
        WHERE email_user = '$email_user'
        AND id_user <> '$id_user_update'";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }
    
    
}
?>