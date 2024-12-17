<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - MenStyle</title>
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
    <div class="container">
        <h1 class="cart-title">Shopping Cart</h1>
        
        <div class="cart-container">
            <div class="cart-items">
                <!-- Sample cart item -->
                <div class="cart-item">
                    <img src="../assets/images/clothes.jpg" alt="Product" class="item-image">
                    <div class="item-details">
                        <h3>Classic White T-Shirt</h3>
                        <p>Size: L | Color: White</p>
                    </div>
                    <div class="quantity-controls">
                        <button class="quantity-btn">-</button>
                        <span class="quantity">1</span>
                        <button class="quantity-btn">+</button>
                    </div>
                    <span class="price">$29.99</span>
                    <span class="subtotal">$29.99</span>
                    <button class="remove-btn">×</button>
                </div>

                <div class="cart-item">
                    <img src="../assets/images/clothes.jpg" alt="Product" class="item-image">
                    <div class="item-details">
                        <h3>Classic White T-Shirt</h3>
                        <p>Size: L | Color: White</p>
                    </div>
                    <div class="quantity-controls">
                        <button class="quantity-btn">-</button>
                        <span class="quantity">1</span>
                        <button class="quantity-btn">+</button>
                    </div>
                    <span class="price">$29.99</span>
                    <span class="subtotal">$29.99</span>
                    <button class="remove-btn">×</button>
                </div>                <div class="cart-item">
                    <img src="../assets/images/clothes.jpg" alt="Product" class="item-image">
                    <div class="item-details">
                        <h3>Classic White T-Shirt</h3>
                        <p>Size: L | Color: White</p>
                    </div>
                    <div class="quantity-controls">
                        <button class="quantity-btn">-</button>
                        <span class="quantity">1</span>
                        <button class="quantity-btn">+</button>
                    </div>
                    <span class="price">$29.99</span>
                    <span class="subtotal">$29.99</span>
                    <button class="remove-btn">×</button>
                </div>                <div class="cart-item">
                    <img src="../assets/images/clothes.jpg" alt="Product" class="item-image">
                    <div class="item-details">
                        <h3>Classic White T-Shirt</h3>
                        <p>Size: L | Color: White</p>
                    </div>
                    <div class="quantity-controls">
                        <button class="quantity-btn">-</button>
                        <span class="quantity">1</span>
                        <button class="quantity-btn">+</button>
                    </div>
                    <span class="price">$29.99</span>
                    <span class="subtotal">$29.99</span>
                    <button class="remove-btn">×</button>
                </div>                <div class="cart-item">
                    <img src="../assets/images/clothes.jpg" alt="Product" class="item-image">
                    <div class="item-details">
                        <h3>Classic White T-Shirt</h3>
                        <p>Size: L | Color: White</p>
                    </div>
                    <div class="quantity-controls">
                        <button class="quantity-btn">-</button>
                        <span class="quantity">1</span>
                        <button class="quantity-btn">+</button>
                    </div>
                    <span class="price">$29.99</span>
                    <span class="subtotal">$29.99</span>
                    <button class="remove-btn">×</button>
                </div>                <div class="cart-item">
                    <img src="../assets/images/clothes.jpg" alt="Product" class="item-image">
                    <div class="item-details">
                        <h3>Classic White T-Shirt</h3>
                        <p>Size: L | Color: White</p>
                    </div>
                    <div class="quantity-controls">
                        <button class="quantity-btn">-</button>
                        <span class="quantity">1</span>
                        <button class="quantity-btn">+</button>
                    </div>
                    <span class="price">$29.99</span>
                    <span class="subtotal">$29.99</span>
                    <button class="remove-btn">×</button>
                </div>

                <!-- Add more cart items here -->
            </div>

            <div class="cart-summary">
                <h2 class="summary-title">Order Summary</h2>
                <div class="summary-item">
                    <span>Subtotal</span>
                    <span>$29.99</span>
                </div>
                <div class="summary-item">
                    <span>Shipping</span>
                    <span>$5.00</span>
                </div>
                <div class="summary-item">
                    <span>Tax</span>
                    <span>$2.50</span>
                </div>
                <div class="summary-total">
                    <span>Total</span>
                    <span>$37.49</span>
                </div>
                <button class="checkout-btn">Proceed to Checkout</button>
                <a href="#" class="continue-shopping">← Continue Shopping</a>
            </div>
        </div>
    </div>

    <script>
        // Add functionality for quantity buttons
        document.querySelectorAll('.quantity-btn').forEach(button => {
            button.addEventListener('click', () => {
                const quantitySpan = button.parentElement.querySelector('.quantity');
                let quantity = parseInt(quantitySpan.textContent);
                
                if (button.textContent === '+') {
                    quantity++;
                } else if (quantity > 1) {
                    quantity--;
                }
                
                quantitySpan.textContent = quantity;
                updateSubtotal();
            });
        });

        // Add functionality for remove buttons
        document.querySelectorAll('.remove-btn').forEach(button => {
            button.addEventListener('click', () => {
                button.closest('.cart-item').remove();
                updateSummary();
            });
        });

        // Function to update subtotals and total
        function updateSubtotal() {
            const items = document.querySelectorAll('.cart-item');
            let total = 0;

            items.forEach(item => {
                const price = parseFloat(item.querySelector('.price').textContent.replace('$', ''));
                const quantity = parseInt(item.querySelector('.quantity').textContent);
                const subtotal = price * quantity;
                
                item.querySelector('.subtotal').textContent = `$${subtotal.toFixed(2)}`;
                total += subtotal;
            });

            updateSummary(total);
        }

        // Function to update order summary
        function updateSummary(subtotal = 29.99) {
            const shipping = 5.00;
            const tax = subtotal * 0.08; // 8% tax
            const total = subtotal + shipping + tax;

            document.querySelector('.summary-item:nth-child(1) span:last-child').textContent = `$${subtotal.toFixed(2)}`;
            document.querySelector('.summary-item:nth-child(3) span:last-child').textContent = `$${tax.toFixed(2)}`;
            document.querySelector('.summary-total span:last-child').textContent = `$${total.toFixed(2)}`;
        }
    </script>
</body>
</html>