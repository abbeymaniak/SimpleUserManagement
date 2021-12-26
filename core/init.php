<?php

ob_start();


session_start();



include 'db/connection.php';

foreach (glob(dirname(__FILE__) . "/libraries/*.php") as $filename) {
	include $filename;
}

global $pdo;



$getFromU = new User($pdo);
$getFromV = new Validation($pdo);
$getCRUD = new Database($pdo);



define("BASE_URL", "http://localhost/CaesarsCourtHotelBackend/"); //FOR LOCALHOST


date_default_timezone_set("Africa/Lagos");
define('SITE_ROOT', realpath(dirname(__FILE__))); //for file upload path

// Include Handlers
foreach (glob(dirname(__FILE__) . "/handlers/*.php") as $filename) {
	include $filename;
}

ini_set('display_errors',1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/log.txt');
// error_reporting(E_ALL);

 error_reporting(0); 