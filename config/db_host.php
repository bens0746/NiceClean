<?php
    $servername = "localhost";
    $username = "zdmtyqaz_nicecleandb";
    $password = "nicenice";
    $dbname = "zdmtyqaz_nicecleandb";

    try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
    } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    }
?>