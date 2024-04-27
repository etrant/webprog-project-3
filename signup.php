<?php
session_start();
$_SESSION['page'] = "signup.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
            <p class="login-text">Already have an account? <a href="signup.php">Log in</a></p>
        </form>
    </div>
    <script src="./js/validate.js"></script>

</body>

</html>