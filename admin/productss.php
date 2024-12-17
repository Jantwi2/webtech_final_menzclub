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

        .main-content {
            padding: 2rem;
            margin-left: 250px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            width: 100%;
        }

        .search-container {
            flex-grow: 0; /* Prevents the search bar from taking up too much space */
            margin-right: auto; /* Pushes the header items to the right */
        }

        .search-bar {
            background: var(--secondary);
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
            position: absolute;
            top: 0;
            right: 0;
            background-color: red;
            color: var(--accent);
            font-size: 0.7rem;
            border-radius: 50%;
            padding: 0.2rem 0.5rem;
        }

        .summary-image {
            width: 200px; /* Make the logo image a bit smaller */
            display: block;
            margin: 0 auto 1rem; /* Center the image and add space below */
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



        .product-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }

        .product-container h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .btn.add-product-btn {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border-radius: 4px;
            border: none;
            font-size: 16px;
            cursor: pointer;
        }

        .btn.add-product-btn:hover {
            background-color: #0056b3;
        }

        .product-list table {
            width: 100%;
            border-collapse: collapse;
        }

        .product-list th, .product-list td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .product-list th {
            background-color: #f1f1f1;
        }

        .btn-edit, .btn-delete {
            padding: 6px 12px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-edit {
            background-color: #28a745;
            color: white;
        }

        .btn-edit:hover {
            background-color: #218838;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
        }

        .btn-delete:hover {
            background-color: #c82333;
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

    <div class="product-container">
        <h2>Products</h2>

        <!-- Button to Open Add Product Modal -->
        <button class="btn add-product-btn" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</button>

        <!-- Product List -->
        <div class="product-list">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="productTableBody">
                    <!-- Product Rows will go here -->
                    <tr>
                        <td>1</td>
                        <td>Leather Jacket</td>
                        <td>₵300</td>
                        <td>Clothing</td>
                        <td>
                            <button class="btn btn-edit" data-bs-toggle="modal" data-bs-target="#editProductModal" onclick="editProduct(1)">Edit</button>
                            <button class="btn btn-delete" onclick="deleteProduct(1)">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Smartwatch</td>
                        <td>₵400</td>
                        <td>Accessories</td>
                        <td>
                            <button class="btn btn-edit" data-bs-toggle="modal" data-bs-target="#editProductModal" onclick="editProduct(2)">Edit</button>
                            <button class="btn btn-delete" onclick="deleteProduct(2)">Delete</button>
                        </td>
                    </tr>
                    <!-- Add more product rows here -->
                </tbody>
            </table>
        </div>
    </div>


</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


    <script>        
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