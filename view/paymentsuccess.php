<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MenzClub Payment Successful!</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #000000;
            --secondary-color: #a88beb;
            --text-color: #2d3436;
            --light-bg: #f8f7ff;
            --border-radius-lg: 30px;
            --border-radius-md: 20px;
            --border-radius-sm: 12px;
            --spacing-xs: 0.5rem;
            --spacing-sm: 1rem;
            --spacing-md: 1.5rem;
            --spacing-lg: 2rem;
            --spacing-xl: 3rem;
        }

        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }

        @keyframes confetti {
            0% { transform: translateY(0) rotate(0deg); }
            100% { transform: translateY(1000px) rotate(720deg); }
        }

        @keyframes scale {
            0% { transform: scale(0.8); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        @keyframes slideIn {
            from { transform: translateX(-100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Roboto;
        }

        body {
            min-height: 100vh;
            min-height: -webkit-fill-available;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--text-color);
            overflow-x: hidden;
            padding: var(--spacing-md);
        }

        html {
            height: -webkit-fill-available;
        }

        .confetti {
            width: 10px;
            height: 10px;
            background-color: #ffd700;
            position: fixed;
            top: -10px;
            animation: confetti 4s ease-out infinite;
        }

        .success-container {
            background: white;
            padding: clamp(var(--spacing-md), 5vw, var(--spacing-xl));
            border-radius: var(--border-radius-lg);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            text-align: center;
            width: min(90vw, 600px);
            position: relative;
            animation: scale 0.5s ease-out;
            margin: auto;
        }
        .summary-image {
            width: 100px; /* Make the logo image a bit smaller */
            display: block;
            margin: 0 auto 1rem; /* Center the image and add space below */
        }

        .success-icon {
            width: clamp(80px, 15vw, 120px);
            height: clamp(80px, 15vw, 120px);
            background: #6c5ce7;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto var(--spacing-lg);
            animation: float 3s ease-in-out infinite;
        }

        .success-icon i {
            font-size: clamp(40px, 8vw, 60px);
            color: white;
        }

        h1 {
            color: var(--text-color);
            margin-bottom: var(--spacing-sm);
            font-size: clamp(1.5rem, 5vw, 2.5rem);
            line-height: 1.2;
        }

        .subtitle {
            font-size: clamp(1rem, 3vw, 1.2rem);
            color: #636e72;
            margin-bottom: var(--spacing-md);
        }

        .order-number {
            background: var(--light-bg);
            padding: var(--spacing-sm);
            border-radius: var(--border-radius-sm);
            margin: var(--spacing-lg) 0;
            font-size: clamp(0.9rem, 2.5vw, 1.2rem);
            border: 2px dashed var(--primary-color);
            word-break: break-all;
        }

        .delivery-info {
            background: white;
            padding: var(--spacing-md);
            border-radius: var(--border-radius-md);
            margin: var(--spacing-lg) 0;
            text-align: left;
            animation: slideIn 0.5s ease-out 0.5s both;
        }

        .delivery-step {
            display: flex;
            align-items: flex-start;
            margin-bottom: var(--spacing-sm);
            padding: var(--spacing-sm);
            background: var(--light-bg);
            border-radius: var(--border-radius-sm);
            transition: transform 0.3s ease;
        }

        .delivery-step:hover {
            transform: translateX(10px);
        }

        .step-icon {
            width: clamp(32px, 8vw, 40px);
            height: clamp(32px, 8vw, 40px);
            min-width: clamp(32px, 8vw, 40px);
            background: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: var(--spacing-sm);
        }

        .step-icon i {
            color: white;
            font-size: clamp(14px, 3vw, 16px);
        }

        .step-content {
            flex: 1;
        }

        .btn-container {
            display: flex;
            flex-wrap: wrap;
            gap: var(--spacing-sm);
            justify-content: center;
            margin-top: var(--spacing-lg);
        }

        .btn {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: var(--spacing-sm) var(--spacing-lg);
            border-radius: var(--border-radius-sm);
            font-size: clamp(0.9rem, 2.5vw, 1.1rem);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            flex: 1;
            min-width: 200px;
            max-width: 300px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(108, 92, 231, 0.2);
        }

        .btn.outline {
            background: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
        }

        .celebration {
            position: absolute;
            top: -40px;
            left: 50%;
            transform: translateX(-50%);
            font-size: clamp(2rem, 6vw, 3rem);
            animation: float 2s ease-in-out infinite;
        }

        .order-details {
            margin: var(--spacing-lg) 0;
            padding: var(--spacing-sm);
            background: var(--light-bg);
            border-radius: var(--border-radius-sm);
            text-align: left;
        }

        .product-row {
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
            margin-bottom: var(--spacing-sm);
            padding: var(--spacing-xs);
            border-radius: var(--border-radius-sm);
            transition: background-color 0.3s ease;
            flex-wrap: wrap;
        }

        .product-row:hover {
            background-color: #eee9ff;
        }

        .product-image {
            width: clamp(50px, 12vw, 60px);
            height: clamp(50px, 12vw, 60px);
            background: #ddd;
            border-radius: var(--border-radius-sm);
            flex-shrink: 0;
        }

        .product-info {
            flex: 1;
            min-width: 150px;
        }

        .product-price {
            font-weight: bold;
            white-space: nowrap;
        }

        @media (max-width: 480px) {
            .success-container {
                padding: var(--spacing-md);
            }

            .product-row {
                flex-direction: column;
                align-items: flex-start;
            }

            .product-price {
                align-self: flex-end;
            }

            .delivery-step {
                flex-direction: column;
                align-items: flex-start;
                text-align: left;
            }

            .step-icon {
                margin-bottom: var(--spacing-xs);
            }
        }

        @media (max-width: 350px) {
            :root {
                --spacing-md: 1rem;
                --spacing-lg: 1.5rem;
            }

            .btn-container {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                max-width: none;
            }
        }

        @media (min-width: 768px) {
            .product-row {
                padding: var(--spacing-sm);
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .confetti, .celebration, .success-icon, .delivery-step {
                animation: none;
            }
        }
    </style>
</head>
<body>
    <div id="confetti-container"></div>

    <div class="success-container">
        <div class="celebration">🎉</div>
        
        <div class="success-icon">
            <i class="fas fa-check"></i>
        </div>

        <img src="../assets/images/logowhitebg.png" alt="Product" class="summary-image">

        <h1>Payment Successful!</h1>
        <p class="subtitle">Your order is on its way to being processed</p>

        <div class="order-number">
            <strong>Order Number:</strong> #STY-2024-8547
        </div>

        <div class="order-details">
            <h3 style="margin-bottom: var(--spacing-md);">Order Summary</h3>
            <div class="product-row">
                <div class="product-image"></div>
                <div class="product-info">
                    <strong>Streetwear Hoodie</strong>
                    <div style="color: #636e72;">Size: L | Color: Black</div>
                </div>
                <div class="product-price">GH₵ 899.99</div>
            </div>
            <div class="product-row">
                <div class="product-image"></div>
                <div class="product-info">
                    <strong>Cargo Pants</strong>
                    <div style="color: #636e72;">Size: 32 | Color: Olive</div>
                </div>
                <div class="product-price">GH₵ 699.99</div>
            </div>
        </div>

        <div class="delivery-info">
            <h3 style="margin-bottom: var(--spacing-md);">What's Next?</h3>
            <div class="delivery-step">
                <div class="step-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="step-content">
                    <strong>Order Confirmation</strong>
                    <div style="color: #636e72;">Check your email for order details</div>
                </div>
            </div>
            <div class="delivery-step">
                <div class="step-icon">
                    <i class="fas fa-box"></i>
                </div>
                <div class="step-content">
                    <strong>Order Processing</strong>
                    <div style="color: #636e72;">We're preparing your items</div>
                </div>
            </div>
            <div class="delivery-step">
                <div class="step-icon">
                    <i class="fas fa-truck"></i>
                </div>
                <div class="step-content">
                    <strong>Delivery</strong>
                    <div style="color: #636e72;">Estimated delivery: 3-5 business days</div>
                </div>
            </div>
        </div>

        <div class="btn-container">
            <a href="trackorder.php" class="btn">Track Order</a>
            <a href="shop.php" class="btn outline">Continue Shopping</a>
        </div>
    </div>

    <script>
        // Create confetti with performance optimization
        function createConfetti() {
            const colors = ['#ffd700', '#ff6b6b', '#4ecdc4', '#45b7d1', '#96c93d'];
            const confettiCount = window.innerWidth < 480 ? 25 : 50;
            const container = document.getElementById('confetti-container');

            for (let i = 0; i < confettiCount; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + 'vw';
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.animationDuration = (Math.random() * 3 + 2) + 's';
                confetti.style.opacity = Math.random();
                confetti.style.transform = `rotate(${Math.random() * 360}deg)`;

                container.appendChild(confetti);

                // Remove confetti after animation
                confetti.addEventListener('animationend', () => {
                    confetti.remove();
                });
            }
        }

        // Check if user prefers reduced motion
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

        if (!prefersReducedMotion.matches) {
            // Initial confetti burst
            createConfetti();

            // Create new confetti every few seconds
            const confettiInterval = setInterval(createConfetti, 3000);

            // Cleanup interval when page is hidden
            document.addEventListener('visibilitychange', () => {
                if (document.hidden) {
                    clearInterval(confettiInterval);
                }
            });
        }

        // Handle viewport height for mobile browsers
        function setViewportHeight() {
            document.documentElement.style.setProperty(
                '--vh', 
                `${window.innerHeight * 0.01}px`
            );
        }

        setViewportHeight();
        window.addEventListener('resize', setViewportHeight);
    </script>
</body>
</html>