<?php

include_once("Orm.php");

class Usuari extends Orm
{

    public function __construct()
    {
        parent::__construct('usuaris');
        if (!isset($_SESSION['id_usuari'])) {
            $_SESSION['id_usuari'] = 1;
        }
    }

    public function login($u, $p)
    {

        foreach ($_SESSION[$this->model] as $usuari) {
            if ($usuari['usuari_usuari'] == $u) {
                if ($usuari['contrasenya_usuari'] == $p) {
                    return $usuari;
                }
            }
        }

        return null;
    }

    public function getByUsername($u)
    {
        foreach ($_SESSION[$this->model] as $usuari) {
            if ($usuari['usuari_usuari'] == $u) {
                return $usuari;
            }
        }
        return null;
    }
}
