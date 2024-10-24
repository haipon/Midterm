<?php
session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Debugging: Check the session
var_dump($_SESSION); // Check if admin_id is set

// Database connection
$conn = new mysqli("localhost", "root", "", "furniture_store");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if admin ID is set in the session
    if (!isset($_SESSION['admin_id'])) {
        die("Admin ID is not set in the session.");
    }

    // Assign form variables
    $name = isset($_POST['name']) ? htmlspecialchars($conn->real_escape_string($_POST['name'])) : null;
    $description = isset($_POST['description']) ? htmlspecialchars($conn->real_escape_string($_POST['description'])) : null;
    $price = isset($_POST['price']) ? floatval($_POST['price']) : null; // Ensure it's a valid number
    $category = isset($_POST['category']) ? htmlspecialchars($conn->real_escape_string($_POST['category'])) : null;
    $item_type = isset($_POST['item_type']) ? htmlspecialchars($conn->real_escape_string($_POST['item_type'])) : null;
    $admin_id = $_SESSION['admin_id']; // This should now contain the correct admin ID

    // Ensure required fields are not empty
    if (empty($name) || empty($description) || empty($price) || empty($category) || empty($item_type)) {
        die("All fields are required.");
    }

    // Handle file upload
    $uploadDir = "uploads/";
    $image = $_FILES['image']['name'];

    if (!empty($image)) {
        $target = $uploadDir . basename($image); // Set target path for the image
    } else {
        die('Image file not provided.');
    }

    // Ensure the uploads directory exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Check for file upload errors
    if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        die("Upload failed with error code: " . $_FILES['image']['error']);
    }

    // Attempt to move the uploaded file to the target directory
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        // Insert the product data into the database
        $sql = "INSERT INTO products (name, description, price, image, category, item_type, admin_id)
                VALUES ('$name', '$description', '$price', '$image', '$category', '$item_type', '$admin_id')";

        if ($conn->query($sql) === TRUE) {
            echo "Product uploaded successfully!";
            if ($item_type === 'Bathtub') {
                header("Location: /midterm/display_furniture/d_bathroom/d_bathtub.php?success=1");
                exit();
            } else if($item_type === 'Sink') {
                header("Location: /midterm/d_sinks.php?success=1");
                exit();

            } else if($item_type === 'Toilet Seat') {
                header("Location: /midterm/d_toiletseats.php?success=1");
                exit();

            } else if($item_type === 'Bed') {
                header("Location: /midterm/d_bed.php?success=1");
                exit();

            } else if($item_type === 'Dresser') {
                header("Location: /midterm/d_dresser.php?success=1");
                exit();

            } else if($item_type === 'Nightstand') {
                header("Location: /midterm/d_nightstand.php?success=1");
                exit();

            } else if($item_type === 'bathtub') {
                header("Location: /midterm/d_h.php?success=1");
                exit();

            } else if($item_type === 'bathtub') {
                header("Location: /midterm/d_bathtub.php?success=1");
                exit();

            }
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Failed to upload image.";
    }
}

// Close the connection
$conn->close();
?>
