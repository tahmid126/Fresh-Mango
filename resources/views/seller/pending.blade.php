@extends('layouts.app')

@section('title', 'Application Received')

@section('content')

<div class="account-page" style="padding: 80px 0; background: #f9f9f9; min-height: 80vh; display: flex; align-items: center;">
    <div class="container">
        <div class="row" style="justify-content: center;">
            
            <div class="col-2" style="flex-basis: 600px; background: white; padding: 50px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); text-align: center;">
                
                <!-- Icon -->
                <div style="width: 80px; height: 80px; background: #e8f5e9; color: #2e7d32; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 40px; margin: 0 auto 25px;">
                    <i class="fas fa-clock"></i>
                </div>

                <h2 style="font-size: 28px; color: #333; margin-bottom: 15px;">Application Received!</h2>
                
                <p style="color: #666; font-size: 16px; line-height: 1.6; margin-bottom: 30px;">
                    Thank you for applying to become a seller. We have received your details.
                    <br>
                    You have been <strong>logged out</strong> for security reasons. Once Admin approves your request, you can log in directly to the Seller Panel.
                </p>

                <div style="background: #fff3cd; border: 1px solid #ffeeba; padding: 15px; border-radius: 8px; margin-bottom: 30px; text-align: left; color: #856404;">
                    <strong>Note:</strong> Please check your email for approval notification. Do not try to log in to the customer account until approved.
                </div>

                <div style="display: flex; gap: 15px; justify-content: center;">
                    <a href="{{ url('/') }}" class="btn-secondary" style="padding: 12px 25px; background: #eee; color: #333; text-decoration: none; border-radius: 5px; font-weight: 600;">
                        Back to Home
                    </a>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection