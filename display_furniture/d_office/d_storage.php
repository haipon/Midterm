<!DOCTYPE html>
<html>
    <head>
        <title>Office Page</title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="/midterm/design.css">
        <link rel="stylesheet" href="/midterm/display_furniture/display_design.css">
        
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
                <a href="/midterm/login-regis/login.php" class="login">Login</a>
            </nav>
        </header>

        <h2 class="Title2">BATHTUBS</h2>
        <div class="search-bar">
            <input type="text" placeholder="Search...">
            <button class="search-btn">🔍</button>
        </div>

        <div class="furniture-grid">
            <div class="furniture-card">
                <img src="photos/bathtub.png" alt="Bathtub">
                <div class="card-content">
                    <h2>Name</h2>
                    <p>Description</p>
                    <div class="price">
                        <span class="currency">Rp</span>
                        <span class="amount">3.499.000</span>
                    </div>
                    <button class="addCart">
                        Add to Cart
                    </button>
                    <button class="wishlist">
                        <i class="fa-regular fa-heart"></i>
                    </button>
                    <button class="comment">
                        <i class="fa-regular fa-comment"></i>
                    </button>
                </div>
            </div>
            <div class="furniture-card">
                <img src="vanity.jpg" alt="Vanity">
                <div class="card-content">
                    <h2>Name</h2>
                    <p>Description</p>
                    <div class="price">
                        <span class="currency">Rp</span>
                        <span class="amount">5.499.000</span>
                    </div>
                    <button class="addCart">
                        Add to Cart
                    </button>
                    <button class="wishlist">
                        <i class="fa-regular fa-heart"></i>
                    </button>
                    <button class="comment">
                        <i class="fa-regular fa-comment"></i>
                    </button>
                </div>
            </div>
            <div class="furniture-card">
                <img src="sofa2.jpg" alt="Sofa">
                <div class="card-content">
                    <h2>Name</h2>
                    <p>Description</p>
                    <div class="price">
                        <span class="currency">Rp</span>
                        <span class="amount">9.999.000</span>
                    </div>
                    <button class="addCart">
                        Add to Cart
                    </button>
                    <button class="wishlist">
                        <i class="fa-regular fa-heart"></i>
                    </button>
                    <button class="comment">
                        <i class="fa-regular fa-comment"></i>
                    </button>
                </div>
            </div>
            <div class="furniture-card">
                <img src="sofa3.jpg" alt="Sofa">
                <div class="card-content">
                    <h2>Name</h2>
                    <p>Description</p>
                    <div class="price">
                        <span class="currency">Rp</span>
                        <span class="amount">3.999.000</span>
                    </div>
                    <button class="addCart">
                        Add to Cart
                    </button>
                    <button class="wishlist">
                        <i class="fa-regular fa-heart"></i>
                    </button>
                    <button class="comment">
                        <i class="fa-regular fa-comment"></i>
                    </button>
                </div>
            </div>
        </div>
        <main>
        </main>
    </body>
</html>
