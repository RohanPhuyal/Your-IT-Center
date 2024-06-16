<?php
// Start the session
session_start();
require("dbconnect.php");
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare statement
    $stmt = $conn->prepare("SELECT admin_id, full_name, email, password FROM admin WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists and password is correct
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if ($password === $user['password']) {
            // Set session variables
            $_SESSION['admin_id'] = $user['admin_id'];
            $_SESSION['afull_name'] = $user['full_name'];
            $_SESSION['aemail'] = $user['email'];
            $_SESSION['isLoggedInAdmin'] = true;
            
            // Redirect to dashboard or any other page
            header("Location: ../index.php");
            exit();
        } else {
            $_SESSION['login_failed'] = true;
            header("Location: login.php");
            exit();
        }
    } else {
        header("Location: login.php");
    }
    $stmt->close();
}
?>