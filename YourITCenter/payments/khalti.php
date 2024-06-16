<?php
// Define the payload array
$payload = array(
    "return_url" => "http://localhost/YourITCenter/payments/success.php",
    "website_url" => "http://localhost/YourITCenter/",
    "amount" => 1300,
    "purchase_order_id" => "test12",
    "purchase_order_name" => "test",
    "customer_info" => array(
        "name" => "Ashim Upadhaya",
        "email" => "example@gmail.com",
        "phone" => "9811496763"
    ),
    "amount_breakdown" => array(
        array(
            "label" => "Mark Price",
            "amount" => 1000
        ),
        array(
            "label" => "VAT",
            "amount" => 300
        )
    ),
    "product_details" => array(
        array(
            "identity" => "1234567890",
            "name" => "Khalti logo",
            "total_price" => 1300,
            "quantity" => 1,
            "unit_price" => 1300
        )
    )
);

// Encode the payload as JSON
$json_payload = json_encode($payload);

// Initialize cURL
$curl = curl_init();
curl_setopt_array(
    $curl,
    array(
        CURLOPT_URL => 'https://a.khalti.com/api/v2/epayment/initiate/',
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

// Output the response
// Decode the JSON response
$response_data = json_decode($response, true);

// Check if the response contains the payment URL
if (isset($response_data['payment_url'])) {
    // Redirect the user to the payment URL
    header('Location: ' . $response_data['payment_url']);
    exit(); // Make sure to exit to prevent further execution
} else {
    // Handle the case where payment URL is not received
    echo "Payment URL not found in the response.";
}
?>