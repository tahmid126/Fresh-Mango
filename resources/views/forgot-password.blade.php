@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')

      <header>
        <div class="logo"><h1>🥭 Fresh Mango</h1></div>
        <nav>
            <ul id="navbar" class="nav-links">
                <a href="#" id="close-btn"><i class="fas fa-times"></i></a>
                <li><a href="index.html">Home</a></li>
                <li><a href="shop.html">Shop</a></li>
                <li><a href="blog.html">Blog</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li id="mobile-bag"><a href="cart.html"><i class="fas fa-shopping-cart"></i> Cart</a></li>
                <li id="mobile-login"><a href="login.html">Login</a></li>
            </ul>
        </nav>
        <div class="nav-icons mobile-header-icons">
            <a href="cart.html"><i class="fas fa-shopping-cart"></i></a>
            <a href="login.html"><i class="fas fa-user"></i></a>
            <i id="bar" class="fas fa-bars"></i>
        </div>
    </header>

    <div class="account-page">
        <div class="container">
            <div class="row" style="justify-content: center;">
                <div class="col-2" style="flex-basis: 400px;">
                    <div class="form-container">
                        
                        <div id="step-1">
                            <h3>Reset Password</h3>
                            <p style="color: #666; font-size: 14px; margin-bottom: 20px;">Enter your mobile number to receive an OTP.</p>
                            <form>
                                <input type="tel" id="userPhone" placeholder="Enter Mobile Number (+880###)" required>
                                <button type="button" class="btn-primary" onclick="sendOTP()">Send OTP</button>
                                <div class="switch-link">
                                    <br><a href="login.html">Back to Login</a>
                                </div>
                            </form>
                        </div>

                        <div id="step-2" style="display: none;">
                            <h3>Verify OTP</h3>
                            <p style="color: #666; font-size: 14px; margin-bottom: 20px;">
                                We sent a code to <span id="displayPhone" style="font-weight: bold; color: #ff9f1c;"></span>
                            </p>
                            <form>
                                <input type="text" id="otpInput" placeholder="Enter 4-digit OTP" style="text-align: center; letter-spacing: 5px; font-weight: bold;">
                                <p style="font-size: 12px; text-align: right; color: #666;">Demo OTP: <b>1234</b></p>
                                <button type="button" class="btn-primary" onclick="verifyOTP()">Verify</button>
                            </form>
                        </div>

                        <div id="step-3" style="display: none;">
                            <h3>New Password</h3>
                            <form>
                                <input type="password" placeholder="New Password" required>
                                <input type="password" placeholder="Confirm Password" required>
                                <button type="button" class="btn-primary" onclick="resetSuccess()">Change Password</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer-bottom">
            <p>&copy; 2024 Fresh Mango. All Rights Reserved.</p>
        </div>
    </footer>

    <script>
        
        function sendOTP() {
            const phone = document.getElementById('userPhone').value;
            
            if (phone.length < 11) {
                alert("Please enter a valid mobile number!");
                return;
            }

           
            alert(`OTP sent to ${phone}.\n(Demo OTP is: 1234)`);

            
            document.getElementById('step-1').style.display = 'none';
            document.getElementById('step-2').style.display = 'block';
            document.getElementById('displayPhone').innerText = phone;
        }

       
        function verifyOTP() {
            const otp = document.getElementById('otpInput').value;

            if (otp === "1234") {
                alert("OTP Verified Successfully! ✅");
                document.getElementById('step-2').style.display = 'none';
                document.getElementById('step-3').style.display = 'block';
            } else {
                alert("Wrong OTP! Try again. (Hint: 1234)");
            }
        }

       
        function resetSuccess() {
            alert(" Password Changed Successfully! Please login now.");
            window.location.href = "login.html";
        }
    </script>
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>Fresh Mango</h3>
                <p>Bringing the sweetness of Rajshahi directly to your doorstep.</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="shop.html">Shop</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Follow Us</h3>
                <div class="socials">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Fresh Mango. All Rights Reserved.</p>
        </div>
    </footer>

@endsection