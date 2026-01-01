@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')

 
    
    <div class="relative" style="height: 220px; background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.6)), url('{{ asset('images/back_2.png') }}'); background-size: cover; background-position: center; display: flex; align-items: center; justify-content: center; text-align: center; color: white;">
        <div>
            <h1 style="font-size: 2.5rem; font-weight: 800; letter-spacing: 1px; text-transform: uppercase; margin: 0;">CONTACT US</h1>
            <p style="font-size: 1rem; opacity: 0.9; font-weight: 300; margin-top: 5px;">We love to hear from you</p>
        </div>
    </div>
    
    <section class="contact-section" style="padding: 50px 10%;">
        <div class="row" style="display: flex; justify-content: space-between; flex-wrap: wrap;">
            
            
            <div class="contact-details" style="flex-basis: 40%; margin-bottom: 30px;">
                <h3 style="margin-bottom: 20px; font-size: 26px;">Get in Touch</h3>
                <p>Visit our garden or contact us for fresh mangoes.</p>
                
                <div class="info-box" style="display: flex; align-items: center; margin-bottom: 25px;">
                    <i class="fas fa-map-marker-alt" style="font-size: 24px; color: #ff9f1c; margin-right: 20px;"></i>
                    <span>
                        <h5 style="font-size: 16px; margin-bottom: 5px;">Address</h5>
                        <p style="color: #666; font-size: 14px;">Mango Garden Road, Rajshahi, Bangladesh</p>
                    </span>
                </div>

                <div class="info-box" style="display: flex; align-items: center; margin-bottom: 25px;">
                    <i class="fas fa-envelope" style="font-size: 24px; color: #ff9f1c; margin-right: 20px;"></i>
                    <span>
                        <h5 style="font-size: 16px; margin-bottom: 5px;">Email</h5>
                        <p style="color: #666; font-size: 14px;">support@freshmango.com</p>
                    </span>
                </div>

                <div class="info-box" style="display: flex; align-items: center; margin-bottom: 25px;">
                    <i class="fas fa-phone-alt" style="font-size: 24px; color: #ff9f1c; margin-right: 20px;"></i>
                    <span>
                        <h5 style="font-size: 16px; margin-bottom: 5px;">Phone</h5>
                        <p style="color: #666; font-size: 14px;">+880 1754831778</p>
                    </span>
                </div>

                <div class="info-box" style="display: flex; align-items: center; margin-bottom: 25px;">
                    <i class="fas fa-clock" style="font-size: 24px; color: #ff9f1c; margin-right: 20px;"></i>
                    <span>
                        <h5 style="font-size: 16px; margin-bottom: 5px;">Hours</h5>
                        <p style="color: #666; font-size: 14px;">10:00 AM - 08:00 PM (Daily)</p>
                    </span>
                </div>
            </div>

           
            <div class="contact-form" style="flex-basis: 55%; background: #fdfdfd; padding: 30px; border: 1px solid #eee; border-radius: 8px;">
                <h3 style="margin-bottom: 20px; font-size: 26px;">Send a Message</h3>

                
                @if(session('success'))
                    <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                        {{ session('success') }}
                    </div>
                @endif

               
                @if($errors->any())
                    <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @auth
                  //. jodi login thake
                    <form action="{{ route('contact.send') }}" method="POST">
                        @csrf
                        
                        //Name (Auto-filled)
                        <div style="margin-bottom: 15px;">
                            <input type="text" name="name" value="{{ Auth::user()->name }}" readonly 
                                   style="width: 100%; padding: 12px 15px; background: #eee; border: 1px solid #ddd; border-radius: 5px; cursor: not-allowed;">
                        </div>

                        //Email (Auto-filled)
                        <div style="margin-bottom: 15px;">
                            <input type="email" name="email" value="{{ Auth::user()->email }}" readonly 
                                   style="width: 100%; padding: 12px 15px; background: #eee; border: 1px solid #ddd; border-radius: 5px; cursor: not-allowed;">
                            <small style="color: #888;">(Sending from your registered email)</small>
                        </div>

                        
                        <div style="margin-bottom: 15px;">
                            <input type="tel" name="phone" value="{{ Auth::user()->phone ?? '' }}" placeholder="Phone Number (017xxxxxxxx)" required 
                                   style="width: 100%; padding: 12px 15px; border: 1px solid #ddd; border-radius: 5px; outline: none;">
                        </div>

                        <div style="margin-bottom: 15px;">
                            <input type="text" name="subject" placeholder="Subject" required 
                                   style="width: 100%; padding: 12px 15px; border: 1px solid #ddd; border-radius: 5px; outline: none;">
                        </div>
                        
                        <div style="margin-bottom: 15px;">
                            <textarea name="message" rows="5" placeholder="Your Message" required 
                                      style="width: 100%; padding: 12px 15px; border: 1px solid #ddd; border-radius: 5px; outline: none; resize: none;"></textarea>
                        </div>
                        
                        <button type="submit" class="btn-primary" 
                                style="padding: 12px 30px; background: #3a5a40; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; transition: 0.3s;">
                            Submit Message
                        </button>
                    </form>
                @else
                    
                    <div style="text-align: center; padding: 40px 20px; border: 1px dashed #ccc; border-radius: 10px;">
                        <i class="fas fa-lock" style="font-size: 40px; color: #ccc; margin-bottom: 15px;"></i>
                        <p style="color: #666; margin-bottom: 20px;">You must be logged in with a valid Gmail account to send a message.</p>
                        
                        <a href="{{ route('login.redirect.contact') }}" class="btn-primary" 
                           style="padding: 10px 25px; background: #ff9f1c; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;">
                           Login Now
                        </a>
                    </div>
                @endauth
            </div>

        </div>
    </section>

   
    <section class="map" style="margin-bottom: 20px;">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3634.336423521235!2d88.6014493149929!3d24.36968898428784!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39fbefd0a55ea957%3A0x61665e78346cb571!2sRajshahi!5e0!3m2!1sen!2sbd!4v1649845671234!5m2!1sen!2sbd" 
        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </section>

@endsection