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
            color: white;
            font-size: 0.7rem;
            border-radius: 50%;
            padding: 0.2rem 0.5rem;
        }


        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr); /* Test by forcing 3 columns */
            gap: 4rem;
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
            margin: 0 auto 1rem; /* Center the image and add space below */
        }



        .recent-orders {
    background: var(--secondary);
    border-radius: 12px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 20px;
    width: 80%; /* Adjusted for better centering */
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
        padding: 0.8rem;
    }

    h2 {
        font-size: 1.2rem;
    }

    .recent-orders {
        width: 95%; /* Increase width for smaller screens */
    }
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
            <div class="nav-item active">
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


        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-info">
                    <h3>₵24,789</h3>
                    <p>Today's Sales</p>
                    <small class="trend-up">↑ 12% vs yesterday</small>
                </div>
                <i class="fas fa-dollar-sign stat-icon"></i>
            </div>
            
            <div class="stat-card">
                <div class="stat-info">
                    <h3>154</h3>
                    <p>New Orders</p>
                    <small class="trend-up">↑ 8% vs yesterday</small>
                </div>
                <i class="fas fa-shopping-cart stat-icon"></i>
            </div>
            
            <div class="stat-card">
                <div class="stat-info">
                    <h3>892</h3>
                    <p>Total Customers</p>
                    <small class="trend-up">↑ 24% this month</small>
                </div>
                <i class="fas fa-users stat-icon"></i>
            </div>
            
            <div class="stat-card">
                <div class="stat-info">
                    <h3>89%</h3>
                    <p>Satisfaction Rate</p>
                    <small class="trend-down">↓ 3% this week</small>
                </div>
                <i class="fas fa-heart stat-icon"></i>
            </div>
        </div>



    <div class="recent-orders">
        <h2>Recent Orders</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ORD-1234</td>
                    <td>John Doe</td>
                    <td>Premium Leather Jacket</td>
                    <td>₵300</td>
                    <td><span class="status pending">Pending</span></td>
                </tr>
                <tr>
                    <td>ORD-5678</td>
                    <td>Mike Smith</td>
                    <td>Designer Watch</td>
                    <td>₵800</td>
                    <td><span class="status completed">Completed</span></td>
                </tr>
                <tr>
                    <td>ORD-9101</td>
                    <td>Alex Johnson</td>
                    <td>Classic Suit</td>
                    <td>₵550</td>
                    <td><span class="status cancelled">Cancelled</span></td>
                </tr>
                <tr>
                    <td>ORD-1122</td>
                    <td>Chris Wilson</td>
                    <td>Sports Sneakers</td>
                    <td>₵200</td>
                    <td><span class="status completed">Completed</span></td>
                </tr>
                <tr>
                    <td>ORD-3344</td>
                    <td>Robert Brown</td>
                    <td>Denim Collection</td>
                    <td>₵120</td>
                    <td><span class="status pending">Pending</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</main>


    <script>        

        // Navigation interaction
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