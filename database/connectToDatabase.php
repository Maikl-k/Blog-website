<?php

$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "1234";
$databaseName = "DB2";

// create connction
$conn = new mysqli($serverName, $dbUsername, $dbPassword, $databaseName);


// check connection
if($conn->connect_error)
{
    die("connection failed: " . $conn->connect_error);
}