<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
    $connectdb = new PDO("mysql:host=$servername;dbname=mydb", $username, $password);
    $connectdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "DB connected successfully";
} catch(PDOException $err) {
    // Check connection
    die("Access Denied to connect to db: " . $err->getMessage());
}

// check for any syntax error
