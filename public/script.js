function addToCart(productName, price) {
    alert(`${productName} has been added to your cart for KSh ${price}.`);
}

function searchProducts() {
    const query = document.getElementById('search').value;
    alert(`Searching for: ${query}`);
}
