<?php

require_once(__DIR__ . "/App/autoload.php");
include_once(__DIR__ . "/App/Router.php");

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$r = new Router();
$r->run();
