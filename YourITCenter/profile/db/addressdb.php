<?php
session_start();
require_once("../../db/dbconnect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $phone = $_POST['phone'];
    $province = $_POST['province'];
    $district = $_POST['district'];
    $address = $_POST['address'];
    $shippingProvince = $_POST['shippingProvince'];
    $shippingDistrict = $_POST['shippingDistrict'];
    $shippingAddress = $_POST['shippingAddress'];

    $fulladdress=$address.','.$district.','.$province;
    $fullShippingAddress=$shippingAddress.','.$shippingDistrict.','.$shippingProvince;
    // Get user_id from session
    $user_id = $_SESSION['user_id'];

    // Prepare and bind statement
    $stmt = $conn->prepare("UPDATE customers SET phone=?, address=?, shipping_address=? WHERE user_id=?");
    $stmt->bind_param("sssi", $phone, $fulladdress, $fullShippingAddress, $user_id);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        // Address updated successfully
        header("Location: ../../address.php"); // Redirect to the address page
        exit();
    } else {
        // Error occurred while updating address
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
