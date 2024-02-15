<?php


class userController extends Controller
{

    public function home()
    {
        //hola
        echo "Estic a Home!!!!";
    }

    public function index()
    {

        $params['flash_ok'] = $_SESSION['flash_ok'];
        unset($_SESSION['flash_ok']);
        $this->render("user/login", $params, "site");
    }

    public function store()
    {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $pass = $_POST['pass'];

        if ($username == 'admin') {
            $admin = true;
        } else {
            $admin = false;
        }

        $user = array(
            "name" => $name,
            "username" => $username,
            "password" => $pass,
            "admin" => $admin
        );

        $userModel = new User();

        $userModel->create($user);
        $_SESSION['flash_ok'] = "Usuari creat correctament";

        header("Location: /user/index");
    }

    public function list()
    {

        $userModel = new User();
        $llista = $userModel->getAll();
        foreach ($llista as $u) {
            echo "<pre>";
            print_r($u);
            echo "</pre>";
        }
    }

    public function create()
    {

        $params = null;
        $this->render("user/create", $params, "site");
        //include_once(__DIR__ . "../../Views/user/create.view.php");
    }


    public function login()
    {
        $username = $_POST['username'] ?? null;
        $pass = $_POST['pass'] ?? null;

        $userModel = new User();
        $result = $userModel->login($username, $pass);

        if ($result['username'] == 'admin') {
            $params['llista'] = $userModel->getAll();
        }

        if (is_null($result)) {
            $params['flash_ko'] = "Credencials incorrectes";
            $this->render("user/login", $params, "site");
        } else {
            $params['usuari'] = $result;
            $this->render("home/index", $params, "site");
        }
    }
}
