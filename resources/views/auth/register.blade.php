@extends('layouts.app')

@section('title', 'Sign Up')

@section('content')

    <div class="account-page">
        <div class="container">
            <div class="row" style="justify-content: center;"> 
                
                <div class="col-2" style="flex-basis: 400px;"> 
                    <div class="form-container">
                        <h3>Register (New Customer)</h3>
                        
                        <form method="POST" action="{{ route('register') }}">
                            @csrf <div style="margin-bottom: 10px;">
                                <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" required autofocus
                                       style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                                <x-input-error :messages="$errors->get('name')" class="mt-2" style="color: red; font-size: 12px;" />
                            </div>

                            <div style="margin-bottom: 10px;">
                                <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required
                                       style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" style="color: red; font-size: 12px;" />
                            </div>
                            
                            <div class="password-box">
                                <input type="password" name="password" id="regPass" placeholder="Create Password" required>
                                <i class="fas fa-eye toggle-password" id="regEye" onclick="togglePassword('regPass', 'regEye')"></i>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" style="color: red; font-size: 12px;" />

                            <div style="margin-bottom: 10px;">
                                <input type="password" name="password_confirmation" placeholder="Confirm Password" required
                                       style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" style="color: red; font-size: 12px;" />
                            </div>
                            
                            <button type="submit" class="btn-primary">Register</button>
                            
                            <div class="switch-link">
                                <br>
                                <p>Already have an account? <a href="{{ route('login') }}" style="color: #ff9f1c; font-weight: bold;">Login here</a></p>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection