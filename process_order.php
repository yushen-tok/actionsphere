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

            $confirm_name = $_POST["hidden_confirm_name"];
            $confirm_email = $_POST["hidden_confirm_email"];
            $confirm_movie = $_POST["hidden_confirm_movie"];
            $confirm_date = $_POST["hidden_confirm_date"];
            $confirm_time = $_POST["hidden_confirm_time"];
            $confirm_seats = $_POST["hidden_confirm_seats"];
            $confirm_total = $_POST["hidden_confirm_total"];
            $confirm_fandb = $_POST["hidden_confirm_f&b"];

            $deductedPoints = isset($_POST['seat_count']) ? intval($_POST['seat_count']) : 0; // Adjust the key based on your form
            $updatePointsSql = "UPDATE Action_Customer SET points = points - $deductedPoints WHERE cust_username = '$username'";

            // Execute the query to update points
            if ($connection->query($updatePointsSql) === TRUE) {
                // Points updated successfully
            } else {
                echo "Error updating points: " . $connection->error;
            }

            $ctype = $_POST["ctype"];
            $cname = $_POST["cname"];
            $cnum = $_POST["cnum"];
            $cexp = $_POST["cexp"];
            $ccvv = $_POST["ccvv"];

            $sql_table = "Action_Bookings";

            // Get the current date and time
            $orderTime = date("Y-m-d H:i:s");

            // Store the order time in the session
            $_SESSION["order_time"] = $orderTime;

            $insertOrderQuery = "INSERT INTO `$sql_table` (
                datetime, custID, movie_name, movie_seats, movie_date, movie_time, addonsID, selectedfandb, totalPrice, ccType, ccName, ccNumber, ccExp, ccCVV
            ) SELECT
                '$orderTime', '$custID', '$confirm_movie', '$confirm_seats', '$confirm_date',
                '$confirm_time', '1', '$confirm_fandb', '$confirm_total', '$ctype', '$cname', '$cnum', '$cexp','$ccvv'
            FROM dual WHERE NOT EXISTS (
                SELECT datetime FROM `$sql_table` WHERE datetime = '$orderTime'
            ) LIMIT 1";

            echo $insertOrderQuery;

            $sql = "UPDATE Action_Customer SET spins = spins + 1 WHERE cust_username = '$cust_username'";
            if ($connection->query($sql) === TRUE) {
            } else {
                echo "Error updating spins." . $connection->error;
            }

            $resultInsert = mysqli_query($connection, $insertOrderQuery);


            if ($resultInsert) {
                $qweq = 1;
                $sql = "UPDATE Action_Customer SET spins = spins + $qweq WHERE cust_username = '$cust_username'";

                $resultupdate = mysqli_query($connection, $sql);

                if ($resultupdate) {
                    // Database update successful
                    echo "Order placed successfully!";
                    // You can redirect to the receipt page here if needed
                    header("Location: receipt.php");
                } else {
                    // Database update failed
                    echo "Error updating spins: " . mysqli_error($connection);
                }
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
