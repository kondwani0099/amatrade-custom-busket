<?php
// admin_dashboard.php

// Include your database configuration file
include 'config.php';

// Fetch all transactions and user information from the database
$sql = "SELECT t.*, u.id AS user_id, u.first_name, u.last_name, u.phone FROM transactions t
        INNER JOIN users u ON t.user_id = u.id
        ORDER BY t.created_at DESC";
$result = $conn->query($sql);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Admin Dashboard</h1>

        <?php if ($result->num_rows > 0) : ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>User Name</th>
                        <th>User Phone</th>
                        <th>Total Amount</th>
                        <th>Delivery Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $row['created_at']; ?></td>
                            <td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
                            <td><?php echo $row['phone']; ?></td>
                            <td>$<?php echo number_format($row['total_amount'], 2); ?></td>
                            <td>$<?php echo number_format($row['delivery_price'], 2); ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td>
                                <form action="admin_process.php" method="post">
                                    <input type="hidden" name="transaction_id" value="<?php echo $row['transaction_id']; ?>">
                                    <button type="submit" name="approve" class="btn btn-success">Approve</button>
                                    <button type="submit" name="cancel" class="btn btn-danger">Cancel</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>No transactions found.</p>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
