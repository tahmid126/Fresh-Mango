@extends('layouts.app')

@section('title', 'About Us')

@section('content')

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    
    
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
       
        .about-page-wrapper {
            font-family: 'Poppins', sans-serif;
            color: #333;
        }
        
        h1, h2, h3 {
            font-family: 'Playfair Display', serif;
        }

        
        .hero-section {
            height: 60vh;
            min-height: 400px;
            
            background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.6)), url('{{ asset('images/back_2.png') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            position: relative;
        }

        .hero-content h1 {
            font-size: 4rem;
            margin-bottom: 10px;
            text-shadow: 2px 2px 10px rgba(0,0,0,0.3);
        }
        
        .hero-content p {
            font-size: 1.2rem;
            font-weight: 300;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

       
        .stats-container {
            display: flex;
            justify-content: space-around;
            padding: 60px 10%;
            background: #fff;
            margin-top: -50px;
            position: relative;
            z-index: 10;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        .stat-item { text-align: center; }
        .stat-number { font-size: 2.5rem; font-weight: 700; color: #ff9f1c; display: block; }
        .stat-label { color: #666; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px; }

       
        .story-section {
            padding: 100px 5%;
            background-color: #fdfdfd;
            overflow: hidden;
        }
        
        .story-container {
            max-width: 1300px; 
            margin: 0 auto; 
            display: flex; 
            align-items: center; 
            gap: 80px; 
            flex-wrap: wrap;
        }

        .story-text h4 { color: #ff9f1c; text-transform: uppercase; letter-spacing: 2px; font-size: 0.9rem; font-weight: 600; margin-bottom: 10px; }
        .story-text h2 { font-size: 3rem; margin-bottom: 30px; line-height: 1.2; }
        .story-text p { color: #555; line-height: 1.8; margin-bottom: 20px; font-size: 1.05rem; }

        
        .garden-section { padding: 100px 5%; background: #f4f5f7; }
        .section-title { text-align: center; margin-bottom: 60px; }
        .section-title h2 { font-size: 3rem; margin-bottom: 15px; }

        .garden-card {
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
        }
        .garden-card:hover { transform: translateY(-10px); }

        .swiper { width: 100%; height: 400px; }
        .swiper-slide img { width: 100%; height: 100%; object-fit: cover; }

        .garden-info { padding: 30px; text-align: center; }
        .garden-info h3 { font-size: 1.8rem; margin-bottom: 10px; }
        .garden-info p { color: #777; display: flex; justify-content: center; align-items: center; gap: 8px; }

       
        .app-section {
            padding: 100px 10%;
            background: #111;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .app-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #ff9f1c; color: white; padding: 15px 40px;
            border-radius: 50px; font-weight: 600; text-decoration: none;
            margin-top: 30px; transition: 0.3s;
        }
        .app-btn:hover { background: #e08e0b; transform: scale(1.05); }

   
        @media (max-width: 768px) {
            .story-section { padding: 60px 5%; }
            .stats-container { flex-wrap: wrap; gap: 20px; padding: 40px 20px; }
            .hero-content h1 { font-size: 2.5rem; }
            .story-text h2, .section-title h2 { font-size: 2.2rem; }
            
         
            .story-img-wrapper { margin: 20px 0 30px 20px !important; }
        }
    </style>

    <div class="about-page-wrapper">

       
        <div class="hero-section">
            <div class="hero-content">
                <h1>Our Heritage</h1>
                <p>Rooted in Rajshahi • Grown with Love</p>
            </div>
        </div>

       
        <div class="stats-container">
            <div class="stat-item">
                <span class="stat-number">2025</span>
                <span class="stat-label">Established</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">100%</span>
                <span class="stat-label">Organic</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">50+</span>
                <span class="stat-label">Premium Gardens</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">1k+</span>
                <span class="stat-label">Happy Clients</span>
            </div>
        </div>

       
        <section class="story-section">
            <div class="story-container">
                
                
            <div class="story-img-wrapper" style="flex: 1; min-width: 350px; position: relative; margin-top: 30px; margin-left: 30px;">
                
                
                <img src="{{ asset('images/who-we-are.jpg') }}" 
                     onerror="this.src='https://images.unsplash.com/photo-1601493700631-2b16ec4b4716?q=80&w=1000&auto=format&fit=crop'" 
                     alt="Who We Are" 
                     style="width: 100%; height: auto; border-radius: 20px; box-shadow: 0 20px 50px rgba(0,0,0,0.2); display: block; object-fit: cover;">
            </div>
                
                <div class="story-text" style="flex: 1; min-width: 300px;">
                    <h4>Who We Are</h4>
                    <h2>Purveyors of the Finest Mangoes</h2>
                    <p>
                        Fresh Mango started with a simple yet powerful vision: to deliver the authentic, chemical-free taste of Rajshahi mangoes to every home in Bangladesh.
                    </p>
                    <p>
                        We don't just sell fruits; we deliver an experience. From our heritage gardens in Chapainawabganj to your doorstep, every step is monitored to ensure safety, sweetness, and premium quality.
                    </p>
                    <div style="margin-top: 20px; font-style: italic; border-left: 3px solid #ff9f1c; padding-left: 15px; color: #777;">
                        "Our mission is simple: No Chemicals, No Compromise."
                    </div>
                </div>

            </div>
        </section>

        
        <section class="garden-section">
            <div class="section-title">
                <h2>Our Gardens</h2>
                <p>Take a glimpse into where the magic happens</p>
            </div>

            @if($gardens->isEmpty())
                <div style="text-align: center; color: #999; padding: 50px;">
                    <p>No gardens added yet.</p>
                </div>
            @else
                <div class="garden-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 40px; max-width: 1300px; margin: 0 auto;">
                    
                    @foreach($gardens as $garden)
                        <div class="garden-card">
                           
                            <div class="swiper mySwiper-{{ $garden->id }}">
                                <div class="swiper-wrapper">
                                    @if(is_array($garden->image))
                                        @foreach($garden->image as $img)
                                            <div class="swiper-slide">
                                                <img src="{{ asset('storage/' . $img) }}" alt="{{ $garden->name }}">
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="swiper-slide">
                                            <img src="{{ asset('storage/' . $garden->image) }}" alt="{{ $garden->name }}">
                                        </div>
                                    @endif
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-pagination"></div>
                            </div>
                            
                            
                            <div class="garden-info">
                                <h3>{{ $garden->name }}</h3>
                                <p><i class="fas fa-map-marker-alt" style="color: #ff9f1c;"></i> {{ $garden->address }}</p>
                            </div>
                        </div>
                    @endforeach

                </div>
            @endif
        </section>

       
        <section class="app-section">
            <div class="app-content">
                <h2 style="font-size: 3rem; margin-bottom: 20px;">Experience Freshness</h2>
                <p style="font-size: 1.1rem; max-width: 600px; margin: 0 auto 40px; opacity: 0.8;">
                    Download our app to order exclusive varieties before they run out of stock.
                </p>
                
                <div style="max-width: 800px; margin: 0 auto; border-radius: 20px; overflow: hidden; box-shadow: 0 20px 50px rgba(255,255,255,0.1);">
                    <video autoplay muted loop style="width: 100%; display: block;">
                        <source src="{{ asset('images/1.mp4') }}" type="video/mp4">
                    </video>
                </div>

                <a href="#" class="app-btn">
                    <i class="fab fa-apple" style="font-size: 24px;"></i> Download Our App
                </a>
            </div>
        </section>

    </div>

   
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.querySelectorAll('.swiper').forEach(function(swiperContainer) {
            new Swiper(swiperContainer, {
                loop: true,
                effect: "fade",
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: swiperContainer.querySelector('.swiper-button-next'),
                    prevEl: swiperContainer.querySelector('.swiper-button-prev'),
                },
                pagination: {
                    el: swiperContainer.querySelector('.swiper-pagination'),
                    clickable: true,
                },
            });
        });
    </script>

@endsection