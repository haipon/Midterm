<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist | SAVICLE</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="design.css"> <!-- Reference your existing design CSS -->
    <style>
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

        /* Table styling */
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
            text-align: left; /* Default text alignment */
        }

        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        td img {
            width: 100px; /* Increase the width */
            height: auto; /* Maintain aspect ratio */
        }

        td {
            text-align: center; /* Center the content of table cells */
        }

        .stock-status {
            color: green;
            font-weight: bold;
        }

        /* Action buttons styling */
        .action-btns {
            text-align: center; /* Center the buttons */
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
            display: inline-block; /* Change to inline-block for uniformity */
            margin: 0 5px; /* Add margin for spacing */
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

        /* Responsive layout */
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
            <a href="wishlist.php" class="active">Wishlist</a>
            <a href="cart.php">Cart</a>
            <?php if (isset($_SESSION["user"])): ?>
                <a href="/midterm/login-regis/logout.php" class="logout">Logout</a>
            <?php else: ?>
                <a href="/midterm/login-regis/login.php" class="login">Login</a>
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
                    <th>Stock Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Wishlist Item 1 -->
                <tr>
                    <td><img src="photos/sofa.png" alt="Wishlist Sofa"></td>
                    <td>Cozy Sofa</td>
                    <td>$99.00</td>
                    <td class="stock-status">In Stock</td>
                    <td class="action-btns">
                        <button class="add-btn">Add to Cart</button>
                        <button class="remove-btn">Remove</button>
                    </td>
                </tr>
                <!-- Wishlist Item 2 -->
                <tr>
                    <td><img src="photos/coffeetablevintage.png" alt="Wishlist Coffee Table"></td>
                    <td>Sculptural Coffee Table</td>
                    <td>$220.00</td>
                    <td class="stock-status">In Stock</td>
                    <td class="action-btns">
                        <button class="add-btn">Add to Cart</button>
                        <button class="remove-btn">Remove</button>
                    </td>
                </tr>
                <!-- Wishlist Item 3 -->
                <tr>
                    <td><img src="photos/lamp.png" alt="Wishlist Lamp"></td>
                    <td>Elegant Lamp</td>
                    <td>$19.00</td>
                    <td class="stock-status">In Stock</td>
                    <td class="action-btns">
                        <button class="add-btn">Add to Cart</button>
                        <button class="remove-btn">Remove</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>