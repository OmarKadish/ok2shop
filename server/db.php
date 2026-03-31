<?php
session_start();

//$host = "localhost";               // My MySQL host (usually "localhost")
//$dbname = "kadish1_ok2shopDB";    // database name
//$username = "kadish1_ok2Admin";       // MySQL username
//$password = "qvu7Qj3LdcVPZLdVApAs";       // MySQL password
$host = "localhost";               // My MySQL host (usually "localhost")
$dbname = "ok2shop";    // database name
$username = "omar";       // MySQL username
$password = "niiRexME*w4h7[0@";       // MySQL password

$home_url = "http://" . $_SERVER['HTTP_HOST'] . "/index.php";

// I use PhpMyAdmin to manage my databases 
//$conn = new mysqli($host, $username, $password, $dbname);
//
//if ($conn->connect_error) {
//    die("Connection failed: " . $conn->connect_error);
//}
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}
?>