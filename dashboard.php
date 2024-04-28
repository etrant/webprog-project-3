<?php

session_start();


$host = "localhost";
$user = "uthompson3";
$pass = "uthompson3";
$dbname = "uthompson3";

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    echo "Could not connect to server\n";
    die("Connection failed: " . $conn->connect_error);
} 

$searchTerm = !empty($_GET['search']) ? $_GET['search'] : ''; // Check if 'search' parameter is set and not empty
if (!empty($searchTerm)) {
    // Use prepared statement to prevent SQL injection
    $sql = "SELECT * FROM property WHERE 
    property_name LIKE '%$searchTerm%' OR 
    property_address LIKE '%$searchTerm%' OR 
    property_description  LIKE '%$searchTerm%' OR
    price LIKE '%$searchTerm%' ";
    $result = $conn->query($sql);
    $properties = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $properties[] = $row;
        }
    }
} else {
    // SQL query to retrieve data from the property table
    $sql = "SELECT * FROM property";
    $result = $conn->query($sql);

    $properties = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $properties[] = $row;
        }
    }
}
// Execute the SQL query
if ($conn->query($sql) === TRUE) {
    echo "New records inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
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
                <h1>Dashboard</h1>
                <form action="functions.php" method="post">
                <li><a href="functions.php?action=signOut">Log Out</a></li>
                <li><?php $_SESSION["user"]?></li>
        </form>
            </ul>
        </nav>
    </header>
    <div class="centered">
        <?php
        
        if (isset($_GET['status'])) {

echo '<h1>Welcome to our platform. Thank you for choosing us for your purchasing needs</h1>';
 echo '  <h2>Lets find your dream home</h2>';
}
else{
    
    echo '<h1>Welcome to HomeMarket</h1>';
    echo '  <h2>Find your dream home here</h2>';
}
?>
       <div class="search-bar">
         <form method="GET" action="">
                    <input type="text" name='search' placeholder="Search for a property by name, address, or price">
                    <button type="submit">Search</button>
</form>
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
 <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchResults = <?php echo json_encode($properties); ?>;
            
            function generatePropertyCards(results) {
                const propertyList = document.getElementById('property-list');

                propertyList.innerHTML = '';

                results.forEach(property => {
                    const card = document.createElement('div');
                    card.classList.add('property-card');

                    const img = document.createElement('img');
                    img.src = property.image_path; // Assuming the image path column is named 'image_path'
                    img.alt = property.property_name;

                    const details = document.createElement('div');
                    details.classList.add('property-details');
                    details.innerHTML = `
                        <h2>${property.property_name}</h2>
                        <p>Address: ${property.property_address}</p>
                        <p>Price: $${property.price}</p>
                        <button class="view-details-btn">View Details</button>
                    `;

                    card.appendChild(img);
                    card.appendChild(details);
                    propertyList.appendChild(card);

                    // Add event listener to the "View Details" button to open modal
                    const viewDetailsBtn = details.querySelector('.view-details-btn');
                    viewDetailsBtn.addEventListener('click', function() {
                        openModal(property);
                    });
                });
            }

            generatePropertyCards(searchResults);

            // Modal functionality
            const modal = document.getElementById('property-modal');
            const modalContent = document.querySelector('.modal-content');
            const modalPropertyDetails = document.getElementById('modal-property-details');
            const closeModalBtn = document.querySelector('.close');

            function openModal(property) {
                modal.style.display = 'block';
                modalPropertyDetails.innerHTML = `
                    <img src="${property.image_path}" alt="${property.property_name}">
                    <p><strong>Name:</strong> ${property.property_name}</p>
                    <p><strong>Address:</strong> ${property.property_address}</p>
                    <p><strong>Price:</strong> $${property.price}</p>
                    <p><strong>Description:</strong> ${property.property_description}</p>
                    <button class="wishlist-btn">Add to Wishlist</button>
                `;
                const wishlistBtn = modalPropertyDetails.querySelector('.wishlist-btn');
                wishlistBtn.addEventListener('click', function() {
                    wishlistBtn.innerHTML = "Added";
                    wishlistBtn.disabled = true; 
                });
            }

            closeModalBtn.addEventListener('click', function() {
                modal.style.display = 'none';
            });

            window.addEventListener('click', function(event) {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            });
        });
    </script>

</body>

</html>