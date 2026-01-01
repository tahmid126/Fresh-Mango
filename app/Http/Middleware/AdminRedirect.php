<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // ১. যদি ইউজার লগিন করা থাকে এবং সে অ্যাডমিন না হয়
        if (Auth::check() && Auth::user()->role !== 'admin') {
            
            // ২. তাকে হোম পেজে পাঠিয়ে দাও এবং মেসেজ দেখাও
            return redirect('/')->with('error', 'You cannot create account in admin panel!');
        }

        return $next($request);
    }
}