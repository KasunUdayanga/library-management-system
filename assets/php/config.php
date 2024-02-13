<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "library_system";

// Create MySQLi connection
$database = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($database->connect_error) {
    die("Connection failed: " . $database->connect_error);
}


?>
