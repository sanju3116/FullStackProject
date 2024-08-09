<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb2";
$port = 3306; 
$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>

