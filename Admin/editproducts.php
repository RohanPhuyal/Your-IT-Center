<?php
session_start();
require_once("db/dbconnect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set
    if (isset($_POST['productName'], $_POST['category'], $_POST['description'], $_POST['price'], $_POST['stock'])) {
        // Retrieve the values from the form
        $productName = $_POST['productName'];
        $category = $_POST['category'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $productID=$_POST['productID'];
        // Update the product in the database
        $updateQuery = "UPDATE products SET name=?, category=?, description=?, price=?, stock=? WHERE product_id=?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("sssdii", $productName, $category, $description, $price, $stock, $productID);
        $stmt->execute();
        $stmt->close();
        // After updating, you can redirect the user or display a success message
        $_SESSION['editProductSuccess']=true;
        header("Location: products.php");
    } else {
        // Handle the case where required fields are not set
        echo "All fields are required!";
    }
}
?>
