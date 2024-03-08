<?php

class homeController extends Controller
{
    public function index()
    {
        $params['usuari'] = $_SESSION['user_logged'];
        $this->render("home/index", $params, "home");
    }
}
