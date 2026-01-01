<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Fresh Mango</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">

    <div style="max-width: 600px; margin: 0 auto; background: #ffffff; padding: 30px; border-radius: 10px; text-align: center;">
        
        <h1 style="color: #ff9f1c;">🥭 Fresh Mango</h1>
        
        <h2>Hello, {{ $user->name }}! 👋</h2>
        
        <p style="color: #555; font-size: 16px; line-height: 1.6;">
            Thank you for signing up at <strong>Fresh Mango</strong>! We are excited to have you with us.
            <br>
            Get ready to taste the best premium mangoes directly from Rajshahi.
        </p>

        <a href="{{ route('shop') }}" style="display: inline-block; margin-top: 20px; padding: 12px 25px; background-color: #3a5a40; color: #ffffff; text-decoration: none; border-radius: 5px; font-weight: bold;">
            Start Shopping Now
        </a>

        <p style="margin-top: 30px; font-size: 12px; color: #999;">
            If you have any questions, reply to this email. We're here to help!
        </p>
    </div>

</body>
</html>