<?php
session_start();

// Include your database connection
include_once('../config/config.php'); // Replace with the actual path to your db connection file

// Check if product ID and quantity are set
if (isset($_POST['product_id'])) {
    $product_id = (int) $_POST['product_id'];
    $quantity = 1;

    // Get the user's IP address (you can also get the customer ID if logged in)
    $ip_address = $_SERVER['REMOTE_ADDR'];

    // If customer is logged in, use the customer ID
    $customer_id = isset($_SESSION['user_id']) ? (int) $_SESSION['user_id'] : NULL;

    // Check if the product is already in the cart for this IP/customer
    $query = "SELECT * FROM cart WHERE p_id = ? AND ip_add = ? AND c_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('isi', $product_id, $ip_address, $customer_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // If product is already in the cart, update the quantity
        $row = $result->fetch_assoc();
        $new_quantity = $row['qty'] + $quantity;

        $update_query = "UPDATE cart SET qty = ? WHERE p_id = ? AND ip_add = ? AND c_id = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param('iisi', $new_quantity, $product_id, $ip_address, $customer_id);
        $update_stmt->execute();
    } else {
        // If product is not in the cart, insert it
        $insert_query = "INSERT INTO cart (p_id, ip_add, c_id, qty) VALUES (?, ?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_query);
        $insert_stmt->bind_param('isis', $product_id, $ip_address, $customer_id, $quantity);
        $insert_stmt->execute();
    }

    // Redirect back to the previous page or cart page
    header('Location: ../view/shop.php'); // You can adjust this to the cart page or show a success message
    exit;
} else {
    // If the necessary data is not provided
    echo "Invalid product or quantity.";
}
?>
