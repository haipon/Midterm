<?php
session_start();
$cartConn = new mysqli("localhost", "root", "", "furniture_store");

if ($cartConn->connect_error) {
    die("Connection failed: " . $cartConn->connect_error);
}

// Function to add product to the cart
function addToCart($cartConn, $user_id, $product_id, $quantity, $session_token) {
    // Check if the product is already in the cart for this user or session token
    $stmt = $cartConn->prepare("SELECT id, quantity FROM cart WHERE product_id = ? AND (user_id = ? OR session_token = ?)");
    $stmt->bind_param("iis", $product_id, $user_id, $session_token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $new_quantity = $row['quantity'] + $quantity;

        // Update quantity in cart
        $updateStmt = $cartConn->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
        if (!$updateStmt) {
            die("Prepare failed: " . $cartConn->error);
        }
        $updateStmt->bind_param("ii", $new_quantity, $row['id']);
        
        if (!$updateStmt->execute()) {
            die("Execute failed: " . $updateStmt->error);
        }
        $updateStmt->close();
    } else {
        // Prepare the insert statement
        if ($user_id > 0) {
            $insertStmt = $cartConn->prepare("INSERT INTO cart (user_id, product_id, quantity, session_token) VALUES (?, ?, ?, ?)");
            if (!$insertStmt) {
                die("Prepare failed: " . $cartConn->error);
            }
            $insertStmt->bind_param("iiis", $user_id, $product_id, $quantity, $session_token);
        } else {
            // For guest users, only use session_token
            $insertStmt = $cartConn->prepare("INSERT INTO cart (product_id, quantity, session_token) VALUES (?, ?, ?)");
            if (!$insertStmt) {
                die("Prepare failed: " . $cartConn->error);
            }
            $insertStmt->bind_param("iis", $product_id, $quantity, $session_token);
        }

        // Execute the insert statement and handle errors
        if (!$insertStmt->execute()) {
            die("Execute failed: " . $insertStmt->error);
        }
        $insertStmt->close();
    }    

    $stmt->close();
}

// Add to cart functionality
if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    $user_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : 1; // Default to 1 if not logged in
    $session_token = session_id();

    if ($user_id > 0) {
        // Optional: Check if the user ID is valid
        $userCheckStmt = $cartConn->prepare("SELECT id FROM users WHERE id = ?");
        $userCheckStmt->bind_param("i", $user_id);
        $userCheckStmt->execute();
        $userCheckResult = $userCheckStmt->get_result();

        if ($userCheckResult->num_rows === 0) {
            die("User ID does not exist.");
        }
        $userCheckStmt->close();
    }

    addToCart($cartConn, $user_id, $product_id, $quantity, $session_token);
    header("Location: /midterm/cart.php");
    exit();
}

// Handle quantity update from the cart
if (isset($_POST['cart_id'], $_POST['action'])) {
    $cart_id = intval($_POST['cart_id']);
    $action = $_POST['action'];

    if ($action === 'increase') {
        // Increase quantity
        $updateStmt = $cartConn->prepare("UPDATE cart SET quantity = quantity + 1 WHERE id = ?");
        $updateStmt->bind_param("i", $cart_id);
        $updateStmt->execute();
        $updateStmt->close();
    } elseif ($action === 'decrease') {
        // Decrease quantity
        $updateStmt = $cartConn->prepare("UPDATE cart SET quantity = quantity - 1 WHERE id = ?");
        $updateStmt->bind_param("i", $cart_id);
        $updateStmt->execute();
        $updateStmt->close();
    }

    // Check if quantity is now 0, and if so, delete the item
    $checkStmt = $cartConn->prepare("SELECT quantity FROM cart WHERE id = ?");
    $checkStmt->bind_param("i", $cart_id);
    $checkStmt->execute();
    $result = $checkStmt->get_result();
    $item = $result->fetch_assoc();

    if ($item['quantity'] <= 0) {
        // If quantity is 0, delete the item
        $deleteStmt = $cartConn->prepare("DELETE FROM cart WHERE id = ?");
        $deleteStmt->bind_param("i", $cart_id);
        $deleteStmt->execute();
        $deleteStmt->close();
    }
    $checkStmt->close();
    
    // Redirect back to cart page to show updated cart
    header("Location: /midterm/cart.php");
    exit();
}


// Fetch all items from the cart
$user_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : 1;
$session_token = session_id();
$sql = "SELECT c.id AS cart_id, p.name, p.price, p.image, c.quantity
        FROM cart c
        JOIN products p ON c.product_id = p.id
        WHERE c.user_id = ? OR c.session_token = ?";
$stmt = $cartConn->prepare($sql);
$stmt->bind_param("is", $user_id, $session_token);
$stmt->execute();
$result = $stmt->get_result();
$cartItems = $result->fetch_all(MYSQLI_ASSOC);

// Calculate subtotal
$subtotal = 0;
foreach ($cartItems as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}

$cartConn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cart Page</title>
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
            <a href="/midterm/wishlist.php">Wishlist</a>
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
            <?php if (count($cartItems) > 0): ?>
                <?php foreach ($cartItems as $item): ?>
                    <tr>
                        <td>
                            <img src="/midterm/admin/uploads/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" style="width: 150px; height: auto;">
                        </td>
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td>Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
                        <td>
                            <div class="quantity-container">
                                <form method="post" action="/midterm/cart.php" class="quantity-form">
                                    <input type="hidden" name="cart_id" value="<?= $item['cart_id'] ?>">
                                    <input type="hidden" name="action" value="decrease">
                                    <button type="submit" class="quantity-btn minus-btn">-</button>
                                </form>
                                
                                <span class="quantity"><?= $item['quantity'] ?></span>
                                
                                <form method="post" action="/midterm/cart.php" class="quantity-form">
                                    <input type="hidden" name="cart_id" value="<?= $item['cart_id'] ?>">
                                    <input type="hidden" name="action" value="increase">
                                    <button type="submit" class="quantity-btn plus-btn">+</button>
                                </form>
                            </div>
                        </td>
                        <td>
                            <form method="post" action="/midterm/cart.php">
                                <input type="hidden" name="cart_id" value="<?= $item['cart_id'] ?>">
                                <button type="submit" name="remove" class="remove-btn">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Your cart is empty.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    
    <?php if (count($cartItems) > 0): ?>
    <div class="cart-summary">
        <h3>Subtotal: Rp <?= number_format($subtotal, 0, ',', '.') ?></h3>
        <button onclick="location.href='/midterm/checkout.php'" class="place-order-btn">Place Order</button>
    </div>
<?php endif; ?>

</body>
</html>
