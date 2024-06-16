<?php
session_start();
require_once("db/dbconnect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $productName = $_POST['productName'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    // Set the file system upload directory
    $fileUploadDir = '../YourITCenter/uploads/';

    // Upload images
    $imagePaths = [];
    if (!empty($_FILES['images']['name'][0])) {
        foreach ($_FILES['images']['name'] as $key => $value) {
            $fileName = basename($_FILES['images']['name'][$key]);
            $targetFilePath = $fileUploadDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            $uniqueFileName = uniqid() . '.' . $fileType;

            // Check file size
            if ($_FILES['images']['size'][$key] > 5000000) {
                echo "Sorry, your file is too large.";
                exit();
            }

            // Allow certain file formats
            $allowedTypes = array('jpg', 'jpeg', 'png', 'gif', 'webp');
            if (!in_array($fileType, $allowedTypes)) {
                echo "Sorry, only JPG, JPEG, PNG, GIF files are allowed.";
                exit();
            }

            // Move uploaded file to destination
            if (move_uploaded_file($_FILES['images']['tmp_name'][$key], $fileUploadDir . $uniqueFileName)) {
                $imagePaths[] = 'uploads/' . $uniqueFileName; // Database file paths
            } else {
                echo "Sorry, there was an error uploading your file.";
                exit();
            }
        }
        // Insert product into database
        $imagePathsString = implode(',', $imagePaths);
        $insertQuery = "INSERT INTO products (name, category, description, price, stock, image_path) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("sssdis", $productName, $category, $description, $price, $stock, $imagePathsString);
        $stmt->execute();
        $stmt->close();
        $_SESSION['addProductSuccess'] = true;
        // Redirect to products.php or any other page
        header("Location: products.php");
    }
}
?>
