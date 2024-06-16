<?php
// Start the session
session_start();
require("../../db/dbconnect.php");

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and bind statement to insert user into users table
    $stmt_users = $conn->prepare("INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)");
    $stmt_users->bind_param("sss", $full_name, $email, $hashed_password);

    // Execute the statement
    if ($stmt_users->execute() === TRUE) {
        // Retrieve the user_id of the inserted user
        $user_id = $conn->insert_id;

        // Close the statement for users
        $stmt_users->close();

        // Prepare and execute statement to retrieve user_id from users table based on email
        $stmt_select_user_id = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
        $stmt_select_user_id->bind_param("s", $email);
        $stmt_select_user_id->execute();
        $stmt_select_user_id->bind_result($user_id);
        $stmt_select_user_id->fetch();
        $stmt_select_user_id->close();

        // Prepare and bind statement to insert user into customers table
        $stmt_customers = $conn->prepare("INSERT INTO customers (user_id, name, email) VALUES (?, ?, ?)");
        $stmt_customers->bind_param("iss", $user_id, $full_name, $email);

        // Execute the statement
        if ($stmt_customers->execute() === TRUE) {
            // Set session variable to indicate successful registration
            $_SESSION['registration_success'] = true;
            // Redirect to index.php after successful registration
            header("Location: ../../index.php");
            exit(); // Ensure script stops executing after redirect
        } else {
            echo "Error inserting into customers table: " . $stmt_customers->error;
        }

        $stmt_customers->close();
    } else {
        echo "Error inserting into users table: " . $stmt_users->error;
    }

    $stmt_users->close();
}
?>
