@extends('layouts.app')

@section('title', 'Track Order')

@section('content')

<style>
    
    .timeline-container {
        max-width: 600px;
        margin: 50px auto;
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }
    .timeline-item {
        display: flex;
        gap: 20px;
        position: relative;
        padding-bottom: 30px;
    }
    .timeline-item:last-child {
        padding-bottom: 0;
    }
    
   
    .time-col {
        width: 80px;
        text-align: right;
        font-size: 12px;
        color: #888;
        font-weight: 600;
        padding-top: 5px;
    }

    
    .icon-col {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
    }
    .line {
        position: absolute;
        top: 25px;
        bottom: -15px;
        width: 3px;
        background-color: #e0e0e0;
        z-index: 0;
    }
    
    .timeline-item:last-child .line {
        display: none;
    }
    .circle-icon {
        width: 25px;
        height: 25px;
        background-color: #e0e0e0;
        border-radius: 50%;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 12px;
    }

   
    .content-col {
        flex: 1;
        padding-top: 2px;
    }
    .content-col h4 {
        margin: 0;
        font-size: 16px;
        color: #333;
        font-weight: 700;
    }
    .content-col p {
        margin: 5px 0 0;
        font-size: 13px;
        color: #666;
        line-height: 1.4;
    }

   
    .timeline-item.active .circle-icon {
        background-color: #00875a; 
    }
    .timeline-item.active .line {
        background-color: #00875a;
    }
</style>

<section class="page-header" style="text-align: center; padding: 40px; background: #f9f9f9;">
    <h2 style="font-size: 32px; margin-bottom: 10px;">Track Order</h2>
    <p>Track realtime status of your order</p>
</section>

<section style="padding: 30px 10%;">

    
    <div style="max-width: 500px; margin: 0 auto 30px; text-align: center;">
        <form action="{{ route('order.track') }}" method="GET" style="display: flex; gap: 10px;">
            <input type="text" name="order_id" placeholder="Enter Order ID (e.g. 15)" value="{{ request('order_id') }}" required 
                   style="flex: 1; padding: 12px; border: 1px solid #ccc; border-radius: 5px;">
            <button type="submit" class="btn-primary" style="padding: 12px 25px; background: #ff9f1c; color: white; border: none; border-radius: 5px; font-weight: bold;">
                Track
            </button>
        </form>
    </div>

    @if(isset($order))
        <div class="timeline-container">
            <h3 style="margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                Order #{{ $order->id }} 
                <span style="float: right; font-size: 14px; color: #666;">Total: {{ $order->total_amount }} Tk</span>
            </h3>

           
            <div class="timeline-item active">
                <div class="time-col">
                    {{ $order->created_at->format('d M') }}<br>
                    {{ $order->created_at->format('h:i A') }}
                </div>
                <div class="icon-col">
                    <div class="circle-icon"><i class="fas fa-check"></i></div>
                    <div class="line"></div>
                </div>
                <div class="content-col">
                    <h4>Order Placed</h4>
                    <p>Your order is successfully placed. Order id #{{ $order->id }}</p>
                </div>
            </div>

         
            <div class="timeline-item {{ ($order->status == 'Processing' || $order->status == 'Completed') ? 'active' : '' }}">
                <div class="time-col">
                   
                    @if($order->status == 'Processing' || $order->status == 'Completed')
                        {{ $order->updated_at->format('d M') }}<br>
                        {{ $order->updated_at->format('h:i A') }}
                    @endif
                </div>
                <div class="icon-col">
                    <div class="circle-icon"><i class="fas fa-box-open"></i></div>
                    <div class="line"></div>
                </div>
                <div class="content-col">
                    <h4>Processing</h4>
                    <p>We have received your order, our team is checking it.</p>
                </div>
            </div>

           

           
            <div class="timeline-item {{ $order->status == 'Completed' ? 'active' : '' }}">
                <div class="time-col"></div>
                <div class="icon-col">
                    <div class="circle-icon"><i class="fas fa-truck"></i></div>
                    <div class="line"></div>
                </div>
                <div class="content-col">
                    <h4>Out for Delivery</h4>
                    <p>Our delivery partner has picked up your order.</p>
                </div>
            </div>

           
            <div class="timeline-item {{ $order->status == 'Completed' ? 'active' : '' }}">
                <div class="time-col">
                    @if($order->status == 'Completed')
                        {{ $order->updated_at->format('d M') }}<br>
                        {{ $order->updated_at->format('h:i A') }}
                    @endif
                </div>
                <div class="icon-col">
                    <div class="circle-icon"><i class="fas fa-check-double"></i></div>
                </div>
                <div class="content-col">
                    <h4>Delivered</h4>
                    <p>You have received your order. Thank you for shopping!</p>
                </div>
            </div>

        </div>
    @elseif(request('order_id'))
        <div style="text-align: center; padding: 20px; background: #ffebee; color: #d32f2f; border-radius: 5px; max-width: 500px; margin: 0 auto;">
             Order not found! Please check the ID.
        </div>
    @endif

</section>

@endsection