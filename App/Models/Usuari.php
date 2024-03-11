<?php

include_once("Orm.php");

class Usuari extends Orm
{

    public function __construct()
    {
        parent::__construct('usuaris');
    }

    public static function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `des-extincio`.`usuaris` 
        (`id` INT NOT NULL AUTO_INCREMENT , 
        `nom` VARCHAR(250) NOT NULL ,  
        `email` VARCHAR(250) NOT NULL, 
        `password` VARCHAR(250) NOT NULL, 
        `salt` VARCHAR(250) NOT NULL, 
        `naixement` DATE NOT NULL ,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL ,
        `modified_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP,
        `pressupost` DOUBLE NOT NULL , 
        `token` VARCHAR(250) NOT NULL,
        `verified` TINYINT(1) NOT NULL, 
        `admin` TINYINT(1) NOT NULL,
        PRIMARY KEY (`id`))
        ENGINE = InnoDB
        DEFAULT CHARSET=utf8mb4 
        COLLATE=utf8mb4_0900_ai_ci;";



        $db = new Database();
        $db->queryDataBase($sql);
    }

    public function checkLogin($email, $contrasenya)
    {
        $sql = "SELECT * FROM usuaris WHERE email = :email";
        $params = array(":email" => $email);

        $db = new Database();
        $result = $db->queryDataBase($sql, $params)->fetch();

        if (!$result) {
            return null;
        } else {
            $salt = $result['salt'];
            $pepper = $_ENV['PEPPER'];
            $passwordToCheck = $pepper . $contrasenya . $salt;
            if(password_verify($passwordToCheck, $result['password'])) {
                // ok
                return $result;
            } else {
                // ko
                // echo "Bilal";
                // die();
                return null;
            }
        }
    }

    public function getByEmail($email)
    {
        $sql = "SELECT * FROM usuaris WHERE email = :email";
        $params = array(":email" => $email);

        $db = new Database();
        $result = $db->queryDataBase($sql, $params)->fetch();

        return $result;
    }
}
