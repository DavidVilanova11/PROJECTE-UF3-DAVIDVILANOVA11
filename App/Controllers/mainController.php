<?php

class mainController extends Controller
{

    public function index()
    {
        $params = [];

        $this->render("home/index", $params, "site");
    }
}
