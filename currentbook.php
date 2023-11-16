<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Booking</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles/responsive.css">

    <style>
        .refresh-button {
            text-align: right;
        }

        .refresh-button button {
            margin-right: 80px;
            /* Adjust the margin as needed */
        }

        .trbooking th {
            background-color: black;
            color: white;
        }

        .bookingtd td {
            background-color: white;

        }
    </style>
</head>
<?php include("includes/header.inc"); ?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the bookingID input element
        var bookingIDInput = document.getElementById("bookingID");

        // Check if the URL contains the "submitted" parameter
        var urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('submitted') === '1') {
            // Clear the bookingID input field if the form was submitted
            bookingIDInput.value = "";
        }
    });
</script>

<body class="body">
    <br><br><br><br><br><br><br><br><br><br><br><br><br>
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

                // Handle refund request
                if (isset($_POST['refund_request'])) {
                    $bookingID = $_POST['bookingID'];
                    $refundReason = $_POST['refund_reason']; // Get the reason from the form

                    // Update the status and reason for refund request
                    $updateSql = "UPDATE Action_Bookings SET status = 'PENDING', reason = '$refundReason' WHERE BookingID = $bookingID";
                    $conn->query($updateSql);

                    // Redirect to the same page with the "submitted" parameter
                    header("Location: currentbook.php?submitted=1");
                    exit();
                }

                if (isset($_SESSION['cust_username'])) {
                    $cust_username = $_SESSION['cust_username'];

                    // Fetch the custID based on the cust_username
                    $custIDQuery = "SELECT custID FROM Action_Customer WHERE cust_username = '$cust_username'";
                    $custIDResult = $conn->query($custIDQuery);

                    if ($custIDResult->num_rows > 0) {
                        $custIDRow = $custIDResult->fetch_assoc();
                        $custID = $custIDRow['custID'];

                        // Fetch data from the database for the specific customer
                        $sql = "SELECT BookingID, datetime, custID, movie_name, movie_seats, movie_date, movie_time, selectedfandb, totalPrice, ccName, reason, status FROM Action_Bookings WHERE custID = $custID AND RoomName=''";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            echo '<h1>Movie Ticket</h1>';
                            echo '<thead>';
                            echo '<tr class="trbooking">';
                            echo '<th>Booking ID</th>';
                            echo '<th>Book Time</th>';
                            echo '<th>Name</th>';
                            echo '<th>Movie Name</th>';
                            echo '<th>Movie Seats</th>';
                            echo '<th>Movie Date</th>';
                            echo '<th>Movie Time</th>';
                            echo '<th>Food & Beverage</th>';
                            echo '<th>Total Price</th>';
                            echo '<th>Reason</th>';
                            echo '<th>Status</th>';
                            echo '<th>Refund</th>';
                            echo '<th>E-Ticket</th>';
                            echo '</tr>';
                            echo '</thead>';

                            while ($row = $result->fetch_assoc()) {

                                echo "<tr class='bookingtd'>";
                                // Output data as before
                                echo "<td>" . $row["BookingID"] . "</td>";
                                echo "<td>" . $row["datetime"] . "</td>";
                                echo "<td>" . $row["ccName"] . "</td>";
                                echo "<td>" . $row["movie_name"] . "</td>";
                                echo "<td>" . $row["movie_seats"] . "</td>";
                                echo "<td>" . $row["movie_date"] . "</td>";
                                echo "<td>" . $row["movie_time"] . "</td>";
                                echo "<td>";
                                if ($row["selectedfandb"] !== "") {
                                    echo $row["selectedfandb"];
                                } else {
                                    echo "No food and beverage selected for this booking";
                                }
                                echo "</td>";
                                echo "<td> RM" . $row["totalPrice"] . "</td>";
                                echo "<td>" . ($row["reason"] != "" ? $row["reason"] : "N/A") . "</td>";
                                echo "<td>" . ($row["status"] != "" ? $row["status"] : "N/A"). "</td>";


                                // Add a Refund button
                                if ($row["status"] !== "REJECTED" && $row["status"] !== "PENDING" && $row["status"] !== "APPROVED") {
                                    echo "<td>";
                                    echo "<form method='post'>";
                                    echo "<input type='hidden' name='bookingID' value='" . $row["BookingID"] . "'>";
                                    echo "<input type='text' name='refund_reason' placeholder='Enter Reason' required>";
                                    echo "<button type='submit' name='refund_request' onclick='return confirm(\"Are you sure you want to request a refund?\")'>Submit Refund</button>";
                                    echo "</form>";
                                    echo "</td>";
                                } elseif($row["status"]== "PENDING") {
                                    echo "<td>Waiting For Response</td>"; // No button for REJECTED or PENDING statuses
                                }else
                                {
                                    echo "<td>Unavailable to Refund again!</td>";
                                }
                                // Add a form to send details via email
                                echo "<td>";
                                echo "<form method='post' action='e-ticket.php'>";
                                echo "<input type='text' name='recipient_email' placeholder='Recipient Email' required>"; // Email input field
                                echo "<input type='hidden' name='details' value='" . json_encode($row) . "'>";
                                echo "<button type='submit' name='send_email'>Send Details via Email</button>";
                                echo "</form>";
                                echo "</td>";

                                echo "</tr>";
                            }
                        } else {
                            echo '<p style="font-size: 24px; font-weight: bold;">No Booking Yet</p>';
                            echo '<p style="font-size: 16px;">You haven\'t booked any tickets yet. Why not start your movie adventure now?</p>';
                            echo '<a href="index.php" class="btn btn-primary">Book Now</a>';
                        }
                    } else {
                        echo "User not found.";
                    }
                }

                $conn->close();
                ?>
            </tbody>
        </table>
            
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


                if (isset($_SESSION['cust_username'])) {
                    $cust_username = $_SESSION['cust_username'];

                    // Fetch the custID based on the cust_username
                    $custIDQuery = "SELECT custID FROM Action_Customer WHERE cust_username = '$cust_username'";
                    $custIDResult = $conn->query($custIDQuery);

                    if ($custIDResult->num_rows > 0) {
                        $custIDRow = $custIDResult->fetch_assoc();
                        $custID = $custIDRow['custID'];
                    
                    // Fetch data from the database for the specific customer
                    $sql = "SELECT BookingID, datetime, custID, RoomName, PricePerPerson, RoomPrice, MaxCapacity, AdditionalServicePrice, totalPrice, ccName FROM Action_Bookings WHERE custID = $custID AND movie_name=''";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo '<h1>Room Reservation</h1>';
                        echo '<thead>';
                        echo '<tr class="trbooking">';
                        echo '<th>Booking ID</th>';
                        echo '<th>Book Time</th>';
                        echo '<th>Name</th>';
                        echo '<th>Room Name</th>';
                        echo '<th>Price Per Person</th>';
                        echo '<th>Room Price</th>';
                        echo '<th>Max Capacity</th>';
                        echo '<th>Additional Service Price</th>';
                        echo '<th>Total Price</th>';
                        echo '<th>E-Ticket</th>';
                        echo '</tr>';
                        echo '</thead>';

                        while ($row = $result->fetch_assoc()) {

                            echo "<tr class='bookingtd'>";
                            // Output data as before
                            echo "<td>" . $row["BookingID"] . "</td>";
                            echo "<td>" . $row["datetime"] . "</td>";
                            echo "<td>" . $row["ccName"] . "</td>";
                            echo "<td>" . $row["RoomName"] . "</td>";
                            echo "<td> RM" . $row["PricePerPerson"] . "</td>";
                            echo "<td> RM" . $row["RoomPrice"] . "</td>";
                            echo "<td>" . $row["MaxCapacity"] . " Pax</td>";
                            echo "<td> RM" . $row["AdditionalServicePrice"] . "</td>";
                            echo "<td> RM" . $row["totalPrice"] . "</td>";

                            // Add a form to send details via email
                            echo "<td>";
                            echo "<form method='post' action='e-ticket.php'>";
                            echo "<input type='hidden' name='booking_id' value='" . $row["BookingID"] . "'>";
                            echo "<input type='hidden' name='datetime' value='" . $row["datetime"] . "'>";
                            echo "<input type='hidden' name='cc_name' value='" . $row["ccName"] . "'>";
                            echo "<input type='hidden' name='room_name' value='" . $row["RoomName"] . "'>";
                            echo "<input type='hidden' name='PricePerPerson' value='" . $row["PricePerPerson"] . "'>";
                            echo "<input type='hidden' name='RoomPrice' value='" . $row["RoomPrice"] . "'>";
                            echo "<input type='hidden' name='MaxCapacity' value='" . $row["MaxCapacity"] . "'>";
                            echo "<input type='hidden' name='AdditionalServicePrice' value='" . $row["AdditionalServicePrice"] . "'>";
                            echo "<input type='hidden' name='totalPrice' value='" . $row["totalPrice"] . "'>";
                            // Include other details as hidden input fields
                            echo "<input type='text' name='recipient_email' placeholder='Recipient Email' required>"; // Email input field
                            echo "<button type='submit' name='send_emailtheme'>Send Details via Email</button>";
                            echo "</form>";
                            echo "</td>";

                            echo "</tr>";
                        }
                    }else {
                        echo '<p style="font-size: 24px; font-weight: bold;">Explore Our Theme Rooms</p>';
                        echo '<p style="font-size: 16px;">Discover our exciting theme rooms and make your movie experience unforgettable.</p>';
                        echo '<a href="hometheme.php" class="btn btn-primary">Book a Theme Room</a>';
                    }
                }
            }

                $conn->close();
                ?>
            </tbody>
        </table>
        
    </div>
    <div class="refresh-button">
        <button type="button" onclick="window.location.href='currentbook.php'">Refresh</button>
    </div>
    <br><br>
    <?php include 'includes/footer.inc'; ?>
</body>

</html>