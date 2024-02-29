resetController.php:
<?php
include_once(__DIR__ . '/../Services/Database.php');
include_once(__DIR__ . "/../Models/Usuari.php");
include_once(__DIR__ . "/../Models/Adn.php");
include_once(__DIR__ . "/../Models/Recuperada.php");
include_once(__DIR__ . "/../Core/Extincta.php");
include_once(__DIR__ . "/../Models/Host.php");
include_once(__DIR__ . "/../Models/Log_cap.php");
include_once(__DIR__ . "/../Models/Log.php");

class resetController extends Controller
{
    public function run()
    {
        $db = new Database();
        $sql = "DROP TABLE IF EXISTS usuaris, recuperades, recuperada,cistella";
        $db->queryDataBase($sql);

        Usuari::createTable();

        chat_messages::createTable();

        Recuperada::createTable();

        Cistella::createTable();

        $pepper = $_ENV['PEPPER'];
        $salt = bin2hex(random_bytes(16));
        $passClear = "1234";
        $passWitdhPepperAndSalt = $pepper . $passClear . $salt;
        $passHashed = password_hash($passWitdhPepperAndSalt, PASSWORD_ARGON2ID);

        $usuariModel = new Usuari();
        $usuari = [
            "name" => "ADMIN",
            "usuariname" => "admin",
            "mail" => "marcramilogarrido04@gmail.com",
            "direction" => "x",
            "password" => $passHashed,
            "profile_image" => "admin.jpg",
            "avis_legal" => 1,
            "avis_enviament_propaganda" => 1,
            "verify" => 1,
            "commands" => null,
            "admin" => 1,
            "token" => null,
            "salt" => $salt
        ];

        $usuariModel->insert($usuari);


        $usuari = [
            "name" => "Marc",
            "usuariname" => "marcrami",
            "mail" => "marc.ramilo@cirvianum.cat",
            "direction" => "Ribes de Freser",
            "password" => $passHashed,
            "profile_image" => "marcrami.jpg",
            "avis_legal" => 1,
            "avis_enviament_propaganda" => 1,
            "verify" => 1,
            "commands" => null,
            "admin" => 0,
            "token" => null,
            "salt" => $salt
        ];

        $usuariModel->insert($usuari);

        $recuperada = new Recuperada();
        $recuperada->insert([
            "title" => "Hamburguesa",
            "description" => "Hamburguesa de vedella amb formatge",
            "ingredients" => "Vedella, formatge, pa",
            "grams" => "200",
            "price" => 5.50,
            "stock" => 10,
            "image" => "hamburguesa.jpg"
        ]);

        header("Location: /main/index");
    }
}


