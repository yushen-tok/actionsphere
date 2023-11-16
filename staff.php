<!DOCTYPE html>
<html>

<head>
    <title>Staff page</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles/responsive.css">

    <style>
        th {
            color: white;
        }

        .refresh-button {
            text-align: right;
        }

        .refresh-button button {
            margin-right: 80px;
            /* Adjust the margin as needed */
        }

        .bookingtd td {
            background-color: white;

        }
    </style>
</head>

<?php include("includes/header4.inc"); ?>

<!-- OYZ modified 1st Nov-->
<?php
if (empty($_SESSION['staff_name'])) {
    echo '<script>
        window.alert("Access denied. You are required to log in your account first.");
        window.location.href = "managerstafflogin.php";
    </script>';
    exit; // Stop executing the page
}
?>
<!-- OYZ modified 1st Nov-->

<body class="body">
    <br><br><br><br><br><br><br>
    <h1 class="title1">Staff page</h1>
    <div class="containermanager">
        <table border="1">
            <tbody>
                <?php
                require_once('settings.php');
                $conn = @mysqli_connect(
                    $host,
                    $user,
                    $pwd,
                    $sql_db
                );

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Handle form submissions to update status or delete records
                    if (isset($_POST['bookingID'])) {
                        $bookingID = $_POST['bookingID'];
                        $newStatus = $_POST['status'];

                        if ($newStatus === 'APPROVED') {
                            // Delete the record
                            $deleteSql = "DELETE FROM Action_Bookings WHERE BookingID = $bookingID";
                            $conn->query($deleteSql);
                        } else {
                            // Update the status in the database
                            $updateSql = "UPDATE Action_Bookings SET status = '$newStatus' WHERE BookingID = $bookingID";
                            $conn->query($updateSql);
                        }
                    }
                }

                // Function to fetch and display data
                function fetchData($conn)
                {
                    $sql = "SELECT BookingID, datetime, custID, movie_name, movie_seats, movie_date, movie_time, addonsID, totalPrice, reason, status FROM Action_Bookings WHERE status != ''";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {

                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>BookingID</th>";
                        echo "<th>Datetime</th>";
                        echo "<th>CustID</th>";
                        echo "<th>Movie Name</th>";
                        echo "<th>Movie Seats</th>";
                        echo "<th>Movie Date</th>";
                        echo "<th>Movie Time</th>";
                        echo "<th>AddonsID</th>";
                        echo "<th>Total Price</th>";
                        echo "<th>Reason</th>";
                        echo "<th>Status</th>";
                        echo "</tr>";
                        echo "</thead>";
                        
                        while ($row = $result->fetch_assoc()) {

                            // Check if the status is "REJECTED" and skip this record
                            if ($row["status"] == "REJECTED") {
                                continue;
                            }

                            echo "<tr class='bookingtd'>";
                            echo "<td>" . $row["BookingID"] . "</td>";
                            echo "<td>" . $row["datetime"] . "</td>";
                            echo "<td>" . $row["custID"] . "</td>";
                            echo "<td>" . $row["movie_name"] . "</td>";
                            echo "<td>" . $row["movie_seats"] . "</td>";
                            echo "<td>" . $row["movie_date"] . "</td>";
                            echo "<td>" . $row["movie_time"] . "</td>";
                            echo "<td>" . $row["addonsID"] . "</td>";
                            echo "<td>" . $row["totalPrice"] . "</td>";
                            echo "<td>" . $row["reason"] . "</td>";
                            echo "<td>";
                            if ($row["status"] == "PENDING") { // Use equality operator (==) for comparison
                                // Display a form to change the status or delete the record
                                echo "<form method='post'>";
                                echo "<input type='hidden' name='bookingID' value='" . $row["BookingID"] . "'>";
                                echo "<select name='status'>
                                    <option value='PENDING'>PENDING</option>
                                    <option value='APPROVED'>APPROVED</option>
                                    <option value='REJECTED'>REJECTED</option>
                                </select>";
                                echo "<input type='submit' value='Update'>";
                                echo "</form>";
                            } else {
                                // If status is not "PENDING," display it as text
                                echo $row["status"];
                            }
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "No records found";
                    }
                }

                // Fetch and display data
                fetchData($conn);

                // Close the database connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    <div class="refresh-button">
        <button type="button" onclick="window.location.href='staff.php'">Refresh</button>
    </div>
    <br>
    <?php include 'includes/footer.inc'; ?>
</body>

</html>