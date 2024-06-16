<?php
// Start the session
session_start();
require("../../db/dbconnect.php");
require_once("transfertocart.php");

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare statement
    $stmt = $conn->prepare("SELECT user_id, full_name, email, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists and password is correct
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['isLoggedIn'] = true;

            $_SESSION['login_success'] = true;

            //CART CODE
            // Transfer cart items from session to user cart in the database
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                transferCartItemsToDatabase($_SESSION['cart'], $user['user_id'], $conn);
                unset($_SESSION['cart']);
            }

            // Redirect to dashboard or any other page
            header("Location: ../../index.php");
            exit();
        } else {
            $_SESSION['login_failed'] = true;
            header("Location: ../../signin.php");
            exit();
        }
    } else {
        $_SESSION['login_failed'] = true;
        header("Location: ../../signin.php");
    }
    $stmt->close();
}
?>