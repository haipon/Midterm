<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Bathroom Page</title>
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
                <a href="/midterm/wishlist.php">Wishlist</a>
                <a href="/midterm/cart.php">Cart</a>
                <?php if (isset($_SESSION["user"])): ?>
                    <a href="/midterm/login-regis/logout.php" class="logout">Logout</a>
                <?php else: ?>
                    <a href="/midterm/login-regis/login.php" class="login">Login</a>
                <?php endif; ?>
            </nav>
        </header>

        <h2 class="Title">BATHROOM FURNITURES</h2>
            <h3 class="pick">Choose Your Desired Category</h3>

            <div class="image-container">
                <a href="/midterm/display_furniture/d_bathroom/d_bathtub.php" class="image-card">
                    <img src="photos/bathtub.png" alt="Bathtubs">
                    <h2>Bathtubs</h2>
                    <p>Revamp your workspace with our stylish, pre-loved office desks. Each desk offers a unique character...</p>
                </a>

                <a href="/midterm/display_furniture/d_bathroom/d_sinks.php" class="image-card">
                    <img src="photos/sink.png" width="100px" alt="Sinks">
                    <h2>Sinks</h2>
                    <p>Discover the perfect blend of comfort and style with our collection of used office chairs...</p>
                </a>

                <a href="/midterm/display_furniture/d_bathroom/d_toiletseats.php" class="image-card">
                    <img src="photos/browntoilet.png" alt="Toilet Seats">
                    <h2>Toilet Seats</h2>
                    <p>Maximize your office organization with our selection of used storage solutions...</p>
                </a>
            </div>

    </body>
</html>
