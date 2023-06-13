<?php
require_once "../private_files_simat/setting_connection_simat.php";

class Connection
{
    //ATRIBUTOS PARA HACER BUSQUEDAS A LA DB
    private $link;
    private $result;

    //MÉTODO PARA LA CONEXIÓN
    function __construct()
    {
        //DATOS DE LA DB
        $ip = IP;
        $data_base = DATA_BASE;
        $port = PORT;
        $user = USER_PG;
        $password = PASSWORD_PG;

        //REALIZA CONEXION A LA DB
        try
        {
            //LINK - DE LA CONEXION A LA DB
            $this->link = new PDO("pgsql:host=$ip;port=$port;dbname=$data_base",$user,$password);
            $this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            exit("ERROR PARA CONECTARSE");
        }
    }

    //EJECUTA (ELIMINAR, INSERTAR Y ACTUALIZAR) LA DB
    function query($sql) 
    {
        $this->result = $this->link->query($sql) 
        or exit('Consulta mal estructurada');
    }

    //SELECCIONA LA DB
    function fetchAll() 
    {
        return $this->result->fetchAll(PDO::FETCH_OBJ);
    }    
}

?>