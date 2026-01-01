//mobile menu logic
const bar = document.getElementById('bar');
const close = document.getElementById('close-btn');
const nav = document.getElementById('navbar');

if (bar) {
    bar.addEventListener('click', () => {
        nav.classList.add('active');
    })
}

if (close) {
    close.addEventListener('click', () => {
        nav.classList.remove('active');
    })
}



// product cart
function addToCart(id, name, price, img) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    
    let existingProduct = cart.find(item => item.id === id);

    if (existingProduct) {
        existingProduct.quantity += 1;
    } else {
        cart.push({ id, name, price, img, quantity: 1 });
    }

    localStorage.setItem('cart', JSON.stringify(cart));
    alert(name + " added to cart!"); 
    
   
    if(window.location.href.indexOf("cart") > -1){
        displayCart();
    }
}


function displayCart() {
    const cartTableBody = document.querySelector("#cart tbody");
    const subtotalBox = document.querySelector("#cart-subtotal");
    const totalBox = document.querySelector("#cart-total");

   
    if (!cartTableBody) return; 

    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cartTableBody.innerHTML = ""; 
    
    let total = 0;

    cart.forEach((item, index) => {
        let subtotal = item.price * item.quantity;
        total += subtotal;

        let row = document.createElement("tr");
        row.innerHTML = `
            <td><a href="#" onclick="removeFromCart(${index})"><i class="fas fa-times-circle" style="color: red;"></i></a></td>
            <td><img src="${item.img}" alt="${item.name}" style="width: 50px;"></td>
            <td>${item.name}</td>
            <td>${item.price} Tk</td>
            <td><input type="number" value="${item.quantity}" min="1" style="width: 50px; padding: 5px;" onchange="updateQuantity(${index}, this.value)"></td>
            <td>${subtotal} Tk</td>
        `;
        cartTableBody.appendChild(row);
    });

    
    if(subtotalBox) subtotalBox.innerText = total + " Tk";
    if(totalBox) totalBox.innerText = (total + 60) + " Tk"; 
}


function removeFromCart(index) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart.splice(index, 1);
    localStorage.setItem('cart', JSON.stringify(cart));
    displayCart();
}


function updateQuantity(index, newQty) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    if(newQty < 1) newQty = 1;
    cart[index].quantity = parseInt(newQty);
    localStorage.setItem('cart', JSON.stringify(cart));
    displayCart();
}



// shop page
if (document.getElementById('priceRange')) {
    
    window.updatePrice = function() {
        const priceRange = document.getElementById('priceRange').value;
        const priceValue = document.getElementById('priceValue');
        if(priceValue) priceValue.innerText = priceRange;
        filterProducts();
    }

    const categoryInputs = document.querySelectorAll('.category-filter');
    categoryInputs.forEach(input => {
        input.addEventListener('change', filterProducts);
    });

    function filterProducts() {
        const priceRange = parseInt(document.getElementById('priceRange').value);
        
        const selectedCategories = [];
        document.querySelectorAll('.category-filter:checked').forEach(checkbox => {
            selectedCategories.push(checkbox.value);
        });

        const products = document.querySelectorAll('.product-card');

        products.forEach(product => {
            const productPrice = parseInt(product.getAttribute('data-price'));
            const productCategory = product.getAttribute('data-category');

            const matchPrice = productPrice <= priceRange;
            const matchCategory = selectedCategories.length === 0 || selectedCategories.includes(productCategory);

            if (matchPrice && matchCategory) {
                product.style.display = 'block';
            } else {
                product.style.display = 'none';
            }
        });
    }
}

//cupon
let couponApplied = false; 

function applyCoupon() {
    const couponInput = document.getElementById('couponInput');
    const totalElement = document.getElementById('cart-total');
    const btn = document.querySelector('#coupon button');
    
    if (!couponInput || !totalElement) return;

    const code = couponInput.value.trim();

    if (!code) {
        alert("Please enter a coupon code.");
        return;
    }

    if (couponApplied) {
        alert("⚠️ আপনি ইতিমধ্যে একটি কুপন ব্যবহার করেছেন!");
        return;
    }

    
    fetch("/apply-coupon", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ code: code })
    })
    .then(res => res.json())
    .then(data => {
        if (data.status) {
           
            let currentTotal = parseInt(totalElement.innerText);
            let discount = parseInt(data.discount);

            if (currentTotal > discount) { 
                let newTotal = currentTotal - discount;
                totalElement.innerText = newTotal + " Tk";
                
                alert(`🎉 ${data.message} (Discount: ${discount} Tk)`);
                couponApplied = true; 
                
                if(btn) {
                    btn.innerText = "Applied ✅";
                    btn.style.backgroundColor = "green";
                    btn.disabled = true;
                }
            } else {
                alert(" অর্ডারের পরিমাণ ডিসকাউন্টের চেয়ে বেশি হতে হবে।");
            }

        } else {
            
            alert(" " + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert("Something went wrong! Check console.");
    });
}

//password toggle
function togglePassword(inputId, iconId) {
    const inputField = document.getElementById(inputId);
    const icon = document.getElementById(iconId);

    if (inputField && icon) {
        if (inputField.type === "password") {
            inputField.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            inputField.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
}


window.addEventListener('DOMContentLoaded', () => {
    displayCart();
});