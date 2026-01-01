<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Fresh Mango - @yield('title')</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    
</head>
<body>

    <!-- Header Section -->
    <header>
        <div class="logo">
            <h1>🥭 Fresh Mango</h1>
        </div>
        
        <nav>
            <ul id="navbar" class="nav-links">
                <a href="#" id="close-btn"><i class="fas fa-times"></i></a>
                
                <!-- ১. সাধারণ পেজগুলো (বাম দিকে থাকবে) -->
                <li><a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('shop') }}" class="{{ Request::is('shop') ? 'active' : '' }}">Shop</a></li>
                <li><a href="{{ route('blog') }}" class="{{ Request::is('blog') ? 'active' : '' }}">Blog</a></li>
                <li><a href="{{ route('about') }}" class="{{ Request::is('about') ? 'active' : '' }}">About Us</a></li>
                <li><a href="{{ route('contact') }}" class="{{ Request::is('contact') ? 'active' : '' }}">Contact</a></li>
                
                <!-- ২. My Account লিংক (এখন সবার শেষে/কার্টের পাশে আনা হয়েছে) -->
                <!-- ২. My Account লিংক -->
@auth
    <!-- লজিক: ইউজার যদি 'seller.register' বা 'become-seller' লিংকে না থাকে, তবেই দেখাবে -->
    @if(!request()->routeIs('seller.register') && !request()->is('become-seller'))
        <li>
            <a href="{{ route('dashboard') }}" 
               class="{{ Request::is('dashboard') ? 'active' : '' }}" 
               style="color: #ff9f1c; font-weight: bold;">
               My Account
            </a>
        </li>
    @endif
@endauth

                <!-- ৩. মোবাইল কার্ট -->
                <li id="mobile-bag">
                    <a href="{{ route('cart') }}" class="{{ Request::is('cart') ? 'active' : '' }}">
                        <i class="fas fa-shopping-cart"></i> Cart
                    </a>
                </li>
                
                <!-- ৪. মোবাইল লগিন/লগআউট -->
                @auth
                    <li id="mobile-login">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" style="background:none; border:none; color: inherit; font-size: inherit; font-weight: inherit; cursor: pointer;">Logout</button>
                        </form>
                    </li>
                @else
                    <li id="mobile-login"><a href="{{ route('login') }}" class="{{ Request::is('login') ? 'active' : '' }}">Login</a></li>
                @endauth
            </ul>
        </nav>

        <div class="nav-icons mobile-header-icons">
            <a href="{{ route('cart') }}"><i class="fas fa-shopping-cart"></i></a>
            
            <!-- ইউজার আইকন (লগিন থাকলে ড্যাশবোর্ডে যাবে) -->
            @auth
                <a href="{{ route('dashboard') }}"><i class="fas fa-user" style="color: #ff9f1c;"></i></a>
            @else
                <a href="{{ route('login') }}"><i class="fas fa-user"></i></a>
            @endauth

            <i id="bar" class="fas fa-bars"></i>
        </div>
    </header>

    <!-- Main Content Area -->
    <main>
        @yield('content')
        {{ $slot ?? '' }} 
    </main>

    
    <!-- Footer Section -->
    <footer>
        <div class="footer-content" style="display: flex; justify-content: space-between; flex-wrap: wrap; padding: 40px 8%; background-color: #222; color: white;">
            
            <!-- 1. Logo & Slogan -->
            <div class="footer-section" style="flex: 1; min-width: 250px; margin-bottom: 20px;">
                <h3 style="color: #ff9f1c; font-size: 24px; margin-bottom: 15px;">🥭 Fresh Mango</h3>
                <p style="color: #bbb; font-size: 14px; line-height: 1.6;">Bringing the authentic sweetness of Rajshahi directly to your doorstep. Chemical-free & Premium Quality Guaranteed.</p>
            </div>

            <!-- 2. Quick Links -->
            <div class="footer-section" style="flex: 1; min-width: 200px; margin-bottom: 20px;">
                <h3 style="color: #fff; font-size: 18px; margin-bottom: 15px;">Quick Links</h3>
                <ul style="list-style: none; padding: 0;">
                    <li style="margin-bottom: 8px;"><a href="{{ route('shop') }}" style="color: #bbb; text-decoration: none; transition: 0.3s;">Shop Now</a></li>
                    <li style="margin-bottom: 8px;"><a href="{{ route('about') }}" style="color: #bbb; text-decoration: none; transition: 0.3s;">About Us</a></li>
                    <li style="margin-bottom: 8px;"><a href="{{ route('contact') }}" style="color: #bbb; text-decoration: none; transition: 0.3s;">Contact Support</a></li>
                </ul>
            </div>

            <!-- 3. Social Media -->
            <div class="footer-section" style="flex: 1; min-width: 200px; margin-bottom: 20px;">
                <h3 style="color: #fff; font-size: 18px; margin-bottom: 15px;">Follow Us</h3>
                <div class="socials" style="display: flex; gap: 15px;">
                    <a href="#" style="color: #fff; font-size: 20px; background: #3b5998; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 50%;"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" style="color: #fff; font-size: 20px; background: #E1306C; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 50%;"><i class="fab fa-instagram"></i></a>
                    {{-- <a href="#" style="color: #fff; font-size: 20px; background: #25D366; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 50%;"><i class="fab fa-whatsapp"></i></a> --}}
                </div>
            </div>

            <!-- 4. Become a Seller (New & Highlighted) -->
            <div class="footer-section" style="flex: 1; min-width: 250px; margin-bottom: 20px;">
                <h3 style="color: #fff; font-size: 18px; margin-bottom: 15px;">Grow with Us</h3>
                <p style="color: #bbb; font-size: 13px; margin-bottom: 15px;">Are you a mango farmer? Join us and sell your products directly to customers.</p>
                
                <a href="{{ route('seller.register') }}" 
                   style="display: inline-block; padding: 12px 25px; background: linear-gradient(45deg, #ff9f1c, #e67e22); color: white; text-decoration: none; font-weight: bold; border-radius: 50px; box-shadow: 0 4px 15px rgba(255, 159, 28, 0.4); transition: transform 0.3s;">
                    <i class="fas fa-store"></i> Become a Seller
                </a>
            </div>

        </div>
        
        <!-- Copyright -->
        <div class="footer-bottom" style="text-align: center; padding: 20px; background-color: #1a1a1a; color: #888; font-size: 13px; border-top: 1px solid #333;">
            <p>&copy; 2025 Fresh Mango. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('script.js') }}"></script>
    
    <a href="https://wa.me/8801754831778" class="whatsapp-btn" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

</body>
</html>