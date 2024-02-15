<?php

include_once("Orm.php");

class Extinguida extends Orm
{

    public function __construct()
    {
        parent::__construct('ocells');
        if (!isset($_SESSION['id_ocell'])) {
            $_SESSION['id_ocell'] = 1;
        }
    }

    //getOcellsByIdEntrenador using the ocell list (no databse)

    public function getOcellsByIdEntrenador($id_entrenador)
    {
        $ocells = array();
        foreach ($this->getAll() as $ocell) {
            if ($ocell['id_entrenador'] == $id_entrenador) {
                array_push($ocells, $ocell);
            }
        }
        return $ocells;
    }
}
