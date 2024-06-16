<?php
session_start();
require_once("db/dbconnect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['product_id'], $_POST['quantity'])) {
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        // Retrieve the current stock level of the product from the database
        $stmt_stock = $conn->prepare("SELECT stock FROM products WHERE product_id = ?");
        $stmt_stock->bind_param("i", $product_id);
        $stmt_stock->execute();
        $result_stock = $stmt_stock->get_result();

        if ($result_stock->num_rows > 0) {
            $row_stock = $result_stock->fetch_assoc();
            $stock_available = $row_stock['stock'];

            // Check if the requested quantity exceeds the available stock
            if ($quantity > $stock_available) {
                // Handle the error - requested quantity exceeds available stock
                // You can redirect the user to the product page with a message
                $_SESSION['notEnoughQuantity'] = true;
                header("Location: cart.php");
                exit();
            }
        }

        // Check if the user is logged in
        if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true) {
            // User is logged in, update the quantity in the database
            $user_id = $_SESSION['user_id'];

            $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?");
            $stmt->bind_param("iii", $quantity, $user_id, $product_id);
            $stmt->execute();

            // Redirect back to the cart page after updating the quantity
            $_SESSION['cartDBQuantity'] = true;
            header("Location: cart.php");
            exit();
        } else {
            // User is not logged in, update the quantity in the session cart
            if (isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id] = $quantity;
                $_SESSION['cartSessionQuantity'] = true;
            }

            // Redirect back to the cart page after updating the quantity
            header("Location: cart.php");
            exit();
        }
    }
}
?>
