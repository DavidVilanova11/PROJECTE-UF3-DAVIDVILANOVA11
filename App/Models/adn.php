<?php

include_once("Orm.php");

class Adn extends Orm
{

    public function __construct()
    {
        parent::__construct('adn');
    }

    public static function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `des-extincio`.`adn` 
        (`id` INT NOT NULL AUTO_INCREMENT , 
        `nom` VARCHAR(250) NOT NULL , 
        `preu` DOUBLE NOT NULL , 
        `img` VARCHAR(250) NOT NULL , 
        PRIMARY KEY (`id`)) ENGINE = InnoDB
        DEFAULT CHARSET=utf8mb4 
        COLLATE=utf8mb4_0900_ai_ci;";


        $db = new Database();
        $db->queryDataBase($sql);
    }

    public function selectById($id){
        $sql = "SELECT * FROM adn WHERE id = :id";
        $params = array(":id" => $id);

        $db = new Database();
        $result = $db->queryDataBase($sql, $params)->fetch();

        if (!$result) {
            return null;
        } else {
            return $result;
        }
    }
}
