<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MenStyle - Premium Men's Clothing</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel = "stylesheet" href = 'assets/css/styles.css'>
    <link rel = "stylesheet" href = 'assets/css/landing.css'>


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
                    <div class="cart-empty">
                        <p>Your cart is empty</p>
                        <p style="font-size: 0.9rem; color: #000000;">Add some cute items to make it happy!</p>
                    </div>
                </div>
                
                <div class="cart-footer">
                    <div class="cart-subtotal">
                        <span>Subtotal</span>
                        <span>$0.00</span>
                    </div>
                    <div class="cart-buttons">
                        <button class="checkout-btn">Checkout</button>
                        <button class="view-cart-btn">View Cart</button>
                    </div>
                </div>
            </div>
    <header>
        <div class="header-top">
            <img src="assets/images/logocropped.png" alt="MenStyle Logo">
            <button class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="view/shop.php">Shop</a></li>
                    <li><a href="view/collections.php">Collections</a></li>
                    <li><a href="view/about.php">About</a></li>
                    <li><a href="view/contact.php">Contact</a></li>
                </ul>
            </nav>
            <div class="header-right">
                <form class="search-form">
                    <input type="search" placeholder="Search for products...">
                    <button type="submit">Search</button>
                </form>
                <div class = "icons-wrapper">
                    <a href="#" class="cart-icon"><img src = "assets/images/cart.png" alt ="cart"></a>
                    <a href="view/login.php" class="account-icon"><img src = "assets/images/account.png" alt ="account"></a>
                </div>     
            </div>
        </div>
    </header>

    <!-- Hero Section with Carousel -->
    <section class="hero">
        <div class="carousel">
            <div class="carousel-item">
                <img src="assets/images/clothes.jpg" alt="New Collection Banner">
                <div class="carousel-content">
                    <h1>Summer Collection 2024</h1>
                    <p>Discover the latest trends in men's fashion</p>
                    <br>
                    <a href="#" class="cta-button">Shop Now</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Value Proposition Section -->
    <section class="value-proposition">
        <h2>Why Choose MenzClub</h2>
        <div class="values-container">
            <div class="value-item">
                <div class="icon">
                    <!-- Replace with actual icon or image -->
                    <img src="assets/images/premiumquality.png" alt="Premium Quality">
                </div>
                <h3>Premium Quality</h3>
                <p>Handpicked materials and superior craftsmanship</p>
            </div>
            <div class="value-item">
                <div class="icon">
                    <!-- Replace with actual icon or image -->
                    <img src="assets/images/freeshipping.png" alt="Free Shipping">
                </div>
                <h3>Free Shipping</h3>
                <p>On orders above $100</p>
            </div>
            <div class="value-item">
                <div class="icon">
                    <!-- Replace with actual icon or image -->
                    <img src="assets/images/easyreturn.png" alt="Easy Returns">
                </div>
                <h3>Easy Returns</h3>
                <p>30-day hassle-free returns</p>
            </div>
        </div>
    </section>



    <!-- Product Categories Section -->
    <section class="categories">
        <h2>Shop by Category</h2>
        <div class="category-grid">
            <div class="category-card">
                <img src="assets/images/clothes.jpg" alt="Shirts">
                <h3>Shirts</h3>
            </div>
            <div class="category-card">
                <img src="assets/images/clothes1.jpg" alt="Pants">
                <h3>Pants</h3>
            </div>
            <div class="category-card">
                <img src="assets/images/suits.jpg" alt="Suits">
                <h3>Suits</h3>
            </div>
            <div class="category-card">
                <img src="assets/images/clothes.jpg" alt="Accessories">
                <h3>Accessories</h3>
            </div>
        </div>
    </section>

    <!-- New Arrivals Section -->
    <section class="new-arrivals">
        <h2>New Arrivals</h2>
        <div class="products-grid">
            <div class="product-card">
                <img src="assets/images/clothes.jpg" alt="Product 1">
                <h3>Casual Linen Shirt</h3>
                <p class="price">$59.99</p>
                <button>Add to Cart</button>
            </div>
            <div class="product-card">
                <img src="assets/images/clothes.jpg" alt="Product 2">
                <h3>Classic Chinos</h3>
                <p class="price">$79.99</p>
                <button>Add to Cart</button>
            </div>
            <div class="product-card">
                <img src="assets/images/clothes2.jpg" alt="Product 3">
                <h3>Leather Belt</h3>
                <p class="price">$39.99</p>
                <button>Add to Cart</button>
            </div>
        </div>
    </section>

    <!-- Promotions Section -->
    <section class="promotions">
        <h2>Special Offers</h2>
        <div class="promotions-grid">
            <div class="promo-card">
                <h3>Summer Sale</h3>
                <p>Up to 50% off on selected items</p>
                <a href="#" class="promo-button">Shop Sale</a>
            </div>
            <div class="promo-card">
                <h3>Bundle Offer</h3>
                <p>Buy 2 shirts, get 1 free</p>
                <a href="#" class="promo-button">Learn More</a>
            </div>
        </div>
    </section>

    <!-- Customer Testimonials Section -->
    <section class="testimonials">
        <h2>What Our Customers Say</h2>
        <div class="testimonials-grid">
            <div class="testimonial-card">
                <img src="assets/images/clothes.jpg" alt="Customer 1">
                <p>"Excellent quality and perfect fit. Will definitely shop again!"</p>
                <h4>John Smith</h4>
                <div class="rating">★★★★★</div>
            </div>
            <div class="testimonial-card">
                <img src="assets/images/clothes.jpg" alt="Customer 2">
                <p>"Great selection of assets/images/clothes and amazing customer service."</p>
                <h4>Michael Brown</h4>
                <div class="rating">★★★★★</div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter">
        <h2>Stay Updated</h2>
        <p>Subscribe to our newsletter for exclusive offers and updates</p>
        <form class="newsletter-form">
            <input type="email" placeholder="Enter your email address">
            <button type="submit">Subscribe</button>
        </form>
    </section>

    <!-- Footer Section -->
    <footer>
        <div class="footer-content">
            <div class="footer-column">
                <img src="assets/images/logocropped.png" width = 300rem; alt="Menzstyle Logo">
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
    <script src="assets/js/tawk-chat.js"></script>
<script>
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