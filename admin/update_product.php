<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "furniture_store");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $price = $_POST['price'];
    $category = $_POST['category'];
    $item_type = $_POST['item_type'];
    
    // Handle image upload if a new image is provided
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target = "uploads/" . basename($image);

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $sql = "UPDATE products SET name='$name', description='$description', price='$price', image='$image', category='$category', item_type='$item_type' WHERE id='$id'";
        } else {
            echo "Failed to upload image.";
            exit();
        }
    } else {
        // If no new image is uploaded, keep the existing image
        $sql = "UPDATE products SET name='$name', description='$description', price='$price', category='$category', item_type='$item_type' WHERE id='$id'";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Product updated successfully!";
        header("Location: admin_shop.php"); // Redirect to the product list
        exit();
    } else {
        echo "Error updating product: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
