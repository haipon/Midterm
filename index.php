<?php
session_start();

if (isset($_SESSION["user"])) {
    header("Location: /midterm/admin/admin_index.php");
    exit();
}

// Error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Home Page</title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="home_design.css">
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
                <a href="/midterm/login-regis/login.php" class="login">Logout</a>
            <?php else: ?>
                <a href="/midterm/login-regis/login.php" class="login">Login</a>
            <?php endif; ?>
        </nav>
        </header>
        <div class="homepage">
                <h2>Giving Furniture a <br> Second Chance</h2>
                <p>SAVICLE saves and recycles beautifully crafted furniture, offering timeless  <br>
                    pieces that feel as good as they look, all while giving them a new life in your home.</p>
                <img src="photos/homepage.png" class="home">
        </div>
        <!-- <div class="bg-info p-3 text-center">
            <p> All rights reserved SAVICLE 2024</p>
            </div>
        </div> -->
    </body>
</html>