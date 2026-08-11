let cart=[];


function addToCart(name, price) {

    let product = cart.find(item => item.name === name);

    if (product) {
        product.qty++;
    } else {
        cart.push({
            name: name,
            price: price,
            qty: 1
        });
    }

    updateCart();

    document.getElementById("cartBox").classList.add("active");
}


function updateCart() {

    let items = document.getElementById("cartItems");
    let total = 0;

    items.innerHTML = "";

    if (cart.length == 0) {
        items.innerHTML = "<p>Your cart is empty</p>";
    }

    cart.forEach((product, index) => {

        total += product.price * product.qty;

        items.innerHTML += `
        <div class="cart-item">

            <div>
                <h4>${product.name}</h4>
                <p>₹${product.price}</p>
            </div>

            <div class="qty-box">
                <button onclick="decreaseQty(${index})">-</button>

                <span>${product.qty}</span>

                <button onclick="increaseQty(${index})">+</button>
            </div>

        </div>
        `;
    });

    document.getElementById("total").innerHTML = total;

    let count = 0;

    cart.forEach(item => count += item.qty);

    document.getElementById("cartCount").innerHTML = count;
}




function removeItem(index){


cart.splice(index,1);


updateCart();


}
function increaseQty(index) {
    cart[index].qty++;
    updateCart();
}

function decreaseQty(index) {

    cart[index].qty--;

    if (cart[index].qty == 0) {
        cart.splice(index, 1);
    }

    updateCart();
}




function closeCart(){


document.getElementById("cartBox")
.classList.remove("active");


}





// Theme changer

function changeTheme(color){

document.documentElement
.style.setProperty("--main",color);

}
function openCart(){

document.getElementById("cartBox")
.classList.add("active");

}
function proceedToPay() {

    if (cart.length === 0) {
        alert("Your cart is empty!");
        return;
    }

    alert("✅ Order Placed Successfully!\n\nThank you for shopping with ShopZone.");

    cart = [];

    updateCart();

    closeCart();
}
