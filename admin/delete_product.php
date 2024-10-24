<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "furniture_store");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the ID is provided
if (isset($_POST['id'])) {
    $product_id = $_POST['id'];

    // Delete the product from the database
    $sql = "DELETE FROM products WHERE id = '$product_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Product deleted successfully!";
        header("Location: admin_shop.php"); // Redirect to the product list
        exit();
    } else {
        echo "Error deleting product: " . $conn->error;
    }
} else {
    echo "No product ID provided.";
}

// Close the database connection
$conn->close();
?>
