<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - Gentlemen's Wardrobe</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background: #f5f5f5;
        }

        .container {
            display: flex;
            padding: 2rem;
            gap: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 280px;
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            height: fit-content;
            position: sticky;
            top: 2rem;
        }

        .search-box {
            position: relative;
            margin-bottom: 2rem;
        }

        .search-box input {
            width: 100%;
            padding: 0.8rem;
            padding-left: 2.5rem;
            border: 2px solid #B6B6B6;
            border-radius: 8px;
            font-size: 0.9rem;
        }

        .search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #B6B6B6;
        }

        .filter-section {
            margin-bottom: 2rem;
        }

        .filter-title {
            font-size: 1.1rem;
            color: #000000;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .filter-options {
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
        }

        .filter-option {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #666;
            cursor: pointer;
        }

        .filter-option input[type="checkbox"] {
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .filter-option:hover {
            color: #0056b3;
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .result-count {
            color: #666;
        }

        .sort-dropdown {
            padding: 0.5rem;
            border: 2px solid #B6B6B6;
            border-radius: 6px;
            background: white;
            color: #666;
            cursor: pointer;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 2rem;
        }

        .product-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-image {
            position: relative;
            padding-top: 125%;
            background: #f8f8f8;
            overflow: hidden;
        }

        .product-image img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-actions {
            position: absolute;
            top: 1rem;
            right: 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            opacity: 0;
            transform: translateX(10px);
            transition: all 0.3s ease;
        }

        .product-card:hover .product-actions {
            opacity: 1;
            transform: translateX(0);
        }

        .action-btn {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .action-btn:hover {
            background: #0056b3;
            color: white;
        }

        .product-info {
            padding: 1rem;
        }

        .product-brand {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 0.3rem;
        }

        .product-name {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #000000;
        }

        .product-price {
            font-weight: 600;
            color: #0056b3;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                padding: 1rem;
            }

            .sidebar {
                width: 100%;
                position: static;
            }

            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="search-box">
                <input type="text" placeholder="Search products...">
                <i class="fas fa-search"></i>
            </div>

            <div class="filter-section">
                <h3 class="filter-title">Categories</h3>
                <div class="filter-options">
                    <label class="filter-option">
                        <input type="checkbox"> Suits
                    </label>
                    <label class="filter-option">
                        <input type="checkbox"> Shirts
                    </label>
                    <label class="filter-option">
                        <input type="checkbox"> Trousers
                    </label>
                    <label class="filter-option">
                        <input type="checkbox"> Accessories
                    </label>
                    <label class="filter-option">
                        <input type="checkbox"> Shoes
                    </label>
                </div>
            </div>

            <div class="filter-section">
                <h3 class="filter-title">Brands</h3>
                <div class="filter-options">
                    <label class="filter-option">
                        <input type="checkbox"> Hugo Boss
                    </label>
                    <label class="filter-option">
                        <input type="checkbox"> Ralph Lauren
                    </label>
                    <label class="filter-option">
                        <input type="checkbox"> Tom Ford
                    </label>
                    <label class="filter-option">
                        <input type="checkbox"> Armani
                    </label>
                    <label class="filter-option">
                        <input type="checkbox"> Brooks Brothers
                    </label>
                </div>
            </div>

            <div class="filter-section">
                <h3 class="filter-title">Price Range</h3>
                <div class="filter-options">
                    <label class="filter-option">
                        <input type="checkbox"> Under $100
                    </label>
                    <label class="filter-option">
                        <input type="checkbox"> $100 - $300
                    </label>
                    <label class="filter-option">
                        <input type="checkbox"> $300 - $500
                    </label>
                    <label class="filter-option">
                        <input type="checkbox"> Over $500
                    </label>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <div class="result-count">
                    Showing 12 results
                </div>
                <select class="sort-dropdown">
                    <option>Sort by: Featured</option>
                    <option>Price: Low to High</option>
                    <option>Price: High to Low</option>
                    <option>Newest First</option>
                </select>
            </div>

            <div class="products-grid">
                <!-- Product Card 1 -->
                <div class="product-card">
                    <div class="product-image">
                        <img src="../assets/images/clothes.jpg" alt="Product">
                        <div class="product-actions">
                            <div class="action-btn">
                                <i class="far fa-heart"></i>
                            </div>
                            <div class="action-btn">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="product-brand">Hugo Boss</div>
                        <div class="product-name">Classic Fit Suit</div>
                        <div class="product-price">$599.99</div>
                    </div>
                </div>

                <!-- Product Card 2 -->
                <div class="product-card">
                    <div class="product-image">
                        <img src="../assets/images/clothes.jpg" alt="Product">
                        <div class="product-actions">
                            <div class="action-btn">
                                <i class="far fa-heart"></i>
                            </div>
                            <div class="action-btn">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="product-brand">Ralph Lauren</div>
                        <div class="product-name">Oxford Dress Shirt</div>
                        <div class="product-price">$89.99</div>
                    </div>
                </div>

                <div class="product-card">
                    <div class="product-image">
                        <img src="../assets/images/clothes.jpg" alt="Product">
                        <div class="product-actions">
                            <div class="action-btn">
                                <i class="far fa-heart"></i>
                            </div>
                            <div class="action-btn">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="product-brand">Ralph Lauren</div>
                        <div class="product-name">Oxford Dress Shirt</div>
                        <div class="product-price">$89.99</div>
                    </div>
                </div><div class="product-card">
                    <div class="product-image">
                        <img src="../assets/images/clothes.jpg" alt="Product">
                        <div class="product-actions">
                            <div class="action-btn">
                                <i class="far fa-heart"></i>
                            </div>
                            <div class="action-btn">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="product-brand">Ralph Lauren</div>
                        <div class="product-name">Oxford Dress Shirt</div>
                        <div class="product-price">$89.99</div>
                    </div>
                </div><div class="product-card">
                    <div class="product-image">
                        <img src="../assets/images/clothes1.jpg" alt="Product">
                        <div class="product-actions">
                            <div class="action-btn">
                                <i class="far fa-heart"></i>
                            </div>
                            <div class="action-btn">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="product-brand">Ralph Lauren</div>
                        <div class="product-name">Oxford Dress Shirt</div>
                        <div class="product-price">$89.99</div>
                    </div>
                </div>  

                <!-- Additional product cards would follow the same pattern -->
                
            </div>
        </div>
    </div>
</body>
</html>