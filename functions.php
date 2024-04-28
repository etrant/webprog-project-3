<?php
function initializeDbConnection(): object
{
    $servername = "localhost";
    $username = "etrant1";
    $password = "etrant1";
    $dbname = "etrant1";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        exit("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
