<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomeMarket | Dashboard</title>
    <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="stylesheet" href="./css/global.css">
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <a href="index.php">HomeMarket</a>
            </div>
            <ul class="navlinks">
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="signout.php">Sign Out</a></li>
            </ul>
        </nav>
    </header>

    <div class="centered">
        <h1>Your wishlist.</h1>
    </div>

    <main>
        <div id="properties-list">

        </div>
    </main>
</body>

</html>