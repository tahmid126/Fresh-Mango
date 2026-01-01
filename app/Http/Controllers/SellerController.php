<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    
    public function registerForm()
    {
       
        if (!Auth::check()) {
            
            session(['becoming_seller' => true]);
            session()->save(); 
            
            return redirect()->route('login'); 
        }

      
        if (Auth::user()->seller) {
            return redirect()->route('dashboard')->with('info', 'You have already applied.');
        }

        return view('seller.register');
    }

    
    public function registerStore(Request $request)
    {
         
        $request->validate([
            'shop_name' => 'required|string|max:255|unique:sellers,shop_name',
            'shop_phone' => 'required|string|max:15',
            'shop_address' => 'required|string',
            'trade_license' => 'required|file|mimes:pdf,jpg,png|max:2048',
        ]);

        
        $path = $request->file('trade_license')->store('trade_licenses', 'public');

        
        Seller::create([
            'user_id' => Auth::id(),
            'shop_name' => $request->shop_name,
            'shop_slug' => \Str::slug($request->shop_name),
            'shop_email' => Auth::user()->email,
            'shop_phone' => $request->shop_phone,
            'shop_address' => $request->shop_address,
            'trade_license' => $path,
            'status' => 'pending',
        ]);

        
        $user = Auth::user();
        $user->role = 'seller';
        $user->save();

        
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        
        return view('seller.pending');
    }
}