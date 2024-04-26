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
                <a href="/">HomeMarket</a>
            </div>
            <ul class="navlinks">
                <li class="active"><a href="login.php">Log in</a></li>
                <li><a href="signup.php">Sign up</a></li>
            </ul>
        </nav>
    </header>

    <div class="form-container">
        <form id="loginForm" action="your-server-endpoint.php" method="POST">
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
        </form>
</body>

</html>