<?php
require_once("functions.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$data = array();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $mysqli = initializeDbConnection();

    $searchTerm = !empty($_GET['query']) ? $_GET['query'] : '';

    if (empty($searchTerm)) {
        $userQuery = $mysqli->prepare("SELECT * FROM properties");
        $userQuery->execute();
        $result = $userQuery->get_result();

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    } else {
        $userQuery = $mysqli->query("SELECT * FROM properties WHERE 
    address LIKE '%$searchTerm%' OR 
    city LIKE '%$searchTerm%' OR
    price <= '$searchTerm'");

        while ($row = $userQuery->fetch_assoc()) {
            $data[] = $row;
        }
    }


    $mysqli->close();
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);
