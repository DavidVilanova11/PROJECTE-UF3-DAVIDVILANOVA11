<?php

include_once("Orm.php");

class Host extends Orm
{

    public function __construct()
    {
        parent::__construct('hosts');
    }

    public static function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `des-extincio`.`hosts` 
        (`id` INT NOT NULL AUTO_INCREMENT , 
        `especie` VARCHAR(250) NOT NULL , 
        `preu` DOUBLE NOT NULL , 
        `img` VARCHAR(250) NOT NULL , 
        PRIMARY KEY (`id`)) ENGINE = InnoDB
        DEFAULT CHARSET=utf8mb4 
        COLLATE=utf8mb4_0900_ai_ci;";
        

        $db = new Database();
        $db->queryDataBase($sql);
    }
}

