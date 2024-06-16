<?php
// Start the session
session_start();

if (isset($_SESSION["isLoggedInAdmin"]) && $_SESSION['isLoggedInAdmin'] === true) {
    // Unset all of the session variables
// $_SESSION = array();

    // Destroy the session cookie
// if (isset($_COOKIE[session_name()])) {
//     setcookie(session_name(), '', time()-42000, '/');
// }

    // Destroy the session
    unset($_SESSION['admin_id']);
    unset($_SESSION['afull_name']);
    unset($_SESSION['aemail']);
    $_SESSION['isLoggedInAdmin'] = false;


    // Redirect to the login page
    header("Location: login.php");
    exit();

} else {
    header("Location: login.php");
}
?>