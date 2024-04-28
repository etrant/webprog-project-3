<?php
session_start();
$_SESSION['page'] = "login.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomeMarket | Log in</title>
    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/auth.css">
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <a href="index.php">HomeMarket</a>
            </div>
            <ul class="navlinks">
                <li class="active"><a href="login.php">Log in</a></li>
                <li><a href="signup.php">Sign up</a></li>
            </ul>
        </nav>
    </header>

    <div class="form-container">
        <form id="loginForm" action="auth.php" method="POST">
            <section class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
                <div class="error-message"></div>
            </section>
            <section class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
                <div class="error-message"></div>
            </section>
            <button type="submit">Log in</button>
            <p class="login-text">Need an account? <a href="signup.php">Sign up</a></p>

            <?php
            if (isset($_GET["status"])) {
                switch ($_GET["status"]) {
                    case 'invalid':
                        echo '<div class="error-message error server">Invalid username or password.</div>';
                        break;
                    case 'email_exists';
                        echo '<div class="error-message error server">Email already in use.</div>';
                        break;
                    case 'error';
                        echo '<div class="error-message error server">Something went wrong.</div>';
                        break;
                }
            }
            ?>
        </form>
</body>

</html>