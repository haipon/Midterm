<?php
session_start();
$conn = new mysqli("localhost", "u260447614_cd", "Midterm711", "u260447614_ab");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all bathtubs from the database
$sql = "SELECT * FROM products WHERE item_type = 'sofas'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sofas Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/design.css">
    <link rel="stylesheet" href="/display_furniture/display_design.css">
</head>
<body>
<header>
    <h1 class="header">SAVICLE</h1>
    <nav>
        <a href="/index.php">Home</a>
        <div class="dropdown">
            <h2 class="dropbtn">Furniture</h2>
            <div class="dropdown-content">
                <a href="/office.php">Office</a>
                <a href="/livingroom.php">Living Room</a>
                <a href="/diningroom.php">Dining Room</a>
                <a href="/bedroom.php">Bedroom</a>
                <a href="/bathroom.php">Bathroom</a>
            </div>
        </div>
        <a href="/wishlist.php">Wishlist</a>
        <a href="/cart.php">Cart</a>
        <!-- PHP Session-based Login/Logout Button -->
        <?php if (isset($_SESSION["user"])): ?>
            <a href="/login-regis/logout.php" class="logout">Logout</a>
        <?php else: ?>
            <a href="/login-regis/login.php" class="login">Login</a>
        <?php endif; ?>
    </nav>
</header>

<h2 class="Title2">SOFAS</h2>
<div class="search-bar">
    <input type="text" placeholder="Search...">
    <button class="search-btn">🔍</button>
</div>

<div class="furniture-grid">
    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="furniture-card">
                <img src="/admin/uploads/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                <div class="card-content">
                    <h2><?= htmlspecialchars($row['name']) ?></h2>
                    <p><?= htmlspecialchars($row['description']) ?></p>
                    <div class="price">
                        <span class="currency">Rp</span>
                        <span class="amount"><?= number_format($row['price'], 0, ',', '.') ?></span>
                    </div>
                    <form method="post" action="/cart.php">
                        <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="addCart">Add to Cart</button>
                    </form>
                    <form method="post" action="/wishlist.php">
                        <input type="hidden" name="product_id" value="<?= htmlspecialchars($row['id']) ?>">
                        <input type="hidden" name="action" value="add_to_wishlist">
                        <button type="submit" class="wishlist"><i class="fa-regular fa-heart"></i></button>
                    </form>
                    <button class="comment"><i class="fa-regular fa-comment"></i></button>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No sofas found.</p>
    <?php endif; ?>
</div>

<main>
</main>

<?php
$conn->close();
?>
</body>
</html>
