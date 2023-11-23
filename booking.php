<!DOCTYPE html>
<html lang="en">

<head>
    <title>Booking</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles/responsive.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

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

<?php include("includes/header4.inc"); ?>

<!-- Include DataTables JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Initialize DataTable for bookingTable
        $('#bookingTable').DataTable();

        // Initialize DataTable for roomTable
        $('#roomTable').DataTable();

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
        <!-- Add an ID to the table for initialization -->
        <table id="bookingTable" border="1">
            <thead>
                <tr class="trbooking">
                    <th>Booking ID</th>
                    <th>Book Time</th>
                    <th>Name</th>
                    <th>Movie Name</th>
                    <th>Movie Seats</th>
                    <th>Movie Date</th>
                    <th>Movie Time</th>
                    <th>Food & Beverage</th>
                    <th>Total Price</th>
                    <th>Reason</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Your PHP code for fetching and displaying bookings
                require_once('settings.php');
                $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                if (isset($_SESSION['staff_name'])) {
                    $staff_name = $_SESSION['staff_name'];

                    // Fetch the staffID based on the staff_name
                    $staffIDQuery = "SELECT staffID FROM Action_Staff WHERE staff_name = '$staff_name'";
                    $staffIDResult = $conn->query($staffIDQuery);

                    if ($staffIDResult->num_rows > 0) {
                        $staffIDRow = $staffIDResult->fetch_assoc();
                        $staffID = $staffIDRow['staffID'];

                        // Fetch data from the database for the specific staff member
                        $sql = "SELECT BookingID, datetime, custID, movie_name, movie_seats, movie_date, movie_time, selectedfandb, totalPrice, ccName, reason, status FROM Action_Bookings WHERE RoomName=''";

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr class='bookingtd'>";
                                echo "<td>" . $row["BookingID"] . "</td>";
                                echo "<td>" . $row["datetime"] . "</td>";
                                echo "<td>" . $row["ccName"] . "</td>";
                                echo "<td>" . $row["movie_name"] . "</td>";
                                echo "<td>" . $row["movie_seats"] . "</td>";
                                echo "<td>" . $row["movie_date"] . "</td>";
                                echo "<td>" . $row["movie_time"] . "</td>";
                                echo "<td>" . ($row["selectedfandb"] !== "" ? $row["selectedfandb"] : "No food and beverage selected for this booking") . "</td>";
                                echo "<td> RM" . $row["totalPrice"] . "</td>";
                                echo "<td>" . ($row["reason"] != "" ? $row["reason"] : "N/A") . "</td>";
                                echo "<td>" . ($row["status"] != "" ? $row["status"] : "N/A") . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo '<tr><td colspan="11">No Booking Yet</td></tr>';
                        }
                    } else {
                        echo '<tr><td colspan="11">User not found.</td></tr>';
                    }
                }

                
                ?>
            </tbody>
        </table>

        <!-- Another table for Room Reservation -->
        <table id="roomTable" border="1">
            <thead>
                <tr class="trbooking">
                    <th>Booking ID</th>
                    <th>Book Time</th>
                    <th>Name</th>
                    <th>Room Name</th>
                    <th>Price Per Person</th>
                    <th>Room Price</th>
                    <th>Max Capacity</th>
                    <th>Additional Service Price</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Your PHP code for fetching and displaying room reservations
                $sql = "SELECT BookingID, datetime, custID, RoomName, PricePerPerson, RoomPrice, MaxCapacity, AdditionalServicePrice, totalPrice, ccName FROM Action_Bookings WHERE movie_name=''";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr class='bookingtd'>";
                        echo "<td>" . $row["BookingID"] . "</td>";
                        echo "<td>" . $row["datetime"] . "</td>";
                        echo "<td>" . $row["ccName"] . "</td>";
                        echo "<td>" . $row["RoomName"] . "</td>";
                        echo "<td> RM" . $row["PricePerPerson"] . "</td>";
                        echo "<td> RM" . $row["RoomPrice"] . "</td>";
                        echo "<td>" . $row["MaxCapacity"] . " Pax</td>";
                        echo "<td> RM" . $row["AdditionalServicePrice"] . "</td>";
                        echo "<td> RM" . $row["totalPrice"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo '<tr><td colspan="9">Explore Our Theme Rooms</td></tr>';
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <br><br>
    <?php include 'includes/footer.inc'; ?>
</body>

</html>
