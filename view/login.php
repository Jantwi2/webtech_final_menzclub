<?php
// Start the session to access error messages
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gentlemen's Wardrobe - Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel = "stylesheet" href = '../assets/css/login.css'>
</head>
<body>
    <div class="login-container">
        <div class="login-image">
            <div class="brand-section">
                <img src="../assets/images/logocroppednobg.png" alt="Product" class="summary-image">
                <div class="brand">GENTLEMEN'S WARDROBE</div>
                <div class="brand-tagline">Elevate Your Style. Define Your Legacy.</div>
            </div>
            <div class="testimonial">
                "Discover the perfect blend of sophistication and comfort with our curated collection of men's fashion essentials."
            </div>
        </div>
        <div class="login-form">
            <div class="form-header">
                <h2>Welcome Back</h2>
                <p>Please sign in to continue shopping</p>
            </div>

            <!-- Display error message if exists -->
            <?php if (isset($_SESSION['login_error'])): ?>
                <div class="error-message">
                    <p><?php echo $_SESSION['login_error']; ?></p>
                </div>
                <?php unset($_SESSION['login_error']); // Clear the error message after displaying it ?>
            <?php endif; ?>
            
            <form action = "../actions/login_action.php" method = "POST">
                <div class="input-group">
                    <input type="email" placeholder="Email Address" name="email" required>
                    <i class="fas fa-envelope"></i>
                </div>

                <div class="input-group">
                    <input type="password" placeholder="Password" name="password" required>
                    <i class="fas fa-lock"></i>
                </div>

                <div class="options">
                    <label class="remember-me">
                        <input type="checkbox">
                        <span>Remember me</span>
                    </label>
                    <a href="#" class="forgot-password">Forgot Password?</a>
                </div>

                <button type="submit" class="login-btn">Sign In</button>

                <div class="social-login">
                    <p>Or continue with</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-google"></i></a>
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-apple"></i></a>
                    </div>
                </div>

                <div class="signup-link">
                    Don't have an account? <a href="signup.php">Create Account</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
