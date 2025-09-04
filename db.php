<?php
$host = "127.0.0.1";
$port = "3307";   
$username = "root";
$password = "";      
$dbname = "login_system";

$conn = new mysqli($host, $username, $password, $dbname, $port);

if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}
?>
