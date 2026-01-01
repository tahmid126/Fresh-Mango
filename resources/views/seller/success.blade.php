@extends('layouts.app')

@section('title', 'Application Submitted')

@section('content')

<div class="account-page" style="padding: 80px 0; background: #f9f9f9; min-height: 80vh; display: flex; align-items: center;">
    <div class="container">
        <div class="row" style="justify-content: center;">
            
            <div class="col-2" style="flex-basis: 550px; background: white; padding: 50px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); text-align: center;">
                
                <!-- Success Icon -->
                <div style="width: 80px; height: 80px; background: #e8f5e9; color: #2e7d32; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 40px; margin: 0 auto 25px;">
                    <i class="fas fa-check-circle"></i>
                </div>

                <h2 style="font-size: 28px; color: #333; margin-bottom: 15px;">Application Submitted! 🎉</h2>
                
                <p style="color: #666; font-size: 16px; line-height: 1.6; margin-bottom: 30px;">
                    Thank you for applying to become a seller on <strong>Fresh Mango</strong>. 
                    <br>
                    Your application is currently <strong>Pending Approval</strong>. Our team will review your details (Trade License & Shop Info) and activate your account shortly.
                </p>

                <div style="background: #fff8e1; border: 1px solid #ffeeba; padding: 15px; border-radius: 8px; margin-bottom: 30px; text-align: left;">
                    <h5 style="font-size: 14px; font-weight: bold; color: #856404; margin-bottom: 5px;">What happens next?</h5>
                    <ul style="font-size: 13px; color: #856404; padding-left: 20px; margin: 0;">
                        <li>Admin will verify your documents within 24 hours.</li>
                        <li>Once approved, you can log in to the Seller Panel.</li>
                        <li>You can start uploading products immediately after approval.</li>
                    </ul>
                </div>

                <div style="display: flex; gap: 15px; justify-content: center;">
                    <a href="{{ url('/') }}" class="btn-secondary" style="padding: 12px 25px; background: #eee; color: #333; text-decoration: none; border-radius: 5px; font-weight: 600;">
                        Back to Home
                    </a>
                    
                    <!-- সেলার লগিন পেজের লিংক -->
                    <a href="{{ url('/seller/login') }}" class="btn-primary" style="padding: 12px 25px; background: #ff9f1c; color: white; text-decoration: none; border-radius: 5px; font-weight: 600;">
                        Go to Seller Login
                    </a>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection