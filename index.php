<?php
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
        <!-- Corrected header tag -->
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
                <a href="/midterm/login-regis/login.php" class="login">Login</a>
            </nav>
        </header>
        <div class="homepage">
                <h2>Giving Furniture a <br> Second Chance</h2>
                <p>SAVICLE saves and recycles beautifully crafted furniture, offering timeless  <br>
                    pieces that feel as good as they look, all while giving them a new life in your home.</p>
                <img src="photos/homepage.png" class="home">
        </div>
        <main>
        </main>
    </body>
</html>
