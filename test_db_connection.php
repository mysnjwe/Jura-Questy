<?php
$servername = "localhost";
$username = "srv90026_juraquest_db";
$password = "zaq12wsxz";
$dbname = "srv90026_juraquest_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>