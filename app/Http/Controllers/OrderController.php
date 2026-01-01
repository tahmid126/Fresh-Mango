<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlaced;

class OrderController extends Controller
{
    
    public function checkout()
    {
        return view('checkout');
    }

   
    public function track(Request $request)
    {
        $order = null;

        if ($request->has('order_id')) {
            $order = Order::find($request->order_id);
        }

        return view('track_order', compact('order'));
    }

  
    public function store(Request $request)
    {
    
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'order_details' => 'required',
            'total_amount' => 'required',
            'payment_method' => 'required',
            'email' => 'nullable|email',
            'order_items_json' => 'required',
        ]);

       
        $order = Order::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'order_details' => $request->order_details,
            'total_amount' => (int)$request->total_amount,
            'payment_method' => $request->payment_method,
            'status' => 'Pending',
        ]);

      
        $items = json_decode($request->order_items_json, true);

        if (is_array($items)) {
            foreach ($items as $item) {
                $product = Product::find($item['product_id']);
                
                if ($product) {
                   
                    $totalItemPrice = $item['quantity'] * $item['price'];

                    
                    $rate = $product->commission_rate ?? 10; 
                    $commission = ($totalItemPrice * $rate) / 100;

                    
                    $sellerEarning = $totalItemPrice - $commission;

                    
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'seller_id' => $product->seller_id,
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                        'total' => $totalItemPrice,
                        
                        
                        'admin_commission' => $commission,
                        'seller_earning' => $sellerEarning,
                    ]);
                }
            }
        }

       
        if ($request->email) {
            try {
                Mail::to($request->email)->send(new OrderPlaced($order));
            } catch (\Exception $e) {
                
            }
        }

      
        return redirect()->route('dashboard')->with('success', 'Order Placed Successfully! Commission calculated.');
    }
}