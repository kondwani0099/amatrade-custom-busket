// Assuming you have a variable to keep track of the total price
let totalBasketPrice = 0.00;

function calculateTotalPrice() {
    const itemPrices = document.getElementsByName('itemPrice[]');
    totalBasketPrice = 0.00;

    for (let i = 0; i < itemPrices.length; i++) {
        const itemPrice = parseFloat(itemPrices[i].value);
        if (!isNaN(itemPrice)) {
            totalBasketPrice += itemPrice;
        }
    }

    // Update the total price element
    document.getElementById('totalPrice').innerText = totalBasketPrice.toFixed(2);
}

function addMoreItems() {
    // Your existing code for adding more items

    // After adding items, recalculate the total price
    calculateTotalPrice();
}

// Initialize the total price on page load
calculateTotalPrice();
