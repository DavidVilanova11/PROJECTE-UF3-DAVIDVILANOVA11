<?php

include_once("Orm.php");

class Entrenador extends Orm
{

    public function __construct()
    {
        parent::__construct('entrenadors');
        if (!isset($_SESSION['id_entrenador'])) {
            $_SESSION['id_entrenador'] = 1;
        }
    }

    public function login($u, $p)
    {

        foreach ($_SESSION[$this->model] as $entrenador) {
            if ($entrenador['usuari_entrenador'] == $u) {
                if ($entrenador['contrasenya_entrenador'] == $p) {
                    return $entrenador;
                }
            }
        }

        return null;
    }

    public function getByUsername($u)
    {
        foreach ($_SESSION[$this->model] as $entrenador) {
            if ($entrenador['usuari_entrenador'] == $u) {
                return $entrenador;
            }
        }
        return null;
    }
}
