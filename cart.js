document.addEventListener('DOMContentLoaded', () => {
    const cartItemsContainer = document.getElementById('cart-items');
    const subTotalElement = document.getElementById('sub-total');
    const discountElement = document.getElementById('discount');
    const totalElement = document.getElementById('total');
    const checkoutBtn = document.getElementById('checkout-btn');

    // Fetch cart data from the server
    function fetchCartData() {
        fetch('cart-proccess/fetch-cart.php')
            .then(response => response.json())
            .then(cartItems => {
                renderCartItems(cartItems);
            })
            .catch(error => {
                console.error('Error fetching cart data:', error);
            });
    }

    function renderCartItems(cartItems) {
        cartItemsContainer.innerHTML = '';
        cartItems.forEach(item => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${item.title}</td>
                <td>${item.price}</td>
                <td>
                    <div class="quantity-control">
                        <button class="decrease-qty" data-id="${item.cart_id}" data-qty="${item.qty}">-</button>
                        <span class="quantity" data-id="${item.cart_id}">${item.qty}</span>
                        <button class="increase-qty" data-id="${item.cart_id}" data-qty="${item.qty}">+</button>
                    </div>
                </td>
                <td>${(item.price * item.qty).toFixed(2)}</td>
                <td><button class="remove-item" data-id="${item.cart_id}">×</button></td>
            `;
            cartItemsContainer.appendChild(row);
        });
        updateTotals(cartItems);
    }

    function updateTotals(cartItems) {
        const subTotal = cartItems.reduce((total, item) => total + item.price * item.qty, 0);
        const discount = 0; // Add discount logic if needed
        const total = subTotal - discount;

        subTotalElement.textContent = subTotal.toFixed(2);
        discountElement.textContent = discount.toFixed(2);
        totalElement.textContent = total.toFixed(2);
    }

    // Handle quantity changes and item removal
    cartItemsContainer.addEventListener('click', (e) => {
        const target = e.target;
        const id = target.dataset.id;

        if (target.classList.contains('increase-qty')) {
            let qty = parseInt(target.dataset.qty);
            updateCartItemQty(id, qty + 1);
        } else if (target.classList.contains('decrease-qty')) {
            let qty = parseInt(target.dataset.qty);
            if (qty > 1) {
                updateCartItemQty(id, qty - 1);
            }
        } else if (target.classList.contains('remove-item')) {
            removeCartItem(id);
        }
    });

    // Function to update cart item quantity
    function updateCartItemQty(cartId, newQty) {
        fetch('cart-proccess/update-cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ cart_id: cartId, qty: newQty })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Fetch updated cart data to re-render the UI
                fetchCartData();
            } else {
                console.error('Error updating cart:', data.message);
            }
        })
        .catch(error => {
            console.error('Error updating cart data:', error);
        });
    }

    // Function to remove cart item
    function removeCartItem(cartId) {
        fetch('cart-proccess/remove-cart-item.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ cart_id: cartId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Fetch updated cart data to re-render the UI
                fetchCartData();
            } else {
                console.error('Error removing cart item:', data.message);
            }
        })
        .catch(error => {
            console.error('Error removing cart item:', error);
        });
    }

    // Call fetchCartData on page load
    fetchCartData();

    // Checkout button functionality
    checkoutBtn.addEventListener('click', () => {
        alert('Proceeding to checkout!');
        // Implement checkout logic here
    });
});
