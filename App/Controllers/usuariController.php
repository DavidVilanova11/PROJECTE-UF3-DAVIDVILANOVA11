<?php

include_once(__DIR__ . "/../Core/Controller.php");
include_once(__DIR__ . "/../Core/Mailer.php");
include_once(__DIR__ . "/../Models/Usuari.php");

class usuariController extends Controller
{

    public function index()
    {
        $usuariModel = new Usuari();
        $usuariModel->getAll();

        $params = null;
        if (isset($_SESSION['flash'])) {
            $params['flash'] = $_SESSION['flash'];
            unset($_SESSION['flash']);
        }

        // if ($usuariModel->getAll() == null) {

        // }

        $params['title'] = "Gestió usuaris";
        $params['llista'] = $usuariModel->getAll();
        $params['var'] = $_ENV['DB_NAME']; //


        if (!isset($_SESSION['user_logged'])) {
            $this->render("usuari/login", $params, "main");
        } else {
            header("Location: /usuari/create");
        }
    }

    public function store()
    {
        $usuariModel = new Usuari();

        $emailUsuari = $_POST['email_usuari'];
        $nomUsuari = $_POST['nom_usuari'];
        $naixementUsuari = $_POST['naixement_usuari'];
        $contrasenyaUsuari = $_POST['contrasenya_usuari'];
        $admin = 0;


        foreach ($usuariModel->getAll() as $usuari) {
            if ($usuari['email'] == $_POST['email_usuari']) {
                $params['flash_ko'] = "Usuari ja existent";
                $this->render("usuari/index", $params, "main");
                die();
            }
        }

        if ($_POST['contrasenya_usuari'] == "admin") {
            $admin = 1;
        } else {

            $admin = 0;
        }


        $caracters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $token = substr(str_shuffle($caracters), 0, 15);


        $pepper = $_ENV['PEPPER'];
        $salt = bin2hex(random_bytes(16));
        $passClear = $contrasenyaUsuari;
        $passWitdhPepperAndSalt = $pepper . $passClear . $salt;
        $passHashed = password_hash($passWitdhPepperAndSalt, PASSWORD_ARGON2ID);

        $usuari = array(
            "email" => $emailUsuari,
            "nom" => $nomUsuari,
            "naixement" => $naixementUsuari,
            "password" => $passHashed,
            "pressupost" => 10000,
            "salt" => $salt,
            "admin" => $admin,
            "token" => $token,
            "verified" => 0
        );

        $usuariModel->insert($usuari);

        $mail = new Mailer();
        $mail->mailServerSetup();
        $mail->addRec([$usuari['email']], [], []);
        $mail->addVerifyContent($usuari);
        $mail->send();

        $params['flash_ok'] = "Usuari creat correctament, verifica el teu correu per poder accedir";

        $params['var'] = $_ENV['DB_NAME']; //
        $this->render("usuari/login", $params, "main");
    }

    public function destroy()
    {
        $usuariModel = new Usuari();

        $usuariModel->removeItemById($_GET['id']);

        header("Location: /usuari/index");
    }

    public function update()
    {
        $usuariModel = new Usuari();
        $id = $_GET['id'] ?? null;
        $params['usuari'] = $usuariModel->getById($id);

        $this->render("usuari/update", $params, "main");
    }

    public function modify()
    {

        $usuariModel = new Usuari();

        if (isset($_POST['contrasenya_usuari'])) { // si el camp contrasenya_usuari no està habilitat no el modifiquem
            $pepper = $_ENV['PEPPER'];
            $salt = bin2hex(random_bytes(16));
            $passClear = $_POST['contrasenya_usuari'];
            $passWithPepperAndSalt = $pepper . $passClear . $salt;
            $passHashed = password_hash($passWithPepperAndSalt, PASSWORD_ARGON2ID);

            $usuari = array(
                "id" => $_POST['id'],
                "email" => $_POST['email_usuari'],
                "nom" => $_POST['nom_usuari'],
                "naixement" => $_POST['usuari_usuari'],
                "password" => $passHashed,
                "salt" => $salt

            );

            $usuariModel->insert($usuari);
        } else {
            $usuari = array(
                "id" => $_POST['id'],
                "email" => $_POST['email_usuari'],
                "nom" => $_POST['nom_usuari'],
                "naixement" => $_POST['usuari_usuari'],
            );
        }



        header("Location: /usuari/index");
    }

    public function addRecuperada()
    {
        $usuariModel = new Usuari();
        $id = $_GET['id'] ?? null;
        $params['title'] = "Afegir Extinguides";
        $params['usuari'] = $usuariModel->getById($id);
        $recuperadaModel = new Recuperada();
        //$params['llista'] = $recuperadaModel->getRecuperadesByIdUsuari($id); //aquí necessito el getRecuperadesByIdUsuari que es trona al model

        $this->render("recuperada/index", $params, "main");
    }

    public function login()
    {


        // $username = $_POST['usuari'] ?? null;
        // $pass = $_POST['contrasenya'] ?? null;

        // //   echo "<pre>";
        // //     var_dump($_POST);
        // //   echo "</pre>";

        // //    die();

        // $enrenadorModel = new Usuari();
        // $result = $enrenadorModel->login($username, $pass);

        // if (is_null($result)) {
        //     $params['flash_ko'] = "Credencials incorrectes";
        //     $this->render("usuari/login", $params, "site");
        // } else {
        //     if ($result['verificat'] == false) {
        //         $params['flash_ko'] = "Usuari no verificat";
        //         $this->render("usuari/login", $params, "site");
        //     } else {
        //         if ($result['usuari_usuari'] == 'admin') {
        //             $params['llista'] = $enrenadorModel->getAll();
        //         }
        //         $_SESSION['user_logged'] = $result;
        //         $params['usuari'] = $result;
        //         $this->render("home/index", $params, "home");
        //     }
        // }


        $email = trim($_POST['email'] ?? null);
        $pass = trim($_POST['contrasenya'] ?? null);

        if (is_null($email) || is_null($pass)) {

            header("Location: /usuari/index");
        } else {
            $usuariModel = new Usuari();
            $resultat = $usuariModel->checkLogin($email, $pass);

            // var_dump($resultat);
            if (is_null($resultat)) {
                $_SESSION['flash']['ko'] = "Credencials incorrectes";
                header("Location: /usuari/index");
            } else {
                if ($resultat['verified'] == 0) {
                    $_SESSION['flash']['ko'] = "Usuari no verificat";
                    header("Location: /usuari/index");
                } else {
                    $_SESSION['user_logged'] = $resultat;
                    //$_SESSION['flash']['ok'] = $resultat;
                    header("Location: /home/index");
                }
            }
        }
    }


    public function create()
    {
        $usuariModel = new Usuari();
        $params['title'] = "Gestió usuaris";
        $params['llista'] = $usuariModel->getAll();
        $params['usuari_loguejat'] = $_GET['id_usuari'] ?? null; // if user_logejat and admin == true veiem la llista


        //$params['usuari_loguejat'] = $usuariModel->getById('1');  


        $this->render("usuari/index", $params, "main");
    }


    public function logout()
    {
        // $recuperadaModel = new Recuperada();
        // $recuperada = array(
        //     "id" => $_POST['id'],
        //     "num_recuperada" => $_POST['num_recuperada'],
        //     "nom_recuperada" => $_POST['nom_recuperada'],

        // );

        // $recuperadaModel->updateItemById($recuperada);

        $params = null;

        $this->render("usuari/logout", $params, "main");
    }

    // public function switchToLogin()
    // {
    //     // $recuperadaModel = new Recuperada();
    //     // $recuperada = array(
    //     //     "id" => $_POST['id'],
    //     //     "num_recuperada" => $_POST['num_recuperada'],
    //     //     "nom_recuperada" => $_POST['nom_recuperada'],

    //     // );

    //     // $recuperadaModel->updateItemById($recuperada);

    //     $params = null;

    //     $this->render("usuari/login", $params, "main");
    // }

    public function verify()
    {
        $email = $_GET['email'];
        $token = $_GET['token'];

        $usuariModel = new Usuari();
        $usuari = $usuariModel->getByEmail($email);

        if ($usuari['token'] == $token) {
            $usuari['verified'] = 1;
            $usuari = $usuariModel->insert($usuari); // ja tenim el camp ID per tant farem un update automàticament
            $params['flash_ok'] = "Usuari verificat correctament";
            $this->render("usuari/login", $params, "main");
        } else {
            $params['flash_ko'] = "Usuari no verificat";
            $params['var'] = $_ENV['DB_NAME']; //
            $this->render("usuari/login", $params, "main");
        }
    }
}
