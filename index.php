<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amatrade Store - Custom Basket</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Amatrade Store - Custom Basket</h1>

        <form id="basketForm" method="post" action="process.php">
            <!-- Initial five items -->
            <?php for ($i = 1; $i <= 5; $i++) : ?>
                <div class="form-group">
                    <label for="itemName<?= $i ?>">Item <?= $i ?> Name:</label>
                    <input type="text" name="itemName[]" class="form-control" required>

                    <label for="itemPrice<?= $i ?>">Item <?= $i ?> Price:</label>
                    <input type="number" name="itemPrice[]" step="0.01" class="form-control" required>

        
                </div>
            <?php endfor; ?>
            <form id="basketForm" method="post" action="process.php">
            <!-- Initial five items -->
            <?php for ($i = 1; $i <= 3; $i++) : ?>
                <div class="form-group">
                    
                    <label for="shop<?= $i ?>">Enter Shop for Location <?= $i ?>:</label>
                    <input type="text" name="shop[]" class="form-control" required>
                </div>
            <?php endfor; ?>
            <label for="location<?= $i ?>">Select Location:</label>
                    <select name="location[]" class="form-control" required>
                        <option value="location1">Riverside </option>
                        <option value="location2">Gurton</option>
                        <option value="location3">Ndeke</option>
                    </select>

            <!-- Additional items are added dynamically -->
            <div id="additionalItems"></div>

            <!-- Button to add more items -->
            <button type="button" class="btn btn-primary" onclick="addMoreItems()">Add More</button>

            <!-- Submit button -->
            <button type="submit" class="btn btn-success">Add to Basket</button>
        </form>

        <div id="basketItems">
            <h2>Your Basket</h2>
            <ul id="itemList"></ul>
            <p>Total Price: $<span id="totalPrice">0.00</span></p>
            <!-- The checkout button can remain here or redirect to another page for further processing -->
            <button type="button" onclick="checkout()" class="btn btn-info">Proceed to Checkout</button>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
