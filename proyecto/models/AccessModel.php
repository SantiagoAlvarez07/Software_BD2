<?php

class AccessModel
{
    //ATRIBUTOS
    private $Connection;

    //MÉTODO CONTRUCTOR - CONEXIÓN
    function __Construct($Connection)
    {
        $this->Connection = $Connection;
    }

    //FUNCIÓN VALIDAR - (LOGIN)
    function validateFormSession($document,$password,$role)
    {
        $sql = "SELECT * FROM SIMAT_MASS.USER
                WHERE document_user = '$document' 
                AND password_user = '$password' 
                AND id_role_user = '$role'";

        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }
}

?>