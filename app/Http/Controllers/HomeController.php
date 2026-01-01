<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Models\Product;
use App\Models\Coupon;
use App\Models\Garden;
use App\Models\Contact;
use App\Models\Shipping;
use App\Models\Blog;

class HomeController extends Controller
{
    
    public function index()
    {
        
        $products = Product::where('is_approved', true)
                           ->where('is_featured', true) 
                           ->latest()
                           ->take(8) 
                           ->get();
                           
        return view('home', compact('products'));
    }

    
    public function shop()
    {
      
        $products = Product::where('is_approved', true)->latest()->get(); 
        return view('shop', compact('products'));
    }

   
    public function show($id)
    {
        $product = Product::findOrFail($id);
        
        $related = Product::where('id', '!=', $id)->where('is_approved', true)->take(4)->get();
        return view('details', compact('product', 'related'));
    }

    
    public function cart()
    {
        return view('cart');
    }

    public function blog()
    {
        
        $blogs = Blog::latest()->get();
        return view('blog', compact('blogs'));
    }

 
    public function about()
    {
        $gardens = Garden::all();
        return view('about', compact('gardens'));
    }

    // contact page
    public function contact()
    {
        return view('contact');
    }

    //massage save kora
    public function sendMessage(Request $request)
    {
        
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'email'   => ['required', 'email', 'ends_with:gmail.com'],
            'phone'   => ['required', 'numeric', 'digits:11'], 
        ], [
            'email.ends_with' => 'Only Gmail addresses are allowed!',
            'phone.required'  => 'Phone number is mandatory!',
            'phone.digits'    => 'Phone number must be exactly 11 digits (e.g. 017xxxxxxxx).',
        ]);

        // database a save kra
        Contact::create([
            'name'    => Auth::user()->name,
            'email'   => Auth::user()->email,
            'phone'   => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Message sent successfully! We will contact you soon.');
    }

   
    public function sendOtp(Request $request)
    {
        $phone = $request->phone;
        
        $otp = rand(1000, 9999); 

        return response()->json([
            'status' => true,
            'otp' => $otp,
            'message' => 'OTP sent successfully!'
        ]);
    }

   
    public function verifyOtp(Request $request)
    {
        $inputOtp = $request->otp;

        
        if ($inputOtp == "1234") {
            return response()->json(['status' => true, 'message' => 'OTP Verified!']);
        } else {
            return response()->json(['status' => false, 'message' => 'Invalid OTP!']);
        }
    }

    // cupon (AJAX)
    public function checkCoupon(Request $request)
    {
        $code = $request->code;
        
        
        $coupon = Coupon::where('code', $code)->where('is_active', true)->first();

        if ($coupon) {
            return response()->json([
                'status' => true,
                'discount' => $coupon->discount_amount,
                'message' => 'Coupon Applied Successfully!'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Invalid or Expired Coupon Code!'
            ]);
        }
    }

    // shipping charge API
    public function getShippingCharge()
    {
        $shippings = Shipping::where('is_active', true)->get();
        return response()->json($shippings);
    }
    
}