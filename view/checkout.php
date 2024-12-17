<?php
include '../functions/cart_functions.php';
session_start();
$customer_id = $_SESSION['user_id'];
$cartItems = getCartItems($conn, $customer_id);
$customer_email = $_SESSION['user_email'];
$subtotal = 0;



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - StreetStyle</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel = "stylesheet" href = '../assets/css/styles.css'>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Roboto;
        }

        body {
            background-color: #f8f9fa;
            color: #2d3436;
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .payment-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 2rem;
            margin-top: 2rem;
        }

        .card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .payment-methods {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin: 1.5rem 0;
        }

        .payment-method {
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            padding: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .payment-method:hover {
            border-color: #6c5ce7;
            background: #f8f7ff;
        }

        .payment-method.selected {
            border-color: #6c5ce7;
            background: #f8f7ff;
        }

        .payment-method i {
            font-size: 1.5rem;
            color: #6c5ce7;
        }

        .input-group {
            margin-bottom: 1.5rem;
        }

        .input-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #2d3436;
        }

        .input-group input {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .input-group input:focus {
            outline: none;
            border-color: #6c5ce7;
        }

        .order-summary {
            background: #f8f7ff;
            padding: 1.5rem;
            border-radius: 15px;
            margin-bottom: 1.5rem;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
            color: #636e72;
        }

        .summary-image {
            width: 200px; /* Make the logo image a bit smaller */
            display: block;
            margin: 0 auto 1rem; /* Center the image and add space below */
        }

        .total {
            border-top: 2px solid #e0e0e0;
            margin-top: 1rem;
            padding-top: 1rem;
            font-weight: bold;
            color: #2d3436;
        }

        .pay-button {
            background: #000000;
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 12px;
            width: 100%;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .pay-button:hover {
            background: #5f50e3;
            transform: translateY(-2px);
        }

        .secure-badge {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1rem;
            color: #636e72;
            font-size: 0.9rem;
        }

        .payment-section {
            margin-top: 1.5rem;
        }

        .payment-section h3 {
            margin-bottom: 1rem;
            color: #2d3436;
            font-size: 1.2rem;
        }

        .network-select {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1rem;
            margin-bottom: 1rem;
            background: white;
        }

        .momo-icon {
            width: 24px;
            height: 24px;
            margin-right: 8px;
        }

        .divider {
            margin: 1.5rem 0;
            border-top: 2px solid #e0e0e0;
            position: relative;
        }

        .divider-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 0 1rem;
            color: #636e72;
        }

        @media (max-width: 768px) {
            .payment-grid {
                grid-template-columns: 1fr;
            }
            
            .payment-methods {
                grid-template-columns: 1fr;
            }
        }

        .loading {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #6c5ce7;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .momo-details {
            display: none;
        }

        .momo-details.active {
            display: block;
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
        <h1 style="font-size: 2rem; margin-bottom: 1rem;">Checkout</h1>
        
        <div class="payment-grid">
            <div class="card">
                <h2 style="margin-bottom: 1.5rem;">Payment Method</h2>
                
                <div class="payment-methods">
                    <div class="payment-method" onclick="selectPayment('card')">
                        <i class="fas fa-credit-card"></i>
                        <span>Credit Card</span>
                    </div>
                    <div class="payment-method" onclick="selectPayment('paypal')">
                        <i class="fab fa-paypal"></i>
                        <span>PayPal</span>
                    </div>
                    <div class="payment-method" onclick="selectPayment('apple')">
                        <i class="fab fa-apple"></i>
                        <span>Apple Pay</span>
                    </div>
                    <div class="payment-method" onclick="selectPayment('google')">
                        <i class="fab fa-google-pay"></i>
                        <span>Google Pay</span>
                    </div>
                </div>

                <div class="divider">
                    <span class="divider-text">or pay with Mobile Money</span>
                </div>

                <div class="payment-methods">
                    <div class="payment-method" onclick="selectPayment('mtn')">
                        <i class="fas fa-mobile-alt" style="color: #ffc107;"></i>
                        <span>MTN MoMo</span>
                    </div>
                    <div class="payment-method" onclick="selectPayment('vodafone')">
                        <i class="fas fa-mobile-alt" style="color: #dc3545;"></i>
                        <span>Vodafone Cash</span>
                    </div>
                    <div class="payment-method" onclick="selectPayment('airteltigo')">
                        <i class="fas fa-mobile-alt" style="color: #0dcaf0;"></i>
                        <span>AirtelTigo Money</span>
                    </div>
                </div>

                <div id="cardDetails" class="payment-section">
                    <div class="input-group">
                        <label>Card Number</label>
                        <input type="text" placeholder="1234 5678 9012 3456" maxlength="19" id="cardNumber">
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div class="input-group">
                            <label>Expiry Date</label>
                            <input type="text" placeholder="MM/YY" maxlength="5">
                        </div>
                        <div class="input-group">
                            <label>CVV</label>
                            <input type="text" placeholder="123" maxlength="3">
                        </div>
                    </div>

                    <div class="input-group">
                        <label>Name on Card</label>
                        <input type="text" placeholder="John Doe">
                    </div>
                </div>

                <div id="momoDetails" class="payment-section momo-details">
                    <div class="input-group">
                        <label>Mobile Money Number</label>
                        <input type="tel" placeholder="0XX XXX XXXX" maxlength="10">
                    </div>
                    <div class="input-group">
                        <label>Account Name</label>
                        <input type="text" placeholder="Enter account name">
                    </div>
                    <p style="color: #636e72; font-size: 0.9rem; margin-top: 1rem;">
                        <i class="fas fa-info-circle"></i>
                        You will receive a prompt on your phone to complete the payment
                    </p>
                </div>
            </div>

            <div class="card">
            <img src="../assets/images/logowhitebgcropped.png" alt="Product" class="summary-image">
                <h2 style="margin-bottom: 1.5rem;">Order Summary</h2>
                <form id = "paymentForm">
                    <div class="order-summary">
                        <?php foreach ($cartItems as $cartItem): ?>
                        <div class="summary-item">
                            <span><?php echo $cartItem['product_title']; ?></span>
                            <span>GH₵ <?php echo $cartItem['total']; ?></span>
                        </div>
                        <?php 
                            $subtotal += $cartItem['total'];
                        ?>
                        <?php endforeach; ?>
                        <div class="summary-item">
                            <span>Delivery</span>
                            <span>Free</span>
                        </div>
                        <div class="summary-item">
                            <span>Tax (15%)</span>
                            <span>GH₵ <?php echo number_format($subtotal * 0.15, 2); ?></span>
                        </div>
                        <div class="summary-item total">
                            <span>Total</span>
                            <span>GH₵ <?php echo number_format($subtotal + ($subtotal * 0.15), 2); ?></span>
                        </div>
                    </div>
                    <?php $_SESSION['amount'] = number_format($subtotal + ($subtotal * 0.15), 2); ?>
                    <form id = "paymentForm">
                        <input type = "hidden" id = "email-address" value = "<?php echo $customer_email; ?>">
                        <input type="hidden" id="amount" value="<?php echo $subtotal + ($subtotal * 0.15), 2; ?>">
                        <button type ="submit" onclick="payWithPaystack()" class="pay-button">
                            Pay Now
                        </button>
                    </form>
                <div class="secure-badge">
                    <i class="fas fa-lock"></i>
                    <span>Secure Payment</span>
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

    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script src="../assets/js/pay.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script src="../assets/js/tawk-chat.js"></script>
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
        function selectPayment(method) {
            // Remove selected class from all methods
            document.querySelectorAll('.payment-method').forEach(el => {
                el.classList.remove('selected');
            });
            
            // Add selected class to clicked method
            event.currentTarget.classList.add('selected');
            
            // Show/hide appropriate payment details
            const cardDetails = document.getElementById('cardDetails');
            const momoDetails = document.getElementById('momoDetails');
            
            if (['mtn', 'vodafone', 'airteltigo'].includes(method)) {
                cardDetails.style.display = 'none';
                momoDetails.style.display = 'block';
            } else if (method === 'card') {
                cardDetails.style.display = 'block';
                momoDetails.style.display = 'none';
            } else {
                cardDetails.style.display = 'none';
                momoDetails.style.display = 'none';
            }
        }

        // // Format card number input with spaces
        // document.getElementById('cardNumber').addEventListener('input', function(e) {
        //     let value = e.target.value.replace(/\s/g, '');
        //     let formattedValue = value.replace(/(\d{4})/g, '$1 ').trim();
        //     e.target.value = formattedValue;
        // });

    </script>
</body>
</html>