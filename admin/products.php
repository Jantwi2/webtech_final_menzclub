<?php
include('../functions/product_functions.php');
$categories = viewAllCategories($conn);
$brands = viewAllBrands($conn);
$products = viewAllProducts($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MenzClub Admin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #CACACA;         /* Black */
            --secondary: #000000;       /* Light Gray */
            --accent: #0056b3;          /* Blue */
            --text: #ffffff;            /* White */
            --danger: #ff4444;          /* Red (kept unchanged) */
            --success: #0056b3;         /* Blue (same as accent) */
            --warning: #ffbb33;         /* Yellow (kept unchanged) */
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Roboto;
        }

        body {
            background: var(--primary);
            color: var(--text);
            min-height: 100vh;
            grid-template-columns: 250px 1fr;
            overflow-x: hidden;
        }

        .sidebar {
            background: var(--secondary);
            padding: 2rem;
            height: 100vh;
            position: fixed;
            width: 250px;
            overflow-y: auto;
            transition: transform 0.3s ease-in-out;
        }

        .sidebar.hidden {
            transform: translateX(-250px); /* Move sidebar out of view */
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--accent);
        }

        .nav-item {
            padding: 1rem;
            margin: 0.5rem 0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .nav-item:hover {
            background: rgba(0, 255, 0, 0.1);
            color: var(--primary);
        }

        /* Remove text decoration from anchor tags inside nav items */
        nav .nav-item a {
            text-decoration: none;  /* Removes underline */
            color: inherit;         /* Inherits the color from the parent (nav-item) */
        }

        .nav-item.active {
            background: var(--accent);
            color: var(--primary);
        }


        /* Mobile Sidebar Toggle Button */
        .mobile-toggle {
            display: none;
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 2rem;
            cursor: pointer;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            /* Hide sidebar by default on mobile */
            .sidebar {
                width: 250px;
                transform: translateX(-250px); /* Sidebar is off-screen */
            }

            /* Show mobile toggle button */
            .mobile-toggle {
                display: block;
            }

            /* Adjust main content when sidebar is hidden */
            .main-content {
                margin-left: 0; /* Ensure content starts without sidebar */
            }

            .main-content.sidebar-visible {
                margin-left: 250px; /* Add space when sidebar is visible */
            }
        }

        .main-content {
            padding: 2rem;
            margin-left: 250px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            width: calc(100% - 250px); /* Ensure header width does not overlap with the sidebar */
            position: fixed;
            top: 0;
            left: 250px; /* Start the header after the sidebar */
            z-index: 1000;
            padding: 1rem;
            background-color: var(--secondary);
        }

        .search-container {
            flex-grow: 0; /* Prevents the search bar from taking up too much space */
            margin-right: auto; /* Pushes the header items to the right */
        }

        .search-bar {
            background: var(--accent);
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 8px;
            color: var(--text);
            width: 250px; /* You can adjust this width as needed */
        }

        .header-items {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .notification-container, .dropdown {
            position: relative;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: var(--primary);
        }

        .notification-badge {
            background: var(--danger);
            color: white;
            border-radius: 50%;
            padding: 0.2rem 0.5rem;
            font-size: 0.8rem;
            position: absolute;
            top: -5px;
            right: -5px;
        }

        .dropdown {
            position: relative;
            cursor: pointer;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            background: var(--secondary);
            border-radius: 8px;
            padding: 1rem;
            min-width: 200px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-item {
            padding: 0.5rem;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background: rgba(0, 255, 0, 0.1);
            border-radius: 4px;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }


        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr); /* Test by forcing 3 columns */
            gap: 4rem;
            margin-top: 80px; /* Add margin-top to avoid content being hidden behind the header */
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--secondary);
            padding: 2rem;
            width: 15rem;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stat-info h3 {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        .stat-icon {
            font-size: 2rem;
            color: var(--accent);
        }

        .trend-up {
            color: var(--success);
        }

        .summary-image {
            width: 200px; /* Make the logo image a bit smaller */
            display: block;
            top: 0;
            margin: 0 auto 1rem; /* Center the image and add space below */
        }

        .recent-orders {
            background: var(--secondary);
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 30px;
            width: 100%; /* Adjusted for better centering */
            max-width: 1200px; /* Limit the width of the table */
            margin: 2rem auto; /* Center the container with some spacing around */
        }

        h2 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
            max-width: 100%;
        }

        .table th, .table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #444;
        }

        .table th {
            background-color: var(--accent);
        }

        .status {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
        }

        .status.pending {
            background: rgba(255, 187, 51, 0.2);
            color: var(--warning);
        }

        .status.completed {
            background: rgba(0, 200, 81, 0.2);
            color: var(--success);
        }

        .status.cancelled {
            background: rgba(255, 68, 68, 0.2);
            color: var(--danger);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .table th, .table td {
                padding: 0.4rem;
            }

            h2 {
                font-size: 1.2rem;
            }

            .recent-orders {
                width: 95%; /* Increase width for smaller screens */
            }
        }


        @media (max-width: 768px) {
            .table th, .table td {
                padding: 0.4rem;
            }

            h2 {
                font-size: 1.2rem;
            }

            .recent-orders {
                width: 95%; /* Increase width for smaller screens */
            }
        }


        .live-indicator {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 2rem;
            padding: 1rem;
            background: rgba(0, 200, 81, 0.1);
            border-radius: 8px;
        }

        .live-dot {
            width: 10px;
            height: 10px;
            background: var(--success);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @media (max-width: 1024px) {
            body {
                grid-template-columns: 1fr;
            }

            .sidebar {
                display: none;
            }

            .main-content {
                margin-left: 0;
            }
        }


        @media (min-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 767px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }


        .product-image {
            width: 50px; /* Adjust size as needed */
            height: auto;
            border-radius: 5px; /* Optional: add rounded corners */
            object-fit: cover; /* Ensures the image is not stretched */
        }


        .add-product-btn {
            background-color: #4CAF50; /* Green background */
            color: white; /* White text */
            padding: 10px 20px; /* Padding around the text */
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-bottom: 15px;
        }

        .add-product-btn:hover {
            background-color: #45a049; /* Darker green on hover */
        }
        
        /* Modal Styles */
        .modal {
            display: none;  /* Hidden by default */
            position: fixed;
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            color: #000000;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            max-height: 80%; /* Limit the max height */
            overflow-y: auto; /* Enable scrolling if content exceeds max-height */
        }

        /* Ensure the modal stays centered */
        .modal-content {
            display: flex;
            flex-direction: column;
            justify-content: flex-start; /* Align items at the start of the container */
            align-items: center;
            min-height: 300px;
            max-height: 80%; /* This limits the height of the modal */
        }

        /* Scrollable form area */
        #addProductForm {
            display: flex;
            flex-direction: column;
            width: 100%;
            max-height: 500px;
            overflow-y: auto; /* Makes the form scrollable */
            padding-right: 10px; /* Prevents form overflow */
        }

        #addProductForm label {
            margin: 10px 0 5px 0;
            font-size: 16px;
        }

        #addProductForm input, #addProductForm select {
            margin: 5px 0 15px 0;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            font-size: 14px;
        }

        .submit-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        .submit-btn:hover {
            background-color: #45a049;
        }

        /* Close Button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <aside class="sidebar">
        <div class="logo">
            <img src="../assets/images/logocroppednobg.png" alt="Product" class="summary-image">
        </div>

        <nav>
            <div class="nav-item">
                <a href="dashboard.php">
                    <i class="fas fa-th-large"></i>
                    Dashboard
                </a>
            </div>
            <div class="nav-item active">
                <a href="products.php">
                    <i class="fas fa-shopping-bag"></i>
                    Products
                </a>
            </div>
            <div class="nav-item">
                <a href="brandcat.php">
                    <i class="fas fa-tags"></i>
                    Brand/Category
                </a>
            </div>
            <div class="nav-item">
                <a href="customers.php">
                    <i class="fas fa-users"></i>
                    Customers
                </a>
            </div>
            <div class="nav-item">
                <a href="analytics.php">
                    <i class="fas fa-chart-bar"></i>
                    Analytics
                </a>
            </div>
            <div class="nav-item">
                <a href="orders.php">
                    <i class="fas fa-truck"></i>
                    Orders
                </a>
            </div>
            <div class="nav-item">
                <a href="settings.php">
                    <i class="fas fa-cog"></i>
                    Settings
                </a>
            </div>
        </nav>

        <div class="live-indicator">
            <div class="live-dot"></div>
            <span>12 Users Online</span>
        </div>
    </aside>

    <!-- Mobile Toggle Button -->
        <div class="mobile-toggle" onclick="toggleSidebar()">☰</div>

            <main class="main-content">
                <header class="header">
                    <div class="search-container">
                        <input type="text" class="search-bar" placeholder="Search...">
                    </div>

                    <div class="header-items">
                        <!-- Add more items here if needed -->
                        <div class="notification-container">
                            <div class="dropdown">
                                <i class="fas fa-bell" style="position: relative;">
                                    <span class="notification-badge">3</span>
                                </i>
                                <div class="dropdown-content">
                                    <div class="dropdown-item">New order #1337</div>
                                    <div class="dropdown-item">Low stock alert</div>
                                    <div class="dropdown-item">Review pending</div>
                                </div>
                            </div>
                        </div>

                        <div class="dropdown">
                            <div class="user-avatar">JD</div>
                            <div class="dropdown-content">
                                <div class="dropdown-item">Profile</div>
                                <div class="dropdown-item">Settings</div>
                                <div class="dropdown-item">Logout</div>
                            </div>
                        </div>
                    </div>
                </header>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-info">
                            <h3>25</h3>
                            <p>New Products Added</p>
                            <small class="trend-up">↑ 10% this week</small>
                        </div>
                        <i class="fas fa-box stat-icon"></i>
                    </div>

                <!-- Inventory Levels -->
                    <div class="stat-card">
                        <div class="stat-info">
                            <h3>1,200</h3>
                            <p>Items in Inventory</p>
                            <small class="trend-up">↑ 5% this month</small>
                        </div>
                        <i class="fas fa-warehouse stat-icon"></i>
                    </div>

                    <!-- Out of Stock Products -->
                    <div class="stat-card">
                        <div class="stat-info">
                            <h3>5</h3>
                            <p>Out of Stock Products</p>
                            <small class="trend-down">↓ 2 this week</small>
                        </div>
                        <i class="fas fa-exclamation-triangle stat-icon"></i>
                    </div>
                </div>

                <div class="recent-orders">
                    <div class="recent-products">
                        <h2>Recent Products</h2>
                        <button class="add-product-btn" id="addProductBtn">
                            <i class="fas fa-plus"></i> Add Product
                        </button>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Brand</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($products as $product) : ?>
                                <tr>
                                    <td>PROD-10<?php echo $product['product_id']; ?></td>
                                    <td><img src="<?php echo $product['product_image']; ?>" alt="<?php echo $product['product_title']; ?>" class="product-image"></td>
                                    <td><?php echo $product['product_title']; ?></td>
                                    <td><?php echo $product['brand_name']; ?></td>
                                    <td><?php echo $product['quantity']; ?></td>
                                    <td>GHc<?php echo $product['product_price']; ?></td>
                                    <?php
                                        // Check if the quantity is greater than zero
                                        if ($product['quantity'] > 0) {
                                            echo '<td><span class="status available">Available</span></td>';
                                        } else {
                                            echo '<td><span class="status out-of-stock">Out of Stock</span></td>';
                                        }
                                    ?>
                                    <td>
                                        <a href="#" class="edit-icon" title="Edit"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="delete-icon" title="Delete"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal for Adding Product -->
                <div class="modal" id="productModal">
                    <div class="modal-content">
                        <span class="close" id="closeModal">&times;</span>
                        <h2>Add New Product</h2>
                        <form id="addProductForm" action = "../actions/add_product.php" method = "POST" enctype="multipart/form-data">
                            <label for="productName">Product Name:</label>
                            <input type="text" id="productName" name="productName" required>

                            <label for="productCategory">Category:</label>
                            <select id="productCategory" name="productCategory" required>
                                <option value="">Select a Category</option>
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?php echo $category['cat_id']; ?>"><?php echo $category['cat_name']; ?></option>
                                <?php endforeach; ?>
                                    
                            </select>

                            <label for="productBrand">Brand:</label>
                            <select id="productBrand" name="productBrand" required>
                                <option value="">Select a Brand</option>
                                <?php foreach ($brands as $brand) : ?>
                                    <option value="<?php echo $brand['brand_id']; ?>"><?php echo $brand['brand_name']; ?></option>
                                <?php endforeach; ?>
                            </select>

                            <label for="productQuantity">Quantity:</label>
                            <input type="number" id="productQuantity" name="productQuantity" required>

                            <label for="productPrice">Price (₵):</label>
                            <input type="number" id="productPrice" name="productPrice" required>

                            <label for="productImage">Product Image:</label>
                            <input type="file" id="productImage" name="productImage" accept="image/*" required>

                            <button type="submit" class="submit-btn">Add Product</button>
                        </form>
                    </div>
                </div>

            </main>



            <script>
    // Get modal and button
    const modal = document.getElementById("productModal");
    const addProductBtn = document.getElementById("addProductBtn");
    const closeModal = document.getElementById("closeModal");

    // When the user clicks the button, open the modal
    addProductBtn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    closeModal.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    }

</script>

    <script> 
    
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('hidden');
            const mainContent = document.querySelector('.main-content');
            mainContent.classList.toggle('sidebar-visible');
        }

        // Navigation interaction
        document.querySelectorAll('.nav-item a').forEach(item => {
            item.addEventListener('click', (event) => {
                // Prevent the default anchor behavior
                event.preventDefault();

                // Remove active class from all items
                document.querySelectorAll('.nav-item').forEach(nav => {
                    nav.classList.remove('active');
                });

                // Add active class to the clicked item's parent div
                item.parentElement.classList.add('active');

                // Navigate to the respective page
                window.location.href = item.getAttribute('href');
            });
        });


    </script>
</body>
</html>