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

        // Amb log cap
        // $sql = "CREATE TABLE IF NOT EXISTS `des-extincio`.`logs` 
        // (`id` INT NOT NULL AUTO_INCREMENT, 
        // `id_cap` INT NOT NULL,
        // `id_usuari` INT NOT NULL , 
        // `id_extinta` INT NOT NULL , 
        // `id_adn` INT NOT NULL , 
        // `id_host` INT NOT NULL , 
        // `satisfactori` BOOLEAN NOT NULL , 
        // `timestamp` TIMESTAMP NOT NULL, 
        // PRIMARY KEY (`id`),
        // FOREIGN KEY (`id_usuari`) REFERENCES usuaris(`id`) ON DELETE CASCADE,
        // FOREIGN KEY (`id_extinta`) REFERENCES extintes(`id`),
        // FOREIGN KEY (`id_adn`) REFERENCES adn(`id`),
        // FOREIGN KEY (`id_host`) REFERENCES hosts(`id`),
        // FOREIGN KEY (`id_cap`) REFERENCES log_cap(`id`) ON DELETE CASCADE)
        // ENGINE = InnoDB 
        // DEFAULT CHARSET=utf8mb4 
        // COLLATE=utf8mb4_0900_ai_ci;";

        // sense log cap

        $sql = "CREATE TABLE IF NOT EXISTS `des-extincio`.`logs` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `id_usuari` INT NOT NULL,
            `id_extinta` INT NOT NULL,
            `id_adn` INT NOT NULL,
            `id_host` INT NOT NULL,
            `satisfactori` BOOLEAN NOT NULL,
            `timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            FOREIGN KEY (`id_usuari`) REFERENCES usuaris(`id`) ON DELETE CASCADE,
            FOREIGN KEY (`id_adn`) REFERENCES adn(`id`),
            FOREIGN KEY (`id_host`) REFERENCES hosts(`id`)
        ) ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;";



        $db = new Database();
        $db->queryDataBase($sql);
    }


    // Ja no utilitzarem aquest trigger donat que hem de passar-li el nom escollit per l'usuari
    // public static function createTriggers()
    // {

    //     // Trigger to insert the recuperada after log satisfactori (img de moment serà el nom de la extinta)
    //     $sql = "CREATE TRIGGER `insert_recuperada` AFTER INSERT ON `logs` FOR EACH ROW
    //     BEGIN
    //         IF NEW.satisfactori = 1 THEN
    //             INSERT INTO recuperades (nom, especie, img, id_usuari, id_extinta) VALUES ((SELECT nom FROM extintes WHERE id = NEW.id_extinta), (SELECT nom FROM extintes WHERE id = NEW.id_extinta), (SELECT img FROM extintes WHERE id = NEW.id_extinta), NEW.id_usuari, NEW.id_extinta);
    //         END IF;
    //     END;";

    //     $db = new Database();
    //     $db->queryDataBase($sql);
    // }

    public function getLogByIdUsuari($id_usuari)
    {
        $sql = "SELECT * FROM " . $this->model . " WHERE id_usuari = :id_usuari";
        $params = array(
            ":id_usuari" => $id_usuari
        );
        $db = new Database();
        $result = $db->queryDataBase($sql, $params)->fetchAll();
        return $result;
    }
}
