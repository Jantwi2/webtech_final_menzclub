<?php
// Include database connection file
require_once('../config/config.php'); 


// Check form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get form data
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $phone_no = trim($_POST['phone']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm_password']);

    // Array to hold error messages
    $errors = [];

    // Validate password strength
    if (!preg_match("/^(?=.*[A-Z])(?=.*\d.*\d.*\d)(?=.*[@#$%^&+=!]).{8,}$/", $password)) {
        $errors[] = "Password must be at least 8 characters, contain 1 uppercase letter, 3 digits, and 1 special character.";
    }

    // Check if passwords match
    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match.";
    }

    // If there are any errors, display them
    if (count($errors) > 0) {
        echo json_encode(['status' => 'error', 'errors' => $errors]);
        exit;
    }

    // Hash the password for security before storing it
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Prepare the SQL query to insert the new user
    $query = "INSERT INTO `customer` (`firstname`, `lastname`, `email`, `user_password`, `phone_no`) VALUES (?, ?, ?, ?, ?)";
    if ($stmt = $conn->prepare($query)) {
        // Bind the parameters
        $stmt->bind_param("sssss", $firstname, $lastname, $email, $hashedPassword, $phone_no);

        // Execute the query
        if ($stmt->execute()) {
            header('Location: ../view/login.php');
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error: Could not register user.']);
        }

        // Close the statement
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Database error: Could not prepare the statement.']);
    }

    // Close the connection
    $conn->close();
}
?>
