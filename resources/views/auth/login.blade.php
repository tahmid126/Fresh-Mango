@extends('layouts.app')

@section('title', 'Login')

@section('content')

    <div class="account-page" style="min-height: 80vh; display: flex; align-items: center; background: #f9f9f9;">
        <div class="container">
            <div class="row" style="justify-content: center;"> 
                
                <div class="col-2" style="flex-basis: 400px;"> 
                    <div class="form-container">
                        <h3>Login</h3>
                        
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div style="margin-bottom: 15px;">
                                <input type="email" name="email" placeholder="Username or Email" value="{{ old('email') }}" required autofocus
                                    style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" style="color: red; font-size: 12px;" />
                            </div>

                            <div class="password-box">
                                <input type="password" name="password" id="loginPass" placeholder="Password" required>
                                <i class="fas fa-eye toggle-password" id="loginEye" onclick="togglePassword('loginPass', 'loginEye')"></i>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" style="color: red; font-size: 12px;" />
                            
                            <button type="submit" class="btn-primary">Login</button>
                            
                           <!-- Links -->
                            <div class="switch-link">
                                
                                <!-- Forgot Password Link (Fixed) -->
                                <a href="{{ route('password.request') }}" style="color: #555; font-size: 13px;">Forgot Password?</a>
                                
                                <br><br>
                                
                                <!-- OR Divider -->
                                <div class="or-divider">
                                    <span>or</span>
                                </div>  
                                
                                <!-- Register Link -->
                                <p>New here? <a href="{{ route('register') }}" style="color: #ff9f1c; font-weight: bold;">Create an Account</a></p>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection