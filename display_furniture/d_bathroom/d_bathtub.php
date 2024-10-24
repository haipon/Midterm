<!DOCTYPE html>
<html>
    <head>
        <title>Bathtub Page</title>
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
                <?php if (isset($_SESSION["user"])): ?>
                    <a href="/midterm/login-regis/logout.php" class="logout">Logout</a>
                <?php else: ?>
                    <a href="/midterm/login-regis/login.php" class="login">Login</a>
                <?php endif; ?>
            </nav>
        </header>

        <h2 class="Title2">Bathtubs</h2>
        <div class="search-bar">
            <input type="text" placeholder="Search...">
            <button class="search-btn">🔍</button>
        </div>

        <?php
        session_start();
        $conn = new mysqli("localhost", "root", "", "furniture_store");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM products WHERE item_type = 'bathtub'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0): ?>
            <div class="furniture-grid">
                <?php while ($row = $result->fetch_assoc()): ?>
                <div class="furniture-card">
                    <img src="/midterm/admin/uploads/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                    <div class="card-content">
                        <h2><?= htmlspecialchars($row['name']) ?></h2>
                        <p><?= htmlspecialchars($row['description']) ?></p>
                        <div class="price">
                            <span class="currency">Rp</span>
                            <span class="amount"><?= number_format($row['price'], 0, ',', '.') ?></span>
                        </div>
                        <button class="addCart">Add to Cart</button>
                        <button class="wishlist"><i class="fa-regular fa-heart"></i></button>
                        <button class="comment"><i class="fa-regular fa-comment"></i></button>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p>No bathtubs found.</p>
        <?php endif;

        $conn->close();
        ?>
    </body>
</html>
