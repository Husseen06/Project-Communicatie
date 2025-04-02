// Winkelwagen functionaliteit
let cart = [];

const addToCartButtons = document.querySelectorAll('.add-to-cart');
const cartItems = document.getElementById('cart-items');
const checkoutButton = document.getElementById('checkout');

// Voeg product toe aan winkelwagen
addToCartButtons.forEach(button => {
    button.addEventListener('click', (e) => {
        const productName = e.target.previousElementSibling.previousElementSibling.textContent;
        const productPrice = e.target.previousElementSibling.textContent;

        cart.push({ productName, productPrice });
        updateCart();
    });
});

// Update winkelwagenweergave
function updateCart() {
    cartItems.innerHTML = '';
    cart.forEach(item => {
        const li = document.createElement('li');
        li.textContent = `${item.productName} - ${item.productPrice}`;
        cartItems.appendChild(li);
    });
}

// Checkout actie
checkoutButton.addEventListener('click', () => {
    document.getElementById('checkout').style.display = 'none';
    document.getElementById('confirmation').style.display = 'block';
});
