<?php
session_start();
$_SESSION['page'] = "signup.php";
if (isset($_SESSION["user_id"])) {
    header("location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomeMarket | Sign up</title>
    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/auth.css">
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <a href="signup.php">HomeMarket</a>
            </div>
            <ul class="navlinks">
                <li><a href="login.php">Log in</a></li>
                <li class="active"><a href="signup.php">Sign up</a></li>
            </ul>
        </nav>
    </header>

    <div class="form-container">
        <form id="signupForm" action="auth.php" method="POST">
            <section class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
                <div class="error-message"></div>
            </section>
            <section class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Create a password" required>
                <div class="error-message"></div>
            </section>
            <section class="input-group">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password" required>
                <div class="error-message"></div>
            </section>
            <button type="submit">Create account</button>
            <p class="login-text">Already have an account? <a href="login.php">Log in</a></p>

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
    </div>
    <script src="./js/validate.js"></script>

</body>

</html>