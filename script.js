let basket = [];

// Use jQuery to handle location change event
$(document).ready(function () {
    $('#location').change(function () {
        // Get the selected location value
        var selectedLocation = $(this).val();

        // Extract the price from the selected location value
        var priceMatch = selectedLocation.match(/K(\d+)/);
        var locationPrice = priceMatch ? parseFloat(priceMatch[1]) : 0;

        // Set the location_price input value
        $('#locationPrice').val(locationPrice);
    });
});
// let additionalItemsCount = 0;

// function addMoreItems() {
//     additionalItemsCount++;
//     const additionalItemsContainer = document.getElementById('additionalItems');

//     const newItemHtml = `
//         <hr>
//         <div class="form-group">
//             <label for="itemNameAdditional${additionalItemsCount}">Additional Item Name:</label>
//             <input type="text" name="itemName[]" class="form-control" required>

//             <label for="itemPriceAdditional${additionalItemsCount}">Additional Item Price:</label>
//             <input type="number" name="itemPrice[]" step="0.01" class="form-control" required>

//             <label for="locationAdditional${additionalItemsCount}">Select Location:</label>
//             <select name="location[]" class="form-control" required>
//                 <option value="location1">Location 1</option>
//                 <option value="location2">Location 2</option>
//                 <option value="location3">Location 3</option>
//             </select>

//             <label for="shopAdditional${additionalItemsCount}">Enter Shop for Location:</label>
//             <input type="text" name="shop[]" class="form-control" required>
//         </div>
//     `;

//     additionalItemsContainer.innerHTML += newItemHtml;
// }

// Other functions (addItem, updateBasket, checkout) remain the same as before

// let additionalItemsCount = 0;


// Add this part to your existing JavaScript code
const initialItemsHtml = `
    <tr>
        <td>
            <label for="itemName1">Item 1 Name:</label>
            <input type="text" name="itemName[]" class="form-control" required>
        </td>
        <td>
            <label for="itemPrice1">Item 1 Price:</label>
            <input type="number" name="itemPrice[]" step="0.01" class="form-control" required>
        </td>
    </tr>
    <tr>
        <td>
            <label for="itemName2">Item 2 Name:</label>
            <input type="text" name="itemName[]" class="form-control" required>
        </td>
        <td>
            <label for="itemPrice2">Item 2 Price:</label>
            <input type="number" name="itemPrice[]" step="0.01" class="form-control" required>
        </td>
    </tr>
    <tr>
        <td>
            <label for="itemName3">Item 3 Name:</label>
            <input type="text" name="itemName[]" class="form-control" required>
        </td>
        <td>
            <label for="itemPrice3">Item 3 Price:</label>
            <input type="number" name="itemPrice[]" step="0.01" class="form-control" required>
        </td>
    </tr>
    <tr>
        <td>
            <label for="itemName4">Item 4 Name:</label>
            <input type="text" name="itemName[]" class="form-control" required>
        </td>
        <td>
            <label for="itemPrice4">Item 4 Price:</label>
            <input type="number" name="itemPrice[]" step="0.01" class="form-control" required>
        </td>
    </tr>
    <tr>
        <td>
            <label for="itemName5">Item 5 Name:</label>
            <input type="text" name="itemName[]" class="form-control" required>
        </td>
        <td>
            <label for="itemPrice5">Item 5 Price:</label>
            <input type="number" name="itemPrice[]" step="0.01" class="form-control" required>
        </td>
    </tr>
`;

function addMoreItems() {
    additionalItemsCount++;
    const additionalItemsContainer = document.getElementById('additionalItems');

    // Check if the total number of items is less than or equal to 5
    if (additionalItemsCount <= 5) {
        const newItemHtml = `
        <tbody>
            <tr>
                <td>
                    <label for="itemNameAdditional${additionalItemsCount}">Additional Item Name:</label>
                    <input type="text" name="itemName[]" class="form-control" required>
                </td>
                <td>
                    <label for="itemPriceAdditional${additionalItemsCount}">Additional Item Price:</label>
                    <input type="number" name="itemPrice[]" step="0.01" class="form-control" required>
                </td>
            </tr>
            </tbody>
        `;

        const tableBody = document.getElementById('itemTableBody');
        tableBody.innerHTML += newItemHtml;
    } else {
        alert("You can only add up to 5 additional items.");
    }
}

// Initialize the table with initial items
document.getElementById('itemTableBody').innerHTML = initialItemsHtml;




// Other functions (addItem, updateBasket, checkout) remain the same as before

function addItem() {
    const itemName = document.getElementById('itemName').value;
    const itemPrice = parseFloat(document.getElementById('itemPrice').value);
    const location = document.getElementById('location').value;
    const shop = document.getElementById('shop').value;

    const item = {
        name: itemName,
        price: itemPrice,
        location: location,
        shop: shop
    };

    basket.push(item);
    updateBasket();
}

function updateBasket() {
    const itemList = document.getElementById('itemList');
    const totalPriceElement = document.getElementById('totalPrice');
    let totalPrice = 0;

    // Clear the previous items
    itemList.innerHTML = '';

    // Update the basket items
    basket.forEach(item => {
        const listItem = document.createElement('li');
        listItem.textContent = `${item.name} - $${item.price.toFixed(2)} - ${item.location} - ${item.shop}`;
        itemList.appendChild(listItem);

        totalPrice += item.price;
    });

    // Update the total price
    totalPriceElement.textContent = totalPrice.toFixed(2);
}

function checkout() {
    // Here, you can implement the logic to send the basket data to the server for further processing (e.g., storing in a database)
    // You can use AJAX or other methods to send the data to a PHP script.
    console.log('Basket:', basket);
    alert('Checkout functionality not implemented in this example.');
}
