<?php

include_once("Orm.php");

class Recuperada extends Orm
{

    public function __construct()
    {
        parent::__construct('recuperades');
        if (!isset($_SESSION['id_recuperada'])) {
            $_SESSION['id_recuperada'] = 1;
        }
    }

    //getExtinguidesByIdUsuari using the recuperada list (no databse)

    public function getExtinguidesByIdUsuari($id_usuari)
    {
        $recuperades = array();
        foreach ($this->getAll() as $recuperada) {
            if ($recuperada['id_usuari'] == $id_usuari) {
                array_push($recuperades, $recuperada);
            }
        }
        return $recuperades;
    }
}
