<?php
session_start();
require_once("../db/dbconnect.php");
$pidx = $_GET['pidx'];
$transaction_id = $_GET['transaction_id'];
$amount = ($_GET['amount'] / 100);
$mobile = $_GET['mobile'];
$purchase_order_id = $_GET['purchase_order_id'];
$purchase_order_name = $_GET['purchase_order_name'];

function verifyPayment($pidx, $conn, $purchase_order_id, $amount, $transaction_id, $purchase_order_name)
{
    $payload = array("pidx" => $pidx);
    $json_payload = json_encode($payload);
    // Initialize cURL
    $curl = curl_init();
    curl_setopt_array(
        $curl,
        array(
            CURLOPT_URL => 'https://a.khalti.com/api/v2/epayment/lookup/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $json_payload,
            CURLOPT_HTTPHEADER => array(
                'Authorization: key 2ab17b262d074d63bc973e9ab5e4d3ef',
                'Content-Type: application/json',
            ),
        )
    );

    // Execute the cURL request
    $response = curl_exec($curl);
    // Close cURL resource
    curl_close($curl);
    verifyPaymentResponse($response, $conn, $purchase_order_id, $amount, $transaction_id, $purchase_order_name);

}

function verifyPaymentResponse($response, $conn, $purchase_order_id, $amount, $transaction_id, $purchase_order_name)
{
    $response_data = json_decode($response, true);
    $sqlStatus = 'Pending';
    if ($response_data['status'] === "Completed") {
        $sqlStatus = "Completed";
    }
    if ($response_data['status'] === "Pending") {
        $sqlStatus = "Pending";
    }
    if ($response_data['status'] === "Refunded") {
        $sqlStatus = "Refunded";
    }
    if ($response_data['status'] === "Expired") {
        $sqlStatus = "Expired";
    }
    if ($response_data['status'] === "Initiated") {
        $sqlStatus = "Initiated";
    }
    $stmt = $conn->prepare("INSERT INTO Orders (product_id, name, customer_id, customer_email, price, payment_status, order_status, transaction_id, payment_method) VALUES (?, ?, ?, ?, ?, ?, 'Processing Order', ?, 'Khalti')");
    $stmt->bind_param('ssisdss', $purchase_order_id, $purchase_order_name, $_SESSION['user_id'], $_SESSION['email'], $amount, $sqlStatus, $transaction_id);
    $stmt->execute();

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
        "paymentMethod" => "Khalti"
    );
    $stmtorder = $conn->prepare("SELECT order_id FROM orders WHERE transaction_id = ? AND customer_id=?");
    $stmtorder->bind_param("si", $transaction_id, $_SESSION['user_id']);
    $stmtorder->execute();
    $resultorder = $stmtorder->get_result();
    $getorder = $resultorder->fetch_assoc();
    // $stmtorder = $conn->prepare("SELECT order_id FROM orders WHERE product_id = ?");

    $stmtcustomers = $conn->prepare("SELECT shipping_address FROM customers WHERE user_id=?");
    $stmtcustomers->bind_param("i", $_SESSION['user_id']);
    $stmtcustomers->execute();
    $stmtcustomers = $stmtcustomers->get_result();
    $getcustomers = $stmtcustomers->fetch_assoc();
    $shippingAddress = $getcustomers['shipping_address'];

    setQuantity($conn, $purchase_order_id, $transaction_id);

    $stmtqty = $conn->prepare("SELECT quantity FROM orders WHERE transaction_id=? AND customer_id=?");
    $stmtqty->bind_param("si", $transaction_id, $_SESSION['user_id']);
    $stmtqty->execute();
    $stmtqty = $stmtqty->get_result();
    $quantityString = $stmtqty->fetch_assoc();

    $getqty = explode(',', $quantityString['quantity']);
    // Generate receipt HTML
    $receiptHTML = generateReceipt($receiptData, $productNames, $shippingAddress, $getqty);
    $stmtreceipt = $conn->prepare("INSERT INTO receipt (user_id, order_id, product_id, customer_email, customer_name, description,transaction_id,status) VALUES (?, ?, ?, ?, ?, ?, ?,'Paid')");
    $stmtreceipt->bind_param("iisssss", $_SESSION['user_id'], $getorder['order_id'], $_GET['purchase_order_id'], $_SESSION['email'], $_SESSION['full_name'], $receiptHTML, $transaction_id);

    // Execute the statement
    $stmtreceipt->execute();

    // Output the receipt HTML
}
function generateReceipt($receiptData, $productNames, $shippingAddress, $getqty)
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


function removeFromCart($conn, $purchase_order_id, $transaction_id)
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
function setQuantity($conn, $purchase_order_id, $transaction_id)
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
    verifyPayment($pidx, $conn, $purchase_order_id, $amount, $transaction_id, $purchase_order_name);
    removeFromCart($conn, $purchase_order_id, $transaction_id);
    // Close the prepared statements
    if (isset($stmt)) {
        $stmt->close();
    }

    if (isset($stmt1)) {
        $stmt1->close();
    }

    if (isset($stmtorder)) {
        $stmtorder->close();
    }

    if (isset($stmtcustomers)) {
        $stmtcustomers->close();
    }

    if (isset($stmtqty)) {
        $stmtqty->close();
    }

    if (isset($stmtreceipt)) {
        $stmtreceipt->close();
    }

    if (isset($stmtStock)) {
        $stmtStock->close();
    }

    if (isset($stmtUpdate)) {
        $stmtUpdate->close();
    }
    // Call the function with the transaction_id
    header('Location: ../viewreceipt.php?transaction_id=' . $transaction_id . '');
    exit();

} else {
    // echo $transaction_id;
    header('Location: ../error.php');
    exit();
}
?>