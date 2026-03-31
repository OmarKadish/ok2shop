document.addEventListener('DOMContentLoaded', () => {

    const addToCartButtons = document.querySelectorAll(".add-to-cart");
    const checkoutButton = document.getElementById("checkout");
    const cartContainer = document.querySelector('#cart-container');
    const cartItems = cartContainer.querySelectorAll(".cart-item");

    let totalAmount = 0;
    cartContainer.addEventListener("load", ()=> {
        cartItems.forEach((cartItem) =>{
            let price = parseFloat(cartItem.querySelector('.price').value);
            totalAmount += price * parseInt(cartItem.querySelector('.quantity').value);
            document.getElementById("total").textContent = `Amount: $${totalAmount}`;
        });
    })


    addToCartButtons.forEach((button) => {
        button.addEventListener("click", (e) => {
            e.preventDefault();
            console.log("Hello");
            const productDiv = e.target.closest(".product");
            const productId = productDiv.getAttribute("data-id");
            const productName = productDiv.getAttribute("data-name");
            const productPrice = parseFloat(productDiv.getAttribute("data-price"));

            const selectedOption = productDiv.querySelector(".product-option").value;
            $.ajax({
                type: "POST",
                url: "./server/save_cart.php",
                dataType: "json",
                data: {
                    'type': "add",
                    'product_id': productId,
                    'quantity': 1,
                    'option': selectedOption },
                success: function (res) {
                    if(res.success) {
                        alert(productName + ' (' + selectedOption + ') added to cart!');
                    } else {
                        alert('Error: ' + res.message);
                    }
                }
            })

        });
    });

    // function updateCartUI() {
    //     cartContainer.innerHTML = ""; // Clear previous items
    //     let totalAmount = 0;

    //     if (cart.length === 0) {
    //         cartContainer.innerHTML = "<p>Your cart is empty.</p>";
    //         return;
    //     }

    //     cart.forEach((item, index) => {
    //         totalAmount += item.price * item.quantity;

    //         const cartItem = document.createElement('div');
    //         cartItem.classList.add('cart-item');

    //         cartItem.innerHTML = `
    //             <img src="images/product${item.id}.jpg" alt="${item.name}">
    //             <div class="cart-item-details">
    //                 <h2>${item.name}</h2>
    //                 <p>$${item.price}</p>
    //                 <p>Quantity: ${item.quantity}</p>
    //             </div>
    //             <button class="remove-btn" data-index="${index}">Remove</button>
    //         `;

    //         cartContainer.appendChild(cartItem);
    //     });
    //     document.querySelector("#total h4").textContent = `Amount: $${totalAmount}`;
    // }

    // document.querySelectorAll('.remove-btn').forEach(button => {
    //     button.addEventListener('click', event => {
    //         const index = event.target.dataset.index;
    //         cart.splice(index, 1);
    //         localStorage.setItem('cart', JSON.stringify(cart));
    //         updateCartUI();
    //     });
    // });

    // checkoutButton.addEventListener('click', () => {
    //     fetch('../server/save_cart.php', {
    //         method: 'POST',
    //         headers: {
    //             'Content-Type': 'application/json'
    //         },
    //         body: JSON.stringify({ cart })
    //     })
    //         .then(response => response.json())
    //         .then(data => {
    //             if (data.success) {
    //                 alert('Cart saved successfully!');
    //                 localStorage.removeItem('cart');
    //                 updateCartUI();
    //             } else {
    //                 alert('Error saving cart.');
    //             }
    //         })
    //         .catch(error => console.error('Error:', error));
    // });

});

