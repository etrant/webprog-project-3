<?php
require_once("functions.php");

$data = array();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $mysqli = initializeDbConnection();

    $userQuery = $mysqli->prepare("SELECT * FROM wishlist WHERE id = ?");
    $userQuery->execute();
    $result = $userQuery->get_result();

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $mysqli->close();
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);
