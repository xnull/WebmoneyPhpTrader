<?php

include_once 'Core/Loader.php';

$request = new Application_Request();
$router = new Application_Router($request);
$router->runController();

