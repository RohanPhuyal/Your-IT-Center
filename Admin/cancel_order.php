<?php
session_start();
require_once("db/dbconnect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve the values from the form
    $orderID = $_POST['orderID'];
    // Update the product in the database
    $stmt = $conn->prepare("UPDATE orders SET order_status='Cancelled' where order_id=?");
    $stmt->bind_param("i", $orderID);
    $stmt->execute();
    $stmt->close();
    // // After updating, you can redirect the user or display a success message
    // $_SESSION['editProductSuccess']=true;
    header("Location: orders.php");
}
?>