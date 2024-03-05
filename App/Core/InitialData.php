<?php
// include_once("App/Core/Controller.php");
// include_once("App/Models/Usuari.php");
// include_once("App/Models/Recuperada.php");

// class InitialData extends Controller
// {

//     public function charge()
//     {

//         $usuariModel = new Usuari();
//         if ($usuariModel->getAll() == null) {
//             $usuari = array(
//                 //"id" => $_SESSION['id_usuari']++,
//                 "email_usuari" => "admin@gmail.com",
//                 "nom_usuari" => "Admin",
//                 "usuari_usuari" => "admin",
//                 "contrasenya_usuari" => "admin",
//                 "admin" => true,
//                 "token" => "token",
//                 "verificat" => true
//             );

//             $usuariModel->insert($usuari);

//             $recuperadaModel = new Recuperada();


//             if ($recuperadaModel->getAll() == null) {
//                 $recuperada = array(
//                     //"id" => $_SESSION['id_recuperada']++,
//                     "num_recuperada" => "1",
//                     "familia_recuperada" => "Apodidae",
//                     "nom_recuperada" => "Acridotheres tristis",
//                     "imatge_recuperada" => "gavia.jpg",
//                     "video_recuperada" => "gavia.mp4",
//                     "id_usuari" => "1"
//                 );

//                 $recuperadaModel->insert($recuperada);

//                 $recuperada = array(
//                     //"id" => $_SESSION['id_recuperada']++,
//                     "num_recuperada" => "7",
//                     "familia_recuperada" => "Accipitridae",
//                     "nom_recuperada" => "Accipiter gentilis",
//                     "imatge_recuperada" => "Bird-Friendly-City.jpg",
//                     "video_recuperada" => null,
//                     "id_usuari" => "1"
//                 );

//                 $recuperadaModel->insert($recuperada);

//                 $recuperada = array(
//                     //"id" => $_SESSION['id_recuperada']++,
//                     "num_recuperada" => "33",
//                     "familia_recuperada" => "Anatidae",
//                     "nom_recuperada" => "Nix",
//                     "imatge_recuperada" => "Acridotheres tristis.avif",
//                     "video_recuperada" => null,
//                     "id_usuari" => "1"
//                 );

//                 $recuperadaModel->insert($recuperada);
//             }
//         }
//     }
// }

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
