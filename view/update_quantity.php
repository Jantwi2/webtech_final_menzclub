<?php
include '../config/config.php';

if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $cartItemId = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Validate that the quantity is a positive integer
    if (filter_var($quantity, FILTER_VALIDATE_INT) && $quantity > 0) {
        // SQL query to update the quantity in the cart
        $sql = "UPDATE cart SET qty = ? WHERE p_id = ?";

        // Prepare the query
        if ($stmt = $conn->prepare($sql)) {
            // Bind the parameters to the query
            $stmt->bind_param("ii", $quantity, $cartItemId);
            
            // Execute the query
            if ($stmt->execute()) {
                echo "success";  // Return success if the update is successful
            } else {
                echo "error";  // Return error if the update fails
            }
        } else {
            echo "error";  // Return error if the SQL query preparation fails
        }
    } else {
        echo "invalid_quantity";  // Return error if the quantity is invalid
    }
} else {
    echo "error";  // Return error if required parameters are missing
}
?>
