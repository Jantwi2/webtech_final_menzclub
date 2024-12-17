<?php
include('../functions/product_functions.php');
$categories = viewAllCategories($conn);
$brands = viewAllBrands($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MenzClub Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
            background: var(--primary) !important;
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
            color: var(--accent) !important;
        }

        .nav-item {
            padding: 1rem;
            margin: 0.5rem 0;
            border-radius: 8px;
            cursor: pointer;
            color: white !important;
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
            color: var(--text);
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

        h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
            max-width: 100%;
        }


        .tables-row {
            display: flex;
            justify-content: space-between;
            gap: 20px; /* Adds some space between the tables */
        }

        .table-container {
            background: var(--secondary) !important;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            justify-content: center;
            margin: 2rem auto; /* Center the container with some spacing around */
        }   
        .table th, .table td {
            color: white !important;
            padding: 16px 24px;
            border: 1px solid #444;
            text-align: left;
        }

        .table th {
            background-color: var(--accent) !important;
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


        .btn-add {
            background: var(--secondary); /* Gradient background */
            color: white;
            padding: 12px 18px; /* Slightly larger padding */
            border-radius: 30px; /* Rounder corners */
            font-size: 18px; /* Larger font size */
            cursor: pointer;
            margin-bottom: 20px;
            border: none; /* No border */
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3); /* Soft shadow */
            transition: all 0.3s ease; /* Smooth transition for hover effect */
        }

        .btn-add:hover {
            background: linear-gradient(45deg, #0056b3, #003d80); /* Darker gradient on hover */
            box-shadow: 0 6px 12px rgba(0, 123, 255, 0.4); /* Larger shadow on hover */
            transform: translateY(-2px); /* Slight upward movement on hover */
        }

        .btn-add:focus {
            outline: none; /* Remove outline on focus */
        }

        .btn-add:active {
            transform: translateY(2px); /* Slightly lower when clicked */
            box-shadow: 0 2px 4px rgba(0, 123, 255, 0.2); /* Smaller shadow on click */
        }
    


        .actions i {
            cursor: pointer;
            margin: 0 5px;
        }

        .actions .edit {
            color: #007bff;
        }

        .actions .delete {
            color: #dc3545;
        }

        .actions .edit:hover {
            color: #0056b3;
        }

        .actions .delete:hover {
            color: #c82333;
        }

        .custom-modal {
            display: none; /* Initially hidden */
            position: fixed;
            z-index: 1000; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
            overflow: auto; /* Allow scroll if needed */
            padding-top: 80px; /* Adjusted for better vertical centering */
            transition: opacity 0.3s ease;
        }

        /* Modal content styling */
        .custom-modal-content {
            background-color: var(--text);
            color: var(--secondary);
            margin: 5% auto;
            padding: 30px;
            border-radius: 12px; /* Round corners more for a softer look */
            width: 90%;
            max-width: 300px;
            max-height: 400px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Add shadow for depth */
            animation: fadeIn 0.3s ease-in-out; /* Add smooth fade-in animation */
        }

        /* Add smooth fade-in animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* Close button */
        .close-btn {
            color: #aaa;
            font-size: 35px;
            font-weight: bold;
            position: absolute;
            top: 15px;
            right: 20px;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .close-btn:hover,
        .close-btn:focus {
            color: #333;
            text-decoration: none;
        }

        /* Form styles */
        .form-group {
            margin-bottom: 10px;
        }

        .form-group label {
            font-weight: 600; /* Slightly bolder label */
            margin-bottom: 8px;
            color: var(--primary); /* Color to make the label stand out */
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border-radius: 8px; /* Larger border radius for softer look */
            border: 1px solid #ccc;
            font-size: 16px;
            box-sizing: border-box;
            transition: border 0.3s ease;
        }


        .form-group input:focus {
            border: 1px solid #007bff; /* Focus color for inputs */
            outline: none;
        }

        /* Submit button styles */
        button[type="submit"] {
            background-color: var(--secondary);
            color: white;
            padding: 14px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        button[type="submit"]:active {
            background-color: #003d8c; /* Darker shade when active */
        }

        /* Optional: Add a smaller margin on mobile devices */
        @media (max-width: 600px) {
            .custom-modal-content {
                width: 90%;
                padding: 20px;
            }
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
        <div class="nav-item">
            <a href="products.php">
                <i class="fas fa-shopping-bag"></i>
                Products
            </a>
        </div>
        <div class="nav-item active">
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
                    <h3>5</h3>
                    <p>Total Brands</p>
                    <small class="trend-up">↑ 12% vs yesterday</small>
                </div>
                <i class="fas fa-tags stat-icon"></i>
            </div>
            
            <div class="stat-card">
                <div class="stat-info">
                    <h3>4</h3>
                    <p>Total Categories</p>
                    <small class="trend-up">↑ 8% vs yesterday</small>
                </div>
                <i class="fas fa-th-large stat-icon"></i>
            </div>

            <div class="stat-card">
                <div class="stat-info">
                    <h3>150</h3>
                    <p>Total Products</p>
                    <small class="trend-up">↑ 20% vs yesterday</small>
                </div>
                <i class="fas fa-tshirt stat-icon"></i>
            </div>
        </div>

        <div class="brand-category">            
            <!-- Create a row to display the tables side by side -->
            <div class="tables-row">
                <div class="table-container">
                    <h3>Brands</h3>
                    <button class="btn btn-add" onclick="openModal('addBrandModal')">Add Brand</button>
                    <table class="table">
                        <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Brand</th>
                                    <th>Action</th>
                                </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $count = 0;
                        foreach ($brands as $brand): ?>
                            <tr>
                                <td><?php echo $count ++; ?></td>
                                <td><?php echo $brand['brand_name']; ?></td>
                                <td>
                                    <a href="../actions/edit_category.php?id=<?php $brand['brand_id']; ?>" class="edit-icon">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="../actions/delete_category.php?id=<?php $brand['brand_id']; ?>" class="delete-icon" onclick="return confirm('Are you sure you want to delete this category?');">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Second table: Category Management -->
                <div class="table-container">
                    <h3>Categories</h3>
                    <button class="btn btn-add" onclick="openModal('addCategoryModal')">Add Category</button>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $count = 0;
                        foreach ($categories as $category): ?>
                            <tr>
                                <td><?php echo $count ++; ?></td>
                                <td><?php echo $category['cat_name']; ?></td>
                                <td>
                                    <a href="edit_category.php?id=CAT-001" class="edit-icon">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="delete_category.php?id=CAT-001" class="delete-icon" onclick="return confirm('Are you sure you want to delete this category?');">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="custom-modal" id="addBrandModal">
            <div class="custom-modal-content">
                <span class="close-btn" onclick="closeModal('addBrandModal')">&times;</span>
                <h3>Add New Brand</h3>
                <form id="addBrandForm" action = "../actions/add_brand.php" method = "POST">
                    <div class="form-group">
                        <label for="brandName">Brand Name</label>
                        <input type="text" id="brandName" name="brand_name" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Brand</button>
                </form>
            </div>
        </div>

<!-- Custom Modal for Add Category -->
        <div class="custom-modal" id="addCategoryModal">
            <div class="custom-modal-content">
                <span class="close-btn" onclick="closeModal('addCategoryModal')">&times;</span>
                <h3>Add New Category</h3>
                <form id="addCategoryForm" action = "../actions/add_category.php" method = "POST">
                    <div class="form-group">
                        <label for="categoryName">Category Name</label>
                        <input type="text" id="categoryName" name="category_name" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Category</button>
                </form>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script> 

    // Function to open the modal
    function openModal(modalId) {
        document.getElementById(modalId).style.display = "block";
    }

    // Function to close the modal
    function closeModal(modalId) {
        document.getElementById(modalId).style.display = "none";
    }

    // Close modal when clicking anywhere outside the modal content
    window.onclick = function(event) {
        if (event.target.classList.contains('custom-modal')) {
            closeModal(event.target.id);
        }
    }

    
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