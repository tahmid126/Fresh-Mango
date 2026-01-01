<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">

    <div style="max-width: 600px; margin: 0 auto; background: #ffffff; padding: 30px; border-radius: 10px; border-top: 5px solid #ff9f1c;">
        
        <h2 style="text-align: center; color: #333;">Order Received! 🎉</h2>
        
        <p style="color: #555; font-size: 16px; line-height: 1.6;">
            Hello <strong>{{ $order->name }}</strong>,<br>
            Thank you for shopping with <strong>Fresh Mango</strong>. Your order has been placed successfully.
        </p>

        <div style="background: #f9f9f9; padding: 15px; border-radius: 5px; margin: 20px 0; text-align: center;">
            <p style="margin: 0; font-size: 18px; color: #555;">Your Order ID:</p>
            <h1 style="margin: 5px 0; color: #ff9f1c; letter-spacing: 2px;">#{{ $order->id }}</h1>
        </div>

        <p style="text-align: center;">You can track your order status anytime using the link below:</p>

        <div style="text-align: center; margin-top: 20px;">
            <a href="{{ route('order.track', ['order_id' => $order->id]) }}" 
               style="display: inline-block; padding: 12px 25px; background-color: #3a5a40; color: #ffffff; text-decoration: none; border-radius: 5px; font-weight: bold;">
                Track Your Order
            </a>
        </div>

        <hr style="border: 0; border-top: 1px solid #eee; margin: 30px 0;">

        <h3 style="color: #333;">Order Summary</h3>
        <p style="color: #555;">
            <strong>Items:</strong> {{ $order->order_details }}<br>
            <strong>Total Amount:</strong> {{ $order->total_amount }} Tk<br>
            <strong>Payment Method:</strong> {{ $order->payment_method }}
        </p>
    </div>

</body>
</html>