<?php
// transaction_history.php

// Include your database configuration file
include 'config.php';

// Check if a specific date is provided in the URL
$dateFilter = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

// Fetch transaction history for the specified date
$sql = "SELECT * FROM transactions WHERE DATE(created_at) = '$dateFilter'";
$result = $conn->query($sql);

// Store results in an array
$rows = [];
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

// Calculate the total cash sent on the specified date
$totalCashSent = 0.00;
foreach ($rows as $row) {
    $totalCashSent += $row['total_amount'];
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Transaction History</h1>

        <p>Total Cash Sent on <?php echo $dateFilter; ?>: $<?php echo number_format($totalCashSent, 2); ?></p>

        <?php if (!empty($rows)) : ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Delivery</th>
                        <th>Status</th>
                        <!-- Add additional columns as needed -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row) : ?>
                        <tr>
                            <td><?php echo $row['created_at']; ?></td>
                            <td>$<?php echo number_format($row['total_amount'], 2); ?></td>
                            <td>$<?php echo number_format($row['delivery_price'], 2); ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <!-- Add additional cells based on your data structure -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>No transactions found for the specified date.</p>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
