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


        <h2 class="Title">DINING ROOM FURNITURES</h2>
        <h3 class ="pick">Choose Your Desired Category</h3>

        <div class="image-container">
               <a href="/midterm/display_furniture/d_diningroom/d_cabinet.php" class="image-card">
                    <img src="photos/woodencabinet.png" alt="Cabinets">
                    <h2>Cabinets</h2>
                    <p>Transform your kitchen with our exquisite selection of cabinets. 
                        With diverse styles and finishes, find the perfect blend of 
                        practicality and elegance to enhance your culinary space.
                    </p>
                </a>

                <a href="/midterm/display_furniture/d_diningroom/d_table.php" class="image-card">
                    <img src="photos/diningtable.png" alt="Dining Tables">
                    <h2>Dining Tables</h2>
                    <p>Gather around our stunning dining tables, 
                        where style meets functionality. 
                        From rustic charm to modern elegance, 
                        discover the perfect centerpiece for your dining experience.
                    </p>
                </a>

                <a href="/midterm/display_furniture/d_diningroom/d_accessories.php" class="image-card">
                    <img src="photos/mug.png" alt="Accessories">
                    <h2>Accessories</h2>
                    <p>Spruce up your kitchen with our delightful range of accessories! 
                        From stylish mugs to handy utensils, find the perfect pieces that
                        add personality and charm to your cooking space.
                    </p>
                </a>
            </div> <!-- Closing tag for the image-container -->
    </body>
</html>