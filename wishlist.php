
<?php
session_start();
$wishlistConn = new mysqli("localhost", "u260447614_cd", "Midterm711", "u260447614_ab");

if ($wishlistConn->connect_error) {
    die("Connection failed: " . $wishlistConn->connect_error);
}

// Function to check if a product exists in the products table
function productExists($wishlistConn, $product_id) {
    $stmt = $wishlistConn->prepare("SELECT COUNT(*) FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    
    return $count > 0; // Return true if the product exists
}

// Function to add a product to the wishlist
function addToWishlist($wishlistConn, $user_id, $product_id) {
    // Check if product is already in the wishlist
    $stmt = $wishlistConn->prepare("SELECT id FROM wishlist WHERE user_id = ? AND product_id = ?");
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) { // Only add if not already in wishlist
        $stmt->close(); // Close the previous statement
        $stmt = $wishlistConn->prepare("INSERT INTO wishlist (user_id, product_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $product_id);
        
        if (!$stmt->execute()) {
            die("Error adding to wishlist: " . $stmt->error); // Debugging: show the error
        } else {
            echo "Item added to wishlist."; // Confirm addition
        }
    } else {
        echo "Item already in wishlist."; // Confirm already exists
    }

    $stmt->close();
}

// Function to remove a product from the wishlist
function removeFromWishlist($wishlistConn, $wishlist_id) {
    $stmt = $wishlistConn->prepare("DELETE FROM wishlist WHERE id = ?");
    $stmt->bind_param("i", $wishlist_id);

    if (!$stmt->execute()) {
        die("Error removing from wishlist: " . $stmt->error);
    }

    $stmt->close();
}

// Handle the POST request for adding/removing from the wishlist
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['action']) && $_POST['action'] === 'add_to_wishlist' && isset($_POST['product_id'])) {
        $user_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : 1; // Default to 1 if not logged in
        $product_id = (int)$_POST['product_id'];

        // Check if the product exists before adding to wishlist
        if (productExists($wishlistConn, $product_id)) {
            addToWishlist($wishlistConn, $user_id, $product_id);
        } else {
            echo "Product does not exist.";
        }

        // Redirect to the wishlist page after adding
        header("Location: /wishlist.php");
        exit();
    } elseif (isset($_POST['action']) && $_POST['action'] === 'remove' && isset($_POST['wishlist_id'])) {
        $wishlist_id = (int)$_POST['wishlist_id'];
        removeFromWishlist($wishlistConn, $wishlist_id);

        // Redirect to the wishlist page after removing
        header("Location: /wishlist.php");
        exit();
    }
}

// Fetch wishlist items for the user
$user_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : 1; // Default to 1 if not logged in
$sql = "SELECT w.id AS wishlist_id, p.id AS product_id, p.name, p.price, p.image
        FROM wishlist w
        JOIN products p ON w.product_id = p.id
        WHERE w.user_id = ?";
$stmt = $wishlistConn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$wishlistItems = $result->fetch_all(MYSQLI_ASSOC);

// Close connection
$wishlistConn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist | SAVICLE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="design.css"> <!-- Reference your existing design CSS -->
    <style>
        /* Your existing styles */
        /* Additional styles for wishlist page */
        .wishlist-container {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .pick {
            font-size: 2.5em;
            color: #72383d;
            margin-bottom: 30px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        td img {
            width: 100px;
            height: auto;
        }

        td {
            text-align: center;
        }

        .action-btns {
            text-align: center;
        }

        .add-btn, .remove-btn {
            background-color: #72383d;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
            font-weight: 500;
            transition: background-color 0.3s ease;
            display: inline-block;
            margin: 0 5px;
        }

        .add-btn:hover {
            background-color: #ab644b;
        }

        .remove-btn {
            background-color: #d7e1f3;
            color: #6F3F3A;
        }

        .remove-btn:hover {
            background-color: #d2bba4;
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @media (max-width: 768px) {
            th, td {
                font-size: 14px;
                padding: 10px;
            }
        }
    </style>
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
            <a href="/wishlist.php" class="active">Wishlist</a>
            <a href="/cart.php">Cart</a>
            
            <?php if (isset($_SESSION["user"])): ?>
                <a href="/login-regis/logout.php" class="logout">Logout</a>
            <?php else: ?>
                <a href="/login-regis/login.php" class="login">Login</a>
            <?php endif; ?>
        </nav>
    </header>

    <div class="wishlist-container">
        <h2 class="pick">Your Wishlist</h2>
        <table>
            <thead>
                <tr>
                    <th>Item Image</th>
                    <th>Item Name</th>
                    <th>Unit Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($wishlistItems) > 0): ?>
                    <?php foreach ($wishlistItems as $item): ?>
                        <tr>
                            <td><img src="/admin/uploads/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>"></td>
                            <td><?= htmlspecialchars($item['name']) ?></td>
                            <td>RP<?= number_format($item['price'], 2) ?></td>
                            <td class="action-btns">
                                    <form method="post" action="/cart.php" style="display:inline;">
                                        <input type="hidden" name="action" value="add_to_cart">
                                        <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="add-btn">Add to Cart</button>
                                    </form>

                                <form method="post" action="/wishlist.php" style="display:inline;">
                                    <input type="hidden" name="action" value="remove">
                                    <input type="hidden" name="wishlist_id" value="<?= $item['wishlist_id'] ?>">
                                    <button type="submit" class="remove-btn">Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No items in your wishlist.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
