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
                <a href="/wishlist.php">Wishlist</a>
                <a href="/cart.php">Cart</a>
                <?php if (isset($_SESSION["user"])): ?>
                    <a href="/login-regis/logout.php" class="logout">Logout</a>
                <?php else: ?>
                    <a href="/login-regis/login.php" class="login">Login</a>
                <?php endif; ?>
            </nav>
        </header>

        <h2 class="Title">BATHROOM FURNITURES</h2>
            <h3 class="pick">Choose Your Desired Category</h3>

            <div class="image-container">
                <a href="/display_furniture/d_bathroom/d_bathtub.php" class="image-card">
                    <img src="photos/bathtub.png" alt="Bathtubs">
                    <h2>Bathtubs</h2>
                    <p>Refresh your bathroom with our quality bathtubs. Explore our range of vintage, freestanding, and modern styles to find the perfect fit for your home....</p>
                </a>

                <a href="/display_furniture/d_bathroom/d_sinks.php" class="image-card">
                    <img src="photos/sink.png" width="100px" alt="Sinks">
                    <h2>Sinks</h2>
                    <p>Uncover a diverse range of secondhand sinks that combine charm and utility, perfect for enhancing your space....</p>
                </a>

                <a href="/display_furniture/d_bathroom/d_toiletseats.php" class="image-card">
                    <img src="photos/browntoilet.png" alt="Toilet Seats">
                    <h2>Toilet Seats</h2>
                    <p>Explore our collection of stylish toilet seats that offer both comfort and elegance for your bathroom.
...</p>
                </a>
            </div>

    </body>
</html>
