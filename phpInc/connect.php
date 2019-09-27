<?php
 
/**
 * Start the session.
 */
session_start();

//If using locally, please comment out the remote connection section

//Our Local connection details.
$host = 'localhost';
$user = 'root';
$password = 'student55';
$database = 'gobudget';
 
//An options array.
//Set the error mode to "exceptions"
$pdoOptions = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
);
 
//Connect
$pdo = new PDO("mysql:host=$host;dbname=$database", $user, $password, $pdoOptions);


// This part declares functions and an error array that will used latter in the code
$errors = array();
$signup_report = '';
$login_report = '';
$pass_reset_report = '';

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function display_errors($errors){
    foreach ($errors as $error) {
        return $error;
    }
}

?>