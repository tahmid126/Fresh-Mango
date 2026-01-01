<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
// মেইল পাঠানোর জন্য প্রয়োজনীয় ক্লাস
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // ১. ভ্যালিডেশন
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // ২. ইউজার তৈরি করা
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // ডিফল্ট রোল 'user' থাকবে
        ]);

        // ৩. রেজিস্টার্ড ইভেন্ট কল করা
        event(new Registered($user));

        // ৪. অটোমেটিক লগিন করানো
        Auth::login($user);

        // ৫. ওয়েলকাম মেইল পাঠানো (Error Handling সহ)
        try {
            Mail::to($user->email)->send(new WelcomeMail($user));
        } catch (\Exception $e) {
            // মেইল না গেলেও সমস্যা নেই, প্রসেস চলবে
        }

        // ৬. রিডাইরেক্ট লজিক

        // ক) যদি ইউজার সেলার হতে চেয়ে রেজিস্ট্রেশন করে থাকে
        if (session('becoming_seller')) {
            session()->forget('becoming_seller'); // ফ্ল্যাগ ক্লিয়ার করা
            return redirect()->route('seller.register'); // সেলার ফর্মে পাঠানো
        }

        // খ) যদি ইউজারের রোল 'seller' হয় (ভবিষ্যতের জন্য)
        if ($user->role === 'seller') {
            return redirect('/seller');
        }

        // গ) সাধারণ কাস্টমার হলে ড্যাশবোর্ডে পাঠানো
        return redirect(route('dashboard', absolute: false));
    }
}