<?php
session_start();
require_once("db/dbconnect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve the values from the form
    $status = $_POST['orderStatus'];
    $orderID = $_POST['orderID'];


    // $stmtStatus = $conn->prepare("SELECT status FROM receipt where order_id=?");
    // $stmtStatus->bind_param("i", $orderID);
    // $stmtStatus->execute();
    // $result = $stmtStatus->get_result();
    // $getresult = $result->fetch_assoc();
    // $stmtStatus->close();

    $stmtStatus = $conn->prepare("SELECT payment_status,payment_method FROM orders where order_id=?");
    $stmtStatus->bind_param("i", $orderID);
    $stmtStatus->execute();
    $result = $stmtStatus->get_result();
    $getresult = $result->fetch_assoc();

    $payment_status=$getresult['payment_status'];
    $payment_method=$getresult['payment_method'];

    $stmtStatus->close();

    // Update the product in the database
    $stmt = $conn->prepare("UPDATE orders SET order_status=? where order_id=?");
    $stmt->bind_param("si", $status, $orderID);
    $stmt->execute();
    $stmt->close();
    
    if ($status === "Delivered"&&$payment_method==="COD") {
        // Update the product in the database
        $stmt = $conn->prepare("UPDATE receipt SET status='Paid' where order_id=?");
        $stmt->bind_param("i", $orderID);
        $stmt->execute();
        $stmt->close();
        // Update the product in the database
        $stmt = $conn->prepare("UPDATE orders SET payment_status='Completed' where order_id=?");
        $stmt->bind_param("i", $orderID);
        $stmt->execute();
        $stmt->close();
    }
    // // After updating, you can redirect the user or display a success message
    // $_SESSION['editProductSuccess']=true;
    header("Location: orders.php");
}
?>