<?php
include '../config/config.php';

// Function to view the most recent orders of the logged-in user
function getOrders($conn, $userId) {
    // Prepare SQL query to fetch the most recent orders for the user
    $sql = "SELECT order_id, order_date, invoice_no FROM orders WHERE customer_id = ? ORDER BY order_date DESC LIMIT 1";  // Adjust limit as needed
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);  // Bind the user_id parameter
    $stmt->execute();
    $result = $stmt->get_result();

    $orders = [];

    // Check if there are any orders
    if ($result->num_rows > 0) {
        while ($order = $result->fetch_assoc()) {
            // Add the order data to the orders array
            $orders[] = [
                'invoice_no' =>$order['invoice_no'],
                'order_id' => $order['order_id'],
                'order_date' => $order['order_date']
            ];
        }
    }

    // Return the array of orders
    return $orders;
}
?>
