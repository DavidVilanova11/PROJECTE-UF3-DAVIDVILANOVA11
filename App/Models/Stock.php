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
        FOREIGN KEY (`id_usuari`) REFERENCES usuaris(`id`) ON DELETE CASCADE,
        FOREIGN KEY (`id_adn`) REFERENCES adn(`id`),
        FOREIGN KEY (`id_host`) REFERENCES hosts(`id`))
        ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 
        COLLATE=utf8mb4_0900_ai_ci;";


        $db = new Database();
        $db->queryDataBase($sql);
    }

    public function getProductQuantity($id, $id_usuari, $type)
    {
        $sql = "SELECT COUNT(*) as quantity FROM stock WHERE id_" . $type . " = :id AND id_usuari = :id_usuari";
        $params = array(
            ":id" => $id,
            ":id_usuari" => $id_usuari
        );

        $db = new Database();
        $result = $db->queryDataBase($sql, $params)->fetch();

        return $result['quantity'];
    }

    public function getStockByIdUsuari($column, $id_usuari)
    {
        $db = new Database();

        $sql = "SELECT DISTINCT $column FROM " . $this->model . " WHERE id_usuari = $id_usuari;";
        $params = array(
            ":column" => $column,
            ":id_usuari" => $id_usuari
        );
        $result = $db->queryDataBase($sql)->fetchAll(PDO::FETCH_COLUMN);
        return $result;
    }


    public function removeStock($id, $type)
    {
        // can be id_host or id_adn

        $sql = "DELETE FROM " . $this->model . " WHERE id_" . $type . " = :id LIMIT 1"; // Limit the deletion to one record
        $params = array(
            ":id" => $id
        );

        $db = new Database();
        $db->queryDataBase($sql, $params);

        return true;
    }
}
