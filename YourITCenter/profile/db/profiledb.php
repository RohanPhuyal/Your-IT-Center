<?php
session_start();
require_once("../../db/dbconnect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $currentPassword = $_POST['currentPassword'];

    // Get user_id from session
    $user_id = $_SESSION['user_id'];

    // Validate the current password first
    $stmt = $conn->prepare("SELECT password FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($currentPassword, $user['password'])) {
            // Disable Foregin Key check
            $fkDisable = $conn->prepare("SET FOREIGN_KEY_CHECKS=0;");
            if ($fkDisable->execute() === TRUE) {
                // Update full name and email in users table
                $updateStmt = $conn->prepare("UPDATE users SET full_name=?, email=? WHERE user_id=?");
                $updateStmt->bind_param("ssi", $fullName, $email, $user_id);
                $updateStmt->execute();

                // Update full name and email in customers table
                $updateCustomerStmt = $conn->prepare("UPDATE customers SET name=?, email=? WHERE user_id=?");
                $updateCustomerStmt->bind_param("ssi", $fullName, $email, $user_id);
                $updateCustomerStmt->execute();
                //Enable Foregin Key Check
                $fkEnable = $conn->prepare("SET FOREIGN_KEY_CHECKS=1;");
                if ($fkEnable->execute() === TRUE) {

                    $_SESSION['full_name'] = $fullName;
                    $_SESSION['email'] = $email;
                    $_SESSION['isEditedSuccess'] = true;
                    header("Location: ../../myprofile.php");
                    exit();
                }else{
                    echo "Error enabling fk check: " . $fkEnable->error;
                }
            }else{

            }echo "Error disabling fk check: " . $fkDisable->error;



        } else {
            $_SESSION['isIncorrectPassword'] = true;
            header("Location: ../../myprofile.php");
            exit();
        }
    } else {
        echo "User not found.";
    }

    $stmt->close();
    $updateStmt->close();
    $updateCustomerStmt->close();
    $conn->close();
}
?>