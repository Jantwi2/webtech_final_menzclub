<?php
include '../config/config.php';

function getCartItems($conn, $user_id) {
    global $conn;
    // SQL query to get cart items along with product details
    $sql = "SELECT 
                c.c_id,
                c.qty,
                c.p_id,
                (p.product_price * c.qty) AS total,
                p.product_title,
                p.product_price,
                p.product_image
            FROM 
                cart c
            JOIN 
                products p ON c.p_id = p.product_id
            WHERE 
                c.c_id = ?";

    // Prepare the query
    if ($stmt = $conn->prepare($sql)) {
        // Bind the user_id parameter to the query
        $stmt->bind_param("i", $user_id);  // 'i' means integer
        // Execute the query
        $stmt->execute();
        // Get the result
        $result = $stmt->get_result();

        // Fetch all cart items into an array
        $cartItems = [];
        while ($row = $result->fetch_assoc()) {
            $cartItems[] = $row;
        }

        // Return the cart items
        return $cartItems;
    } else {
        return []; // Return an empty array if the query fails
    }
}
?>
