<?php
session_start();
include '../functions/cart_functions.php';
include '../functions/order_functions.php';

$user_id = $_SESSION['user_id'];
$firtname = $_SESSION['firstname'];
$orders = getOrders($conn, $user_id); // Get the orders
$cartItems = getCartItems($conn, $user_id);
$amount = $_SESSION['amount'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success - StreetStyle</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Roboto;
        }

        body {
            background: #1a1a1a;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            color: #ffffff;
            overflow-x: hidden;
        }

        .success-card {
            background: #262626;
            border-radius: 12px;
            padding: 3rem;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            text-align: center;
            animation: slideIn 0.8s ease-out;
        }

        @keyframes slideIn {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .status-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 2rem;
            border: 3px solid #00ff00;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .status-icon i {
            color: #00ff00;
            font-size: 2rem;
        }

        h1 {
            color: #ffffff;
            font-size: 2.5rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .order-number {
            background: #333333;
            padding: 1rem 2rem;
            border-radius: 8px;
            display: inline-block;
            margin: 1rem 0;
            font-weight: 600;
            color: #00ff00;
            letter-spacing: 1px;
        }

        .receipt-preview {
            background: #333333;
            padding: 1.5rem;
            border-radius: 8px;
            margin: 2rem 0;
            text-align: left;
        }

        .receipt-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            color: #ffffff;
        }

        .timeline {
            margin: 2rem 0;
            padding: 2rem;
            background: #333333;
            border-radius: 8px;
            text-align: left;
        }

        .timeline-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
            opacity: 0;
            animation: slideIn 0.5s ease-out forwards;
        }

        .timeline-icon {
            width: 40px;
            height: 40px;
            background: #00ff00;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #000000;
            flex-shrink: 0;
        }

        .timeline-content h3 {
            color: #ffffff;
            margin-bottom: 0.25rem;
        }

        .timeline-content p {
            color: #888888;
        }

        .action-buttons {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn {
            padding: 1rem;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-primary {
            background: #00ff00;
            color: #000000;
        }

        .btn-secondary {
            background: #333333;
            color: #ffffff;
            border: 2px solid #00ff00;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 255, 0, 0.2);
        }

        .social-share {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 2px solid #333333;
        }

        .social-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-btn {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #333333;
            color: #00ff00;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid #00ff00;
        }

        .social-btn:hover {
            background: #00ff00;
            color: #000000;
        }

        @media (max-width: 768px) {
            .success-card {
                padding: 2rem;
            }

            .action-buttons {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="success-card">
        <div class="status-icon">
            <i class="fas fa-check"></i>
        </div>

        <h1>Order Confirmed</h1>
        <p>Your gear is locked in.</p>
        
        <?php foreach ($orders as $order): ?>
        <div class="order-number">
            Order #<?php echo $order['invoice_no']; ?>
        </div>
        <?php endforeach; ?>

        <div class="receipt-preview">
        <?php foreach ($cartItems as $item): ?>
            <div class="receipt-item">
                <span><?php echo $item['product_title']; ?></span>
                <span>GH₵ <?php echo number_format($item['total'], 2); ?></span>
            </div>
            <?php endforeach; ?>

            <div class="receipt-item" style="border-top: 1px solid #444; margin-top: 0.5rem; padding-top: 0.5rem;">
                <strong>Total</strong>
                <strong>GH₵ <?php echo $amount; ?></strong>
            </div>
        </div>

        <div class="timeline">
            <div class="timeline-item">
                <div class="timeline-icon">
                    <i class="fas fa-check"></i>
                </div>
                <div class="timeline-content">
                    <h3>Confirmed</h3>
                    <p>Payment processed</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-icon">
                    <i class="fas fa-box"></i>
                </div>
                <div class="timeline-content">
                    <h3>In Progress</h3>
                    <p>Preparing for shipping</p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-icon">
                    <i class="fas fa-truck"></i>
                </div>
                <div class="timeline-content">
                    <h3>Delivery</h3>
                    <p>Estimated: 2-3 business days</p>
                </div>
            </div>
        </div>

        <div class="action-buttons">
            <button class="btn btn-primary" onclick="continueShopping()">
                Continue Shopping
            </button>
            <button class="btn btn-secondary" onclick="downloadReceipt()">
                Get Receipt
            </button>
        </div>

        <div class="social-share">
            <p>Share your pickup</p>
            <div class="social-buttons">
                <div class="social-btn">
                    <i class="fab fa-instagram"></i>
                </div>
                <div class="social-btn">
                    <i class="fab fa-twitter"></i>
                </div>
                <div class="social-btn">
                    <i class="fab fa-tiktok"></i>
                </div>
            </div>
        </div>
    </div>

    <script>
        function continueShopping() {
            window.location.href = 'shop.php';  // Replace with the actual URL of your shop page
        }

        function downloadReceipt() {
            alert('Generating your receipt PDF...');
        }

        document.querySelectorAll('.timeline-item').forEach((item, index) => {
            item.style.animationDelay = `${0.2 * (index + 1)}s`;
        });
    </script>
</body>
</html>