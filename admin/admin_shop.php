<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Your Shop</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin_design.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f0f0;
        }
        
        .container {
            display: flex;
            justify-content: center;
            padding: 20px;
            max-width: 1200px;
            margin: auto;
        }

        .product-list {
            width: 100%;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 24px;
            margin-bottom: 15px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: brown;
            color: white;
        }

        .edit-btn, .delete-btn {
            background-color: blue;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            margin: 0 5px;
            text-decoration: none;
        }

        .delete-btn {
            background-color: red;
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
                <a href="/login-regis/logout.php" class="logout2">Logout</a>
            <?php else: ?>
                <a href="/login-regis/login.php" class="login2">Login</a>
            <?php endif; ?>
        </nav>
    </header>
    
    <a href="/admin/admin_panel.php" class="option">Upload A Product</a>

    <div class="container">
        <!-- Product List -->
        <div class="product-list">
            <h2>Your Products</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Picture</th>
                    <th>Product Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php
                // Database connection
                $conn = new mysqli("localhost", "u260447614_cd", "Midterm711", "u260447614_ab");

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $admin_id = $_SESSION['admin_id']; // Get the logged-in admin's ID

                // Fetch products for the logged-in admin from the database
                $sql = "SELECT * FROM products WHERE admin_id = '$admin_id'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td><img src='uploads/{$row['image']}' alt='{$row['name']}' width='100'></td>
                                <td>{$row['name']}</td>
                                <td><a href='edit_product.php?id={$row['id']}' class='edit-btn'>Edit</a></td>
                                <td>
                                    <form action='delete_product.php' method='POST' style='display:inline;'>
                                        <input type='hidden' name='id' value='{$row['id']}'>
                                        <button type='submit' class='delete-btn'>Delete</button>
                                    </form>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No products found.</td></tr>";
                }

                // Close the database connection
                $conn->close();
                ?>
            </table>
        </div>
    </div>
</body>
</html>
