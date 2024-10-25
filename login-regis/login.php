<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION["user"])) {
    header("Location: /index.php");
    exit();
}

// Error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
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
            <a href="/login-regis/login.php" class="login">Login</a>
        </nav>
    </header>

    <div class="container">
        <?php
        if (isset($_POST["login"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];

            require_once "database.php";  // Ensure database connection file is correct

            // Check if the connection is successful
            if ($conn === false) {
                die("<div class='alert alert-danger'>Database connection failed: " . mysqli_connect_error() . "</div>");
            }

            // Prepare SQL statement
            $sql = "SELECT * FROM user WHERE email = ?";  // Use the correct table name
            $stmt = mysqli_prepare($conn, $sql);

            // Check if statement preparation was successful
            if ($stmt === false) {
                die("<div class='alert alert-danger'>Statement preparation failed: " . mysqli_error($conn) . "</div>");
            }

            // Bind parameters and execute
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $user = mysqli_fetch_assoc($result);

            // Check if the user exists
            if ($user) {
                if (password_verify($password, $user["password"])) {
                    // Log in the user and redirect to homepage
                    $_SESSION["user"] = $user['email'];
                    $_SESSION["admin_id"] = $user['id']; // Assuming you want to store user ID
                    header("Location: /index.php");
                    exit();
                } else {
                    echo "<div class='alert alert-danger'>Incorrect password.</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>No user found with that email.</div>";
            }
        }
        ?>
        <form action="login.php" method="post">
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <div class="form-btn">
                <input type="submit" class="custom-btn" value="Login" name="login">
            </div>
        </form>
        <div class="click">
            <a href="/login-regis/registration.php">Register Here</a>
        </div>
    </div>
</body>
</html>