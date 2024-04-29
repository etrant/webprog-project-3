<?php
require_once("functions.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$data = array();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $mysqli = initializeDbConnection();

    $id = !empty($_GET["id"]) ? $_GET["id"] : '';

    if (!empty($_GET["id"])) {
        $result = $mysqli->query("SELECT * FROM properties WHERE id = $id");
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    $mysqli->close();
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);
