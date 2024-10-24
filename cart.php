<!DOCTYPE html>
<html>
    <head>
        <title>Office Page</title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
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
                <a href="wishlist.php">Wishlist</a>
                <a href="/midterm/cart.php">Cart</a>
                <?php if (isset($_SESSION["user"])): ?>
                    <a href="/midterm/login-regis/logout.php" class="logout">Logout</a>
                <?php else: ?>
                    <a href="/midterm/login-regis/login.php" class="login">Login</a>
                <?php endif; ?>
            </nav>
        </header>

        <h2 class="Title2">CART</h2>
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Item Image</th>
                    <th>Item Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <img src="photos/bathtub.png" alt="Bathtub" style="width: 150px; height: auto;">
                    </td>
                    <td>Bathtub</td>
                    <td>Rp 3.499.000</td>
                    <td>1</td>
                    <td><a href="#" class="remove-btn">Remove</a></td>
                </tr>
                <!-- More items can be added here -->
            </tbody>
        </table>
        <main>
        </main>
    </body>
</html>