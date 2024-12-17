<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gentlemen's Wardrobe - Sign Up</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel = "stylesheet" href = '../assets/css/signup.css'>
</head>
<body>
    <div class="signup-container">
        <div class="signup-image">
            <div class="brand-section">
            <img src="../assets/images/logocroppednobg.png" alt="Product" class="summary-image">
                <div class="brand">GENTLEMEN'S WARDROBE</div>
                <div class="brand-tagline">Join Our Distinguished Community</div>
            </div>
            <ul class="benefits-list">
                <li><i class="fas fa-check-circle"></i> Exclusive member discounts</li>
                <li><i class="fas fa-check-circle"></i> Early access to new collections</li>
                <li><i class="fas fa-check-circle"></i> Personal style recommendations</li>
                <li><i class="fas fa-check-circle"></i> Free shipping on all orders</li>
                <li><i class="fas fa-check-circle"></i> Priority customer support</li>
            </ul>
        </div>
        <div class="signup-form">
            <div class="form-header">
                <h2>Create Account</h2>
                <p>Join us to start your refined shopping experience</p>
            </div>
            
            <form id="signupForm" action = "../actions/register_action.php" method = "POST">
                <div class="input-row">
                    <div class="input-group">
                        <input type="text" placeholder="First Name" name = "firstname" required>
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="input-group">
                        <input type="text" placeholder="Last Name" name = "lastname" required>
                        <i class="fas fa-user"></i>
                    </div>
                </div>

                <div class="input-group">
                    <input type="email" placeholder="Email Address"  name = "email" required>
                    <i class="fas fa-envelope"></i>
                </div>

                <div class="input-group">
                    <input type="tel" placeholder="Phone Number" name ="phone" required>
                    <i class="fas fa-phone"></i>
                </div>

                <div class="input-row">
                    <div class="input-group">
                        <input type="password" placeholder="Password" name = "password" required>
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="input-group">
                        <input type="password" placeholder="Confirm Password" name = "confirm_password" required>
                        <i class="fas fa-lock"></i>
                    </div>
                </div>
                <div id="errorMessages"></div>


                <div class="terms">
                    <input type="checkbox" id="terms" required>
                    <label for="terms">
                        I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>. I also agree to receive marketing emails which I can opt out of at any time.
                    </label>
                </div>


                <button type="submit" class="signup-btn">Create Account</button>

                <div class="social-signup">
                    <p>Or sign up with</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-google"></i></a>
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-apple"></i></a>
                    </div>
                </div>

                <div class="login-link">
                    Already have an account? <a href="#">Sign In</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Handle form submission via AJAX
            $('#signupForm').on('submit', function (e) {
                e.preventDefault();  // Prevent form from submitting the default way

                // Clear previous error messages
                $('#errorMessages').html('');

                // Collect form data
                var formData = $(this).serialize();

                $.ajax({
                    url: '../actions/register_action.php',  // Your PHP file
                    method: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status === 'error') {
                            // Loop through errors and display them
                            var errorMessages = response.errors;
                            var errorHtml = '<ul>';
                            errorMessages.forEach(function (error) {
                                errorHtml += '<li>' + error + '</li>';
                            });
                            errorHtml += '</ul>';
                            $('#errorMessages').html(errorHtml);  // Display errors
                        } else {
                            // If registration is successful, redirect
                        }
                    },
                    error: function () {
                        window.location.href = "../view/login.php";  // Redirect to login page

                    }
                });
            });
        });
    </script>

</body>
</html>