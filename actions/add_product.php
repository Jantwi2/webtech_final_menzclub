<?php
include('../config/config.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $productName = $_POST['productName'];
    $productCategory = $_POST['productCategory'];
    $productBrand = $_POST['productBrand'];
    $productQuantity = $_POST['productQuantity'];
    $productPrice = $_POST['productPrice'];

    var_dump($_POST);
    // Handle the image upload
    if (isset($_FILES['productImage']) && $_FILES['productImage']['error'] === UPLOAD_ERR_OK) {
        $imageTmpName = $_FILES['productImage']['tmp_name'];
        $imageName = basename($_FILES['productImage']['name']);
        $imagePath = '../uploads/' . $imageName; // Define where to store the image

        // Validate file type (optional)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($_FILES['productImage']['type'], $allowedTypes)) {
            // Move the uploaded file to the destination folder
            if (move_uploaded_file($imageTmpName, $imagePath)) {
                // Insert product data into the database
                $stmt = $conn->prepare("INSERT INTO products (product_cat, product_brand, product_title, product_price, quantity, product_image) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("iisdis", $productCategory, $productBrand, $productName, $productPrice, $productQuantity, $imagePath);
                // Execute the statement
                if ($stmt->execute()) {
                    header('Location ../admin/products.php');
                } else {
                    echo "Error adding product: " . $stmt->error;
                }

                // Close the prepared statement
                $stmt->close();
            } else {
                echo "Error uploading the image.";
            }
        } else {
            echo "Invalid image type. Only JPG, PNG, and GIF are allowed.";
        }
    } else {
        echo "Error uploading file or no file selected.";
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
