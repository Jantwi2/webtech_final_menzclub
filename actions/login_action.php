<?php
// Include database connection file
require_once '../config/config.php'; 
require '../functions/auth_functions.php';

// Start the session to store error messages
session_start();

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Prepare the SQL query to check if the email exists
    $query = "SELECT `customer_id`, `firstname`, `lastname`, `user_password`, `user_role` FROM `customer` WHERE `email` = ?";
    if ($stmt = $conn->prepare($query)) {
        // Bind the parameter
        $stmt->bind_param("s", $email);

        // Execute the query
        $stmt->execute();

        // Bind the result variables
        $stmt->bind_result($userId, $firstname, $lastname, $hashedPassword, $role);

        // Check if user was found
        if ($stmt->fetch()) {
            // Verify the password against the hashed password
            if (password_verify($password, $hashedPassword)) {
                // Successful login, create session
                startSession($userId, $role, $firstname, $lastname, $email);

                header('Location: ../view/shop.php');
            } else {
                // Incorrect password, store error message in session
                $_SESSION['login_error'] = 'Incorrect password.';
                header('Location: ../view/login.php');
            }
        } else {
            // No user found, store error message in session
            $_SESSION['login_error'] = 'No user found with that email address.';
            header('Location: ../view/login.php');
        }

        // Close the statement
        $stmt->close();
    } else {
        // Database error, store error message in session
        $_SESSION['login_error'] = 'Database error: Could not prepare the statement.';
        header('Location: ../view/login.php');
    }

    // Close the connection
    $conn->close();
}
?>
