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
                <a href="wishlist.php">Wishlist</a>
                <a href="cart.php">Cart</a>
                <a href="/midterm/login-regis/login.php" class="login">Login</a>
            </nav>
        </header>


        <h2 class="Title">BATHROOM FURNITURES</h2>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <div class="image-container">
                <div class="image-card" data-target="#section1">
                    <img src="photos/bathtub.png" alt="Bathtubs">
                    <h2>Bathtubs</h2>
                    <p>Revamp your workspace with our stylish, 
                        pre-loved office desks. Each desk offers a 
                        unique character and sturdy design, perfect for 
                        enhancing productivity while supporting sustainable choices.
                    </p>
                </div> <!-- Closing tag for the first image-card -->
            
                <div class="image-card" data-target="#section2">
                    <img src="photos/sink.png" width="100px" alt="Sinks">
                    <h2>Sinks</h2>
                    <p>Discover the perfect blend of comfort and style with our 
                        collection of used office chairs. Designed for ergonomic support, 
                        these chairs will keep you productive without compromising on aesthetics.
                    </p>
                </div> <!-- Closing tag for the second image-card -->
            
                <div class="image-card" data-target="#section3">
                    <img src="photos/browntoilet.png" alt="Toilet Seats">
                    <h2>Toilet Seats</h2>
                    <p>Maximize your office 
                        organization with our selection of 
                        used storage solutions. From charming filing cabinets 
                        to versatile shelves, each piece combines functionality with 
                        sustainability to enhance your workspace.
                    </p>
                </div> <!-- Closing tag for the third image-card -->
            </div> <!-- Closing tag for the image-container -->
            <main>
        </main>

        <section id="section1" class="styled-section">
            <h1>Bathtubs</h1>
            
        </section>

        <section id="section2" class="styled-section">
            <h1>Sinks</h1>
        </section>

        <section id="section3" class="styled-section">
            <h1>Toilet Seats</h1>
        </section>

        <script src="script.js"></script> 
        
        <main>
        </main>
    </body>
</html>
