<?php

include_once("Orm.php");

class Usuari extends Orm
{

    public function __construct()
    {
        parent::__construct('usuaris');
    }

    public static function createTable()
    {
        $sql = "CREATE TABLE `des-extincio`.`usuaris` 
        (`id` INT NOT NULL AUTO_INCREMENT , 
        `nom` VARCHAR(250) NOT NULL ,  
        `email` VARCHAR(250) NOT NULL, 
        `contrassenya` VARCHAR(250) NOT NULL, 
        `salt` VARCHAR(250) NOT NULL, 
        `naixement` DATE NOT NULL , 
        `pressupost` DOUBLE NOT NULL , 
        `verified` BOOLEAN NOT NULL, 
        `admin` BOOLEAN NOT NULL,
        PRIMARY KEY (`id`)) ENGINE = InnoDB
        DEFAULT CHARSET=utf8mb4 
        COLLATE=utf8mb4_0900_ai_ci;";


        $db = new Database();
        $db->queryDataBase($sql);
    }

}
