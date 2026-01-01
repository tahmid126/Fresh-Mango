@extends('layouts.app')

@section('title', 'Become a Seller')

@section('content')
@if(!Auth::check())
    <div style="text-align: center; padding: 30px; background: #fff3cd; border: 1px solid #ffeeba; border-radius: 10px; margin-bottom: 20px;">
        <h3 style="color: #856404;">Please Login First</h3>
        <p>You must have a user account to apply as a seller.</p>
        <a href="{{ route('login') }}" class="btn-primary" style="display: inline-block; margin-top: 10px; text-decoration: none;">Login to Apply</a>
    </div>
@else
    <!-- এখানে আপনার আগের ফর্মটি থাকবে -->
    <form action="{{ route('seller.store') }}" ... >
       ...
    </form>
@endif
<div class="account-page" style="padding: 50px 0; background: #f9f9f9; min-height: 80vh; display: flex; align-items: center;">
    <div class="container" style="max-width: 800px; margin: auto;">
        <div class="row" style="justify-content: center;">
            
            <div class="col-2" style="background: white; padding: 40px; border-radius: 10px; box-shadow: 0 0 20px rgba(0,0,0,0.1); width: 100%;">
                <div class="form-container">
                    <h2 style="text-align: center; margin-bottom: 10px; color: #333;">Become a Seller</h2>
                    <p style="text-align: center; color: #666; margin-bottom: 30px;">Start your business with Fresh Mango today!</p>
                    
                    <form action="{{ route('seller.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Shop Info -->
                        <h4 style="margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 5px; color: #ff9f1c;">Shop Information</h4>
                        
                        <div style="margin-bottom: 15px;">
                            <label style="font-weight: bold; display: block; margin-bottom: 5px;">Shop Name *</label>
                            <input type="text" name="shop_name" placeholder="e.g. Rajshahi Mango Store" required 
                                   style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px;">
                            @error('shop_name') <span style="color: red; font-size: 12px;">{{ $message }}</span> @enderror
                        </div>

                        <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                            <div style="flex: 1; min-width: 250px; margin-bottom: 15px;">
                                <label style="font-weight: bold; display: block; margin-bottom: 5px;">Phone Number *</label>
                                <input type="tel" name="shop_phone" placeholder="017xxxxxxxx" required 
                                       style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px;">
                            </div>
                            <div style="flex: 1; min-width: 250px; margin-bottom: 15px;">
                                <label style="font-weight: bold; display: block; margin-bottom: 5px;">Trade License / NID (Image/PDF) *</label>
                                <input type="file" name="trade_license" required 
                                       style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; background: #f9f9f9;">
                            </div>
                        </div>

                        <div style="margin-bottom: 15px;">
                            <label style="font-weight: bold; display: block; margin-bottom: 5px;">Shop Address *</label>
                            <textarea name="shop_address" rows="3" placeholder="Full address of your shop/warehouse" required 
                                      style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px;"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn-primary" 
                                style="width: 100%; padding: 15px; background: #3a5a40; color: white; border: none; border-radius: 5px; font-size: 18px; font-weight: bold; cursor: pointer; margin-top: 10px;">
                            Submit Application
                        </button>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
