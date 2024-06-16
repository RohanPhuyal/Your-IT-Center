<?php
session_start();
require_once("../db/dbconnect.php");

$transaction_id = $_GET['transaction_id'];
$purchase_order_id = $_GET['product_id'];
$purchase_order_name = $_GET['product_name'];
$amount = $_GET['amount'];


function verifyPaymentResponse1($conn, $purchase_order_id, $amount, $transaction_id, $purchase_order_name)
{
    $stmt = $conn->prepare("INSERT INTO Orders (product_id, name, customer_id, customer_email, price, payment_status, order_status, transaction_id, payment_method) VALUES (?, ?, ?, ?, ?, 'Cash on Delivery', 'Processing Order', ?, 'COD')");
    $stmt->bind_param('ssisds', $purchase_order_id, $purchase_order_name, $_SESSION['user_id'], $_SESSION['email'], $amount, $transaction_id);
    $stmt->execute();
    $stmt->close(); // Close the statement

    // Retrieve product names based on product IDs
    $productIds = explode(',', $purchase_order_id);
    $productNames = array();

    foreach ($productIds as $productId) {
        $stmt = $conn->prepare("SELECT name, price FROM products WHERE product_id = ?");
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $productNames[$row['name']] = $row['price'];
        }
        $stmt->close(); // Close the statement
    }

    $receiptNumber = mt_rand(100000, 999999);
    $fullname = $_SESSION['full_name'];
    $email = $_SESSION['email'];
    // Define receipt data
    $receiptData = array(
        "receiptNumber" => "$receiptNumber",
        "orderedBy" => "$fullname",
        "email" => "$email",
        "total" => $amount,
        "paymentMethod" => "Cash on Delivery"
    );
    $stmtorder = $conn->prepare("SELECT order_id FROM orders WHERE transaction_id = ? AND customer_id=?");
    $stmtorder->bind_param("si", $transaction_id, $_SESSION['user_id']);
    $stmtorder->execute();
    $resultorder = $stmtorder->get_result();
    $getorder = $resultorder->fetch_assoc();

    $stmtcustomers = $conn->prepare("SELECT shipping_address FROM customers WHERE user_id=?");
    $stmtcustomers->bind_param("i", $_SESSION['user_id']);
    $stmtcustomers->execute();
    $stmtcustomers = $stmtcustomers->get_result();
    $getcustomers = $stmtcustomers->fetch_assoc();
    $shippingAddress = $getcustomers['shipping_address'];
    $stmtcustomers->close(); // Close the statement

    setQuantity1($conn, $purchase_order_id, $transaction_id);

    $stmtqty = $conn->prepare("SELECT quantity FROM orders WHERE transaction_id=? AND customer_id=?");
    $stmtqty->bind_param("si", $transaction_id, $_SESSION['user_id']);
    $stmtqty->execute();
    $stmtqty = $stmtqty->get_result();
    $quantityString = $stmtqty->fetch_assoc();
    $stmtqty->close(); // Close the statement

    $getqty = explode(',', $quantityString['quantity']);
    // Generate receipt HTML
    $receiptHTML = generateReceipt1($receiptData, $productNames, $shippingAddress, $getqty);
    $stmtreceipt = $conn->prepare("INSERT INTO receipt (user_id, order_id, product_id, customer_email, customer_name, description,transaction_id,status) VALUES (?, ?, ?, ?, ?, ?, ?,'Unpaid')");
    $stmtreceipt->bind_param("iisssss", $_SESSION['user_id'], $getorder['order_id'], $purchase_order_id, $_SESSION['email'], $_SESSION['full_name'], $receiptHTML, $transaction_id);
    $stmtreceipt->execute();
    $stmtreceipt->close(); // Close the statement
    $stmtorder->close(); // Close the statement
}
function generateReceipt1($receiptData, $productNames, $shippingAddress, $getqty)
{
    $html = '<div class="receipt-container">';
    $html .= '<h1 class="mt-4 mb-3">Receipt</h1>';
    $html .= '<div class="row">';
    $html .= '<div class="col">';
    $html .= '<p><strong>Date:</strong> ' . date("Y-m-d H:i:s") . '</p>';
    $html .= '<p><strong>Receipt Number:</strong> #' . $receiptData['receiptNumber'] . '</p>';
    $html .= '<p><strong>Ordered By:</strong> #' . $receiptData['orderedBy'] . '</p>';
    $html .= '<p><strong>Email:</strong> #' . $receiptData['email'] . '</p>';
    $html .= '<p><strong>Shipping Address:</strong> #' . $shippingAddress . '</p>';
    $html .= '</div>';
    $html .= '</div>';

    $html .= '<h3 class="mt-4 mb-3">Items:</h3>';
    $html .= '<ul class="list-group mb-3">';

    $i = 0;
    // Iterate over product names and prices
    foreach ($productNames as $productName => $price) {
        $html .= '<li class="list-group-item d-flex justify-content-between lh-condensed">';
        $html .= '<div>';
        $html .= '<h6 class="my-0">' . $productName . '</h6>';
        $html .= '<small class="text-muted">Price: Rs.' . $price . '   QTY: ' . $getqty[$i] . '</small>';
        $html .= '</div>';
        $html .= '<span class="text-muted">Rs.' . ($price * $getqty[$i]) . '</span>';
        $html .= '</li>';
        $i++;
    }
    $i = 0;
    $html .= '<li class="list-group-item d-flex justify-content-between">';
    $html .= '<span>Total (NRP)</span>';
    $html .= '<strong>Rs.' . ($receiptData['total']) . '</strong>';
    $html .= '</li>';
    $html .= '</ul>';
    $html .= '<p><strong>Payment Method:</strong> ' . $receiptData['paymentMethod'] . '';

    return $html;
}


function removeFromCart1($conn, $purchase_order_id, $transaction_id)
{
    $product_id = explode(',', $purchase_order_id);

    // Check if the user is logged in
    if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true) {
        // User is logged in, remove the item from the database
        $user_id = $_SESSION['user_id'];

        // $quantity = array();

        foreach ($product_id as $product) {
            // $qtystmt = $conn->prepare("SELECT quantity FROM cart WHERE user_id = ? AND product_id = ?");
            // $qtystmt->bind_param("ii", $user_id, $product);
            // $qtystmt->execute();
            // $qtystmt = $qtystmt->get_result();
            // $getquantity = $qtystmt->fetch_assoc();
            // $quantity[] = $getquantity['quantity'];

            $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ? AND product_id = ?");
            $stmt->bind_param("ii", $user_id, $product);
            $stmt->execute();

            $stmt1 = $conn->prepare("ALTER TABLE cart AUTO_INCREMENT = 1");
            $stmt1->execute();
        }
        // $stringqty = implode(',', $quantity);

        // $stmt = $conn->prepare("UPDATE orders SET quantity=? WHERE transaction_id=? AND customer_id=?");
        // $stmt->bind_param("sii", $stringqty, $transaction_id, $_SESSION['user_id']);
        // $stmt->execute();

    }
}
function setQuantity1($conn, $purchase_order_id, $transaction_id)
{
    $product_id = explode(',', $purchase_order_id);

    // Check if the user is logged in
    if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true) {
        // User is logged in, remove the item from the database
        $user_id = $_SESSION['user_id'];

        $quantity = array();

        foreach ($product_id as $product) {
            $qtystmt = $conn->prepare("SELECT quantity FROM cart WHERE user_id = ? AND product_id = ?");
            $qtystmt->bind_param("ii", $user_id, $product);
            $qtystmt->execute();
            $qtystmt = $qtystmt->get_result();
            $getquantity = $qtystmt->fetch_assoc();
            $quantity[] = $getquantity['quantity'];

            // Prepare the SQL statement
            $stmtStock = $conn->prepare("UPDATE products SET stock = stock - ? WHERE product_id = ?");
            // Bind the parameters
            $stmtStock->bind_param("ii", $getquantity['quantity'], $product);
            // Execute the statement
            $stmtStock->execute();
        }
        $stringqty = implode(',', $quantity);
        $stmtUpdate = $conn->prepare("UPDATE orders SET quantity=? WHERE transaction_id=? AND customer_id=?");
        $stmtUpdate->bind_param("ssi", $stringqty, $transaction_id, $_SESSION['user_id']);
        $stmtUpdate->execute();

    }
}

if (isset($_GET['transaction_id']) && $_GET['transaction_id'] != "") {
    verifyPaymentResponse1($conn, $purchase_order_id, $amount, $transaction_id, $purchase_order_name);
    removeFromCart1($conn, $purchase_order_id, $transaction_id);
    // Call the function with the transaction_id
    header('Location: ../viewreceipt.php?transaction_id=' . $transaction_id . '');
    exit();

} else {
    // echo $transaction_id;
    header('Location: ../error.php');
    exit();
}
?>