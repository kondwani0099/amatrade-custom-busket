<?php
// admin_process.php

// Include your database configuration file
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the form is submitted
    if (isset($_POST['approve']) || isset($_POST['cancel'])) {
        // Get the transaction ID from the form
        $transactionId = $_POST['transaction_id'];

        // Determine if it's an approval or cancellation
        $status = isset($_POST['approve']) ? 'approved' : 'cancelled';

        // Update the transaction status in the database
        $updateSql = "UPDATE transactions SET status = '$status' WHERE transaction_id = $transactionId";
        $conn->query($updateSql);

        // Redirect back to the admin dashboard
        header('Location: admin.php');
        exit();
    }
}

// If the form is not submitted, redirect to the admin dashboard
header('Location: admin.php');
exit();
?>
