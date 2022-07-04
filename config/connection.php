<?php

# configuration database
$host = "localhost";
$usename = "root";
$password = "";
$database = "book-store";

/** 
 * Creating database connection
 * Using the PHP Data Object (PDO)
 **/ 
try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $usename, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed : " . $e->getMessage();
}

?>