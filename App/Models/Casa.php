<?php

include_once ("Orm.php");

class Casa extends Orm{

    public function __construct()
    {
        parent::__construct('cases');
        if(!isset($_SESSION['id_casa'])){
            $_SESSION['id_casa'] =1;
        }
    }
}



?>