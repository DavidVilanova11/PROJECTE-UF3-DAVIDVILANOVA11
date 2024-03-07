<?php

class mainController extends Controller
{

    public function index()
    {
        $params = null;
        if (isset($_SESSION['flash'])) {
            $params['flash'] = $_SESSION['flash'];
            unset($_SESSION['flash']);
        }
        $params = null;

        $this->render("home/index", $params, "site");
    }
}
