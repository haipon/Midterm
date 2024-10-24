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


        <h2 class="Title">LIVING ROOM FURNITURES</h2>
        <h3 class ="pick">Choose Your Desired Category</h3>

            <div class="image-container">
               <a href="/midterm/display_furniture/d_livingroom/d_sofas.php" class="image-card">
                    <img src="photos/s.png" alt="Sofas">
                    <h2>Sofas</h2>
                    <p>Experience comfort and style with our diverse 
                        selection of sofas. Whether you prefer a cozy 
                        loveseat or a spacious sectional, we have the perfect 
                        fit for your living room.
                    </p>
                </a>

                <a href="/midterm/display_furniture/d_livingroom/d_coffeetable.php" class="image-card">
                    <img src="photos/coffeetable.png" alt="Coffee Table">
                    <h2>Coffee Table</h2>
                    <p>Add a touch of elegance and functionality to your space with 
                        our beautifully crafted coffee tables. Ideal for displaying 
                        décor or keeping your essentials within easy reach.
                    </p>
                </a>

                <a href="/midterm/display_furniture/d_livingroom/d_lighting.php" class="image-card">
                    <img src="photos/lamp.png" alt="Lighting">
                    <h2>Lighting</h2>
                    <p>Brighten up your home with our unique lighting options. 
                        From sleek floor lamps to eye-catching chandeliers, 
                        find the perfect fixture to set the mood in any room.
                    </p>
                </a>
            </div>
    </body>
</html>
