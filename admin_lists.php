<?php
// admin_lists.php

// Include your database configuration file
include 'config.php';

// Assuming you have the basket ID
$basket_id = isset($_GET['basket_id']) ? $_GET['basket_id'] : null;

// Check if $basket_id is set before executing the query
if ($basket_id !== null) {
    // Fetch basket information including user ID
    $basketSql = "SELECT basket.*, users.id as user_id FROM basket JOIN users ON basket.user_id = users.id WHERE basket.id = $basket_id";
    $basketResult = $conn->query($basketSql);

    // Close the database connection
    $conn->close();
} else {
    echo "Basket ID not provided.";
    exit; // Exit the script if no basket ID is provided
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basket Details</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Basket Details</h1>
        <!-- Display basket information including user ID -->
        <?php if ($basketResult->num_rows > 0) : ?>
            <?php $basketDetails = $basketResult->fetch_assoc(); ?>
            <h2>User ID: <?php echo $basketDetails['user_id']; ?></h2>
            <p>Item Name: <?php echo $basketDetails['item_name']; ?></p>
            <p>Item Price: $<?php echo number_format($basketDetails['item_price'], 2); ?></p>
            <p>Location: <?php echo $basketDetails['location']; ?></p>
            <p>Shop: <?php echo $basketDetails['shop']; ?></p>
            <p>Timestamp: <?php echo $basketDetails['timestamp']; ?></p>
            <p>Status: <?php echo $basketDetails['status']; ?></p>
            <!-- Add more basket details as needed -->
        <?php else : ?>
            <p>No basket information found for the specified basket ID.</p>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
