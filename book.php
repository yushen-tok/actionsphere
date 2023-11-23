<?php
session_start();
$username = $_SESSION['cust_username'];
$_SESSION['cust_username'] = $username;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Page</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Lato&display=swap');

        * {
            box-sizing: border-box;
        }

        body {
            background-image: url("../styles/images/bg.png");
            background-color: black;
            display: flex;
            flex-direction: column;
            color: white;
            align-items: center;
            justify-content: center;
            height: 100vh;
            font-family: 'Lato', 'sans-serif';
        }

        .movie-container {
            margin: 20px 0;
        }

        .movie-container select {
            background-color: #fff;
            border: 0;
            border-radius: 5px;
            font-size: 14px;
            margin-left: 10px;
            padding: 5px 15px 5px 15px;
            -moz-appearance: none;
            -webkit-appearance: none;
            appearance: none;
        }

        .container {
            perspective: 1000px;
            margin-bottom: 30px;
        }

        .seat {
            background-color: #444451;
            height: 50px;
            width: 53px;
            margin: 3px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .seat.selected {
            background-color: green;
        }

        .seat.occupied {
            background-color: red;
        }

        .seat:nth-of-type(2) {
            margin-right: 18px;
        }

        .seat:nth-last-of-type(2) {
            margin-left: 18px;
        }

        .seat:not(.occupied):hover {
            cursor: pointer;
            transform: scale(1.2);
        }

        .showcase .seat:not(.occupied):hover {
            cursor: default;
            transform: scale(1);
        }

        .showcase {
            background-color: rgba(0, 0, 0, 0.1);
            padding: 5px 10px;
            border-radius: 5px;
            color: #777;
            list-style-type: none;
            display: flex;
            justify-content: space-between;
        }

        .showcase li {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 10px;
        }

        .showcase li small {
            margin-left: 10px;
        }

        .row {
            display: flex;
        }

        .screen {
            background-color: #fff;
            color: black;
            text-align: center;
            font-size: 35px;
            height: 70px;
            width: 100%;
            margin: 15px 0;
            transform: rotateX(-45deg);
            box-shadow: 0 3px 10px rgba(255, 255, 255, 0.75);
        }

        p.text {
            margin: 5px 0;
        }

        p.text span {
            color: #6feaf6;
        }

        .booking-form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            color: black;
            background-color: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        }

        .booking-form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }

        .booking-form button {
            width: 100%;
            padding: 10px;
            background-color: #333;
            border: none;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
        }

        .booking-form button:hover {
            background-color: #C93636;
        }

        #continueButton,
        #backButton {
            padding: 10px 25px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 20px;
            font-weight: bold;
            text-transform: uppercase;
        }

        #continueButton {
            background-color: #E50914;
            /* Red color */
            color: white;
        }

        #backButton {
            background-color: #0F6FFF;
            /* Blue color */
            color: white;
        }

        #continueButton:hover,
        #backButton:hover {
            opacity: 0.8;
        }

        /* Display buttons next to each other and add some margin */
        #continueButton,
        #backButton {
            display: inline-block;
            margin-right: 10px;
            /* Adjust the margin to your preference */
        }
    </style>
</head>

<body>

    <?php

    // Function to get occupied seats from the database based on movie, date, and time
    function getOccupiedSeatsFromDatabase($movieTitle, $date, $time)
    {

        // Necessary files and establish database connection
        require_once('settings.php');

        $connection = @mysqli_connect(
            $host,
            $user,
            $pwd,
            $sql_db
        );

        // Check connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
        // Prepare the SQL query
        $sql = "SELECT movie_seats FROM Action_Bookings WHERE movie_name = '$movieTitle' AND movie_date = '$date' AND movie_time = '$time'";
        $result = $connection->query($sql);

        $occupiedSeats = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Split the movie seats by commas and add each seat to the occupiedSeats array
                $seats = explode(',', $row['movie_seats']);
                foreach ($seats as $seat) {
                    $occupiedSeats[] = trim($seat); // Trim to remove any leading/trailing spaces
                }
            }
        }


        $connection->close();

        return $occupiedSeats;
    }
    function getpref()
    {

        // Necessary files and establish database connection
        require_once('settings.php');

        $connection = @mysqli_connect(
            $host,
            $user,
            $pwd,
            $sql_db
        );

        // Check connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }


        // Define the SQL query to retrieve the desired values
        $username = $_SESSION['cust_username'];
        $query = "SELECT cust_username, cust_contactNo, cust_email FROM `Action_Customer` WHERE cust_username = '$username'";

        // Step 3: Perform the database query
        $result1 = mysqli_query($connection, $query);

        if (!$result1) {
            // Handle the query error, if any
            die("Query error: " . mysqli_error($connection));
        }

        if (mysqli_num_rows($result1) > 0) {
            // Step 4: Fetch the results and store them in session storage
            $row = mysqli_fetch_assoc($result1);

            $_SESSION['cust_contactNo'] = $row['cust_contactNo'];
            $_SESSION['cust_email'] = $row['cust_email'];
        } else {
            // You may want to provide default values or handle this case as needed
        }
        $connection->close();
    }
    if (isset($_GET['category'])) {
        $category = $_GET['category'];
        if ($category === 'theme_room') {
            $room = $_GET['room'];
            echo '<h2>Theme Room Booking Form</h2>';
            if ($room === "theme1") {
                $room_name = 'Star Wars\' theme room';
                $room_price = 175;
                $pax_price = 15;
                $AS_price = 1250;
                $SnD_price = 125;
                $max = 7;
                //$totalPrice = 175 + ($seatCount * 15);
            } elseif ($room === "theme2") {
                $room_name = 'The Dark Knight\'s theme room';
                $room_price = 150;
                $pax_price = 5;
                $AS_price = 1000;
                $SnD_price = 225;
                $max = 10;
                //$totalPrice = 150 + ($seatCount * 15);
            } elseif ($room === "theme3") {
                echo '<h3>Theme Room Price: RM 210</h3>';
                $room_name = 'Jurassic Park\'s theme room';
                $room_price = 210;
                $pax_price = 20;
                $AS_price = 1500;
                $SnD_price = 140;
                $max = 10;
                //$totalPrice = 210 + ($seatCount * 15);
            }
            if (isset($_SESSION['cust_username'])) {
            } else {
                $_SESSION['cust_username'] = "";
            }
            if (isset($_SESSION['cust_contactNo'])) {
            } else {
                $_SESSION['cust_contactNo'] = "";
            }
            if (isset($_SESSION['cust_email'])) {
            } else {
                $_SESSION['cust_email'] = "";
            }

            $_SESSION['room_name'] = $room_name;
            $_SESSION['room_price'] = $room_price;
            $_SESSION['pax_price'] = $pax_price;
            $_SESSION['AS_price'] = $AS_price;
            $_SESSION['SnD_price'] = $SnD_price;
            $_SESSION['max'] = $max;
            getpref();
            echo '<div class="booking-form">';
            echo '<form action="payment2.php" method="post" oninput="calculateTotal()">';
            echo '<label for="name">Full Name:</label><br>';
            echo '<input type="text" id="name" name="name" value="' . $_SESSION['cust_username'] . '"><br>';
            echo '<label for="email">Email:</label><br>';
            echo '<input type="email" id="email" name="email" value="' . $_SESSION['cust_email'] . '"><br>';
            echo '<label for="phone">Phone:</label><br>';
            echo '<input type="tel" id="phone" name="phone" value="' . $_SESSION['cust_contactNo'] . '"><br>';
            echo '<p>Room Selected: ' . $room_name . '</p>';
            echo '<p>Theme Room Price: RM' . $room_price . '</p>';
            //Additional Booking Options
            echo '<h3>Additional Services:</h3>';
            echo '<label for="audiovisual">Audiovisual Setup ** - RM' . $AS_price . '</label><br>';
            echo '<input type="checkbox" id="audiovisual" name="services[]" value="Audiovisual Setup **">';
            echo '<label for="snacks_drinks">Snacks and Drinks ** - RM' . $SnD_price . '</label><br>';
            echo '<input type="checkbox" id="snacks_drinks" name="services[]" value="Snacks and Drinks **">';
            echo '<label for="pre_show">Interactive Pre-Show - FREE</label><br>';
            echo '<input type="checkbox" id="pre_show" name="services[]" value="Interactive Pre-Show">';

            // Number of Seats
            echo '<label for="seat_count">Number of People (RM' . $pax_price . ' per pax):</label><br>';
            echo '<input type="number" id="seat_count" name="seat_count" min="1" max = "' . $max . '" required><br>';

            //Additional Remarks
            echo '<label for="remarks">Remarks:</label><br>';
            echo '<textarea id="remarks" name="remarkss" rows="4" cols="50"></textarea><br>';

            //Total Price Calculation

            echo '<h3 id="total_price">Total Price: RM' . $room_price . '</h3>';
            echo '<button type="submit">Submit Booking</button>';
            echo '</form>';
            echo '</div>';

            echo '<script>
            function calculateTotal() {
                var seatCount = parseInt(document.getElementById("seat_count").value);
                var paxPrice = ' . $pax_price . ';
                var roomPrice = ' . $room_price . ';
                var totalAdditionalServicesPrice = 0;

                // Check if Audiovisual Setup checkbox is selected
                if (document.getElementById("audiovisual").checked) {
                    totalAdditionalServicesPrice += ' . $AS_price . ';
                }

                // Check if Snacks and Drinks checkbox is selected
                if (document.getElementById("snacks_drinks").checked) {
                    totalAdditionalServicesPrice += ' . $SnD_price . ';
                }

                var totalPrice = roomPrice + (seatCount * paxPrice) + totalAdditionalServicesPrice;
                document.getElementById("total_price").textContent = "Total Price: RM" + totalPrice.toFixed(2);
                sessionStorage.setItem("room_name", "' . $room_name . '");
                sessionStorage.setItem("room_price", ' . $room_price . ');
                sessionStorage.setItem("pax_price", ' . $pax_price . ');
                sessionStorage.setItem("AS_price", ' . $AS_price . ');
                sessionStorage.setItem("SnD_price", ' . $SnD_price . ');
                sessionStorage.setItem("max", ' . $max . ');
                sessionStorage.setItem("total_price", totalPrice.toFixed(2));
            }
            
            </script>';
        } elseif ($category === 'movie' && isset($_GET['movie'])) {
            $selectId = ''; // Set the select element's ID based on the movie
            $movieTitle = '';
            $moviePrice = 0;

            if ($_GET['movie'] === 'Transformers: Rise of the Beasts') {
                $selectId = 'transformer';
                $movieTitle = 'Transformers: Rise of the Beasts';
                $moviePrice = 15;
                $hallNumber = 'Hall 1';
            } elseif ($_GET['movie'] === 'Avengers: Endgame') {
                $selectId = 'endgame';
                $movieTitle = 'Avengers: Endgame';
                $moviePrice = 20;
                $hallNumber = 'Hall 3';
            } elseif ($_GET['movie'] === 'Mission: Impossible - Dead Reckoning Part One') {
                $selectId = 'impossible';
                $movieTitle = 'Mission: Impossible - Dead Reckoning Part One';
                $moviePrice = 25;
                $hallNumber = 'Hall 2';
            }

            //extract session from movie page
            $selectedMovie = $_GET['movie'];
            $selectedDate = $_GET['date'];
            $selectedTime = $_GET['time'];

            echo '<div class="movie-container">';
            echo '<label>Movie:</label>';
            echo "<select id=\"$selectId\">";
            echo "<option value=\"$moviePrice\">$movieTitle (RM $moviePrice)</option>";
            echo '</select>';
            echo '</div>';

            echo '<ul class="showcase">';
            echo '<li>Hall: ' . $hallNumber . '</li>';
            echo '<li>Ticket Price: RM ' . $moviePrice . '</li>';
            echo '<li>Movie Title: ' . $movieTitle . '</li>';
            echo '</ul>';

            echo '<ul class="showcase">';
            echo '<li>Date: ' . $selectedDate . '</li>';
            echo '<li>Time: ' . $selectedTime . '</li>';
            echo '</ul>';

            function bookinglayout($selectedDate, $selectedMovie, $selectedTime)
            {

                // Get the occupied seats for the selected movie, date, and time from the database
                $occupiedSeats = getOccupiedSeatsFromDatabase($selectedMovie, $selectedDate, $selectedTime);


                echo '<div class="container">
    <div class="screen">Screen</div>';
                // Array of rows
                $rows = ['A', 'B', 'C', 'D', 'E', 'F'];

                foreach ($rows as $row) {
                    echo '<div class="row">';
                    for ($i = 1; $i <= 8; $i++) {
                        $seatValue = $row . $i;
                        $seatClass = in_array($seatValue, $occupiedSeats) ? 'seat occupied' : 'seat';
                        echo '<div class="' . $seatClass . '" value="' . $seatValue . '">' . $seatValue . '</div>';
                    }
                    echo '</div>';
                }
            }

            echo '<p class="text">';
            echo 'You have selected <span id="count" value="0">0</span> seats for a price of RM <span id="total" value="0">0</span>';
            echo '</p>';
            echo '<ul class="showcase">
            
        <li>
          <div class="seat"></div>
          <small>N/A</small>
        </li>
  
        <li>
          <div class="seat selected"></div>
          <small>Selected</small>
        </li>
  
        <li>
          <div class="seat occupied"></div>
          <small>Occupied</small>
        </li>
      </ul>';

            bookinglayout($selectedDate, $selectedMovie, $selectedTime);

            echo '</div>';
            echo '<button id="continueButton">Proceed</button>';
            echo '<br>';
            echo '<button id="backButton">Back</button>';
        } else {
            echo '<p>Invalid category or movie selected.</p>';
        }
    } else {
        echo '<p>No category selected.</p>';
    }
    ?>

    <script>
        const container = document.querySelector('.container');
        const count = document.getElementById('count');
        const total = document.getElementById('total');
        const movieSelect = document.getElementById('<?php echo $selectId; ?>'); // Adjust based on the selected movie
        let selectedSeats = [];

        // Movie select event
        movieSelect.addEventListener('change', () => {
            updateSelectedCount();
        });

        // Seat click event
        container.addEventListener('click', (e) => {
            if (e.target.classList.contains('seat') && !e.target.classList.contains('occupied')) {
                e.target.classList.toggle('selected');
                updateSelectedCount();
            }
        });

        function updateSelectedCount() {
            const selectedSeatElements = document.querySelectorAll('.row .seat.selected');
            selectedSeats = Array.from(selectedSeatElements).map(seat => seat.getAttribute('value'));

            // Update the selected seats string
            selectedSeatsString = selectedSeats.join(', ');

            const selectedSeatsCount = selectedSeats.length;
            count.innerText = selectedSeatsCount;
            count.setAttribute('value', selectedSeatsCount);

            const moviePrice = +movieSelect.value;
            total.innerText = selectedSeatsCount * moviePrice;
            total.setAttribute('value', selectedSeatsCount * moviePrice);

            // Store the selected seat values string in session storage
            sessionStorage.setItem('selectedSeats', selectedSeatsString);
            sessionStorage.setItem('selectedSeatsCount', selectedSeatsCount);
            sessionStorage.setItem('totalPrice', selectedSeatsCount * moviePrice);
        }
        const continueButton = document.getElementById('continueButton');
        const backButton = document.getElementById('backButton');

        continueButton.addEventListener('click', () => {
            const selectedSeatsCount = parseInt(sessionStorage.getItem('selectedSeatsCount'));

            if (selectedSeatsCount === 0 || sessionStorage.getItem('selectedSeatsCount')==null) {
                // Display an error message
                alert('Please select at least one seat.');

                // Optionally, you can stop further actions by returning early
                return;
            }

            // Navigate to food&beverage.php
            window.location.href = 'food&beverage.php';
            console.log('Continue button clicked');
        });

        backButton.addEventListener('click', () => {

            // Handle back button click
            window.location.href = 'index.php';
            sessionStorage.clear(); // Clear sessionStorage
            console.log('Back button clicked');
        });
    </script>

</body>

</html>