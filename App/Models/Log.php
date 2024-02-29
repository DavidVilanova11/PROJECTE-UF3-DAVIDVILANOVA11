<?php

include_once("Orm.php");

class Log extends Orm
{

    public function __construct()
    {
        parent::__construct('logs');
    }

    public static function createTable()
    {
        $sql = "CREATE TABLE `des-extincio`.`logs` 
        (`id` INT NOT NULL AUTO_INCREMENT , `nom` VARCHAR(250) NOT NULL , 
        `especie` INT NOT NULL , `naixement` TIMESTAMP NOT NULL , 
        `img` VARCHAR(250) NOT NULL , `id_usuari` INT NOT NULL , 
        PRIMARY KEY (`id`)) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 
        COLLATE=utf8mb4_0900_ai_ci;";
        

        $db = new Database();
        $db->queryDataBase($sql);
    }
}

