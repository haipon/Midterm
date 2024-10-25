<?php
session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Debugging: Check the session
if (!isset($_SESSION['admin_id'])) {
    die("Admin ID is not set in the session.");
}

// Database connection
$conn = new mysqli("localhost", "u260447614_cd", "Midterm711", "u260447614_ab");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assign form variables
    $name = isset($_POST['name']) ? htmlspecialchars($conn->real_escape_string($_POST['name'])) : null;
    $description = isset($_POST['description']) ? htmlspecialchars($conn->real_escape_string($_POST['description'])) : null;
    $price = isset($_POST['price']) ? floatval($_POST['price']) : null;
    $category = isset($_POST['category']) ? htmlspecialchars($conn->real_escape_string($_POST['category'])) : null;
    $item_type = isset($_POST['item_type']) ? htmlspecialchars($conn->real_escape_string($_POST['item_type'])) : null;
    $admin_id = $_SESSION['admin_id'];

    // Ensure required fields are not empty
    if (empty($name) || empty($description) || empty($price) || empty($category) || empty($item_type)) {
        die("All fields are required.");
    }

    // Handle file upload
    $uploadDir = "uploads/";
    $image = $_FILES['image']['name'];

    // Ensure the uploads directory exists
    if (!is_dir($uploadDir) && !mkdir($uploadDir, 0777, true)) {
        die("Failed to create upload directory.");
    }

    if (!empty($image)) {
        $target = $uploadDir . basename($image); // Set target path for the image
    } else {
        die('Image file not provided.');
    }

    // Check for file upload errors
    if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        $errorMessage = "Upload failed with error code: " . $_FILES['image']['error'];
        switch ($_FILES['image']['error']) {
            case UPLOAD_ERR_INI_SIZE:
                $errorMessage = "The uploaded file exceeds the upload_max_filesize directive in php.ini.";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $errorMessage = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.";
                break;
            case UPLOAD_ERR_PARTIAL:
                $errorMessage = "The uploaded file was only partially uploaded.";
                break;
            case UPLOAD_ERR_NO_FILE:
                $errorMessage = "No file was uploaded.";
                break;
        }
        die($errorMessage);
    }

    // Attempt to move the uploaded file to the target directory
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        // Insert the product data into the database
        $sql = "INSERT INTO products (name, description, price, image, category, item_type, admin_id)
                VALUES ('$name', '$description', '$price', '$image', '$category', '$item_type', '$admin_id')";

        if ($conn->query($sql) === TRUE) {
            echo "Product uploaded successfully!";
            switch (strtolower($item_type)) { // Make case-insensitive
                case 'bathtub':
                    header("Location: /display_furniture/d_bathroom/d_bathtub.php?success=1");
                    break;
                case 'sink':
                    header("Location: /display_furniture/d_bathroom/d_sinks.php?success=1");
                    break;
                case 'toilet_seat':
                    header("Location: /display_furniture/d_bathroom/d_toiletseats.php?success=1");
                    break;
                case 'bed':
                    header("Location: /display_furniture/d_bedroom/d_bed.php?success=1");
                    break;
                case 'dresser':
                    header("Location: /display_furniture/d_bedroom/d_dresser.php?success=1");
                    break;
                case 'nightstand':
                    header("Location: /display_furniture/d_bedroom/d_nightstand.php?success=1");
                    break; //ori
                case 'accessories':
                    header("Location: /display_furniture/d_diningroom/d_accessories.php?success=1");
                    break;
                case 'cabinet':
                    header("Location: /display_furniture/d_diningroom/d_cabinet.php?success=1");
                    break;
                case 'table':
                    header("Location: /display_furniture/d_diningroom/d_table.php?success=1");
                    break;
                case 'coffee_table':
                    header("Location: /display_furniture/d_livingroom/d_coffeetable.php?success=1");
                    break;
                case 'lighting':
                    header("Location: /display_furniture/d_livingroom/d_lighting.php?success=1");
                    break;
                case 'sofas':
                    header("Location: /display_furniture/d_livingroom/d_sofas.php?success=1");
                    break;
                case 'chairs':
                    header("Location: /display_furniture/d_office/d_chairs.php?success=1");
                    break;
                case 'desk':
                    header("Location: /display_furniture/d_office/d_desk.php?success=1");
                    break;
                case 'storage':
                    header("Location: /display_furniture/d_office/d_storage.php?success=1");
                    break;
                default:
                    die("Invalid item type.");
            }
            exit();
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
