@extends('layouts.app')

@section('title', 'Checkout')

@section('content')

    <section class="page-header" style="text-align: center; padding: 40px; background: #f9f9f9;">
        <h2 style="font-size: 32px; margin-bottom: 10px;">Checkout</h2>
        <p>Complete your order</p>
    </section>

    <section class="checkout-container" style="padding: 50px 10%;">
        
        <form id="billingForm" action="{{ route('order.store') }}" method="POST">
            @csrf
            
            <div class="row" style="display: flex; flex-wrap: wrap; gap: 30px;">
                
             
                <div class="col-billing" style="flex: 1; min-width: 300px;">
                    
                
                    <div style="background: #fff; padding: 20px; border: 1px solid #eee; border-radius: 8px; margin-bottom: 20px;">
                        <h3 style="margin-bottom: 15px; font-size: 18px; border-bottom: 2px solid #f4f4f4; padding-bottom: 10px;">
                            <i class="fas fa-user-circle" style="color: #ff9f1c;"></i> Contact Info
                        </h3>
                        
                        <div class="input-group" style="margin-bottom: 15px;">
                            <label style="font-weight: 600; font-size: 14px; margin-bottom: 5px; display: block;">Full Name *</label>
                            <input type="text" name="name" value="{{ Auth::user()->name ?? '' }}" required 
                                   style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px;">
                        </div>

                        <div style="display: flex; gap: 15px;">
                            <div class="input-group" style="flex: 1; margin-bottom: 15px;">
                                <label style="font-weight: 600; font-size: 14px; margin-bottom: 5px; display: block;">Phone Number *</label>
                                <input type="tel" name="phone" placeholder="017xxxxxxxx" required 
                                       style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px;">
                            </div>
                            <div class="input-group" style="flex: 1; margin-bottom: 15px;">
                                <label style="font-weight: 600; font-size: 14px; margin-bottom: 5px; display: block;">Email Address</label>
                                <input type="email" name="email" value="{{ Auth::user()->email ?? '' }}" placeholder="Optional" 
                                       style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px;">
                            </div>
                        </div>
                    </div>

                    //shipping address section
                    <div style="background: #fff; padding: 20px; border: 1px solid #eee; border-radius: 8px;">
                        <h3 style="margin-bottom: 15px; font-size: 18px; border-bottom: 2px solid #f4f4f4; padding-bottom: 10px;">
                            <i class="fas fa-map-marker-alt" style="color: #ff9f1c;"></i> Shipping Address
                        </h3>

                        
                        <div class="input-group" style="margin-bottom: 15px;">
                            <label style="font-weight: 600; font-size: 14px; margin-bottom: 5px; display: block;">Division *</label>
                            <select id="divisionInput" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px; background: white;">
                                <option value="" disabled selected>Select Division</option>
                                <option value="Dhaka">Dhaka</option>
                                <option value="Chittagong">Chittagong</option>
                                <option value="Rajshahi">Rajshahi</option>
                                <option value="Khulna">Khulna</option>
                                <option value="Barisal">Barisal</option>
                                <option value="Sylhet">Sylhet</option>
                                <option value="Rangpur">Rangpur</option>
                                <option value="Mymensingh">Mymensingh</option>
                            </select>
                        </div>

                        
                        <div style="display: flex; gap: 15px; margin-bottom: 15px;">
                            <div class="input-group" style="flex: 1;">
                                <label style="font-weight: 600; font-size: 14px; margin-bottom: 5px; display: block;">District *</label>
                                
                              
                                <select id="districtSelect" onchange="updateShipping()" required style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px; background: white;">
                                    <option value="" disabled selected>Select District</option>
                                    <option value="Dhaka">Dhaka</option>
                                    <option value="Gazipur">Gazipur</option>
                                    <option value="Narayanganj">Narayanganj</option>
                                    <option value="Rajshahi">Rajshahi</option>
                                    <option value="Chittagong">Chittagong</option>
                                    <option value="Khulna">Khulna</option>
                                    <option value="Sylhet">Sylhet</option>
                                    <option value="Barisal">Barisal</option>
                                    <option value="Rangpur">Rangpur</option>
                                    <option value="Comilla">Comilla</option>
                                    <option value="Bogra">Bogra</option>
                                    <option value="Other" style="font-weight: bold; color: #ff9f1c;">Other (Type Manually)</option>
                                </select>

                                
                                <input type="text" id="districtManual" placeholder="Type District Name" oninput="updateShipping(true)"
                                       style="display: none; width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px; margin-top: 10px;">
                            </div>
                            
                            <div class="input-group" style="flex: 1;">
                                <label style="font-weight: 600; font-size: 14px; margin-bottom: 5px; display: block;">Thana / Area *</label>
                                <input type="text" id="thanaInput" placeholder="e.g. Mirpur" required 
                                       style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px;">
                            </div>
                        </div>

                       
                        <div class="input-group" style="margin-bottom: 15px;">
                            <label style="font-weight: 600; font-size: 14px; margin-bottom: 5px; display: block;">Full Address (House, Road) *</label>
                            <textarea id="addressMain" rows="2" placeholder="House No, Road No, Block etc." required 
                                      style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px; font-family: sans-serif; resize: none;"></textarea>
                            
                            
                            <input type="hidden" name="address" id="finalAddress">
                            <input type="hidden" name="city" id="finalCity">
                        </div>

                        <div class="input-group">
                            <label style="font-weight: 600; font-size: 14px; margin-bottom: 5px; display: block;">Order Notes (Optional)</label>
                            <textarea name="order_notes" rows="3" placeholder="Special delivery instructions..." 
                                      style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 5px; resize: none;"></textarea>
                        </div>
                    </div>

                    
                    <input type="hidden" name="order_details" id="hiddenCartData">
                    <input type="hidden" name="order_items_json" id="hiddenOrderItemsJson">
                    <input type="hidden" name="total_amount" id="hiddenTotal">
                    <input type="hidden" name="payment_method" id="hiddenPayment" value="Cash On Delivery">
                </div>

                
                <div class="col-order" style="flex: 0.8; min-width: 300px; background: #fff; padding: 30px; border-radius: 10px; border: 1px solid #eee; height: fit-content;">
                    <h3 style="margin-bottom: 20px; font-size: 20px; border-bottom: 2px solid #ff9f1c; padding-bottom: 10px;">Your Order</h3>
                    
                    <div id="order-items-display"><p>Loading items...</p></div>
                    
                    <hr style="margin: 15px 0; border: 0; border-top: 1px solid #eee;">
                    
                   
                    <div class="coupon-section" style="margin-bottom: 20px; background: #f4f4f4; padding: 10px; border-radius: 5px;">
                        <label style="font-size: 14px; font-weight: bold; margin-bottom: 5px; display: block;">Have a Coupon?</label>
                        <div style="display: flex; gap: 10px;">
                            <input type="text" id="couponCode" placeholder="Enter Code" style="flex: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                            <button type="button" onclick="applyCouponOnCheckout()" style="padding: 8px 15px; background: #333; color: white; border: none; border-radius: 4px; cursor: pointer;">Apply</button>
                        </div>
                        <p id="couponMessage" style="font-size: 12px; margin-top: 5px; font-weight: bold;"></p>
                    </div>

                   
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <span>Subtotal</span>
                        <span id="displaySubtotal">0 Tk</span>
                    </div>
                    
                   
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px; color: #666;">
                        <span>Shipping (<span id="shippingLocation" style="font-size: 12px; font-weight: bold;">Select District</span>)</span>
                        <span id="displayShipping" style="color: #333; font-weight: bold;">0 Tk</span>
                    </div>
                    
                    
                    <div id="discountRow" style="display: none; justify-content: space-between; margin-bottom: 10px; color: green;">
                        <span>Discount</span>
                        <span>- <span id="displayDiscount">0</span> Tk</span>
                    </div>

                   
                    <div style="display: flex; justify-content: space-between; font-size: 20px; border-top: 2px solid #eee; padding-top: 10px; font-weight: bold;">
                        <span>Total</span>
                        <span style="color: #ff9f1c;" id="displayTotal">0 Tk</span>
                    </div>

                    
                    <div class="payment-method" style="margin-top: 30px;">
                        <h3 style="font-size: 18px; margin-bottom: 15px;">Payment Method</h3>
                        
                        <div class="payment-option" style="margin-bottom: 10px; padding: 10px; border: 1px solid #eee; border-radius: 5px;">
                            <input type="radio" name="pay_selector" id="cod" checked onchange="showPaymentInfo('cod')">
                            <label for="cod" style="font-weight: bold; margin-left: 5px; cursor: pointer;">Cash on Delivery</label>
                        </div>
                        
                        <div class="payment-option" style="margin-bottom: 10px; padding: 10px; border: 1px solid #eee; border-radius: 5px;">
                            <input type="radio" name="pay_selector" id="bkash" onchange="showPaymentInfo('bkash')">
                            <label for="bkash" style="color: #E2136E; font-weight: bold; margin-left: 5px; cursor: pointer;">bKash Payment</label>
                        </div>
                        <div id="bkash-info" style="display:none; background: #fff0f5; padding: 15px; border: 1px dashed #E2136E; margin-bottom: 10px; border-radius: 5px;">
                            <p style="font-size: 14px; margin-bottom: 5px;">Send Money to: <strong>017xxxxxxxx</strong></p>
                            <input type="text" name="bkash_trx_id" placeholder="Enter TrxID" style="width: 100%; padding: 5px;">
                        </div>

                        <div class="payment-option" style="margin-bottom: 10px; padding: 10px; border: 1px solid #eee; border-radius: 5px;">
                            <input type="radio" name="pay_selector" id="nagad" onchange="showPaymentInfo('nagad')">
                            <label for="nagad" style="color: #F6921E; font-weight: bold; margin-left: 5px; cursor: pointer;">Nagad Payment</label>
                        </div>
                        <div id="nagad-info" style="display:none; background: #fff8e1; padding: 15px; border: 1px dashed #F6921E; margin-bottom: 10px; border-radius: 5px;">
                            <p style="font-size: 14px; margin-bottom: 5px;">Send Money to: <strong>017xxxxxxxx</strong></p>
                            <input type="text" name="nagad_trx_id" placeholder="Enter TrxID" style="width: 100%; padding: 5px;">
                        </div>

                        <div class="payment-option" style="margin-bottom: 10px; padding: 10px; border: 1px solid #eee; border-radius: 5px;">
                            <input type="radio" name="pay_selector" id="card" onchange="showPaymentInfo('card')">
                            <label for="card" style="color: #0056b3; font-weight: bold; margin-left: 5px; cursor: pointer;">Card Payment</label>
                        </div>
                        <div id="card-info" style="display:none; background: #e3f2fd; padding: 15px; border: 1px dashed #0056b3; margin-bottom: 10px; border-radius: 5px;">
                            <p style="font-size: 14px;">Card payment gateway is under maintenance.</p>
                        </div>

                        <button type="submit" class="btn-primary btn-place-order" style="width: 100%; padding: 15px; background: #3a5a40; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 18px; margin-top: 20px; font-weight: bold;">Place Order</button>
                    </div>
                </div>

            </div>
        </form>
    </section>

    //js logic
    <script>
        let cartTotal = 0;
        let shippingCharge = 0;
        let discountAmount = 0;
        let couponApplied = false;
        let shippingData = []; 

       
        fetch("{{ route('shipping.charge') }}")
            .then(res => res.json())
            .then(data => {
                shippingData = data;
                updateShipping();
            })
            .catch(err => console.error("API Error:", err));

        // shipping logic
        function updateShipping(isManual = false) {
            let select = document.getElementById('districtSelect');
            let manualInput = document.getElementById('districtManual');
            let district = select.value;

            if (district === 'Other') {
                manualInput.style.display = 'block';
                manualInput.required = true;
                select.required = false;
                if(isManual) district = manualInput.value; 
            } else {
                manualInput.style.display = 'none';
                manualInput.required = false;
                select.required = true;
            }

            
            let isInside = (district === 'Dhaka' || district === 'Gazipur' || district === 'Narayanganj');
            
            
            let selectedShipping = shippingData.find(s => 
                isInside ? s.location.toLowerCase().includes('inside') : s.location.toLowerCase().includes('outside')
            );

            if (selectedShipping) {
                shippingCharge = parseInt(selectedShipping.charge);
                document.getElementById('shippingLocation').innerText = selectedShipping.location;
            } else {
               
                if (isInside) {
                    shippingCharge = 60;
                    document.getElementById('shippingLocation').innerText = "Inside Dhaka";
                } else {
                    shippingCharge = 120;
                    document.getElementById('shippingLocation').innerText = "Outside Dhaka";
                }
            }

            document.getElementById('displayShipping').innerText = shippingCharge + " Tk";
            calculateTotal();
        }

        // total hisab
        function calculateTotal() {
            let finalTotal = (cartTotal + shippingCharge) - discountAmount;
            if (finalTotal < 0) finalTotal = 0;
            document.getElementById('displayTotal').innerText = finalTotal + " Tk";
            document.getElementById('hiddenTotal').value = finalTotal;
        }

        // cupon logic
        function applyCouponOnCheckout() {
            let code = document.getElementById('couponCode').value;
            let msgBox = document.getElementById('couponMessage');

            if (!code) {
                msgBox.innerText = "Enter a code.";
                msgBox.style.color = "red";
                return;
            }
            if (couponApplied) {
                msgBox.innerText = "Already applied!";
                msgBox.style.color = "orange";
                return;
            }

            fetch("{{ route('coupon.apply') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ code: code })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status) {
                    discountAmount = parseInt(data.discount);
                    if(cartTotal > discountAmount) {
                        couponApplied = true;
                        document.getElementById('discountRow').style.display = 'flex';
                        document.getElementById('displayDiscount').innerText = discountAmount;
                        msgBox.innerText = "Success!";
                        msgBox.style.color = "green";
                        calculateTotal(); 
                    } else {
                        msgBox.innerText = "Order too low for coupon.";
                        msgBox.style.color = "red";
                    }
                } else {
                    msgBox.innerText = data.message;
                    msgBox.style.color = "red";
                }
            });
        }

       
        window.onload = function() {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let display = document.getElementById('order-items-display');
            let dbData = []; 
            let jsonItems = [];

            if(cart.length === 0) {
                display.innerHTML = "<p style='color:#888;'>Cart is empty!</p>";
                return;
            }

            display.innerHTML = "";
            cartTotal = 0;

            cart.forEach(item => {
                let subtotal = item.price * item.quantity;
                cartTotal += subtotal;
                display.innerHTML += `<div style="display:flex;justify-content:space-between;margin-bottom:5px;"><span>${item.name} x ${item.quantity}</span><span>${subtotal} Tk</span></div>`;
                dbData.push(`${item.name} (${item.quantity} kg)`);
                
               
                jsonItems.push({
                    product_id: item.id,
                    quantity: item.quantity,
                    price: item.price
                });
            });

            document.getElementById('displaySubtotal').innerText = cartTotal + " Tk";
            
            document.getElementById('hiddenCartData').value = dbData.join(", ");
            document.getElementById('hiddenOrderItemsJson').value = JSON.stringify(jsonItems);
            
            calculateTotal(); 
        };

        function showPaymentInfo(method) {
            document.getElementById('bkash-info').style.display = 'none';
            document.getElementById('nagad-info').style.display = 'none';
            document.getElementById('card-info').style.display = 'none';
            let hiddenInput = document.getElementById('hiddenPayment');

            if (method === 'bkash') {
                document.getElementById('bkash-info').style.display = 'block';
                hiddenInput.value = "bKash";
            } else if (method === 'nagad') {
                document.getElementById('nagad-info').style.display = 'block';
                hiddenInput.value = "Nagad";
            } else if (method === 'card') {
                document.getElementById('card-info').style.display = 'block';
                hiddenInput.value = "Card";
            } else {
                hiddenInput.value = "Cash On Delivery";
            }
        }

        function toggleManualDistrict() {
            let select = document.getElementById('districtSelect');
            let manualInput = document.getElementById('districtManual');
            if (select.value === 'Other') {
                manualInput.style.display = 'block';
                manualInput.required = true;
                select.required = false; 
            } else {
                manualInput.style.display = 'none';
                manualInput.required = false;
                select.required = true;
            }
            updateShipping();
        }

        document.getElementById('billingForm').addEventListener('submit', function(e) {
            let division = document.getElementById('divisionInput').value;
            let district = document.getElementById('districtSelect').value === 'Other' ? document.getElementById('districtManual').value : document.getElementById('districtSelect').value;
            let thana = document.getElementById('thanaInput').value;
            let address = document.getElementById('addressMain').value;

            document.getElementById('finalCity').value = district + ", " + division;
            document.getElementById('finalAddress').value = address + ", " + thana + ", " + district + ", " + division;

            setTimeout(() => { localStorage.removeItem('cart'); }, 1000);
        });
    </script>

@endsection