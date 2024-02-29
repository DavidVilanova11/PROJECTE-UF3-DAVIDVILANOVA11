resetController.php:
<?php
include_once(__DIR__ . '/../Services/Database.php');
include_once(__DIR__ . "/../Models/Usuari.php");
include_once(__DIR__ . "/../Models/chat_messages.php");
include_once(__DIR__ . "/../Models/Recuperada.php");
include_once(__DIR__ . "/../Core/Controller.php");
include_once(__DIR__ . "/../Models/Cistella.php");
class resetController extends Controller
{
    public function run()
    {
        $db = new Database();
        $sql = "DROP TABLE IF EXISTS users, recuperades, plat,cistella";
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

        $userModel = new Usuari();
        $user = [
            "name" => "ADMIN",
            "username" => "admin",
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

        $userModel->insert($user);


        $user = [
            "name" => "Marc",
            "username" => "marcrami",
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

        $userModel->insert($user);

        $plat = new Plat();
        $plat->insert([
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


