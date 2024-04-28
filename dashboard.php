<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomeMarket | Dashboard</title>
    <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="stylesheet" href="./css/global.css">
    <script src="js/dashboard.js"></script>
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <a href="index.php">HomeMarket</a>
            </div>
            <ul class="navlinks">
                <h1>Dashboard</h1>
                <form action="functions.php" method="post">
                <li><a href="functions.php?action=signOut">Log Out</a></li>
        </form>
            </ul>
        </nav>
    </header>
    <div class="centered">
        <h1>Welcome to HomeMarket</h1>
        <h2>Find your dream home here</h2>
       <div class="search-bar">
                    <input type="text" placeholder="Search for a property">
                    <button type="submit">Search</button>
                </div>
    </div>
    <main id="property-list">

    </main>
    <!--Modal-->
    <div id="property-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Property Details</h2>
            <div id="modal-property-details">
            </div>
          
        </div>
    </div>

</body>

</html>