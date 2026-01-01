@extends('layouts.app')

@section('title', 'Home')

@section('content')

    <!-- Hero Section (Updated: Height Increased) -->
    <div class="hero-wrapper" style="background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.5)), url('{{ asset('images/back_2.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="hero-content">
            <h1>Fresh & Organic Mangoes</h1>
            <p>Directly from Rajshahi gardens to your home. 100% Chemical Free.</p>
            <a href="{{ route('shop') }}" class="hero-btn">Shop Now</a>
        </div>
    </div>

    <!-- Features Section -->
    <section class="section-container">
        <div class="features-grid">
            <div class="feature-item">
                <div class="icon-box"><i class="fas fa-leaf"></i></div>
                <h3>100% Organic</h3>
                <p>Naturally ripened, chemical-free mangoes.</p>
            </div>
            <div class="feature-item">
                <div class="icon-box"><i class="fas fa-truck-fast"></i></div>
                <h3>Fast Delivery</h3>
                <p>Delivery within 24-48 hours nationwide.</p>
            </div>
            <div class="feature-item">
                <div class="icon-box"><i class="fas fa-star"></i></div>
                <h3>Premium Quality</h3>
                <p>Hand-picked best quality guaranteed.</p>
            </div>
        </div>
    </section>

   
    <section class="section-container product-section">
        <div class="section-header">
            <h2>Best Sellers</h2>
            <div class="divider"></div>
            <p>Customer favorites this season</p>
        </div>

        <div class="product-grid">
            @foreach($products as $product)
                <div class="product-card">
                    <div class="image-box">
                        @if(strtolower($product->category) === 'premium')
                            <span class="badge">Premium</span>
                        @endif
                        
                        <a href="{{ route('product.details', $product->id) }}">
                            <img src="{{ Str::startsWith($product->image, 'images/') ? asset($product->image) : asset('storage/' . $product->image) }}" 
                                 alt="{{ $product->name }}">
                        </a>
                    </div>

                    <div class="details">
                        <a href="{{ route('product.details', $product->id) }}" class="product-title">{{ $product->name }}</a>
                        
                        <div class="price-action">
                            <span class="price">{{ $product->price }} ৳ <small>/kg</small></span>
                            
                            <button class="cart-btn" 
                                onclick="addToCart('{{ $product->id }}', '{{ $product->name }}', {{ $product->price }}, '{{ Str::startsWith($product->image, 'images/') ? asset($product->image) : asset('storage/' . $product->image) }}')">
                                <i class="fas fa-cart-plus"></i> Add
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div style="text-align: center; margin-top: 40px;">
             <a href="{{ route('shop') }}" class="view-all-btn">View All Products</a>
        </div>
    </section>

  
    <style>
        
        .section-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 60px 20px;
        }

        
        .hero-wrapper {
            height: 600px; 
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
        }
        .hero-content h1 { font-size: 4rem; font-weight: 800; margin-bottom: 15px; text-transform: uppercase; }
        .hero-content p { font-size: 1.4rem; margin-bottom: 30px; font-weight: 300; }
        .hero-btn { padding: 14px 40px; background: #ff9f1c; color: white; border-radius: 50px; font-weight: 700; text-decoration: none; transition: 0.3s; font-size: 1.1rem; }
        .hero-btn:hover { background: #e08e0b; transform: scale(1.05); }

        
        .features-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px; }
        .feature-item { text-align: center; padding: 30px; background: white; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); border: 1px solid #eee; }
        .icon-box { width: 60px; height: 60px; background: #f4f9f4; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; color: #3a5a40; font-size: 24px; }
        .feature-item h3 { font-size: 18px; margin-bottom: 10px; }

        
        .product-section { background-color: #f8f9fa; }
        .section-header { text-align: center; margin-bottom: 50px; }
        .section-header h2 { font-size: 32px; font-weight: 800; color: #333; margin-bottom: 10px; }
        .divider { width: 60px; height: 4px; background: #ff9f1c; margin: 0 auto 10px; border-radius: 2px; }

        
        .product-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr); 
            gap: 25px;
        }

      
        .product-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s;
            border: 1px solid #eee;
        }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.1); }

        .image-box { position: relative; height: 240px; overflow: hidden; background: #f9f9f9; }
        .image-box img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }
        .product-card:hover .image-box img { transform: scale(1.08); }
        
        .badge { position: absolute; top: 10px; left: 10px; background: #ff9f1c; color: white; padding: 4px 10px; font-size: 11px; font-weight: 700; border-radius: 4px; z-index: 2; }

        .details { padding: 15px; }
        .product-title { display: block; font-size: 16px; font-weight: 700; color: #333; text-decoration: none; margin-bottom: 10px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        
        .price-action { display: flex; justify-content: space-between; align-items: center; }
        .price { font-size: 18px; font-weight: 700; color: #ff9f1c; }
        .cart-btn { padding: 8px 15px; background: #3a5a40; color: white; border: none; border-radius: 6px; font-size: 13px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 5px; transition: 0.2s; }
        .cart-btn:hover { background: #273c2b; }

        .view-all-btn { display: inline-block; padding: 12px 30px; border: 2px solid #333; color: #333; text-decoration: none; font-weight: 700; border-radius: 50px; transition: 0.3s; }
        .view-all-btn:hover { background: #333; color: white; }

        
        @media (max-width: 1024px) {
            .product-grid { grid-template-columns: repeat(3, 1fr); }
            .hero-wrapper { height: 500px; } 
        }
        
        @media (max-width: 768px) {
            .hero-content h1 { font-size: 2.5rem; }
            .product-grid { 
                grid-template-columns: repeat(2, 1fr); 
                gap: 10px;
            }
            .image-box { height: 180px; }
            .cart-btn { padding: 6px 10px; font-size: 12px; }
            .cart-btn i { display: none; } 
            .hero-wrapper { height: 400px; } 
        }

        @media (max-width: 480px) {
            .section-container { padding: 40px 15px; }
            .product-title { font-size: 14px; }
            .price { font-size: 16px; }
        }
    </style>

@endsection