<?php
// Include the database configuration
include('../config/config.php');

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the category name from POST data and sanitize it
    $category_name = trim($_POST['category_name']);

    // Validate the category name (ensure it's not empty)
    if (empty($category_name)) {
        echo "Category name cannot be empty!";
        exit;
    }

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO categories (cat_name) VALUES (?)");

    if ($stmt === false) {
        echo "Error in preparing SQL statement: " . $conn->error;
        exit;
    }

    // Bind the parameter (the category name) to the SQL query
    $stmt->bind_param('s', $category_name);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        header('Location: ../admin/brandcat.php');
    } else {
        echo "Error adding category: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
