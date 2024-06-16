<?php
session_start();
require_once("db/dbconnect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['product_id'])) {
        $product_id = $_POST['product_id'];

        // Check if the user is logged in
        if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true) {
            // User is logged in, remove the item from the database
            $user_id = $_SESSION['user_id'];

            $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ? AND product_id = ?");
            $stmt->bind_param("ii", $user_id, $product_id);
            $stmt->execute();

            $stmt1 = $conn->prepare("ALTER TABLE cart AUTO_INCREMENT = 1");
            $stmt1->execute();
            
            // Redirect back to the cart page after removing the item
            header("Location: cart.php");
            exit();
        } else {
            // User is not logged in, remove the item from the session cart
            if (isset($_SESSION['cart'][$product_id])) {
                unset($_SESSION['cart'][$product_id]);
            }

            // Redirect back to the cart page after removing the item
            $_SESSION['removeSuccess']=true;
            header("Location: cart.php");
            exit();
        }
    }
}
?>
