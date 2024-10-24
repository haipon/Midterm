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


        <h2 class="Title">OFFICE FURNITURES</h2>
        <h3 class ="pick">Choose Your Desired Category</h3>

            <div class="image-container">
               <a href="/midterm/display_furniture/d_office/d_desk.php" class="image-card">
               <img src="photos/officedesk.png" alt="Desks">
                    <h2>Desks</h2>
                    <p>Revamp your workspace with our stylish, 
                        pre-loved office desks. Each desk offers a 
                        unique character and sturdy design, perfect for 
                        enhancing productivity while supporting sustainable choices.
                    </p>
                </a>

                <a href="/midterm/display_furniture/d_office/d_chairs.php" class="image-card">
                    <img src="photos/officechair.png" alt="Chairs">
                    <h2>Chairs</h2>
                    <p>Discover the perfect blend of comfort and style with our 
                        collection of used office chairs. Designed for ergonomic support, 
                        these chairs will keep you productive without compromising on aesthetics.
                    </p>
                </a>

                <a href="/midterm/display_furniture/d_office/d_storage.php" class="image-card">
                <img src="photos/officestorage.png" alt="Storage">
                    <h2>Storage</h2>
                    <p>Maximize your office 
                        organization with our selection of 
                        used storage solutions. From charming filing cabinets 
                        to versatile shelves, each piece combines functionality with 
                        sustainability to enhance your workspace.
                    </p>
                </a>
            </div>
    </body>
</html>
