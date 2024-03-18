<?php

include_once("Orm.php");

class Recuperada extends Orm
{

    public function __construct()
    {
        parent::__construct('recuperades');
    }

    public static function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `des-extincio`.`recuperades` 
        (`id` INT NOT NULL AUTO_INCREMENT , 
        `nom` VARCHAR(250) NOT NULL,
        `especie` VARCHAR(250) NOT NULL ,
        `naixement` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL ,
        `img` VARCHAR(250) NOT NULL , 
        `id_usuari` INT NOT NULL , 
        `id_extinta` INT NOT NULL,
        PRIMARY KEY (`id`),
        FOREIGN KEY (`id_usuari`) REFERENCES `usuaris`(`id`),
        FOREIGN KEY (`id_extinta`) REFERENCES `extintes`(`id`)) 
        ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 
        COLLATE=utf8mb4_0900_ai_ci;";



        $db = new Database();
        $db->queryDataBase($sql);
    }

    public function getRecuperadesByIdUsuari($id_usuari)
    {
        $db = new Database();

        $sql = "SELECT * FROM " . $this->model . " WHERE id_usuari = $id_usuari;";
        $params = array(
            ":id_usuari" => $id_usuari
        );
        $result = $db->queryDataBase($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getProductQuantity($id, $id_usuari)
    {
        $sql = "SELECT COUNT(*) as quantity FROM recuperades WHERE id = :id AND id_usuari = :id_usuari";
        $params = array(
            ":id" => $id,
            ":id_usuari" => $id_usuari
        );

        $db = new Database();
        $result = $db->queryDataBase($sql, $params)->fetch();

        return $result['quantity'];
    }
}
