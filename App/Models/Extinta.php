<?php

include_once("Orm.php");

class Extinta extends Orm
{

    public function __construct()
    {
        parent::__construct('extintes');
    }

    public static function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `des-extincio`.`extintes` 
        (`id` INT NOT NULL AUTO_INCREMENT , 
        `id_adn` INT NOT NULL , 
        `id_host` INT NOT NULL , 
        `nom` VARCHAR(250) NOT NULL ,
        `probabilitat` FLOAT DEFAULT 0.0 NOT NULL , 
        `img` VARCHAR(250) NOT NULL , 
        `recompensa` DOUBLE NOT NULL,  
        PRIMARY KEY (`id`),
        FOREIGN KEY (`id_adn`) REFERENCES `adn`(`id`),
        FOREIGN KEY (`id_host`) REFERENCES `hosts`(`id`))
        ENGINE = InnoDB 
        DEFAULT CHARSET=utf8mb4 
        COLLATE=utf8mb4_0900_ai_ci;";


        $db = new Database();
        $db->queryDataBase($sql);
    }

    public function checkAdnAndHost($id_adn, $id_host)
    {
        $sql = "SELECT * FROM " . $this->model . " WHERE id_adn = :id_adn AND id_host = :id_host";
        $params = array(
            ":id_adn" => $id_adn,
            ":id_host" => $id_host
        );
        $db = new Database();
        $result = $db->queryDataBase($sql, $params)->fetch();
        return $result;
    }
}
