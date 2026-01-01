@extends('layouts.app')

@section('title', 'Shop')

@section('content')

    <
    <div class="relative" style="height: 220px; background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.6)), url('{{ asset('images/back_2.png') }}'); background-size: cover; background-position: center; display: flex; align-items: center; justify-content: center; text-align: center; color: white;">
        <div>
            <h1 style="font-size: 2.5rem; font-weight: 800; letter-spacing: 1px; text-transform: uppercase; margin: 0;">Shop</h1>
            <p style="font-size: 1rem; opacity: 0.9; font-weight: 300; margin-top: 5px;">Freshness Delivered to Your Doorstep</p>
        </div>
    </div>

 
    <section class="shop-section" style="padding: 30px 0; background-color: #f4f6f8;">
        <div class="shop-container">
            
            <aside class="sidebar">
                <div style="padding: 20px;">
                    <div style="border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 20px;">
                        <h3 style="font-size: 14px; font-weight: 800; color: #333; text-transform: uppercase; margin: 0;">Filters</h3>
                    </div>
                    
        
                    <div class="filter-group">
                        <h4 style="font-size: 13px; font-weight: 600; margin-bottom: 10px; color: #555;">Category</h4>
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            <li><label><input type="checkbox" class="category-filter" value="premium" onclick="filterProducts()"> Premium</label></li>
                            <li><label><input type="checkbox" class="category-filter" value="regular" onclick="filterProducts()"> Regular</label></li>
                            <li><label><input type="checkbox" class="category-filter" value="green" onclick="filterProducts()"> Green Mangoes</label></li>
                        </ul>
                    </div>

                   
                    <div class="filter-group" style="margin-top: 25px;">
                        <h4 style="font-size: 13px; font-weight: 600; margin-bottom: 10px; color: #555;">Price Range</h4>
                        <div style="display: flex; gap: 5px; align-items: center;">
                            <input type="number" id="minPrice" value="" placeholder="Min" onkeyup="filterProducts()" class="price-input">
                            <span style="color: #aaa;">-</span>
                            <input type="number" id="maxPrice" value="" placeholder="Max" onkeyup="filterProducts()" class="price-input">
                        </div>
                    </div>
                </div>
            </aside>

           
            <main class="product-content">
               
                <div class="product-grid">
                    @foreach($products as $product)
                        <div class="product-card" 
                             data-category="{{ strtolower($product->category) }}" 
                             data-price="{{ $product->price }}">
                            
                          
                            <div class="image-container">
                                @if(strtolower($product->category) === 'premium')
                                    <span class="badge">Premium</span>
                                @endif
                                
                                <a href="{{ route('product.details', $product->id) }}">
                                    <img src="{{ Str::startsWith($product->image, 'images/') ? asset($product->image) : asset('storage/' . $product->image) }}" 
                                         alt="{{ $product->name }}">
                                </a>
                            </div>

                            
                            <div class="info">
                                <a href="{{ route('product.details', $product->id) }}">
                                    <h3>{{ $product->name }}</h3>
                                </a>
                                
                               
                                <div class="action-area">
                                    <span class="price">{{ $product->price }} ৳ <span class="unit">/kg</span></span>
                                    
                                    
                                    <button class="add-btn" 
                                            onclick="addToCart('{{ $product->id }}', '{{ $product->name }}', {{ $product->price }}, '{{ Str::startsWith($product->image, 'images/') ? asset($product->image) : asset('storage/' . $product->image) }}')">
                                        <i class="fas fa-shopping-bag"></i> Add
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
               
                <div id="noResults" style="display: none; text-align: center; padding: 50px; width: 100%;">
                    <h3 style="color: #9ca3af; font-weight: 400; font-size: 16px;">No products found.</h3>
                </div>
            </main>
        </div>
    </section>

   
    <style>
      
        .shop-container {
            display: flex;
            max-width: 1600px; 
            margin: 0 auto;
            padding: 0 20px;
            gap: 20px;
        }

        
        .sidebar {
            flex-basis: 200px;
            min-width: 200px;
            background: #fff;
            border: 1px solid #eee;
            border-radius: 8px;
            height: fit-content;
            position: sticky;
            top: 20px;
        }
        .filter-group ul li { margin-bottom: 8px; font-size: 13px; color: #555; }
        .filter-group label { cursor: pointer; display: flex; align-items: center; gap: 8px; transition: color 0.2s; }
        .filter-group label:hover { color: #ff9f1c; }
        .filter-group input[type="checkbox"] { accent-color: #ff9f1c; width: 14px; height: 14px; }
        .price-input { width: 100%; padding: 6px; border: 1px solid #ddd; border-radius: 4px; font-size: 12px; text-align: center; outline: none; }
        .price-input:focus { border-color: #ff9f1c; }

      
        .product-content { flex: 1; }

        
        .product-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr); 
            gap: 15px;
        }

        
        .product-card {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }
        
        .product-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            border-color: #ff9f1c;
        }

        
        .image-container {
            position: relative;
            height: 200px;
            overflow: hidden;
            background: #f9fafb;
            border-bottom: 1px solid #f3f4f6;
        }
        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .product-card:hover .image-container img {
            transform: scale(1.08);
        }

        .badge {
            position: absolute; top: 8px; left: 8px;
            background: #ff9f1c; color: white;
            padding: 2px 8px; font-size: 10px;
            text-transform: uppercase; font-weight: 700;
            border-radius: 3px; z-index: 2;
        }

       
        .info {
            padding: 12px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex-grow: 1;
        }

        .info h3 {
            font-size: 14px;
            font-weight: 600; color: #1f2937;
            margin: 0 0 10px 0; text-decoration: none;
            line-height: 1.3;
            white-space: nowrap; 
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .info a { text-decoration: none; color: inherit; }

   
        .action-area {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto; 
        }
        
        .price { font-size: 15px; font-weight: 700; color: #333; }
        .unit { font-size: 11px; color: #999; font-weight: 400; }

        
        .add-btn {
            background: #3a5a40; 
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: 0.2s;
        }
        .add-btn:hover {
            background: #253528;
        }
        .add-btn i { font-size: 11px; }

       
        @media (max-width: 1400px) { 
            .product-grid { grid-template-columns: repeat(4, 1fr); } 
        }
        @media (max-width: 1100px) { 
            .product-grid { grid-template-columns: repeat(3, 1fr); } 
        }
        @media (max-width: 900px) {
            .shop-container { flex-direction: column; }
            .sidebar { width: 100%; flex-basis: auto; margin-bottom: 20px; position: static; }
            .product-grid { grid-template-columns: repeat(3, 1fr); }
        }
        @media (max-width: 600px) {
            .product-grid { grid-template-columns: repeat(2, 1fr); gap: 10px; }
            .image-container { height: 160px; }
            .info h3 { font-size: 13px; }
            .price { font-size: 14px; }
            .add-btn { padding: 5px 10px; font-size: 11px; }
        }
    </style>

   
    <script>
        function filterProducts() {
            let minPrice = document.getElementById('minPrice').value ? parseInt(document.getElementById('minPrice').value) : 0;
            let maxPrice = document.getElementById('maxPrice').value ? parseInt(document.getElementById('maxPrice').value) : 100000;
            
            let selectedCategories = [];
            document.querySelectorAll('.category-filter:checked').forEach(checkbox => {
                selectedCategories.push(checkbox.value.toLowerCase());
            });

            let products = document.querySelectorAll('.product-card');
            let hasVisibleProduct = false;

            products.forEach(product => {
                let price = parseInt(product.getAttribute('data-price'));
                let category = product.getAttribute('data-category').toLowerCase();

                let priceMatch = price >= minPrice && price <= maxPrice;
                let categoryMatch = selectedCategories.length === 0 || selectedCategories.includes(category);
                
                if (selectedCategories.length > 0 && !categoryMatch) {
                    if (selectedCategories.includes('green') && category.includes('green')) {
                        categoryMatch = true;
                    }
                }

                if (priceMatch && categoryMatch) {
                    product.style.display = 'flex';
                    hasVisibleProduct = true;
                } else {
                    product.style.display = 'none';
                }
            });

            let noResults = document.getElementById('noResults');
            noResults.style.display = hasVisibleProduct ? 'none' : 'block';
        }
    </script>

@endsection