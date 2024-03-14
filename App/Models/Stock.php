<?php

include_once("Orm.php");

class Stock extends Orm
{

    public function __construct()
    {
        parent::__construct('stock');
    }

    // tindrem id_host i id_adn però només un d'ells tindrà valor
    public static function createTable()
    {
        $sql = "CREATE TABLE `des-extincio`.`stock` 
        (`id` INT NOT NULL AUTO_INCREMENT , 
        `id_usuari` INT NOT NULL , 
        `tipus_stock` ENUM('ADN', 'Host') NOT NULL , 
        `id_host` INT NULL , 
        `id_adn` INT NULL , 
        PRIMARY KEY (`id`),
        FOREIGN KEY (`id_usuari`) REFERENCES usuaris(`id`),
        FOREIGN KEY (`id_adn`) REFERENCES adn(`id`),
        FOREIGN KEY (`id_host`) REFERENCES hosts(`id`)),
        ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 
        COLLATE=utf8mb4_0900_ai_ci;";


        $db = new Database();
        $db->queryDataBase($sql);
    }
}
