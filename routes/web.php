<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerController;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/product/{id}', [HomeController::class, 'show'])->name('product.details');


Route::get('/cart', [HomeController::class, 'cart'])->name('cart');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');


Route::get('/api/shipping-charge', [HomeController::class, 'getShippingCharge'])->name('shipping.charge');
Route::post('/apply-coupon', [HomeController::class, 'checkCoupon'])->name('coupon.apply');
Route::post('/send-otp', [HomeController::class, 'sendOtp'])->name('send.otp');
Route::post('/verify-otp', [HomeController::class, 'verifyOtp'])->name('verify.otp');


Route::get('/become-seller', [SellerController::class, 'registerForm'])->name('seller.register');
Route::post('/become-seller', [SellerController::class, 'registerStore'])->name('seller.store');
Route::get('/seller/pending', function () { return view('seller.pending'); })->name('seller.pending');



Route::middleware(['auth', 'verified'])->group(function () {
    
    // customer dashboard
    Route::get('/dashboard', function () {
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        return view('dashboard', compact('orders'));
    })->name('dashboard');

    
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
    
    
    Route::get('/track-order', [OrderController::class, 'track'])->name('order.track');

   
    Route::post('/contact/send', [HomeController::class, 'sendMessage'])->name('contact.send');

    
    Route::get('/contact-login', function () {
        return redirect()->route('contact');
    })->name('login.redirect.contact');

   
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/become-seller', [SellerController::class, 'registerForm'])->name('seller.register');
Route::post('/become-seller', [SellerController::class, 'registerStore'])->name('seller.store');
Route::get('/seller/pending', function () { return view('seller.pending'); })->name('seller.pending');



Route::middleware(['auth', 'verified'])->group(function () {

});
Route::get('/phpinfo', function () {
    return phpinfo();
});