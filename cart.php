<?php
session_start();
$cartConn = new mysqli("localhost", "u260447614_cd", "Midterm711", "u260447614_ab");

if ($cartConn->connect_error) {
    die("Connection failed: " . $cartConn->connect_error);
}

// Function to add product to the cart
function addToCart($cartConn, $user_id, $product_id, $quantity, $session_token) {
    $stmt = $cartConn->prepare("SELECT id, quantity FROM cart WHERE product_id = ? AND (user_id = ? OR session_token = ?)");
    $stmt->bind_param("iis", $product_id, $user_id, $session_token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $new_quantity = $row['quantity'] + $quantity;

        $updateStmt = $cartConn->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
        $updateStmt->bind_param("ii", $new_quantity, $row['id']);
        $updateStmt->execute();
        $updateStmt->close();
    } else {
        if ($user_id > 0) {
            $insertStmt = $cartConn->prepare("INSERT INTO cart (user_id, product_id, quantity, session_token) VALUES (?, ?, ?, ?)");
            $insertStmt->bind_param("iiis", $user_id, $product_id, $quantity, $session_token);
        } else {
            $insertStmt = $cartConn->prepare("INSERT INTO cart (product_id, quantity, session_token) VALUES (?, ?, ?)");
            $insertStmt->bind_param("iis", $product_id, $quantity, $session_token);
        }
        $insertStmt->execute();
        $insertStmt->close();
    }
    $stmt->close();
}

if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    $user_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : 0;
    $session_token = session_id();

    addToCart($cartConn, $user_id, $product_id, $quantity, $session_token);
    header("Location: /cart.php");
    exit();
}

if (isset($_POST['cart_id'], $_POST['action'])) {
    $cart_id = intval($_POST['cart_id']);
    $action = $_POST['action'];

    if ($action === 'increase') {
        $updateStmt = $cartConn->prepare("UPDATE cart SET quantity = quantity + 1 WHERE id = ?");
        $updateStmt->bind_param("i", $cart_id);
        $updateStmt->execute();
        $updateStmt->close();
    } elseif ($action === 'decrease') {
        $updateStmt = $cartConn->prepare("UPDATE cart SET quantity = quantity - 1 WHERE id = ?");
        $updateStmt->bind_param("i", $cart_id);
        $updateStmt->execute();
        $updateStmt->close();
    }

    $checkStmt = $cartConn->prepare("SELECT quantity FROM cart WHERE id = ?");
    $checkStmt->bind_param("i", $cart_id);
    $checkStmt->execute();
    $result = $checkStmt->get_result();
    $item = $result->fetch_assoc();

    if ($item['quantity'] <= 0) {
        $deleteStmt = $cartConn->prepare("DELETE FROM cart WHERE id = ?");
        $deleteStmt->bind_param("i", $cart_id);
        $deleteStmt->execute();
        $deleteStmt->close();
    }
    $checkStmt->close();

    header("Location: /cart.php");
    exit();
}

// Handle item removal
if (isset($_POST['remove_cart_id'])) {
    $remove_cart_id = intval($_POST['remove_cart_id']);
    $deleteStmt = $cartConn->prepare("DELETE FROM cart WHERE id = ?");
    $deleteStmt->bind_param("i", $remove_cart_id);
    $deleteStmt->execute();
    $deleteStmt->close();

    header("Location: /cart.php");
    exit();
}

$user_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : 0;
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
        <link rel="stylesheet" href="/design.css">
        <link rel="stylesheet" href="/display_furniture/display_design.css">
        <style>
            .quantity-container {
                display: flex;
                align-items: center;
            }
            .quantity-btn {
                width: 30px;
                height: 30px;
                display: inline-flex;
                justify-content: center;
                align-items: center;
                border: 1px solid #ddd;
                cursor: pointer;
                font-size: 16px;
                background-color: #f0f0f0;
            }
            .quantity {
                margin: 0 10px;
                font-size: 16px;
            }
            .remove-btn {
                background-color: #f00;
                color: #fff;
                border: none;
                padding: 5px 10px;
                cursor: pointer;
            }
            
            .cart-subtotal {
                margin-top: 45px;
                text-align: center;
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
                <a href="/wishlist.php">Wishlist</a>
                <a href="/cart.php">Cart</a>
                <?php if (isset($_SESSION["user"])): ?>
                    <a href="/login-regis/logout.php" class="logout">Logout</a>
                <?php else: ?>
                    <a href="/login-regis/login.php" class="login">Login</a>
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
                            <img src="/admin/uploads/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" style="width: 150px; height: auto;">
                        </td>
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td>Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
                        <td>
                            <div class="quantity-container">
                                <form method="post" action="/cart.php" class="quantity-form">
                                    <input type="hidden" name="cart_id" value="<?= $item['cart_id'] ?>">
                                    <input type="hidden" name="action" value="decrease">
                                    <button type="submit" class="quantity-btn">-</button>
                                </form>
                                
                                <span class="quantity"><?= $item['quantity'] ?></span>
                                
                                <form method="post" action="/cart.php" class="quantity-form">
                                    <input type="hidden" name="cart_id" value="<?= $item['cart_id'] ?>">
                                    <input type="hidden" name="action" value="increase">
                                    <button type="submit" class="quantity-btn">+</button>
                                </form>
                            </div>
                        </td>
                        <td>
                            <form method="post" action="/cart.php">
                                <input type="hidden" name="remove_cart_id" value="<?= $item['cart_id'] ?>">
                                <button type="submit" class="remove-btn">Remove</button>
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
    <div class="cart-subtotal">
        <h3>Subtotal: Rp <?= number_format($subtotal, 0, ',', '.') ?></h3>
    </div>
</body>
</html>
