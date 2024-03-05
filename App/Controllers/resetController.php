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

        Host::createTable();

        Recuperada::createTable();

        Adn::createTable();

        Extincta::createTable();

        $pepper = $_ENV['PEPPER'];
        $salt = bin2hex(random_bytes(16));
        $passClear = "1234";
        $passWitdhPepperAndSalt = $pepper . $passClear . $salt;
        $passHashed = password_hash($passWitdhPepperAndSalt, PASSWORD_ARGON2ID);


        // USUARIS

        $usuariModel = new Usuari();
        $usuari = [
            "nom" => "David",
            "email" => "david.vilanova@cirvianum.cat",
            "password" => $passHashed,
            "pressupost" => 400000,
            "verified" => 1,
            "admin" => 1,
            "salt" => $salt
        ];

        $usuariModel->insert($usuari);


        $usuari = [
            "nom" => "Billy",
            "email" => "guettavilanova2004@gamil.com",
            "password" => $passHashed,
            "pressupost" => 30000,
            "verified" => 1,
            "admin" => 1,
            "salt" => $salt
        ];

        $usuariModel->insert($usuari);

        // ADN

        $adn = new Adn();
        $adn->insert([
            "nom" => "50-AB17",
            "preu" =>  8000,
            "img" => "50-AB17.jpg"
        ]);

        $adn->insert([
            "nom" => "10-LG06",
            "preu" =>  12000,
            "img" => "10-LG06.jpg"
        ]);

        //HOSTS 
        $host = new Host();
        $host->insert([
            "id_adn" => 1,
            "id_host" =>  8000,
            "img" => "50-AB17.jpg"
        ]);


        // EXTNICTES
        $extincta = new Extincta();
        $extincta->insert([
            "id_adn" => 1,
            "id_host" =>  8000,
            "img" => "50-AB17.jpg"
        ]);

        $adn->insert([
            "nom" => "10-LG06",
            "preu" =>  12000,
            "img" => "10-LG06.jpg"
        ]);


        // RECUPERADES
        $date = new DateTimeImmutable();

        //timestamp automàtic
        $recuperada = new Recuperada();
        $recuperada->insert([
            "nom" => "Spiny",
            "naixemment" =>  $date->getTimestamp(),
            "id_usuari" => 1,
            "id_extincta" => 1
        ]);

        header("Location: /main/index");
    }
}
