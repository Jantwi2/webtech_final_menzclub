<?php
include('../functions/product_functions.php');
include '../functions/cart_functions.php';
session_start();
$user_id = $_SESSION['user_id'];
$cartItems = getCartItems($conn, $user_id);
$categories = viewAllCategories($conn);
$brands = viewAllBrands($conn);
$subtotal = 0;
$selectedCategories = isset($_GET['categories']) ? $_GET['categories'] : [];
if (!empty($selectedCategories)) {
    $products = viewProductsByCategories($conn, $selectedCategories);
} else {
    $products = viewAllProducts($conn); // Default: show all products
}

$subtotal = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - Gentlemen's Wardrobe</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel = "stylesheet" href = '../assets/css/styles.css'>
    <link rel = "stylesheet" href = '../assets/css/shop.css'>
</head>
<body>
        <!-- Header Section -->
            <!-- Cart Overlay -->
        <div class="cart-overlay"></div>

            <div class="cart-drawer">
                <div class="cart-header">
                    <h2>🛍️ Shopping Cart</h2>
                    <button class="cart-close">×</button>
                </div>
                
                <div class="cart-items">
                    <?php if (count($cartItems) > 0): ?>
                        <?php foreach ($cartItems as $cartItem): ?>
                            <div class="cart-item">
                                <img src="<?= htmlspecialchars($cartItem['product_image']) ?>" alt="<?= htmlspecialchars($cartItem['product_title']) ?>" class="cart-item-image">
                                <div class="cart-item-details">
                                    <div class="cart-item-title"><?= htmlspecialchars($cartItem['product_title']) ?></div>
                                    <div class="cart-item-price">GH₵ <?= number_format($cartItem['product_price'], 2) ?></div>
                                    <div class="cart-item-quantity">
                                        <button class="quantity-btn">-</button>
                                        <span><?= htmlspecialchars($cartItem['qty']) ?></span>
                                        <button class="quantity-btn">+</button>
                                    </div>
                                </div>
                            </div>
                            <?php  $subtotal += $cartItem['total']; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="cart-empty">
                            <p>Your cart is empty</p>
                            <p style="font-size: 0.9rem; color: #000000;">Add some cute items to make it happy!</p>
                        </div>
                    <?php endif; ?>
                </div>

                
                <div class="cart-footer">
                    <div class="cart-subtotal">
                        <span>Subtotal</span>
                        <span>GH₵<?php echo $subtotal; ?></span>
                    </div>
                    <div class="cart-buttons">
                        <button class="checkout-btn">Checkout</button>
                        <button class="view-cart-btn">View Cart</button>
                    </div>
                </div>
            </div>
    <header>
        <div class="header-top">
            <img src="../assets/images/logocropped.png" alt="MenStyle Logo">
            <button class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <nav>
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="shop.php">Shop</a></li>
                    <li><a href="collections.php">Collections</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
            <div class="header-right">
                <form class="search-form">
                    <input type="search" placeholder="Search for products...">
                    <button type="submit">Search</button>
                </form>
                <div class = "icons-wrapper">
                    <a href="#" class="cart-icon"><img src = "../assets/images/cart.png" alt ="cart"></a>
                    <a href="login.php" class="account-icon"><img src = "../assets/images/account.png" alt ="account"></a>
                </div>     
            </div>
        </div>
    </header>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="search-box">
                <input type="text" placeholder="Search products..." oninput="searchProducts()">
                <i class="fas fa-search"></i>
            </div>

            <!-- <form action="shop.php" method="GET"> -->
                <div class="filter-section">
                    <h3 class="filter-title">Categories</h3>
                    <div class="filter-options">
                    <?php foreach ($categories as $category): ?>
                        <label class="filter-option">
                        <input type="checkbox" name="categories[]" value="<?php echo $category['cat_name']; ?>"
                        <?php echo in_array($category['cat_name'], $selectedCategories) ? 'checked' : ''; ?>>
                        <?php echo htmlspecialchars($category['cat_name']); ?>
                        </label>
                    <?php endforeach; ?>
                    </div>
                </div>

                <!-- <button type="submit" class="apply-filters-btn">Apply Filters</button> -->
            <!-- </form> -->

            <div class="filter-section">
                <h3 class="filter-title">Brands</h3>
                <div class="filter-options">
                    <?php foreach ($brands as $brand): ?>
                        <label class="filter-option">
                        <input type="checkbox" name="brands[]" value="<?php echo $brand['brand_id']; ?>">
                        <?php echo htmlspecialchars($brand['brand_name']); ?>
                        </label>
                    <?php endforeach; ?>
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
                <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <!-- Product details wrapped in an anchor for navigation -->
                    <a href="productdetails.php?productId=<?php echo htmlspecialchars($product['product_id']); ?>" class="product-link">
                        <div class="product-image">
                            <img src="<?php echo htmlspecialchars($product['product_image']); ?>" alt="<?php echo htmlspecialchars($product['product_title']); ?>">
                        </div>
                        <div class="product-info">
                            <div class="product-brand"><?php echo htmlspecialchars($brand['brand_name']); ?></div>
                            <div class="product-name"><?php echo htmlspecialchars($product['product_title']); ?></div>
                            <div class="product-price">GH₵<?php echo htmlspecialchars($product['product_price']); ?></div>
                        </div>
                    </a>

                    <!-- Action buttons (Add to cart, Wishlist) placed outside the anchor tag -->
                    <div class="product-actions">
                        <div>  
                            <form action="../actions/add_to_cart.php" method="POST" class="product-actions">
                                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['product_id']); ?>">
                                <button type = "submit" class = "action-btn">
                                    <i class="fas fa-shopping-cart"></i> <!-- Add to cart -->
                                </button>
                            </form>                
                        </div>

                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <footer>
        <div class="footer-content">
            <div class="footer-column">
                <img src="../assets/images/logocropped.png" width = 300rem; alt="Menzstyle Logo">
                <h3>About Us</h3>
                <p>Premium men's clothing for the modern gentleman.</p>
            </div>
            <div class="footer-column">
                <h3>Customer Service</h3>
                <ul>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Shipping Info</a></li>
                    <li><a href="#">Returns</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#">Size Guide</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Connect With Us</h3>
                <div class="social-links">
                    <a href="#">Facebook</a>
                    <a href="#">Instagram</a>
                    <a href="#">Twitter</a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Menzclub. All rights reserved.</p>
        </div>
    </footer>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../assets/js/tawk-chat.js"></script>
<script>
    // Function to filter products based on the search input
function searchProducts() {
    // Get the search input value and convert to lowercase for case-insensitive search
    const searchQuery = document.getElementById('search-input').value.toLowerCase();

    // Get all the product cards
    const productCards = document.querySelectorAll('.product-card');

    // Loop through each product card and check if it matches the search query
    productCards.forEach((card) => {
        // Get the product name (title) from the card
        const productName = card.querySelector('.product-name').textContent.toLowerCase();

        // If the product name includes the search query, show the card, otherwise hide it
        if (productName.includes(searchQuery)) {
            card.style.display = 'block'; // Show the product card
        } else {
            card.style.display = 'none'; // Hide the product card
        }
    });
}


document.querySelector('.view-cart-btn').addEventListener('click', () => {
    // Redirect to the cart page
    window.location.href = 'cart.php';  // Replace with the actual path to your cart page
});

document.querySelector('.checkout-btn').addEventListener('click', () => {
    // Redirect to the checkout page
    window.location.href = 'checkout.php';  // Replace with the actual path to your checkout page
});


document.querySelectorAll('.action-btn .fa-shopping-cart').forEach(button => {
    button.addEventListener('click', (e) => {
        alert('Product added to cart!');
        // Add logic to actually add the product to the cart
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const hamburger = document.querySelector('.hamburger');
    const nav = document.querySelector('nav ul');
    
    hamburger.addEventListener('click', () => {
        nav.classList.toggle('active');
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const cartIcon = document.querySelector('.cart-icon');
    const cartDrawer = document.querySelector('.cart-drawer');
    const cartOverlay = document.querySelector('.cart-overlay');
    const cartClose = document.querySelector('.cart-close');
    
    // Function to open cart
    const openCart = () => {
        cartDrawer.classList.add('active');
        cartOverlay.classList.add('active');
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    };
    
    // Function to close cart
    const closeCart = () => {
        cartDrawer.classList.remove('active');
        cartOverlay.classList.remove('active');
        document.body.style.overflow = '';
    };
    
    // Event listeners
    cartIcon.addEventListener('click', (e) => {
        e.preventDefault();
        openCart();
    });
    
    cartClose.addEventListener('click', closeCart);
    cartOverlay.addEventListener('click', closeCart);
    
    // Close cart on escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeCart();
        }
    });
    
    // Prevent closing when clicking inside the cart
    cartDrawer.addEventListener('click', (e) => {
        e.stopPropagation();
    });
});

</script>
</body>
</html>