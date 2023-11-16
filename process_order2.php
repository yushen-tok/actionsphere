<?php
session_start();

$username = $_SESSION['cust_username'];

require_once('settings.php');

$connection = @mysqli_connect(
    $host,
    $user,
    $pwd,
    $sql_db
);

// Checks if connection is successful
if (!$connection) {
    // Displays an error message
    echo "<p class=\"wrong\">Database connection failure</p>"; // Might not show in a production script 
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Fetch the custID based on the cust_username
        $custIDQuery = "SELECT custID FROM Action_Customer WHERE cust_username = '$username'";
        $result = mysqli_query($connection, $custIDQuery);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $custID = $row['custID'];

            $confirm_name = trim($_POST["hidden_confirm_name"]);
            $confirm_email = trim($_POST["hidden_confirm_email"]);
            $confirm_room = trim($_POST["hidden_confirm_room"]);
            $confirm_pax = trim($_POST["hidden_confirm_pax"]);
            $confirm_max = trim($_POST["hidden_confirm_max"]);
            $confirm_rp = trim($_POST["hidden_confirm_rp"]);
            $confirm_as = trim($_POST["hidden_confirm_as"]);
            $confirm_total = trim($_POST["hidden_confirm_total"]);
            $deductedPoints = isset($_POST['seat_count']) ? intval($_POST['seat_count']) : 0; // Adjust the key based on your form
            $updatePointsSql = "UPDATE Action_Customer SET points = points - $deductedPoints WHERE cust_username = '$username'";

            // Execute the query to update points
            if ($connection->query($updatePointsSql) === TRUE) {
                // Points updated successfully
            } else {
                echo "Error updating points: " . $connection->error;
            }
            $ctype = trim($_POST["ctype"]);
            $cname = trim($_POST["cname"]);
            $cnum = trim($_POST["cnum"]);
            $cexp = trim($_POST["cexp"]);
            $ccvv = trim($_POST["ccvv"]);

            $sql_table = "Action_Bookings";
            
            // Get the current date and time
            $orderTime = date("Y-m-d H:i:s");

            // Store the order time in the session
            $_SESSION["order_time"] = $orderTime;

            // Trim single quotes from the room name
            $trimmedRoomName = str_replace("'", "''", $confirm_room);

            $insertOrderQuery = "INSERT INTO `$sql_table` (
                datetime, custID, RoomName, PricePerPerson, RoomPrice, MaxCapacity, addonsID, totalPrice, AdditionalServicePrice,ccType, ccName, ccNumber, ccExp, ccCVV
            ) SELECT
                '$orderTime', '$custID', '$trimmedRoomName', '$confirm_pax', '$confirm_rp',
                '$confirm_max', '1', '$confirm_total', '$confirm_as', '$ctype', '$cname', '$cnum', '$cexp', '$ccvv'
            FROM dual WHERE NOT EXISTS (
                SELECT datetime FROM `$sql_table` WHERE datetime = '$orderTime'
            ) LIMIT 1";

echo $insertOrderQuery ;
            $resultInsert = mysqli_query($connection, $insertOrderQuery);

            if ($resultInsert) {
                // Database update successful
                echo "Order placed successfully!";
                // You can redirect to the receipt page here if needed
                header("Location: receipt2.php");
            } else {
                // Database update failed
                echo "Error updating database: " . mysqli_error($connection);
            }
        } else {
            // Error fetching custID
            echo "Error fetching custID: " . mysqli_error($connection);
        }
    }
}
