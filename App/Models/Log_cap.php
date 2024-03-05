<?php

include_once("Orm.php");

class Log_cap extends Orm
{

    public function __construct()
    {
        parent::__construct('log_cap');
    }

    public static function createTable()
    {
        $sql = "CREATE TABLE `des-extincio`.`log_cap` 
        (`id` INT NOT NULL AUTO_INCREMENT , 
        PRIMARY KEY (`id`)) ON DELETE CASCADE
        ENGINE = InnoDB;
        DEFAULT CHARSET=utf8mb4 
        COLLATE=utf8mb4_0900_ai_ci;";


        $db = new Database();
        $db->queryDataBase($sql);
    }
}
