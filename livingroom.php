<!DOCTYPE html>
<html>
    <head>
        <title>Living Room Page</title>
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
                <a href="/midterm/login-regis/login.php" class="login">Login</a>
            </nav>
        </header>


        <h2 class="Title">LIVING ROOM FURNITURES</h2>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <div class="image-container">
                <div class="image-card" data-target="#section1">
                    <img src="photos/s.png" alt="Sofas">
                    <h2>Sofas</h2>
                    <p>Experience comfort and style with our diverse 
                        selection of sofas. Whether you prefer a cozy 
                        loveseat or a spacious sectional, we have the perfect 
                        fit for your living room.
                    </p>
                </div> <!-- Closing tag for the first image-card -->
            
                <div class="image-card" data-target="#section2">
                    <img src="photos/coffeetable.png" alt="Coffee Table">
                    <h2>Coffee Table</h2>
                    <p>Add a touch of elegance and functionality to your space with 
                        our beautifully crafted coffee tables. Ideal for displaying 
                        décor or keeping your essentials within easy reach.
                    </p>
                </div> <!-- Closing tag for the second image-card -->
            
                <div class="image-card" data-target="#section3">
                    <img src="photos/lamp.png" alt="Lighting">
                    <h2>Lighting</h2>
                    <p>Brighten up your home with our unique lighting options. 
                        From sleek floor lamps to eye-catching chandeliers, 
                        find the perfect fixture to set the mood in any room.
                    </p>
                </div> <!-- Closing tag for the third image-card -->
            </div> <!-- Closing tag for the image-container -->
            <main>
        </main>

        <section id="section1" class="styled-section">
            <h1>Sofas</h1>
            
        </section>

        <section id="section2" class="styled-section">
            <h1>Coffee Table</h1>
        </section>

        <section id="section3" class="styled-section">
            <h1>Lighting</h1>
        </section>

        <script src="script.js"></script> 
        
        <main>
        </main>
    </body>
</html>
