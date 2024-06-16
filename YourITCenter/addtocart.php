<?php
session_start();
require_once("db/dbconnect.php");
// Check if the user is logged in
if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] === false && isset($_POST['product_id'])) {
    // User is not logged in, store in session only
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Add the product to the session cart or increase quantity if already exists
    if (isset($_POST['product_id'])) {
        $product_id = $_POST['product_id'];
        $quantity_requested = 1; // Default quantity to add is 1

        // Retrieve the stock level of the product from the products table
        $stmt = $conn->prepare("SELECT stock FROM products WHERE product_id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stock = $row['stock'];

            // Check if the requested quantity exceeds the available stock
            if ($quantity_requested <= $stock) {
                // Quantity requested is within available stock, proceed to add to cart
                if (!isset($_SESSION['cart'][$product_id])) {
                    $_SESSION['cart'][$product_id] = $quantity_requested;
                    $_SESSION['cartSession'] = true;
                } else {
                    $_SESSION['cart'][$product_id] += $quantity_requested;
                    $_SESSION['cartSessionQuantity'] = true;
                }
                header("Location: cart.php");
                exit();
            } else {
                // Quantity requested exceeds available stock, handle error
                $_SESSION['cartFailed'] = true;
                header("Location: cart.php");
                exit();
            }
        } else {
            // Product not found in the products table, handle error
            $_SESSION['notEnoughQuantity'] = true;
            header("Location: cart.php");
            exit();
        }
    } else {
        // Product ID is missing, handle error
        $_SESSION['cartFailed'] = true;
        header("Location: cart.php");
        exit();
    }
} else {
    // User is logged in, store in database
    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['user_id']; // Assuming you have stored the user_id in the session

    // Retrieve the stock level of the product from the products table
    $stmt_stock = $conn->prepare("SELECT stock FROM products WHERE product_id = ?");
    $stmt_stock->bind_param("i", $product_id);
    $stmt_stock->execute();
    $result_stock = $stmt_stock->get_result();

    if ($result_stock->num_rows > 0) {
        $row_stock = $result_stock->fetch_assoc();
        $stock_available = $row_stock['stock'];

        // Check if the product already exists in the user's cart
        $stmt_cart = $conn->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
        $stmt_cart->bind_param("ii", $user_id, $product_id);
        $stmt_cart->execute();
        $result_cart = $stmt_cart->get_result();

        if ($result_cart->num_rows === 0) {
            // Product is not in the cart, insert into database if stock available
            if ($stock_available > 0) {
                $insert_stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, 1)");
                $insert_stmt->bind_param("ii", $user_id, $product_id);
                $insert_stmt->execute();
                $_SESSION['cartDB'] = true;
                header("Location: cart.php");
                exit();
            } else {
                $_SESSION['notEnoughQuantity'] = true;
                header("Location: cart.php");
                exit();
            }
        } else {
            // Product exists in the cart, increase quantity if stock available
            $row_cart = $result_cart->fetch_assoc();
            $quantity_in_cart = $row_cart['quantity'];

            if ($quantity_in_cart < $stock_available) {
                $update_stmt = $conn->prepare("UPDATE cart SET quantity = quantity + 1 WHERE user_id = ? AND product_id = ?");
                $update_stmt->bind_param("ii", $user_id, $product_id);
                $update_stmt->execute();
                $_SESSION['cartDBQuantity'] = true;
                header("Location: cart.php");
                exit();
            } else {
                $_SESSION['notEnoughQuantity'] = true;
                header("Location: cart.php");
                exit();
            }
        }
    } else {
        $_SESSION['cartFailed'] = "Product not found.";
        header("Location: cart.php");
        exit();
    }
}
?>