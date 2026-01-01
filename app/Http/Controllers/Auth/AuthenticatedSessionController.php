<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // ১. যদি কেউ সেলার হওয়ার জন্য রেজিস্ট্রেশন পেজ থেকে লগিন করে
        if (session('becoming_seller')) {
            session()->forget('becoming_seller'); // সেশন ক্লিয়ার
            return redirect()->route('seller.register'); // ফর্মে ফেরত পাঠানো
        }

        // ২. রোলের ওপর ভিত্তি করে রিডাইরেক্ট (আসল লজিক)
        $role = $request->user()->role;

        if ($role === 'admin') {
            return redirect('/admin'); // অ্যাডমিন হলে অ্যাডমিন প্যানেলে
        } 
        elseif ($role === 'seller') {
            return redirect('/seller'); // সেলার হলে সেলার প্যানেলে
        }

        // ৩. সাধারণ কাস্টমার হলে শপিং ড্যাশবোর্ডে যাবে
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}