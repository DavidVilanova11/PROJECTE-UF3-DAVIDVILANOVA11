<?php
if (!isset($_SESSION)) {
    session_start();
}
include_once("App/config.php");
include_once("App/Router.php");
include_once("App/Models/Usuari.php");
include_once("App/Models/Recuperada.php");
include_once("App/Core/Controller.php");
require_once(__DIR__ . '/../vendor/autoload.php');
