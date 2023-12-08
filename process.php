<?php
// process.php

session_start();
// Include the database configuration
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Collect form data
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    $itemNames = $_POST['itemName'];
    $itemPrices = $_POST['itemPrice'];
    $locations = $_POST['location'];
    $shops = $_POST['shop'];

    // Collect location data
    $locationPrices = [
        "location1_riverside_K50" => 50.0,
        "location2_ndeke_K70" => 70.0,
        // Add more locations and prices as needed
    ];

    // Insert basket items into the database
    for ($i = 0; $i < count($itemNames); $i++) {
        $itemName = $conn->real_escape_string($itemNames[$i]);
        $itemPrice = $conn->real_escape_string($itemPrices[$i]);
        $location = $conn->real_escape_string($locations[$i]);
        $shop = $conn->real_escape_string($shops[$i]);

        // Extract location name and price from the selected option
        $locationParts = explode('_', $location);
        $locationName = $locationParts[0];
        $locationPrice = isset($locationPrices[$location]) ? $locationPrices[$location] : 0;

        // You can store $locationName and $locationPrice in the database as needed
        $sql = "INSERT INTO basket (user_id, item_name, item_price, location, shop, location_price, status)
                VALUES ('$user_id', '$itemName', '$itemPrice', '$locationName', '$shop', '$locationPrice', 'processing')";

        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
            exit();
        }
    }

    // Close the database connection
    $conn->close();

    // Redirect to a success page or back to the form page
    header("Location: success.php");
    exit();
} else {
    // Redirect to the form page if accessed directly
    header("Location: index.php");
    exit();
}
?>
