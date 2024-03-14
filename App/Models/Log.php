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
        $sql = "CREATE TABLE IF NOT EXISTS `des-extincio`.`logs` 
        (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY , 
        `id_cap` INT NOT NULL,
        `id_usuari` INT NOT NULL , 
        `id_extinta` INT NOT NULL , 
        `id_adn` INT NOT NULL , 
        `id_host` INT NOT NULL , 
        `satisfactori` BOOLEAN NOT NULL , 
        `probabilitat` FLOAT NOT NULL , 
        `timestamp` TIMESTAMP NOT NULL, 
        PRIMARY KEY (`id`),
        FOREIGN KEY (`id_usuari`) REFERENCES usuaris(`id`),
        FOREIGN KEY (`id_extinta`) REFERENCES extintes(`id`),
        FOREIGN KEY (`id_adn`) REFERENCES adn(`id`),
        FOREIGN KEY (`id_host`) REFERENCES hosts(`id`),
        FOREIGN KEY (`id_cap`) REFERENCES log_cap(`id`) ON DELETE CASCADE)
        ENGINE = InnoDB 
        DEFAULT CHARSET=utf8mb4 
        COLLATE=utf8mb4_0900_ai_ci;";


        $db = new Database();
        $db->queryDataBase($sql);
    }
}
