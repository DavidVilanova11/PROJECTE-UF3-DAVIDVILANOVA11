<?php

class Router
{

    private $controller;
    private $method;

    public function __construct()
    {
        $this->matchRoute();
    }

    public function matchRoute()
    {
        $url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $url_array = explode('/', $url_path);
        $this->controller = !empty($url_array[1]) ? $url_array[1] : 'usuari';
        $this->controller = $this->controller . "Controller";
        require_once("App/Controllers/" . $this->controller . ".php");
        $this->method = !empty($url_array[2]) ? $url_array[2] : 'index'; // canviar quest per anar directament al login
    }

    public function run()
    {
        $controller = new $this->controller(); //$hector = new Persona();
        $method = $this->method;
        $controller->$method(); // $hector->saluda();

    }
}
