<?php
// Function to transfer cart items from session to user cart in the database
function transferCartItemsToDatabase($cartItems, $user_id, $conn)
{
    foreach ($cartItems as $product_id => $quantity) {
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
                    $insert_stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
                    $insert_stmt->bind_param("iii", $user_id, $product_id, $quantity);
                    $insert_stmt->execute();
                    $_SESSION['cartDB'] = true;
                    unset($_SESSION['cart']);
                    header("Location: ../../cart.php");
                    exit();
                } else {
                    $_SESSION['notEnoughQuantity'] = true;
                    unset($_SESSION['cart']);
                    header("Location: ../../cart.php");
                    exit();
                }
            } else {
                // Product exists in the cart, update quantity if stock available
                $row_cart = $result_cart->fetch_assoc();
                $quantity_in_cart = $row_cart['quantity'];

                if (($quantity + $quantity_in_cart) <= $stock_available) {
                    $update_stmt = $conn->prepare("UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND product_id = ?");
                    $update_stmt->bind_param("iii", $quantity, $user_id, $product_id);
                    $update_stmt->execute();
                    $_SESSION['cartDBQuantity'] = true;
                    unset($_SESSION['cart']);
                    header("Location: ../../cart.php");
                    exit();
                } else {
                    $_SESSION['notEnoughQuantity'] = true;
                    unset($_SESSION['cart']);
                    header("Location: ../../cart.php");
                    exit();
                }
            }
        } else {
            $_SESSION['cartFailed'] = "Product not found.";
            unset($_SESSION['cart']);
            header("Location: ../../cart.php");
            exit();
        }
    }
}
?>