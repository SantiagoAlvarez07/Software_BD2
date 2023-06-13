<?php

class MenuModel
{
    private $Connection;

    function __construct($Connection)
    {
        $this->Connection = $Connection;
    }

    function listUser($id_user)
    {
        $sql = "SELECT * FROM SIMAT_MASS.USER
        WHERE id_user = '$id_user'";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    function numRegister()
    {
        $sql = "SELECT count(*) FROM SIMAT_MASS.USER";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    function numRegister_req()
    {
        $sql = "SELECT count(*) FROM SIMAT_MASS.REQUEST";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    function validateRol($role)
    {
        $sql = "SELECT * FROM SIMAT_MASS.USER
        WHERE id_role_user = '$role'";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }
}
?>