<?php

include_once("Orm.php");

class Extinguida extends Orm
{

    public function __construct()
    {
        parent::__construct('extinguidas');
        if (!isset($_SESSION['id_extinguida'])) {
            $_SESSION['id_extinguida'] = 1;
        }
    }

    //getExtinguidesByIdUsuari using the extinguida list (no databse)

    public function getExtinguidesByIdUsuari($id_usuari)
    {
        $extinguidas = array();
        foreach ($this->getAll() as $extinguida) {
            if ($extinguida['id_usuari'] == $id_usuari) {
                array_push($extinguidas, $extinguida);
            }
        }
        return $extinguidas;
    }
}
