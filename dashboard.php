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
                <li><a href="wishlist.php">Wishlist</a></li>
                <li><a href="signout.php">Sign Out</a></li>
            </ul>
        </nav>
    </header>

    <div class="centered">
        <h1>Hey <?php echo $_SESSION["user_name"] ?>, Welcome to HomeMarket.</h1>
        <h2>Let's search for your dream home</h2>
        <div class="search-bar">
            <form method="GET" action="dashboard.php">
                <input type="text" name='search' placeholder="Search for a property by city, address, or max price">
                <button type="submit">Search</button>
            </form>
        </div>
    </div>

    <main>
        <div id="properties-list">
        </div>
    </main>

    <div id="modal" class="modal-container">
        <div class="modal-content">
            <button onclick="closeModal()" class="close-button">&times;</button>
            <div id="image" class="modal-left">
            </div>
            <div id=" model-content" class="modal-right">
                <div class="property-glance">
                    <h3>Price</h3>
                    <p id="price" class="property-price">$950000</p>
                    <h3>Property Overview</h3>
                    <ul id="specs" class="property-specs">
                        <li><b>3</b> bds</li>
                        <li><b>2.5</b> ba</li>
                        <li><b>2354</b> sqft</li>
                    </ul>
                    <h3>Property Location</h3>
                    <p id="address" class="property-address">123 Sesame St, Clarkston, GA 30000</p>
                    <h3>Seller Description</h3>
                    <p id="summary" class="property_description">Blah blah blah blah blah.</p>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/modal.js"></script>
    <script src="./js/dashboard.js"></script>
    <script>
        window.onload = function() {
            <?php if (isset($_GET['search']) && !empty($_GET['search'])) : ?>
                getProperties("<?php echo htmlspecialchars($_GET['search']) ?>", <?php echo $_SESSION["user_id"]; ?>);
            <?php else : ?>
                getProperties("", <?php echo $_SESSION["user_id"]; ?>);
            <?php endif; ?>
        };
    </script>
</body>

</html>