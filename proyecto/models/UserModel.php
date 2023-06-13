<?php
class UserModel
{
    private $Connection;
    
    //Metodo constrcutor
    function __construct($Connection) {
        $this->Connection = $Connection;
    }


    //Metodo para insertar un usuaro
    function insertUser($name_user,$last_name_user,$id_role_user,$id_doct_user,$document_user,$password_user,$email_user,$state_user)
    {
        // ...

$sql = "INSERT INTO SIMAT_MASS.USER (id_user,name_user,last_name_user,id_role_user,id_doct_user,document_user,password_user,email_user,state_user,id_pos_user)
VALUES (DEFAULT,'$name_user','$last_name_user',$id_role_user,$id_doct_user,'$document_user','$password_user','$email_user','$state_user',DEFAULT)";

// ...

        $this->Connection->query($sql);
    }

    //Metodo para insertar un usuaro
    function insertUserAcudiente($name_curr,$last_name_curr,$document_curr,$document_stud,$email_curr,$id_doct_curr,$id_role_curr)
    {
        $sql = "INSERT INTO SIMAT_MASS.USER (id_user,name_user,last_name_user,id_role_user,id_doct_user,document_user,password_user,email_user,state_user,id_pos_user)
        VALUES (DEFAULT,'$name_curr','$last_name_curr',3,$id_doct_curr,'$document_curr','$document_stud','$email_curr','Y','2')";
        $this->Connection->query($sql);
    }

    function updateRequestAcudiente($id_user,$nombre_user,$apellido_user,$id_rol,$id_tdoc,$documento_user,$password_user,$email_user,$id_estado)
    {
        $sql = "UPDATE SIMAT_MASS.REQUEST
        SET nombre_user = '$nombre_user', apellido_user = '$apellido_user',
        id_rol = '$id_rol', id_tdoc = '$id_tdoc', documento_user = '$documento_user',
        password_user = '$password_user', email_user = '$email_user', id_estado = '$id_estado' 
        WHERE id_user = '$id_user'";
        $this->Connection->query($sql);
    }

    function insertHistorialAccesos($nombre_user,$apellido_user,$documento_user,$id_rol)
    {
        $sql = "INSERT INTO SIMAT_MAS.AUDI_ACCESO(id_user,nombre_user,apellido_user,documento_user,fecha_acceso,id_rol)
        VALUES (DEFAULT,'$nombre_user','$apellido_user','$documento_user',DEFAULT,$id_rol)";
        $this->Connection->query($sql);
    }

    function updateUser($id_user,$name_user,$last_name_user,$id_role_user,$id_doct_user,$document_user,$password_user,$email_user,$state_user)
    {
        $sql = "UPDATE SIMAT_MASS.USER
        SET name_user = '$name_user', last_name_user = '$last_name_user',
        id_role_user = '$id_role_user', id_doct_user = '$id_doct_user', document_user = '$document_user',
        password_user = '$password_user', email_user = '$email_user', state_user = '$state_user' 
        WHERE id_user = '$id_user'";
        $this->Connection->query($sql);
    }

    //MÉTODO QUE CONSULTA - (USUARIOS)
    function paginateUser()
    {
        $sql = "SELECT * FROM SIMAT_MASS.USER
        ORDER BY id_user";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    

    //MÉTODO QUE CONSULTA - (USUARIOS)
    function paginateHistorialAccesos()
    {
        $sql = "SELECT * FROM SIMAT_MASS.AUDI_ACCESO";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    //--------------------------------------- LISTAR TABLAS 

    //MÉTODO QUE CONSULTA - (TIPOS DE DOCUMENTO)
    function paginateDocumentType()
    {
        $sql = "SELECT * FROM SIMAT_MASS.DOCUMENT_TYPE ";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    //MÉTODO QUE CONSULTA - (ROLES)
    function paginateRol()
    {
        $sql = "SELECT * FROM SIMAT_MASS.ROLE";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    /*//MÉTODO QUE CONSULTA - ESTADOS)
    function paginateEstado()
    {
        $sql = "SELECT * FROM SIMAT_MASS.STATE";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }*/

    //Metodo para seleccionar un usuario en concreto
    function selectUser($id_user)
    {
        $sql = "SELECT * FROM SIMAT_MASS.USER
        WHERE id_user = $id_user";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    //---------------- METODOS  PARA REALIZAR VALIDACIONES

    //Saber si un documento ya existe en la base de datos
    function duplicateDocumento($document_user) 
    {
        $sql="SELECT * FROM SIMAT_MASS.USER
        WHERE document_user = '$document_user'";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    } 

    //Saber si un numero de documento no es repetido
    function duplicateDocumentoUpdate($document_user,$id_user_update)
    {
        $sql="SELECT * FROM SIMAT_MASS.USER
        WHERE document_user = '$document_user'
        AND id_user<> '$id_user_update'";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    //Saber si un nombre de usuario esta en la base de datos 
    function duplicateEmail($email_user)
    {
        $sql="SELECT * FROM SIMAT_MASS.USER
        WHERE email_user = '$email_user'";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    //Saber que el nuevo usuario no esta dupli
    function duplicateEmailUpdate($email_user,$id_user_update)
    {
        $sql="SELECT * FROM SIMAT_MASS.USER
        WHERE email_user = '$email_user'
        AND id_user <> '$id_user_update'";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    function validatePosition($id_user)
    {
        $sql = "SELECT * FROM SIMAT_MASS.USER
                WHERE id_user = '$id_user'
                AND id_user > 0";

        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }
}
?>