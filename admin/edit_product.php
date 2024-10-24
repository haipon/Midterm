<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "furniture_store");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the ID is provided
if (!isset($_GET['id'])) {
    die("Product ID not specified.");
}

$product_id = $_GET['id'];

// Fetch the product details
$sql = "SELECT * FROM products WHERE id = '$product_id'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("Product not found.");
}

$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product - Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin_design.css">
    <style>
        .container {
            display: flex;
            justify-content: center;
            padding: 20px;
        }

        .upload-section {
            width: 60%;
            background-color: #f8f8f8;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .upload-section h2 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        .upload-section form {
            display: flex;
            flex-direction: column;
        }

        .upload-section label, .upload-section input, .upload-section textarea, .upload-section select, .upload-section button {
            margin-bottom: 10px;
            font-size: 16px;
        }

        .upload-section button {
            background-color: brown;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .option {
            display: block;
            padding: 20px 10px;
            text-align: center;
            background-color: brown;
            color: white;
            margin: 0;
            text-decoration: none; 
            width: 100%; 
            box-sizing: border-box;
            font-size: 20px
        }
    </style>
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
            <a href="/wishlist.php">Wishlist</a>
            <a href="/cart.php">Cart</a>
            <?php if (isset($_SESSION["user"])): ?>
                <a href="/midterm/login-regis/logout.php" class="logout2">Logout</a>
            <?php else: ?>
                <a href="/midterm/login-regis/login.php" class="login2">Login</a>
            <?php endif; ?>
        </nav>
    </header>
    <a href="admin_shop.php" class="option">View Your Shop</a>

    <div class="container">
        <div class="upload-section">
            <h2>Edit Product</h2>
            <form action="update_product.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

                <label for="name">Product Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>

                <label for="description">Description:</label>
                <textarea id="description" name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea>

                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" value="<?php echo $product['price']; ?>" required>

                <label for="image">Image:</label>
                <input type="file" id="image" name="image">

                <!-- Category Dropdown -->
                <label for="category">Category:</label>
                <select id="category" name="category" required onchange="updateItemTypes()">
                    <option value="">Select a category</option>
                    <option value="bathroom" <?php if ($product['category'] == 'bathroom') echo 'selected'; ?>>Bathroom</option>
                    <option value="bedroom" <?php if ($product['category'] == 'bedroom') echo 'selected'; ?>>Bedroom</option>
                    <option value="diningroom" <?php if ($product['category'] == 'diningroom') echo 'selected'; ?>>Dining Room</option>
                    <option value="livingroom" <?php if ($product['category'] == 'livingroom') echo 'selected'; ?>>Living Room</option>
                    <option value="office" <?php if ($product['category'] == 'office') echo 'selected'; ?>>Office</option>
                </select>

                <!-- Item Type Dropdown -->
                <label for="item_type">Item Type:</label>
                <select id="item_type" name="item_type" required>
                    <option value="">Select an item type</option>
                    <option value="bathtub" <?php if ($product['item_type'] == 'bathtub') echo 'selected'; ?>>Bathtub</option>
                    <option value="sink" <?php if ($product['item_type'] == 'sink') echo 'selected'; ?>>Sink</option>
                    <option value="toilet_seat" <?php if ($product['item_type'] == 'toilet_seat') echo 'selected'; ?>>Toilet Seat</option>
                    <!-- Add more item types here based on category -->
                </select>

                <button type="submit">Update Product</button>
            </form>
        </div>
    </div>

    <script>
        // This part can stay the same if you are planning to use it for dynamic item types
        const itemTypes = {
            bathroom: ['Bathtub', 'Sink', 'Toilet Seat'],
            bedroom: ['Bed', 'Dresser', 'Nightstand'],
            diningroom: ['Accessories', 'Cabinet', 'Table'],
            livingroom: ['Coffee Table', 'Lighting', 'Sofas'],
            office: ['Chairs', 'Desk', 'Storage']
        };

        function updateItemTypes() {
            const category = document.getElementById('category').value;
            const itemTypeSelect = document.getElementById('item_type');

            itemTypeSelect.innerHTML = '<option value="">Select an item type</option>';

            if (category && itemTypes[category]) {
                itemTypes[category].forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.toLowerCase().replace(/\s/g, '_');
                    option.text = item;
                    itemTypeSelect.appendChild(option);
                });
            }
        }
    </script>
</body>
</html>
