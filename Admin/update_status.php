<?php
// Check if the orderID parameter is set
if (isset($_POST['orderID'])) {
    // Retrieve the orderID from the POST request
    $orderID = $_POST['orderID'];

    // Validate and sanitize the orderID
    $orderID = filter_var($orderID, FILTER_SANITIZE_NUMBER_INT);

    // Perform database operations to update the status
    try {
        // Connect to your database (assuming you have a db connection setup)
        require_once("db/dbconnect.php");

        // Prepare the update statement
        $stmt = $conn->prepare("UPDATE Orders SET status = ? WHERE order_id = ?");

        // Define the new status value (you can toggle between the 5 statuses)
        $statuses = ["Completed", "Pending", "Refunded", "Initiated", "Inactive"];
        $currentStatus = $_POST['currentStatus']; // You need to send the current status from the client-side
        $newStatusIndex = array_search($currentStatus, $statuses);
        $newStatusIndex = ($newStatusIndex + 1) % count($statuses);
        $newStatus = $statuses[$newStatusIndex];

        // Bind parameters and execute the statement
        $stmt->bind_param("si", $newStatus, $orderID);
        $stmt->execute();

        // Close the statement and database connection
        $stmt->close();
        $conn->close();

        // Send a success response
        http_response_code(200);
        echo json_encode(array("message" => "Status updated successfully"));
    } catch (Exception $e) {
        // Send an error response if there's an exception
        http_response_code(500);
        echo json_encode(array("message" => "Error updating status: " . $e->getMessage()));
    }
} else {
    // Send a bad request response if the orderID parameter is not set
    http_response_code(400);
    echo json_encode(array("message" => "Missing orderID parameter"));
}
?>
