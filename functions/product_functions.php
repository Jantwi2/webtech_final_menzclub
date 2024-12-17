<?php
// Database connection settings (you can modify these based on your own settings)
include('../config/config.php');

// Function to view all categories
function viewAllCategories($conn) {
    // Get database connection
    global $conn;
    // SQL query to fetch all categories
    $query = "SELECT * FROM categories ORDER BY cat_name ASC"; // Adjust the field names accordingly

    // Execute the query
    $result = $conn->query($query);

    // Check if categories exist
    if ($result->num_rows > 0) {
        // Fetch all categories into an associative array
        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
        return $categories;  // Return the categories
    } else {
        return [];  // Return an empty array if no categories found
    }

    // Close the database connection
    $conn->close();
}


// Function to view all categories
function viewAllBrands($conn) {
    // Get database connection
    global $conn;
    // SQL query to fetch all categories
    $query = "SELECT * FROM brands ORDER BY brand_name ASC"; // Adjust the field names accordingly

    // Execute the query
    $result = $conn->query($query);

    // Check if categories exist
    if ($result->num_rows > 0) {
        // Fetch all categories into an associative array
        $brands = [];
        while ($row = $result->fetch_assoc()) {
            $brands[] = $row;
        }
        return $brands;  // Return the categories
    } else {
        return [];  // Return an empty array if no categories found
    }
    // Close the database connection
}


// Function to view all categories
function viewAllProducts($conn) {
    // Get database connection
    global $conn;
    // SQL query to fetch all categories
    $query = "SELECT 
                p.product_id, p.product_title, p.product_price, p.quantity, p.product_image, 
                b.brand_name, c.cat_name
            FROM 
                products p
            JOIN 
                brands b ON p.product_brand = b.brand_id
            JOIN 
                categories c ON p.product_cat = c.cat_id"; // Adjust the field names accordingly

    // Execute the query
    $result = $conn->query($query);

    // Check if categories exist
    if ($result->num_rows > 0) {
        // Fetch all categories into an associative array
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        return $products;  // Return the categories
    } else {
        return [];  // Return an empty array if no categories found
    }

}


// Function to fetch products by categories
function viewProductsByCategories($conn, $categories) {
    // Sanitize and prepare categories for SQL query
    $categories = array_map(function($cat) {
        return "'" . mysqli_real_escape_string($conn, $cat) . "'";
    }, $categories);
    $categoryList = implode(',', $categories);

    $query = "SELECT * FROM products WHERE product_cat IN ($categoryList)";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        return [];
    }
}

function viewProductsByBrands($conn, $brands) {
    global $conn;
    // Sanitize and prepare categories for SQL query
    $brands = array_map(function($brand) {
        return "'" . mysqli_real_escape_string($conn, $brand) . "'";
    }, $categories);
    $brandList = implode(',', $brands);

    $query = "SELECT * FROM products WHERE product_brand IN ($brandList)";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        return [];
    }
}


?>
