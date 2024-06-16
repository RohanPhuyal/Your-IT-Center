<?php
session_start();
// Check if the productID is set and not empty
if (isset($_POST['productID']) && !empty($_POST['productID'])) {
    // Include your database connection
    require_once("db/dbconnect.php");

    // Prepare and bind the DELETE statement for products table
    $stmtProduct = $conn->prepare("DELETE FROM products WHERE product_id = ?");
    $stmtProduct->bind_param("i", $_POST['productID']);

    // Prepare and bind the DELETE statement for cart table
    $stmtCart = $conn->prepare("DELETE FROM cart WHERE product_id = ?");
    $stmtCart->bind_param("i", $_POST['productID']);

    // Disable foreign key checks
    $stmtForeignDisable = $conn->prepare("SET foreign_key_checks = 0");

    // Enable foreign key checks
    $stmtForeignEnable = $conn->prepare("SET foreign_key_checks = 1");

    $stmt1 = $conn->prepare("ALTER TABLE products AUTO_INCREMENT = 1");

    // Execute the statements
    if ($stmtForeignDisable->execute()) {
        // Delete from products table
        if ($stmtProduct->execute()) {
            // Delete from cart table
            if ($stmtCart->execute()) {
                // Product and cart items deleted successfully, redirect with success message
                $_SESSION['productDeleteSuccess'] = true;
                $stmtForeignEnable->execute();
                $stmtForeignEnable->close();
                $stmt1->execute();
                header("Location: products.php");
                exit();
            } else {
                // Error occurred while deleting from cart table
                $_SESSION['productDeleteSuccess'] = false;
                header("Location: products.php");
                $stmtCart->close();
                exit();
            }
        } else {
            // Error occurred while deleting from products table
            $_SESSION['productDeleteSuccess'] = false;
            header("Location: products.php");
            $stmtProduct->close();
            exit();
        }
    }
} else {
    // ProductID not set or empty, handle the error
    $_SESSION['productDeleteSuccess'] = false;
    header("Location: products.php");
    exit();
}
?>