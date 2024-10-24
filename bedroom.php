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
                <a href="index.php">Home</a>
                <div class="dropdown">
                    <h2 class="dropbtn">Furniture</h2>
                    <div class="dropdown-content">
                        <a href="office.php">Office</a>
                        <a href="livingroom.php">Living Room</a>
                        <a href="diningroom.php">Dining Room</a>
                        <a href="bedroom.php">Bedroom</a>
                        <a href="bathroom.php">Bathroom</a>
                    </div>
                </div>
                <a href="wishlist.php">Wishlist</a>
                <a href="cart.php">Cart</a>
                <?php if (isset($_SESSION["user"])): ?>
                    <a href="/midterm/login-regis/logout.php" class="logout">Logout</a>
                <?php else: ?>
                    <a href="/midterm/login-regis/login.php" class="login">Login</a>
                <?php endif; ?>
            </nav>
        </header>


        <h2 class="Title">BEDROOM FURNITURES</h2>
        <h3 class ="pick">Choose Your Desired Category</h3>

            <div class="image-container">
               <a href="/midterm/display_furniture/d_bedroom/d_bed.php" class="image-card">
                    <img src="photos/bed.png" alt="Beds">
                    <h2>Beds</h2>
                    <p>Experience comfort and style with our diverse 
                        selection of sofas. Whether you prefer a cozy 
                        loveseat or a spacious sectional, we have the perfect 
                        fit for your living room.
                    </p>
                </a>

                <a href="/midterm/display_furniture/d_bedroom/d_nightstand.php" class="image-card">
                    <img src="photos/nightstand.png" alt="Nightstands">
                    <h2>Nightstands</h2>
                    <p>Discover our unique collection of preloved nightstands,
                        where functionality meets flair. These charming pieces 
                        not only keep your essentials within reach but also infuse your
                        bedroom with personality and warmth.
                    </p>
                </a>

                <a href="/midterm/display_furniture/d_bedroom/d_dresser.php" class="image-card">
                    <img src="photos/Dressers.png" alt="Dressers">
                    <h2>Dressers</h2>
                    <p>Explore our preloved dressers that combine style and utility.
                        With unique designs and ample storage, 
                        these pieces enhance your bedroom while keeping your items organized.
                    </p>
                </a>
            </div> <!-- Closing tag for the image-container -->
    </body>
</html>