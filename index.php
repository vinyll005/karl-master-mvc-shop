<?php

error_reporting(E_ALL);

session_start();

define('ROOT', __DIR__);

require_once(ROOT.'/components/Loader.php');

$router = new Router;

$router->run();