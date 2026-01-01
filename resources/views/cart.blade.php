@extends('layouts.app')

@section('title', 'My Cart')

@section('content')
<div class="relative" style="height: 220px; background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.6)), url('{{ asset('images/back_2.png') }}'); background-size: cover; background-position: center; display: flex; align-items: center; justify-content: center; text-align: center; color: white;">
        <div>
            <h1 style="font-size: 2.5rem; font-weight: 800; letter-spacing: 1px; text-transform: uppercase; margin: 0;">YOUR</h1>
            <p style="font-size: 1rem; opacity: 0.9; font-weight: 300; margin-top: 5px;">Shopping Cart</p>
        </div>
    </div>

    <section class="page-header" style="text-align: center; padding: 40px; background: #f9f9f9;">
        <h2 style="font-size: 32px; margin-bottom: 10px;">Your Shopping Cart</h2>
        <p>Review your selected mangoes</p>
    </section>

    
    <section id="cart" class="section-p1" style="padding: 50px 5%; overflow-x: auto;">
        <table width="100%" style="border-collapse: collapse; white-space: nowrap;">
            <thead style="border-bottom: 1px solid #ddd;">
                <tr style="font-weight: bold;">
                    <td style="padding: 15px;">Remove</td>
                    <td style="padding: 15px;">Image</td>
                    <td style="padding: 15px;">Product</td>
                    <td style="padding: 15px;">Price</td>
                    <td style="padding: 15px;">Quantity</td>
                    <td style="padding: 15px;">Subtotal</td>
                </tr>
            </thead>
            <tbody style="text-align: center;"></tbody>
        </table>
    </section>

    
    <section id="cart-add" class="section-p1" style="padding: 0 5% 50px; display: flex; justify-content: center; flex-wrap: wrap;">
        <div id="subtotal" style="width: 100%; max-width: 450px; border: 1px solid #ddd; padding: 25px; border-radius: 8px; background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
            <h3 style="margin-bottom: 15px;">Cart Totals</h3>
            <table style="width: 100%; margin-bottom: 20px;">
                <tr>
                    <td style="padding: 10px; border-bottom: 1px solid #eee;">Cart Subtotal</td>
                    <td id="cart-subtotal" style="padding: 10px; border-bottom: 1px solid #eee; text-align: right;">0 Tk</td>
                </tr>
                <tr>
                    <td style="padding: 10px; font-size: 18px;"><strong>Total</strong></td>
                    <td style="padding: 10px; text-align: right; font-size: 18px; color: #ff9f1c;"><strong id="cart-total">0 Tk</strong></td>
                </tr>
            </table>
            <a href="{{ route('checkout') }}" class="btn-primary" style="display: block; text-align: center; padding: 12px; background: #ff9f1c; color: white; text-decoration: none; font-weight: bold; border-radius: 5px;">Proceed to Checkout</a>
        </div>
    </section>

   
    <script>
        let cartTotal = 0;

        function displayCart() {
            const cartTableBody = document.querySelector("#cart tbody");
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            cartTableBody.innerHTML = "";
            cartTotal = 0;

            if (cart.length === 0) {
                cartTableBody.innerHTML = "<tr><td colspan='6' style='padding:20px;'>Cart is empty!</td></tr>";
                updateTotals();
                return;
            }

            cart.forEach((item, index) => {
                let subtotal = item.price * item.quantity;
                cartTotal += subtotal;

                let row = document.createElement("tr");
                row.innerHTML = `
                    <td><a href="#" onclick="removeFromCart(${index})"><i class="fas fa-times-circle" style="color: red;"></i></a></td>
                    <td><img src="${item.img}" alt="${item.name}" style="width: 50px;"></td>
                    <td>${item.name}</td>
                    <td>${item.price} Tk</td>
                    <td><input type="number" value="${item.quantity}" min="1" style="width: 50px; padding: 5px; text-align: center;" onchange="updateQuantity(${index}, this.value)"></td>
                    <td>${subtotal} Tk</td>
                `;
                cartTableBody.appendChild(row);
            });

            updateTotals();
        }

        function updateTotals() {
            document.getElementById('cart-subtotal').innerText = cartTotal + " Tk";
            document.getElementById('cart-total').innerText = cartTotal + " Tk";
        }

        function removeFromCart(index) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            cart.splice(index, 1);
            localStorage.setItem('cart', JSON.stringify(cart));
            displayCart();
        }

        function updateQuantity(index, newQty) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            if (newQty < 1) newQty = 1;
            cart[index].quantity = parseInt(newQty);
            localStorage.setItem('cart', JSON.stringify(cart));
            displayCart();
        }

        window.onload = displayCart;
    </script>
@endsection
