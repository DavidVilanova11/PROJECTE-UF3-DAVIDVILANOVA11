<?php

include_once(__DIR__ . '/../Services/Database.php');
include_once(__DIR__ . "/../Models/Usuari.php");
include_once(__DIR__ . "/../Models/Adn.php");
include_once(__DIR__ . "/../Models/Recuperada.php");
include_once(__DIR__ . "/../Models/Extinta.php");
include_once(__DIR__ . "/../Models/Host.php");
include_once(__DIR__ . "/../Models/Log_cap.php");
include_once(__DIR__ . "/../Models/Log.php");
include_once(__DIR__ . "/../Models/Compra.php");
include_once(__DIR__ . "/../Models/Stock.php");

class resetController extends Controller
{
    public function run()
    {
        $db = new Database();
        $sql = "DROP TABLE IF EXISTS compres, stock, log_cap, logs, usuaris, recuperades, adn, hosts, extintes;";
        $db->queryDataBase($sql);

        // create tables

        Usuari::createTable();

        Host::createTable();

        Adn::createTable();

        Extinta::createTable();

        Recuperada::createTable();

        Log_cap::createTable();

        Log::createTable();

        Compra::createTable();

        Stock::createTable();

        // Create Triggers

        Compra::createTriggers(); // Inserció a la taula stock i actualització del pressupost

        $pepper = $_ENV['PEPPER'];
        $salt = bin2hex(random_bytes(16));
        $passClear = "admin";
        $passWithPepperAndSalt = $pepper . $passClear . $salt;
        $passHashed = password_hash($passWithPepperAndSalt, PASSWORD_ARGON2ID);


        // USUARIS

        $usuariModel = new Usuari();
        $usuari = [
            "nom" => "admin",
            "email" => "gat2004@gmail.com",
            "password" => $passHashed,
            "naixement" => "2004-11-20", // "2004-11-20",
            "pressupost" => 400000,
            "token" => "indefinit",
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
            "naixement" => "2004-11-20", // "2004-11-20",
            "token" => "indefinit",
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
            "img" => "adn-1.jpg"
        ]);

        $adn->insert([
            "nom" => "10-LG06",
            "preu" =>  12000,
            "img" => "adn-2.jpg"
        ]);

        $adn->insert([
            "nom" => "06-GXX1",
            "preu" =>  2000,
            "img" => "adn-3.jpg"
        ]);

        $adn->insert([
            "nom" => "20-AB17",
            "preu" =>  2300,
            "img" => "adn-4.jpg"
        ]);

        $adn->insert([
            "nom" => "81-AB17",
            "preu" =>  5000,
            "img" => "adn-5.jpg"
        ]);

        $adn->insert([
            "nom" => "37-DSR",
            "preu" =>  6000,
            "img" => "adn-6.jpg"
        ]);



        //HOSTS 
        $host = new Host();
        $host->insert([
            "especie" => "Cervol",
            "preu" =>  600,
            "img" => "deer.jpg"
        ]);

        $host->insert([
            "especie" => "Cocodril Asiàtic",
            "preu" =>  1000,
            "img" => "crocodile.jpg"
        ]);

        $host->insert([
            "especie" => "Cocodril Africà",
            "preu" =>  1500,
            "img" => "crocodile_2.jpg"
        ]);

        $host->insert([
            "especie" => "Indian Rhinoceros",
            "preu" =>  3000,
            "img" => "indian_rhinoceros.jpg"
        ]);

        $host->insert([
            "especie" => "Mountain Lion",
            "preu" =>  3200,
            "img" => "mountain_lion.jpg"
        ]);

        $host->insert([
            "especie" => "Casuarius",
            "preu" =>  3200,
            "img" => "casuarius.jpg"
        ]);


        // EXTINTES
        $extinta = new Extinta();
        $extinta->insert([
            "id_adn" => 1,
            "id_host" =>  1,
            "nom" => "Stygimoloch",
            "probabilitat" => 0.7,
            "recompensa" =>  10000,
            "img" => "stygimoloch.jpg"
        ]);

        $extinta->insert([
            "id_adn" => 2,
            "id_host" =>  4,
            "nom" => "Ankylosaurus",
            "probabilitat" => 0.6,
            "recompensa" =>  10000,
            "img" => "ankylosaurus.jpg"
        ]);

        $extinta->insert([
            "id_adn" => 3,
            "id_host" =>  5,
            "nom" => "Sabertooth Tiger",
            "probabilitat" => 0.5,
            "recompensa" =>  22000,
            "img" => "sabertooth2.jpg"
        ]);

        $extinta->insert([
            "id_adn" => 4,
            "id_host" =>  2,
            "nom" => "Spinosaurus",
            "probabilitat" => 0.5,
            "recompensa" =>  22000,
            "img" => "spinosaurus3.jpg"
        ]);

        $extinta->insert([
            "id_adn" => 5,
            "id_host" =>  6,
            "nom" => "Therizinosaurus",
            "probabilitat" => 0.5,
            "recompensa" =>  22000,
            "img" => "therizinosaurus.png"
        ]);

        $extinta->insert([
            "id_adn" => 6,
            "id_host" =>  3,
            "nom" => "Carcharodontosaurus",
            "probabilitat" => 0.5,
            "recompensa" =>  22000,
            "img" => "carcharodontosaurus2.jpg"
        ]);

        // Compres

        $compra = new Compra();
        $compra->insert([
            "id_usuari" => 1,
            "id_adn" => 1,
            "tipus_compra" => "ADN"
        ]);



        //Log_cap


        // LOGS        

        // RECUPERADES

        //timestamp automàtic
        $recuperada = new Recuperada();
        $recuperada->insert([
            "nom" => "Spiny",
            "especie" => "Stygimoloch",
            "img" => "stygimoloch.jpg",
            "naixement" => "2021-11-20",
            "id_usuari" => 1,
            "id_extinta" => 1
        ]);


        header("Location: /usuari/index");
    }
}
