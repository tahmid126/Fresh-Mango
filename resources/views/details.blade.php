@extends('layouts.app')

@section('title', $product->name)

@section('content')

    
    <section class="pro-details-container" style="padding: 60px 10%; background-color: #fff;">
        <div class="container" style="max-width: 1200px; margin: 0 auto; display: flex; flex-wrap: wrap; gap: 50px; align-items: flex-start;">
            
            
            <div class="single-pro-image" style="flex: 1; min-width: 350px;">
                <div style="border: 1px solid #eee; border-radius: 15px; overflow: hidden; padding: 20px; background: #fcfcfc;">
                    <img src="{{ Str::startsWith($product->image, 'images/') ? asset($product->image) : asset('storage/' . $product->image) }}" 
                         width="100%" 
                         id="MainImg" 
                         alt="{{ $product->name }}" 
                         style="border-radius: 10px; object-fit: cover; width: 100%; height: auto;">
                </div>
            </div>

          
            <div class="single-pro-details" style="flex: 1; min-width: 350px;">
                <h6 style="color: #888; font-size: 14px; margin-bottom: 10px;">Home / Shop / {{ $product->category }}</h6>
                
                <h4 style="font-size: 32px; font-weight: 700; color: #222; margin-bottom: 10px;">{{ $product->name }}</h4>
                
                <h2 style="font-size: 28px; color: #ff9f1c; font-weight: 800; margin-bottom: 20px;">{{ $product->price }} ৳ <span style="font-size: 16px; color: #666; font-weight: 400;">/kg</span></h2>
                
                <div class="stock-status" style="margin-bottom: 25px;">
                    <span class="badge" style="background: #e8f5e9; color: #2e7d32; padding: 6px 12px; border-radius: 5px; font-weight: 700; font-size: 13px;">In Stock</span>
                </div>

                
                <div class="buy-controls" style="margin-bottom: 30px; display: flex; gap: 15px; align-items: center;">
                    <input type="number" id="qtyVal" value="1" min="1" max="50" 
                           style="padding: 12px; width: 80px; border: 1px solid #ccc; border-radius: 5px; text-align: center; font-size: 16px; font-weight: 600;">
                    
                    <button class="btn-primary" 
                            onclick="addDetailsItem()"
                            style="padding: 12px 30px; background: #3a5a40; border: none; color: white; border-radius: 5px; cursor: pointer; font-weight: 700; font-size: 16px; transition: 0.3s;">
                        Add To Cart <i class="fas fa-shopping-bag" style="margin-left: 5px;"></i>
                    </button>
                </div>

                <h4 style="font-size: 18px; font-weight: 700; margin-bottom: 15px; color: #333;">Product Details</h4>
                <div style="line-height: 1.8; color: #555; font-size: 15px;">
                    {!! nl2br(e($product->description ?? 'No description available.')) !!}
                    <br><br>
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 8px;"><i class="fas fa-check-circle" style="color: #3a5a40;"></i> 100% Formalin Free</li>
                        <li style="margin-bottom: 8px;"><i class="fas fa-check-circle" style="color: #3a5a40;"></i> Naturally Ripened</li>
                        <li style="margin-bottom: 8px;"><i class="fas fa-check-circle" style="color: #3a5a40;"></i> Direct from Garden</li>
                        <li style="margin-bottom: 8px;"><i class="fas fa-check-circle" style="color: #3a5a40;"></i> Cash on Delivery Available</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    
    <section class="products" style="padding: 60px 5%; background: #f9fafb;">
        <div style="text-align: center; margin-bottom: 50px;">
            <h2 class="section-title" style="font-size: 28px; color: #222; font-weight: 800;">You May Also Like</h2>
            <div style="width: 60px; height: 3px; background: #ff9f1c; margin: 15px auto;"></div>
        </div>

        <div class="product-container" style="max-width: 1400px; margin: 0 auto;">
          
            <div class="product-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;">
                
                @foreach($related as $relProduct)
                    <div class="product-card" style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.03); border: 1px solid #eee; transition: all 0.3s ease;">
                        
                        <div class="image-container" style="position: relative; height: 220px; overflow: hidden; background: #f9f9f9;">
                            <a href="{{ route('product.details', $relProduct->id) }}">
                                <img src="{{ Str::startsWith($relProduct->image, 'images/') ? asset($relProduct->image) : asset('storage/' . $relProduct->image) }}" 
                                     alt="{{ $relProduct->name }}"
                                     style="width: 100%; height: 100%; object-fit: cover;">
                            </a>
                        </div>
                        
                        <div class="info" style="padding: 15px; text-align: center;">
                            <a href="{{ route('product.details', $relProduct->id) }}" style="text-decoration: none; color: inherit;">
                                <h3 style="font-size: 16px; font-weight: 600; color: #333; margin-bottom: 10px;">{{ $relProduct->name }}</h3>
                            </a>
                            <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #eee; padding-top: 10px;">
                                <span style="font-size: 16px; font-weight: 700; color: #ff9f1c;">{{ $relProduct->price }} ৳</span>
                                <button onclick="addToCart('{{ $relProduct->id }}', '{{ $relProduct->name }}', {{ $relProduct->price }}, '{{ Str::startsWith($relProduct->image, 'images/') ? asset($relProduct->image) : asset('storage/' . $relProduct->image) }}')"
                                        style="padding: 6px 12px; background: #3a5a40; color: white; border: none; border-radius: 4px; font-size: 12px; cursor: pointer;">
                                    Add
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>


    <script>
        function addDetailsItem() {
            
            const qtyInput = document.getElementById('qtyVal').value;
            const quantity = parseInt(qtyInput);

           
            const id = '{{ $product->id }}';
            const name = '{{ $product->name }}';
            const price = {{ $product->price }};
            const img = '{{ Str::startsWith($product->image, 'images/') ? asset($product->image) : asset('storage/' . $product->image) }}';

         
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let existingProduct = cart.find(item => item.id === id);

            if (existingProduct) {
                
                existingProduct.quantity = parseInt(existingProduct.quantity) + quantity;
            } else {
               
                cart.push({ id, name, price, img, quantity: quantity });
            }

            localStorage.setItem('cart', JSON.stringify(cart));
            
            
            alert(name + " (" + quantity + " kg) added to cart!");
            
            
        }
    </script>
    
    
    <style>
        @media (max-width: 992px) {
            .product-grid { grid-template-columns: repeat(3, 1fr) !important; }
        }
        @media (max-width: 768px) {
            .container { flex-direction: column; }
            .single-pro-image, .single-pro-details { width: 100%; min-width: 100%; }
            .product-grid { grid-template-columns: repeat(2, 1fr) !important; gap: 10px !important; }
            .buy-controls { justify-content: center; }
            .single-pro-details { text-align: center; }
            ul { text-align: left; display: inline-block; }
        }
    </style>

@endsection