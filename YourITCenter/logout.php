<?php
// Start the session
session_start();

if (isset($_SESSION["isLoggedIn"]) && $_SESSION['isLoggedIn'] === true) {
    // Unset all of the session variables
// $_SESSION = array();

    // Destroy the session cookie
// if (isset($_COOKIE[session_name()])) {
//     setcookie(session_name(), '', time()-42000, '/');
// }

    // Destroy the session
    unset($_SESSION['user_id']);
    unset($_SESSION['full_name']);
    unset($_SESSION['email']);
    $_SESSION['isLoggedIn'] = false;

    $_SESSION['logout_success'] = true;

    // Redirect to the login page
    header("Location: index.php");
    exit();

} else {
    header("Location: index.php");
}
?>