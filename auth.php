<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["page"])) {
    $mysqli = initializeDbConnection();

    if ($_SESSION['page'] === "signup.php") handleSignup($mysqli);
    if ($_SESSION['page'] === "login.php") handleLogin($mysqli);

    // $mysqli->close(); // Just in case...
}

echo "<h1>Backend error has occured, please contact the developer.</h1>";

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

function handleSignup(object $mysqli): void
{
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // Check if the email already exists
    $userQuery = $mysqli->prepare("SELECT id FROM users WHERE email = ?");
    $userQuery->bind_param("s", $email);
    $userQuery->execute();
    $result = $userQuery->store_result();

    // The user already exists since we got a row back
    if ($result->num_rows > 0) {
        // Email already exists, redirect back with a status message
        header("location: signup.php?status=email_exists");
        return;
    }

    $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);
    $signupQuery = $mysqli->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    $signupQuery->bind_param("ss", $email, $hashedPassword);

    if ($signupQuery->execute()) {
        // Get the last inserted ID to store in the session
        $result = $mysqli->query("SELECT LAST_INSERT_ID()");
        $generatedId = $result->fetch_assoc()['last_id'];

        $_SESSION["user"] = $generatedId;

        header("location: dashboard.php?status=welcome");
        return;
    }
    // Generic error handling if execute fails mysteriously
    header("location: signup.php?status=error");
}

function handleLogin(object $mysqli): void
{
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // Check if the email already exists
    $userQuery = $mysqli->prepare("SELECT id, password FROM users WHERE email = ?");
    $userQuery->bind_param("s", $email);
    $userQuery->execute();
    $result = $userQuery->get_result();

    // The user doesn't exist
    if ($result->num_rows === 0) {
        header("location: login.php?status=invalid");
        exit;
    }

    $user = $result->fetch_assoc();
    $hashed_password = $user['password'];

    if (password_verify($pass, $hashed_password)) {
        $_SESSION["user"] =  $user['id'];
        header("location: dashboard.php");
    } else {
        header("location: login.php?status=invalid");
    }
}
