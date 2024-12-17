<?php
session_start();
include '../functions/cart_functions.php';
$user_id = $_SESSION['user_id'];
$cartItems = getCartItems($conn, $user_id);
$subtotal = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - MenStyle</title>
    <link rel = "stylesheet" href = '../assets/css/styles.css'>
    <style>
        /* Base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Cart styles */
        .cart-container {
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 2rem;
        }

        .cart-title {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #eee;
        }

        /* Cart items section */
        .cart-items {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            padding: 1.5rem;
        }

        .cart-item {
            display: grid;
            grid-template-columns: auto 3fr 1fr 1fr 1fr auto;
            align-items: center;
            gap: 1.5rem;
            padding: 1.5rem 0;
            border-bottom: 1px solid #eee;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 4px;
        }

        .item-details h3 {
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }

        .item-details p {
            color: #666;
            font-size: 0.9rem;
        }

        /* Quantity controls */
        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .quantity-btn {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
        }

        .quantity-btn:hover {
            background: #e9ecef;
        }

        .quantity {
            width: 40px;
            text-align: center;
            font-weight: 500;
        }

        .price {
            font-weight: 500;
        }

        .subtotal {
            font-weight: 600;
            color: #000;
        }

        .remove-btn {
            background: none;
            border: none;
            color: #dc3545;
            cursor: pointer;
            padding: 0.5rem;
            transition: color 0.2s;
        }

        .remove-btn:hover {
            color: #c82333;
        }

        /* Cart summary section */
        .cart-summary {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            padding: 1.5rem;
            height: fit-content;
        }

        .summary-title {
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #eee;
        }

        .summary-image {
            width: 150px; /* Make the logo image a bit smaller */
            display: block;
            margin: 0 auto 1rem; /* Center the image and add space below */
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            margin: 1.5rem 0;
            padding-top: 1rem;
            border-top: 2px solid #eee;
            font-weight: 600;
            font-size: 1.2rem;
        }

        .checkout-btn {
            background: #000;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 1rem;
            width: 100%;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s;
        }

        .checkout-btn:hover {
            background: #333;
        }

        .continue-shopping {
            display: inline-block;
            margin-top: 1rem;
            color: #666;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .continue-shopping:hover {
            color: #000;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .cart-container {
                grid-template-columns: 1fr;
            }

            .cart-item {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .item-image {
                width: 100%;
                height: 200px;
            }

            .quantity-controls {
                justify-content: center;
            }

            .price, .subtotal {
                text-align: center;
            }

            .remove-btn {
                width: 100%;
                padding: 1rem;
                background: #fff8f8;
                border-radius: 4px;
            }
        }
    </style>
</head>
<body>
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
                    <a href="login.php" class="account-icon"><img src = "../assets/images/account.png" alt ="account"></a>
                </div>     
            </div>
        </div>
    </header>


    <div class="container">
        <h1 class="cart-title">Shopping Cart</h1>
        
        <div class="cart-container">
            <div class="cart-items">
                <!-- Sample cart item -->
                 
                 <?php foreach ($cartItems as $cartItem): ?>
                    <div class="cart-item" data-cart-item-id="<?php echo $cartItem['p_id']; ?>">
                        <img src="<?php echo htmlspecialchars($cartItem['product_image']); ?>" alt="<?php echo htmlspecialchars($cartItem['product_title']); ?>" class="item-image">
                        <div class="item-details">
                            <h3><?php echo htmlspecialchars($cartItem['product_title']); ?></h3>
                            <p>Size: L | Color: White</p>
                        </div>
                        <div class="quantity-controls">
                            <button class="quantity-btn">-</button>
                            <span class="quantity"><?php echo htmlspecialchars($cartItem['qty']); ?></span>
                            <button class="quantity-btn">+</button>
                        </div>
                        <span class="price">GH₵<?php echo htmlspecialchars($cartItem['product_price']); ?></span>
                        <span class="subtotal">GH₵<?php echo htmlspecialchars($cartItem['total']); ?></span>
                        <button class="remove-btn" onclick="removeItem(<?= $cartItem['p_id'] ?>)">×</button>
                    </div>
                    <?php 
                    $subtotal += $cartItem['total'];
                    ?>
                <?php endforeach; ?>
            </div>

            <div class = "cart-summary">
                <img src="../assets/images/logowhitebg.png" alt="Product" class="summary-image">
                <h2 class="summary-title">Order Summary</h2>
                <div class="summary-item">
                    <span>Subtotal</span>
                    <span>GH₵ <?php echo number_format($subtotal, 2); ?></span>
                </div>
                <div class="summary-item">
                    <span>Delivery</span>
                    <span>Free</span>
                </div>
                <div class="summary-total">
                    <span>Total</span>
                    <span>GHc<?php echo number_format($subtotal); ?></span>
                </div>
                <form action="../actions/add_order.php" method="POST" id="checkoutForm">
                    <button class="checkout-btn">Proceed to Checkout</button>
                </form>
                <a href="shop.php" class="continue-shopping">← Continue Shopping</a>
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
function removeItem(cartItemId) {
    if (confirm("Are you sure you want to remove this item from your cart?")) {
        // Send AJAX request to delete the item from the cart
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../actions/delete_from_cart.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = xhr.responseText;
                if (response == "success") {
                    // Remove the cart item from the DOM
                    window.location.reload();
                } else {
                    alert("Failed to remove item. Please try again.");
                }
            }
        };
        xhr.send("product_id=" + cartItemId);
    }
}
</script>
<script>

    document.addEventListener('DOMContentLoaded', () => {
        const hamburger = document.querySelector('.hamburger');
        const nav = document.querySelector('nav ul');
        
        hamburger.addEventListener('click', () => {
            nav.classList.toggle('active');
        });
    });

</script>

<script>
document.querySelectorAll('.quantity-btn').forEach(button => {
    button.addEventListener('click', () => {
        const quantitySpan = button.parentElement.querySelector('.quantity');
        let quantity = parseInt(quantitySpan.textContent);
        const cartItemId = button.closest('.cart-item').getAttribute('data-cart-item-id'); // This gets the correct cart item ID
        
        // Update the quantity based on button clicked
        if (button.textContent === '+') {
            quantity++;
        } else if (quantity > 1) {
            quantity--;
        }

        // Update the quantity text in the DOM
        quantitySpan.textContent = quantity;

        // Send updated quantity to backend
        updateCartItemQuantity(cartItemId, quantity);
    });
});

function updateCartItemQuantity(cartItemId, quantity) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../actions/update_quantity.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = xhr.responseText;
            if (response === 'success') {
                updateSubtotal(); // Optionally update subtotal or other cart details
            } else {
                alert('Failed to update quantity. Please try again.');
            }
        }
    };
    xhr.send('product_id=' + cartItemId + '&quantity=' + quantity);  // Send the correct product ID and quantity
}

</script>
</body>
</html>