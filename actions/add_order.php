<?php
// Include the database connection file
include_once('../config/config.php'); // Make sure to include your database connection
include '../functions/cart_functions.php';
session_start();

$customer_id = $_SESSION['user_id'];
$cartItems = getCartItems($conn, $customer_id);
error_reporting(E_ALL);

// Start the session to access user details

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve customer ID and cart items
    $invoice = "MenzC-" . rand(1000000, 9999999);
    $order_date = date('Y-m-d');         // Current date
    $status = 'Pending';                 // Order status set to Pending

    // Sanitize inputs
    $customer_id = mysqli_real_escape_string($conn, $customer_id);
    $invoice = mysqli_real_escape_string($conn, $invoice);
    $order_date = mysqli_real_escape_string($conn, $order_date);
    $status = mysqli_real_escape_string($conn, $status);

    // Insert the order into the orders table
    $sql = "INSERT INTO `orders`(`customer_id`, `invoice_no`, `order_date`, `order_status`) 
            VALUES ('$customer_id', '$invoice', '$order_date', '$status')";
    
    if (mysqli_query($conn, $sql)) {
        // Get the inserted order ID
        $order_id = mysqli_insert_id($conn);

        // If order insertion is successful, insert order details for each cart item
        foreach ($cartItems as $product) {
            $product_id = $product['p_id'];
            $quantity = $product['qty'];

            // Sanitize order details inputs
            $product_id = mysqli_real_escape_string($conn, $product_id);
            $quantity = mysqli_real_escape_string($conn, $quantity);

            // Insert each product into orderdetails table
            $sql_details = "INSERT INTO `orderdetails`(`order_id`, `product_id`, `qty`) 
                            VALUES ('$order_id', '$product_id', '$quantity')";

            // If adding order details failed, stop and display error message
            if (!mysqli_query($conn, $sql_details)) {
                echo "Error adding order details for product ID: $product_id";
                exit;
            }
        }

        // Redirect to checkout page after successful order and order details insertion
        header("Location: ../view/checkout.php");
        exit;

    } else {
        // If order insertion failed
        echo "Error creating order.";
        exit;
    }
}
?>
