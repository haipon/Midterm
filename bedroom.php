<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Office Page</title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="design.css">
    </head>
    <body>
        <header>
            <h1 class="header">SAVICLE</h1>
            <nav>
                <a href="/index.php">Home</a>
                <div class="dropdown">
                    <h2 class="dropbtn">Furniture</h2>
                    <div class="dropdown-content">
                        <a href="/office.php">Office</a>
                        <a href="/livingroom.php">Living Room</a>
                        <a href="/diningroom.php">Dining Room</a>
                        <a href="/bedroom.php">Bedroom</a>
                        <a href="/bathroom.php">Bathroom</a>
                    </div>
                </div>
                <a href="/wishlist.php">Wishlist</a>
                <a href="/cart.php">Cart</a>
                <?php if (isset($_SESSION["user"])): ?>
                    <a href="/login-regis/logout.php" class="logout">Logout</a>
                <?php else: ?>
                    <a href="/login-regis/login.php" class="login">Login</a>
                <?php endif; ?>
            </nav>
        </header>


        <h2 class="Title">BEDROOM FURNITURES</h2>
        <h3 class ="pick">Choose Your Desired Category</h3>

            <div class="image-container">
               <a href="/display_furniture/d_bedroom/d_bed.php" class="image-card">
                    <img src="photos/bed.png" alt="Beds">
                    <h2>Beds</h2>
                    <p>Experience restful nights and timeless design
                    with our varied selection of beds. From snug platform styles
                    to grand canopy options, we have the ideal piece to transform your bedroom.
                    </p>
                </a>

                <a href="/display_furniture/d_bedroom/d_nightstand.php" class="image-card">
                    <img src="photos/nightstand.png" alt="Nightstands">
                    <h2>Nightstands</h2>
                    <p>Enhance your bedroom with our stylish nightstands,
                    offering both practicality and elegance. Whether you need extra storag
                    e or a chic surface for your essentials, we have the perfect option to
                    complement your space.


                    </p>
                </a>

                <a href="/display_furniture/d_bedroom/d_dresser.php" class="image-card">
                    <img src="photos/Dressers.png" alt="Dressers">
                    <h2>Dressers</h2>
                    <p>Elevate your storage solutions with our collection of dressers, blending
                    functionality with stylish design. From sleek modern pieces to classic styles, find the perfect
                    addition to organize your essentials beautifully.


                    </p>
                </a>
            </div> <!-- Closing tag for the image-container -->
    </body>
</html>