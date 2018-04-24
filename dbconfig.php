<?php
$host = "localhost";
$dbname = "classicmodels";
$username = "root";
$password = "";

// Code from lecures

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}

?>