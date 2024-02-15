<?php

class homeController extends Controller
{
    public function index()
    {
        $this->render("home/index", [], "home");
    }
}
