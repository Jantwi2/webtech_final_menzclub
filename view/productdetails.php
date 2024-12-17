<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classic Fit Suit - Gentlemen's Wardrobe</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel = "stylesheet" href = '../assets/css/styles.css'>
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
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Breadcrumb */
        .breadcrumb {
            margin-bottom: 2rem;
            color: #666;
        }

        .breadcrumb a {
            color: #0056b3;
            text-decoration: none;
        }

        .breadcrumb span {
            margin: 0 0.5rem;
        }

        /* Product Section */
        .product-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
        }

        /* Image Gallery */
        .product-gallery {
            position: relative;
        }

        .main-image {
            width: 100%;
            height: 500px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .thumbnail-container {
            display: flex;
            gap: 1rem;
        }

        .thumbnail {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
            cursor: pointer;
            opacity: 0.6;
            transition: opacity 0.3s;
        }

        .thumbnail:hover,
        .thumbnail.active {
            opacity: 1;
        }

        /* Product Info */
        .product-info h1 {
            font-size: 2rem;
            color: #000000;
            margin-bottom: 0.5rem;
        }

        .brand {
            color: #666;
            font-size: 1.1rem;
            margin-bottom: 1rem;
        }

        .price {
            font-size: 1.5rem;
            color: #0056b3;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }

        .product-colors {
            margin-bottom: 2rem;
        }

        .color-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .color-options {
            display: flex;
            gap: 1rem;
        }

        .color-option {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.3s;
        }

        .color-option:hover,
        .color-option.active {
            transform: scale(1.1);
            border-color: #0056b3;
        }

        .size-section {
            margin-bottom: 2rem;
        }

        .size-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .size-guide {
            color: #0056b3;
            text-decoration: none;
            font-size: 0.9rem;
            margin-left: 1rem;
        }

        .size-options {
            display: flex;
            gap: 1rem;
            margin-top: 0.5rem;
        }

        .size-option {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #B6B6B6;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .size-option:hover,
        .size-option.active {
            border-color: #0056b3;
            color: #0056b3;
        }

        .quantity-section {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .quantity-label {
            font-weight: 600;
        }

        .quantity-input {
            display: flex;
            align-items: center;
            border: 2px solid #B6B6B6;
            border-radius: 8px;
            overflow: hidden;
        }

        .quantity-btn {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1.2rem;
            color: #666;
        }

        .quantity-btn:hover {
            background: #f5f5f5;
        }

        .quantity-input input {
            width: 60px;
            height: 40px;
            text-align: center;
            border: none;
            border-left: 2px solid #B6B6B6;
            border-right: 2px solid #B6B6B6;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .add-to-cart {
            flex: 1;
            padding: 1rem;
            background: #0056b3;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .add-to-cart:hover {
            background: #003d80;
        }

        .wishlist-btn {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #B6B6B6;
            border-radius: 8px;
            background: none;
            cursor: pointer;
            transition: all 0.3s;
        }

        .wishlist-btn:hover {
            border-color: #0056b3;
            color: #0056b3;
        }

        .product-description {
            margin-bottom: 2rem;
            line-height: 1.6;
            color: #666;
        }

        .product-features {
            margin-bottom: 2rem;
        }

        .features-list {
            list-style: none;
        }

        .features-list li {
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .features-list li i {
            color: #0056b3;
        }

        .delivery-info {
            padding: 1rem;
            background: #f8f8f8;
            border-radius: 8px;
        }

        .delivery-info h3 {
            margin-bottom: 0.5rem;
        }

        .delivery-info p {
            color: #666;
            margin-bottom: 0.5rem;
        }

        /* Tabs Section */
        .tabs {
            margin-top: 3rem;
        }

        .tab-buttons {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .tab-btn {
            padding: 1rem 2rem;
            background: none;
            border: none;
            border-bottom: 2px solid transparent;
            cursor: pointer;
            font-weight: 600;
            color: #666;
            transition: all 0.3s;
        }

        .tab-btn.active {
            color: #0056b3;
            border-bottom-color: #0056b3;
        }

        .tab-content {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .product-section {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .main-image {
                height: 300px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .wishlist-btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
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
            <div class="cart-item">
                <img src="../assets/images/clothes.jpg" alt="Product" class="cart-item-image">
                <div class="cart-item-details">
                    <div class="cart-item-title">Product Name</div>
                    <div class="cart-item-price">$99.99</div>
                    <div class="cart-item-quantity">
                        <button class="quantity-btn">-</button>
                        <span>1</span>
                        <button class="quantity-btn">+</button>
                    </div>
                </div>
            </div>
            <div class="cart-item">
                <img src="../assets/images/clothes.jpg" alt="Product" class="cart-item-image">
                <div class="cart-item-details">
                    <div class="cart-item-title">Product Name</div>
                    <div class="cart-item-price">$99.99</div>
                    <div class="cart-item-quantity">
                        <button class="quantity-btn">-</button>
                        <span>1</span>
                        <button class="quantity-btn">+</button>
                    </div>
                </div>
            </div>    
            <div class="cart-item">
                <img src="../assets/images/clothes.jpg" alt="Product" class="cart-item-image">
                <div class="cart-item-details">
                    <div class="cart-item-title">Product Name</div>
                    <div class="cart-item-price">$99.99</div>
                    <div class="cart-item-quantity">
                        <button class="quantity-btn">-</button>
                        <span>1</span>
                        <button class="quantity-btn">+</button>
                    </div>
                </div>
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
        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="#">Home</a>
            <span>/</span>
            <a href="#">Suits</a>
            <span>/</span>
            Classic Fit Suit
        </div>

        <!-- Product Section -->
        <div class="product-section">
            <!-- Product Gallery -->
            <div class="product-gallery">
                <img src="../assets/images/clothes2.jpg" alt="Classic Fit Suit" class="main-image">
                <div class="thumbnail-container">
                    <img src="../assets/images/clothes.jpg" alt="Thumbnail 1" class="thumbnail active">
                    <img src="../assets/images/clothes.jpg" alt="Thumbnail 2" class="thumbnail">
                    <img src="../assets/images/clothes.jpg" alt="Thumbnail 3" class="thumbnail">
                    <img src="../assets/images/clothes.jpg" alt="Thumbnail 4" class="thumbnail">
                </div>
            </div>

            <!-- Product Info -->
            <div class="product-info">
                <h1>Classic Fit Suit</h1>
                <div class="brand">Hugo Boss</div>
                <div class="price">$599.99</div>

                <div class="product-colors">
                    <div class="color-title">Color</div>
                    <div class="color-options">
                        <div class="color-option active" style="background: #000000;"></div>
                        <div class="color-option" style="background: #1a365d;"></div>
                        <div class="color-option" style="background: #4a5568;"></div>
                    </div>
                </div>

                <div class="size-section">
                    <div class="size-title">
                        Size
                        <a href="#" class="size-guide">Size Guide</a>
                    </div>
                    <div class="size-options">
                        <div class="size-option">38</div>
                        <div class="size-option active">40</div>
                        <div class="size-option">42</div>
                        <div class="size-option">44</div>
                        <div class="size-option">46</div>
                    </div>
                </div>

                <div class="quantity-section">
                    <div class="quantity-label">Quantity</div>
                    <div class="quantity-input">
                        <button class="quantity-btn">-</button>
                        <input type="number" value="1" min="1">
                        <button class="quantity-btn">+</button>
                    </div>
                </div>

                <div class="action-buttons">
                    <button class="add-to-cart">Add to Cart</button>
                    <button class="wishlist-btn">
                        <i class="far fa-heart"></i>
                    </button>
                </div>

                <div class="product-description">
                    Elevate your professional wardrobe with this timeless classic fit suit. Crafted from premium wool blend fabric, this suit offers both comfort and sophistication for any formal occasion.
                </div>

                <div class="product-features">
                    <ul class="features-list">
                        <li><i class="fas fa-check"></i> Premium wool blend fabric</li>
                        <li><i class="fas fa-check"></i> Classic fit design</li>
                        <li><i class="fas fa-check"></i> Fully lined jacket</li>
                        <li><i class="fas fa-check"></i> Two-button closure</li>
                    </ul>
                </div>

                <div class="delivery-info">
                    <h3>Delivery & Returns</h3>
                    <p>Free standard delivery on orders over $200</p>
                    <p>Free returns within 30 days</p>
                </div>
            </div>
        </div>

        <!-- Tabs Section -->
        <div class="tabs">
            <div class="tab-buttons">
                <button class="tab-btn active">Description</button>
                <button class="tab-btn">Specifications</button>
                <button class="tab-btn">Reviews</button>
            </div>
            <div class="tab-content">
                <div class="description-content">
                    <h3>Product Details</h3>
                    <p>This classic fit suit from Hugo Boss exemplifies timeless elegance and superior craftsmanship. Perfect for business meetings, formal events, or special occasions, this suit combines traditional tailoring with modern comfort.</p>
                    
                    <h3 style="margin-top: 1rem;">Care Instructions</h3>
                    <ul style="margin-left: 1.5rem;">
                        <li>Dry clean only</li>
                        <li>Do not bleach</li>
                        <li>Iron at medium temperature</li>
                        <li>Store on wooden hanger</li>
                    </ul>
                </div>
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
document.querySelector('.view-cart-btn').addEventListener('click', () => {
    // Redirect to the cart page
    window.location.href = 'cart.php';  // Replace with the actual path to your cart page
});

document.querySelector('.checkout-btn').addEventListener('click', () => {
    // Redirect to the checkout page
    window.location.href = 'checkout.php';  // Replace with the actual path to your checkout page
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