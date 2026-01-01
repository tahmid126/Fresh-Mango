@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')

    <div class="account-page" style="padding: 50px 0; background: #f9f9f9; min-height: 80vh; display: flex; align-items: center;">
        <div class="container">
            <div class="row" style="justify-content: center;">
                
                <div class="col-2" style="flex-basis: 400px; background: white; padding: 40px; border-radius: 10px; box-shadow: 0 0 20px rgba(0,0,0,0.1);">
                    <div class="form-container">
                        
                        <!-- STEP 1: Input (Email or Phone) -->
                        <div id="step-1">
                            <h3 style="text-align: center; margin-bottom: 20px; color: #ff9f1c; border-bottom: 2px solid #3a5a40; display: inline-block;">Reset Password</h3>
                            <p style="color: #666; font-size: 14px; margin-bottom: 20px; text-align: center;">Enter your <b>Email</b> or <b>Mobile Number</b> to receive an OTP.</p>
                            
                            <form onsubmit="event.preventDefault(); sendOTP();">
                                <!-- Input type text দেওয়া হয়েছে যাতে ইমেইল বা ফোন দুটোই নেয় -->
                                <input type="text" id="userInput" placeholder="Email or Mobile (+880...)" required 
                                       style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 15px;">
                                
                                <button type="submit" class="btn-primary" 
                                        style="width: 100%; padding: 12px; background: #ff9f1c; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">
                                    Send OTP
                                </button>
                                
                                <div class="switch-link" style="text-align: center; margin-top: 20px;">
                                    <br>
                                    <a href="{{ route('login') }}" style="color: #555; font-size: 14px; font-weight: bold; text-decoration: none;">
                                        <i class="fas fa-arrow-left"></i> Back to Login
                                    </a>
                                </div>
                            </form>
                        </div>

                        <!-- STEP 2: Verify OTP -->
                        <div id="step-2" style="display: none;">
                            <h3 style="text-align: center; margin-bottom: 20px; color: #ff9f1c;">Verify OTP</h3>
                            <p style="color: #666; font-size: 14px; margin-bottom: 20px; text-align: center;">
                                We sent a code to <br> <span id="displayContact" style="font-weight: bold; color: #3a5a40;"></span>
                            </p>
                            
                            <form onsubmit="event.preventDefault(); verifyOTP();">
                                <input type="text" id="otpInput" placeholder="Enter 4-digit OTP" 
                                       style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 10px; text-align: center; letter-spacing: 5px; font-weight: bold; font-size: 18px;">
                                
                                <p style="font-size: 12px; text-align: right; color: #666; margin-bottom: 15px;">Demo OTP: <b>1234</b></p>
                                
                                <button type="submit" class="btn-primary" 
                                        style="width: 100%; padding: 12px; background: #3a5a40; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">
                                    Verify
                                </button>
                            </form>
                        </div>

                        <!-- STEP 3: New Password -->
                        <div id="step-3" style="display: none;">
                            <h3 style="text-align: center; margin-bottom: 20px; color: #ff9f1c;">New Password</h3>
                            
                            <form onsubmit="event.preventDefault(); resetSuccess();">
                                <input type="password" placeholder="New Password" required 
                                       style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 15px;">
                                <input type="password" placeholder="Confirm Password" required 
                                       style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 15px;">
                                
                                <button type="submit" class="btn-primary" 
                                        style="width: 100%; padding: 12px; background: #ff9f1c; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">
                                    Change Password
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Logic (Smart Detection) -->
    <script>
        function sendOTP() {
            const input = document.getElementById('userInput').value;
            let type = "";

            // চেক করা হচ্ছে এটা ইমেইল নাকি ফোন নাম্বার
            if (input.includes("@")) {
                type = "Email Address";
            } else if (!isNaN(input) && input.length > 10) {
                type = "Mobile Number";
            } else {
                alert("Please enter a valid Email or Mobile Number!");
                return;
            }

            // ওটিপি পাঠানোর সিমুলেশন
            alert(`OTP sent to your ${type}: ${input}\n(Demo OTP is: 1234)`);

            // পরের ধাপে যাওয়া
            document.getElementById('step-1').style.display = 'none';
            document.getElementById('step-2').style.display = 'block';
            document.getElementById('displayContact').innerText = input;
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
            alert("Password Changed Successfully! Please login now.");
            window.location.href = "{{ route('login') }}";
        }
    </script>

@endsection