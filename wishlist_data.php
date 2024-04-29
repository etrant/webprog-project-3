<?php
require_once("functions.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$data = array();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $mysqli = initializeDbConnection();

    $p_id = !empty($_GET['property_id']) ? $_GET['property_id'] : '';
    $u_id = !empty($_GET['user_id']) ? $_GET['user_id'] : '';

    if (!empty($p_id) && !empty($u_id)) {
        $userQuery = $mysqli->query("SELECT * FROM wishlists WHERE property_id = '$p_id' AND user_id = '$u_id'");

        while ($row = $userQuery->fetch_assoc()) {
            $data[] = $row;
        }
    } else if (!empty($_GET["translate"]) && !empty($u_id)) {
        $userQuery = $mysqli->query("SELECT properties.*
        FROM properties INNER JOIN wishlists ON properties.id = wishlists.property_id
        WHERE wishlists.user_id = '$u_id'");

        while ($row = $userQuery->fetch_assoc()) {
            $data[] = $row;
        }
    } else if (!empty($u_id)) {
        $userQuery = $mysqli->query("SELECT * FROM wishlists WHERE user_id = '$u_id'");

        while ($row = $userQuery->fetch_assoc()) {
            $data[] = $row;
        }
    } else {
        echo "Error.";
    }

    $mysqli->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mysqli = initializeDbConnection();

    // Get JSON as a string
    $json_str = file_get_contents('php://input');

    // Decode it into an associative array
    $json_obj = json_decode($json_str, true);

    $p_id = $json_obj["property_id"];
    $u_id = $json_obj["user_id"];

    if ($json_obj["modify"] === "add") {
        $userQuery = $mysqli->query("INSERT INTO wishlists (property_id, user_id) VALUES ('$p_id', '$u_id')");
    }

    if ($json_obj["modify"] === "delete") {
        $userQuery = $mysqli->query("DELETE FROM wishlists WHERE property_id = '$p_id' AND user_id = '$u_id'");
    }


    $mysqli->close();
}


header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);
