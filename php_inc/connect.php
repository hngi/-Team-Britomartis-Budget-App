<?php
//Our connection details.
$host = 'localhost';
$user = 'root';
$password = 'student55';
$database = 'db';
 
//An options array.
//Set the error mode to "exceptions"
$pdoOptions = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
);
 
//Connect
$pdo = new PDO("mysql:host=$host;dbname=$database", $user, $password, $pdoOptions);

?>