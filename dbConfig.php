<?php 
$servername = "localhost";
$username = "";
$password = "";
$dbname = "";

// Skapa anslutning med databasen
$conn = new mysqli($servername, $username, $password, $dbname);
// Kontrollera anslutning
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
} 
?>