<?php
// success.php

session_start();
include 'config.php';

// ... (your existing code)



// Get the total cash sent on a particular day
// $date = date("Y-m-d"); // Get the current date, you can modify this as needed

// $sql = "SELECT SUM(location_price) AS total_cash FROM basket WHERE DATE(timestamp) = '$date'";
// $result = $conn->query($sql);

// if ($result) {
//     $row = $result->fetch_assoc();
//     $totalCash = $row['total_cash'];
// } else {
//     $totalCash = 0; // Default value if no records are found
// }

// $date = date("Y-m-d"); // Get the current date, you can modify this as needed

// $sql = "SELECT SUM(location_price) AS total_cash FROM basket WHERE DATE(added_time) = '$date'";
// $result = $conn->query($sql);

// if ($result) {
//     $row = $result->fetch_assoc();
//     $totalCash = $row['total_cash'];
// } else {
//     $totalCash = 0; // Default value if no records are found
// }
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Retrieve the most recently added basket for the user
$sqlRecent = "SELECT * FROM basket WHERE user_id = '$user_id' AND status = 'processing' ORDER BY added_time DESC LIMIT 1";
$resultRecent = $conn->query($sqlRecent);

if ($resultRecent->num_rows > 0) {
    $mostRecentBasket = $resultRecent->fetch_assoc();

    // Get the total cash sent on a particular day
    $date = date("Y-m-d"); // Get the current date, you can modify this as needed

    // Retrieve the total location price for the most recently added basket
    $totalLocationPrice = $mostRecentBasket['location_price'];

    // Sum up the location prices of all baskets excluding the most recent one on the current day
    $sql = "SELECT SUM(location_price) AS total_cash FROM basket WHERE DATE(added_time) = '$date' AND added_time < '{$mostRecentBasket['added_time']}'";
    $result = $conn->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        $totalCash = $row['total_cash'];
    } else {
        $totalCash = 0; // Default value if no records are found
    }
} else {
    // No recent basket found for the user
    $totalCash = 0; // Default value
}
// $totalPrice = 0.00;
// Calculate total price of items
//$totalPrice = 0.00;
$serviceFee = 20.00;
$totalPriceOfItems = 0.00;
while ($row = $result->fetch_assoc()) {
    $totalPriceOfItems += $row['item_price'];
}

// Calculate total amount including delivery and service fee
$serviceFee = isset($serviceFee) ? $serviceFee : 0.00;
// $lastRow = isset($lastRow) ? $lastRow : ['location_price' => 0.00];
$totalAmount = $totalPriceOfItems + $serviceFee + $totalCash;

// Insert into transactions table
$sqlTransaction = "INSERT INTO transactions (user_id, total_amount, delivery_price, status)
                  VALUES ('$user_id', '$totalAmount', '$totalCash', 'pending')";

if ($conn->query($sqlTransaction) !== TRUE) {
    echo "Error: " . $sqlTransaction . "<br>" . $conn->error;
    exit();
}



$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Retrieve the earliest transaction time for the user
$sqlTime = "SELECT MAX(added_time) AS earliest_time FROM basket WHERE user_id = '$user_id' AND status = 'processing'";
$resultTime = $conn->query($sqlTime);
$earliestTime = $resultTime->fetch_assoc()['earliest_time'];

// Retrieve basket information for the user based on the earliest transaction time
$sql = "SELECT * FROM basket WHERE user_id = '$user_id' AND status = 'processing' AND added_time = '$earliestTime'";
$result = $conn->query($sql);






// Assuming you have a valid user session
// $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// // Retrieve the earliest transaction time for the user
// $sqlTime = "SELECT MIN(timestamp) AS earliest_time FROM basket WHERE user_id = '$user_id' AND status = 'processing'";
// $resultTime = $conn->query($sqlTime);
// $earliestTime = $resultTime->fetch_assoc()['earliest_time'];

// // Retrieve basket information for the user based on the earliest transaction time
// $sql = "SELECT * FROM basket WHERE user_id = '$user_id' AND status = 'processing' AND timestamp = '$earliestTime'";
// $result = $conn->query($sql);


// Assuming you have a valid user session


// Assuming you have a valid user session
// $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// // Retrieve the most recently added basket for the user
// $sqlRecent = "SELECT * FROM basket WHERE user_id = '$user_id' AND status = 'processing' ORDER BY timestamp DESC LIMIT 1";
// $resultRecent = $conn->query($sqlRecent);

// if ($resultRecent === false) {
//     // Handle the error (you might want to log it or display a message)
//     echo "Error: " . $conn->error;
// } else {
//     // Check if any rows were returned
//     if ($resultRecent->num_rows > 0) {
//         $mostRecentBasket = $resultRecent->fetch_assoc();
//         // Now you can use $mostRecentBasket as needed
//     } else {
//         // No recent basket found for the user
//         $mostRecentBasket = null;
//     }
// }




// Calculate total price and add service fee
$totalPrice = 0.00;
$serviceFee = 20.00;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amatrade Store - Order Success</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
       <!-- Additional CSS Files -->
       <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">

<link rel="stylesheet" href="assets/css/templatemo-softy-pinko.css">

</head>
</head>
<body>
    <div class="container">
        <h1>Amatrade Store - Order Success</h1>

        <?php if ($result->num_rows > 0) : ?>
            <div>
                <h2>Order Details</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <tr>
                                <td><?php echo $row['item_name']; ?></td>
                                <td>K<?php echo number_format($row['item_price'], 2); ?></td>
                            </tr>
                            <?php $totalPrice += $row['item_price']; ?>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <p>Total Price of Items: K<?php echo number_format($totalPrice, 2); ?></p>
               
                <?php
                // Assuming the location_price is the same for all items in the order
                $lastRow = $result->fetch_assoc();
               // $locationPrice = $lastRow['location_price'];
                ?>
                
                <div>
            <p>Delivery Date <?php echo $date; ?></p>
            <p>Delivery: K<?php echo number_format($totalCash, 2); ?></p>
        </div>

                <p>Service Fee: K<?php echo number_format($serviceFee, 2); ?></p>
                <p><strong>Total Amount: K<?php echo number_format($totalPrice + $serviceFee +$totalCash, 2); ?></strong></p>
            </div>

            <div class="card mt-4">
   

   

            <div class="card-body">
    <?php
    // Fetch all rows from the result set
    $allStatuses = [];
    while ($row = $result->fetch_assoc()) {
        $allStatuses[] = $row['status'];
    }

    // Check if there are any rows in the result set
    if (!empty($allStatuses)) {
        // Get a random status
        $randomStatus = $allStatuses[array_rand($allStatuses)];
    ?>
        <h5 class="card-title">Current Status: <?php echo $randomStatus; ?></h5>
        <p class="card-text">Your order is currently <?php echo $randomStatus; ?>.</p>
    <?php
    } else {
    ?>
        <p class="card-text">Order status information not available.</p>
    <?php
    }
    ?>
</div>




</div>




        <?php else : ?>
            <p>No items found for the order.</p>
        <?php endif; ?>

        <div>
            <h2>Deposit Information</h2>
            <p>Deposit the total amount to the following account:</p>
            <p>Account Name: Kondwani Nyirenda</p>
            <p>Account Number: 0960322980</p>
            <!-- You can add additional details such as bank information, etc. -->
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
