<?php
//for Database Connection
$host = "localhost";
$username = "root";
$password = ""; // enter the MySQL password if have 
$dbname = "event_db";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //ensures a secure and flexible way to interact with MySQL, with    built-in support for prepared statements to prevent SQL injection.
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
