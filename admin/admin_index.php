<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Home Page</title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="admin_design.css">
    </head>
    <body>
        <header>
        <h1 class="header">SAVICLE</h1>
        <nav>
            <a href="/midterm/index.php">Home</a>
            <div class="dropdown">
                <h2 class="dropbtn">Furniture</h2>
                <div class="dropdown-content">
                    <a href="/midterm/office.php">Office</a>
                    <a href="/midterm/livingroom.php">Living Room</a>
                    <a href="/midterm/diningroom.php">Dining Room</a>
                    <a href="/midterm/bedroom.php">Bedroom</a>
                    <a href="/midterm/bathroom.php">Bathroom</a>
                </div>
            </div>
            <a href="/midterm/wishlist.php">Wishlist</a>
            <a href="/midterm/cart.php">Cart</a>
            <?php if (isset($_SESSION["user"])): ?>
                <a href="/midterm/login-regis/logout.php" class="logout2">Logout</a>
            <?php else: ?>
                <a href="/midterm/login-regis/login.php" class="login2">Login</a>
            <?php endif; ?>

        </nav>
        </header>
        <div class="homepage">
                <h2>Giving Furniture a <br> Second Chance</h2>
                <p>SAVICLE saves and recycles beautifully crafted furniture, offering timeless  <br>
                    pieces that feel as good as they look, all while giving them a new life in your home.</p>
                <img src="/midterm/photos/homepage.png" class="home">
                <a href="/midterm/admin/admin_panel.php" class="admin_button">Upload Your Furnitures Here >></a>
        </div>
        <!-- <div class="bg-info p-3 text-center">
            <p> All rights reserved SAVICLE 2024</p>
            </div>
        </div> -->
    </body>
</html>

