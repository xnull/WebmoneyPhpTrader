<?php
$pathToLoader = realpath(dirname(__FILE__) . '../../Core/Loader.php');
include_once $pathToLoader;

$algo = new Algorithm_MainChain_Algorithm();
$algo->start();
