<?php
require_once "views/MenuView.php";
require_once "models/MenuModel.php";

class FrontController
{
    //CONSTRUCTOR 
    function __construct($route)
    {
        //SI LA RUTA NO ESTÁ VACÍA
        if($route)
        { 
            list($class,$method) = explode('/',$route);         
        } 
        
        //SI ESTÁ VACÍA
        else 
        {  
            $class = "MenuController"; 
            $method = "validateMenu"; 
        }
        require_once "controllers/$class.php"; //Requiere automaticamente el archivo

        $instance = new $class(); //Crea la clase

        $instance->$method(); //Llama el método
    }
}
?>