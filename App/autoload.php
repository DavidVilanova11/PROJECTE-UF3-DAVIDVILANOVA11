<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once(__DIR__ . "/config.php");
require_once(__DIR__ . "/Router.php");
require_once(__DIR__ . "/Core/Controller.php");
require_once(__DIR__ . "/../vendor/autoload.php");
// require_once("App/config.php");
// require_once("App/Router.php");
// require_once("App/Models/Usuari.php");
// require_once("App/Models/Casa.php");
// require_once("App/Models/Recuperada.php");
// require_once("App/Core/Controller.php");
// require_once(__DIR__ . '/../vendor/autoload.php');
