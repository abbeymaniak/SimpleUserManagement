<?php

// FOR LOCALHOST









// For Localhost
define("db_username", "root");
define("db_password", "");
define("db_name", "usermgtassessment");
define("db_host", "localhost");

//Assign Constants to PDO Variables
$dsn = "mysql:host=" . db_host . "; dbname=" . db_name . "";
$user = db_username;
$pass = db_password;

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $pdo->exec("SET CHARACTER SET UTF8");
} catch (PDOException $e) {
    echo "Connection Error! " . $e->getMessage();
}