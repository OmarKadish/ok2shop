document.addEventListener('DOMContentLoaded', () => {

    const addToCartButtons = document.querySelectorAll(".add-to-cart");

    addToCartButtons.forEach((button) => {
        button.addEventListener("click", (e) => {
            e.preventDefault();
            console.log("Hello");
            const productDiv = e.target.closest(".product");
            const productId = productDiv.getAttribute("data-id");
            //const productName = productDiv.getAttribute("data-name");
            //const productPrice = parseFloat(productDiv.getAttribute("data-price"));

            const selectedOption = productDiv.querySelector(".product-option").value;
            $.ajax({
                type: "POST",
                url: "./server/save_cart.php",
                dataType: "json",
                data: {
                    'type': "add",
                    'product_id': productId,
                    'quantity': 1,
                    'option': selectedOption
                },
                success: function (res) {
                    if (res.success) {
                        alert(productName + ' (' + selectedOption + ') added to cart!');
                    } else {
                        alert('Error: ' + res.message);
                    }
                }
            })

        });
    });
    // --- Cart Total Calculation and remove function implementation (For cart.php) ---
    // const cartContainer = document.querySelector('#cart-container');
    const removeButtons = document.querySelectorAll(".remove-btn");
    removeButtons.forEach((button) => {
        button.addEventListener("click", (e) => {
            e.preventDefault();
            console.log("Hello");
            const itemId = e.target.getAttribute("data-id");
            const cartItem = e.target.closest(".cart-item");
            $.ajax({
                type: "POST",
                url: "./server/save_cart.php",
                dataType: "json",
                data: {
                    'type': "remove",
                    'cart_id': itemId
                },
                success: function (res) {
                    if (res.success) {
                        cartItem.remove();       // Remove the element from the DOM
                        updateCartTotal();       // Recalculate total
                    } else {
                        alert('Error: ' + res.message);
                    }
                },
                error: function () {
                    alert('Request failed. Please try again.');
                }
            });
        });
        updateCartTotal();

    });

    const checkoutButton = document.getElementById("checkout");
    const cartItems = cartContainer.querySelectorAll(".cart-item");

    function updateCartTotal() {
        let total = 0;
        const prices = document.querySelectorAll(".item-total-price");
        prices.forEach(p => {
            total += parseFloat(p.innerText.replace('$', ''));
        });
        const totalDisplay = document.getElementById("total-amount");
        if (totalDisplay) totalDisplay.innerText = `$${total.toFixed(2)}`;
    }

    // function updateCartUI() {
    //     cartContainer.innerHTML = ""; // Clear previous items
    //     let totalAmount = 0;
    //     console.log("hi cart");
    //
    //     if (cartItems.length === 0) {
    //         cartContainer.innerHTML = "<p>Your cart is empty.</p>";
    //         return;
    //     }
    //
    //     cartItems.forEach((item, index) => {
    //         totalAmount += item.price * item.quantity;
    //
    //         const cartItem = document.createElement('div');
    //         cartItem.classList.add('cart-item');
    //
    //         cartItem.innerHTML = `
    //             <img src="images/product${item.id}.jpg" alt="${item.name}">
    //             <div class="cart-item-details">
    //                 <h2>${item.name}</h2>
    //                 <p>$${item.price}</p>
    //                 <p>Quantity: ${item.quantity}</p>
    //             </div>
    //             <button class="remove-btn" data-index="${index}">Remove</button>
    //         `;
    //
    //         cartContainer.appendChild(cartItem);
    //     });
    //     document.querySelector("#total h4").textContent = `Amount: $${totalAmount}`;
    // }
    //
    // document.querySelectorAll('.remove-btn').forEach(button => {
    //     button.addEventListener('click', event => {
    //         const index = event.target.dataset.index;
    //         cartItems.splice(index, 1);
    //         localStorage.setItem('cart', JSON.stringify(cartItems));
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

