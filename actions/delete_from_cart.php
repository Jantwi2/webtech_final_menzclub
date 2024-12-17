<?php
include '../config/config.php';

if (isset($_POST['product_id'])) {
    // Get the cart item ID from the POST data
    $cartItemId = $_POST['product_id'];

    // SQL query to delete the cart item
    $sql = "DELETE FROM cart WHERE p_id = ?";

    // Prepare the query
    if ($stmt = $conn->prepare($sql)) {
        // Bind the cart item ID to the query
        $stmt->bind_param("i", $cartItemId);  // 'i' means integer
        // Execute the query
        if ($stmt->execute()) {
            // If the query is successful, return "success"
            echo "success";
        } else {
            // If there is an error, return "error"
            echo "error";
        }
    } else {
        echo "error";
    }
} else {
    echo "error";
}
?>
