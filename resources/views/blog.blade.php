@extends('layouts.app')

@section('title', 'Blog')

@section('content')

   
    <div class="relative" style="height: 220px; background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.6)), url('{{ asset('images/back_2.png') }}'); background-size: cover; background-position: center; display: flex; align-items: center; justify-content: center; text-align: center; color: white;">
        <div>
            <h1 style="font-size: 2.5rem; font-weight: 800; letter-spacing: 1px; text-transform: uppercase; margin: 0;">Read More</h1>
            <p style="font-size: 1rem; opacity: 0.9; font-weight: 300; margin-top: 5px;">Explore the latest stories about our mangoes</p>
        </div>
    </div>
    
    <section class="blog-section">
        <div class="container">
            
            @if($blogs->isEmpty())
                <div style="text-align: center; padding: 50px; color: #888;">
                    <i class="fas fa-newspaper" style="font-size: 40px; margin-bottom: 15px; color: #ddd;"></i>
                    <p style="font-size: 18px;">No blog posts available yet.</p>
                </div>
            @else
                @foreach($blogs as $blog)
                    <div class="blog-card">
                        <div class="blog-image">
                            <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
                            <div class="date-badge">{{ $blog->created_at->format('d M') }}</div>
                        </div>
                        
                        <div class="blog-details">
                            <h4>{{ $blog->title }}</h4>
                            
                            <div class="blog-desc">
                                {!! Str::limit(strip_tags($blog->content), 200) !!}
                            </div>

                            
                            <a href="#" class="read-more">
                                Continue Reading <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
    </section>
    
    
    

   
    <style>
        
        .blog-section {
            padding: 60px 0;
            background-color: #fff;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 20px;
        }

      
        .blog-card {
            display: flex;
            align-items: center;
            background: #fff;
            border: 1px solid #eee;
            border-radius: 15px;
            overflow: hidden;
            margin-bottom: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: transform 0.3s ease;
        }
        .blog-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }

       
        .blog-image {
            width: 45%;
            height: 320px;
            position: relative;
            overflow: hidden;
            background: #f9f9f9;
        }
        .blog-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .blog-card:hover .blog-image img {
            transform: scale(1.1);
        }

        
        .date-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            background: rgba(255, 255, 255, 0.9);
            padding: 8px 15px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 800;
            color: #333;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            text-transform: uppercase;
        }

       
        .blog-details {
            width: 55%;
            padding: 40px;
        }
        .blog-details h4 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #222;
            margin-bottom: 15px;
            line-height: 1.3;
        }
        .blog-desc {
            font-size: 1rem;
            color: #666;
            line-height: 1.7;
            margin-bottom: 25px;
        }

        
        .read-more {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            color: #fff; 
            text-transform: uppercase;
            letter-spacing: 1px;
            
            padding: 12px 30px; 
            border-radius: 50px; 

            
            background: linear-gradient(rgba(0,0,0,0.2), rgba(0,0,0,0.4)), url('{{ asset("images/btn-bg.jpg") }}');
            background-size: cover;
            background-position: center;
            
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .read-more i {
            transition: transform 0.3s;
        }

        .read-more:hover {
            color: #fff;
            transform: translateY(-3px); 
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }
        
        .read-more:hover i {
            transform: translateX(5px); 
        }

       //mobile view
        @media (max-width: 768px) {
            .blog-section { padding: 30px 0; }
            
            .blog-card {
                flex-direction: column; 
                margin-bottom: 30px;
                border-radius: 12px;
            }

            .blog-image {
                width: 100%;
                height: 220px; 
            }

            .blog-details {
                width: 100%;
                padding: 25px; 
            }

            .blog-details h4 {
                font-size: 1.4rem; 
                margin-bottom: 10px;
            }

            .blog-desc {
                font-size: 0.95rem;
                margin-bottom: 20px;
                display: -webkit-box;
                -webkit-line-clamp: 3; 
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
            
            .page-header { padding: 40px 20px !important; }
            .page-header h2 { font-size: 2.2rem !important; }
        }
    </style>
    
    

@endsection