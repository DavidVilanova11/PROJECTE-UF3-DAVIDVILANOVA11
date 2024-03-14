<?php

include_once("Orm.php");

class Compra extends Orm
{

    public function __construct()
    {
        parent::__construct('compra');
    }

    // tindrem id_host i id_adn però només un d'ells tindrà valor
    public static function createTable()
    {
        $sql = "CREATE TABLE `des-extincio`.`compres` 
        (`id` INT NOT NULL AUTO_INCREMENT , 
        `id_usuari` INT NOT NULL , `timestamp` 
        TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , 
        `tipus_compra` ENUM('ADN', 'Host') NOT NULL , 
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

        // Trigger to make an insert in the stock table when a new adn or host is bought
        $sql = "CREATE TRIGGER `insert_stock` AFTER INSERT ON `compres` FOR EACH ROW
        BEGIN
            IF NEW.tipus_compra = 'ADN' THEN
                INSERT INTO stock (id_usuari, tipus_stock, id_adn) VALUES (NEW.id_usuari, 'ADN', NEW.id_adn);
            ELSE
                INSERT INTO stock (id_usuari, tipus_stock, id_host) VALUES (NEW.id_usuari, 'Host', NEW.id_host);
            END IF;
        END;";

        $db->queryDataBase($sql);

    }
}
