<?php
// Include the database configuration
include('../config/config.php');

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the brand name from POST data and sanitize it
    $brand_name = trim($_POST['brand_name']);

    // Validate the brand name (ensure it's not empty)
    if (empty($brand_name)) {
        echo "brand name cannot be empty!";
        exit;
    }

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO brands (brand_name) VALUES (?)");

    if ($stmt === false) {
        echo "Error in preparing SQL statement: " . $conn->error;
        exit;
    }

    // Bind the parameter (the brand name) to the SQL query
    $stmt->bind_param('s', $brand_name);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        header('Location: ../admin/brandcat.php');
    } else {
        echo "Error adding brand: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
