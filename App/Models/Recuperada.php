<?php

include_once("Orm.php");

class Recuperada extends Orm
{

    // public function __construct()
    // {
    //     parent::__construct('recuperades');
    //     if (!isset($_SESSION['id_recuperada'])) {
    //         $_SESSION['id_recuperada'] = 1;
    //     }
    // }

    // //getRecuperadesByIdUsuari using the recuperada list (no databse)

    // public function getRecuperadesByIdUsuari($id_usuari)
    // {
    //     $recuperades = array();
    //     foreach ($this->getAll() as $recuperada) {
    //         if ($recuperada['id_usuari'] == $id_usuari) {
    //             array_push($recuperades, $recuperada);
    //         }
    //     }
    //     return $recuperades;
    // }



    public function __construct()
    {
        parent::__construct('recuperades');
    }

    public static function createTable()
    {
        $sql = "CREATE TABLE `des-extincio`.`recuperades` 
        (`id` INT NOT NULL AUTO_INCREMENT , `nom` VARCHAR(250) NOT NULL , 
        `especie` INT NOT NULL , `naixement` TIMESTAMP NOT NULL , 
        `img` VARCHAR(250) NOT NULL , `id_usuari` INT NOT NULL , 
        PRIMARY KEY (`id`)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 
        COLLATE=utf8mb4_0900_ai_ci;";
        

        $db = new Database();
        $db->queryDataBase($sql);
    }
}

