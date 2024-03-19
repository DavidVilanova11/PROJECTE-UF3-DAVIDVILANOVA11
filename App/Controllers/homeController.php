<?php

class homeController extends Controller
{
    public function index()
    {
        $params['usuari'] = $_SESSION['user_logged'];
        $params['title'] = "Home";
        $this->render("home/index", $params, "home");
    }
}
