@extends('layouts.app')

@section('title', 'My Account')

@section('content')

    <section class="dashboard-container" style="padding: 50px 10%; background: #f9f9f9; min-height: 70vh;">
        
      
        <div class="dashboard-header" style="margin-bottom: 30px;">
            <h2 style="font-size: 32px; color: #333;">My Account</h2>
            <p style="color: #666;">Welcome back, <span style="color: #ff9f1c; font-weight: bold;">{{ Auth::user()->name }}</span>!</p>
        </div>

        <div class="dashboard-grid" style="display: flex; flex-wrap: wrap; gap: 30px;">
            
           
            <div class="card profile-card" style="flex: 1; min-width: 300px; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); height: fit-content;">
                <div style="text-align: center; margin-bottom: 20px;">
                    <div style="width: 80px; height: 80px; background: #e8f5e9; color: #3a5a40; font-size: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                        <i class="fas fa-user"></i>
                    </div>
                    <h3 style="margin-bottom: 5px;">{{ Auth::user()->name }}</h3>
                    <p style="color: #888;">{{ Auth::user()->email }}</p>
                </div>
                
                <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">

                <div class="profile-actions">
                    <a href="{{ route('profile.edit') }}" style="display: block; padding: 10px; background: #f4f4f4; color: #333; text-decoration: none; border-radius: 5px; text-align: center; margin-bottom: 10px; transition: 0.3s;">
                        <i class="fas fa-cog"></i> Settings
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" style="width: 100%; padding: 10px; background: #ffebee; color: #d32f2f; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            </div>

            
            <div style="flex: 2; display: flex; flex-direction: column; gap: 30px;">
                
               
                <div class="card track-card" style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
                    <h3 style="margin-bottom: 20px; border-left: 4px solid #ff9f1c; padding-left: 10px;">Track Order</h3>
                    <form action="{{ route('order.track') }}" method="GET" style="display: flex; gap: 10px;">
                        <input type="text" name="order_id" placeholder="Enter Order ID to track..." required 
                               style="flex: 1; padding: 12px; border: 1px solid #ccc; border-radius: 5px;">
                        <button type="submit" class="btn-primary" style="padding: 12px 25px; background: #3a5a40; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">
                            Track
                        </button>
                    </form>
                </div>

               
                <div class="card orders-card" style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
                    <h3 style="margin-bottom: 20px; border-left: 4px solid #ff9f1c; padding-left: 10px;">Recent Orders</h3>
                    
                    @if(isset($orders) && $orders->count() > 0)
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                                <thead>
                                    <tr style="background: #f4f4f4; color: #555; border-bottom: 2px solid #ddd;">
                                        <th style="padding: 12px;">Order ID</th>
                                        <th style="padding: 12px;">Date</th>
                                        <th style="padding: 12px;">Amount</th>
                                        <th style="padding: 12px;">Status</th>
                                        <th style="padding: 12px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr style="border-bottom: 1px solid #eee;">
                                            <td style="padding: 15px; font-weight: bold; color: #333;">#{{ $order->id }}</td>
                                            <td style="padding: 15px; color: #666;">{{ $order->created_at->format('d M, Y') }}</td>
                                            <td style="padding: 15px; color: #ff9f1c; font-weight: bold;">{{ $order->total_amount }} Tk</td>
                                            <td style="padding: 15px;">
                                                <span style="
                                                    padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold;
                                                    background: {{ $order->status == 'Pending' ? '#fff3cd' : ($order->status == 'Completed' ? '#d4edda' : '#f8d7da') }};
                                                    color: {{ $order->status == 'Pending' ? '#856404' : ($order->status == 'Completed' ? '#155724' : '#721c24') }};
                                                ">
                                                    {{ $order->status }}
                                                </span>
                                            </td>
                                            <td style="padding: 15px;">
                                               
                                                <a href="{{ route('order.track', ['order_id' => $order->id]) }}" style="text-decoration: none; color: #3a5a40; font-weight: bold; font-size: 14px;">
                                                    Track <i class="fas fa-arrow-right"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div style="text-align: center; padding: 40px; border: 1px dashed #ddd; border-radius: 10px; color: #999;">
                            <i class="fas fa-shopping-bag" style="font-size: 40px; margin-bottom: 15px; color: #ccc;"></i>
                            <p>No orders found yet.</p>
                            <a href="{{ route('shop') }}" style="display: inline-block; margin-top: 10px; color: #ff9f1c; text-decoration: none; font-weight: bold;">Start Shopping &rarr;</a>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </section>

@endsection