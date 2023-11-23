<?php include 'includes/header.inc'; ?>
<?php
$username = $_SESSION['cust_username'];

// Function to get occupied seats from the database based on movie, date, and time
function getCustDetailsFromDatabase($name)
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
	$sql = "SELECT cust_email, cust_contactNo FROM Action_Customer WHERE cust_username = '$name'";;
	$result = $connection->query($sql);

	// Fetch the result as an associative array
	$row = $result->fetch_assoc();

	if ($row) {
		$email =  $row['cust_email'];
		$contactNo =  $row['cust_contactNo'];
		$cust_det = array();
		$cust_det = [$email, $contactNo];
	} else {
		// No matching row found
		// Handle the case when no result is found
		echo "No matching user found.";
	}


	// Set the table name	
	$sql_table = "Action_Customer";

	// Perform a database query to retrieve the 'points' value for a given username
	$query = "SELECT points FROM $sql_table WHERE cust_username = '$name'";
	$result = mysqli_query($connection, $query);

	if (!$result) {
		// Handle the query error, if any
		die("Query error: " . mysqli_error($connection));
	}

	if (mysqli_num_rows($result) > 0) {
		// Fetch the result row
		$row = mysqli_fetch_assoc($result);
		$_SESSION['points'] = $row['points'];
	} else {
		// Handle the case where the user is not found
		$_SESSION['points'] = 3; // Set a default value or handle as needed
	}


	$connection->close();
	return $cust_det;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Payment</title>
	<meta charset="utf-8" />
	<meta name="author" content="Saw Zi Chuen" />
	<link rel="stylesheet" href="styles/style.css">
	<link rel="stylesheet" href="styles/responsive.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	<script>
    document.addEventListener("DOMContentLoaded", function() {
        const seatCountInput = document.getElementById("seat_count");
        const confirmTotal = document.getElementById("confirm_total");
        const hiddenConfirmTotal = document.getElementsByName("hidden_confirm_total")[0];
        const pointsToRMConversion = 5 / 1000; // 1000 points = RM5
        const minimumTotal = 5; // Minimum total amount

        // Function to update the total cost when the input changes
        function updateTotalCost() {
            const points = parseInt(seatCountInput.value, 10);
            const totalCost = points * pointsToRMConversion;
            let updatedTotal = total - totalCost.toFixed(2); // Calculate the updated total

            // Ensure the updated total doesn't go below the minimum
            updatedTotal = Math.max(updatedTotal, minimumTotal);

            // Ensure that points are not deducted below zero
            const maxPointsToDeduct = Math.floor((total - minimumTotal) / pointsToRMConversion);
            updatedTotal = Math.max(updatedTotal, total - maxPointsToDeduct * pointsToRMConversion);

            // Disable incrementing when confirm_total is less than or equal to 5
            if (updatedTotal <= minimumTotal) {
                seatCountInput.step = "0"; // Set step to 0 to disable incrementing
				
				alert("Note: You can only decrement when the total is less than or equal to 5.");

            } else {
                seatCountInput.step = "1000"; // Set step back to 1000 for normal behavior
            }

            confirmTotal.textContent = updatedTotal.toFixed(2); // Display with 2 decimal places
            hiddenConfirmTotal.value = updatedTotal.toFixed(2); // Set the value of hidden_confirm_total

            return updatedTotal; // Return the updated total
        }

        // Add an event listener to the input to handle changes
        seatCountInput.addEventListener("input", updateTotalCost);

        // Call the function initially to display the initial total cost
        updateTotalCost();
    });
</script>

</head>

<body>
	<div class="space"></div>
	<br><br><br><br>
	<?php

	//OYZ update code 4th Oct
	$_SESSION["totalfoodandbeverage"] = $_POST['totalfoodandbeverage'];

	// Function to calculate the total cost based on the selected options
	$movieIndex = isset($_POST['movie']) ? $_POST['movie'] : 0;
	$seats = isset($_POST['seats']) ? intval($_POST['seats']) : 0;
	$options = isset($_POST['options']) ? $_POST['options'] : 0;

	$total = calculatePrice($movieIndex, $seats, $options);
	$_SESSION['total'] = $total;
	function calculatePrice($movieIndex, $seats, $options)
	{
		if ($movieIndex == 0 || $seats == 0 || !is_array($options))
			return 0;
		$movieP = 0;
		if ($movieIndex == "Monty Python and the Holy Grail") {
			$movieP = 20.99;
		} else if ($movieIndex == "Fear and Loathing in Las Vegas") {
			$movieP = 19.99;
		} else if ($movieIndex == "El Camino: A Breaking Bad Movie") {
			$movieP = 18.99;
		}
		$ticketPrice = $movieP * $seats;
		$optionsPrice = 0;
		foreach ($options as $option) {
			$optionsPrice += (float) $option * $seats;
		}
		$totalPrice = $ticketPrice + $optionsPrice;
		return $totalPrice;
	}

	$opt = [];

	if (isset($_POST["options"])) {

		if (in_array("10.99", $options)) {
			$opt[] = "Popcorn";
		}

		if (in_array("7.99", $options)) {
			$opt[] = "Soda";
		}

		if (in_array("5.99", $options)) {
			$opt[] = "Cookies";
		}
	}

	$optS = implode(", ", $opt);

	$_SESSION['options'] = $optS;


	$_SESSION['frompay'] = true;

	$cust = getCustDetailsFromDatabase($username);
	?>
	<form id="bookform" method="post" action="process_order.php">
		<fieldset>
			<legend>Your Order</legend>
			<p>Your Name: <span id="confirm_name"><?php echo $username ?></span></p>
			<p>E-mail: <span id="confirm_email"><?php echo $cust[0] ?></span></p>
			<p>Phone Number: <span id="confirm_phonenum"><?php echo $cust[1] ?></span></p>
			<p>Movie: <span id="confirm_movie"></span></p>
			<p>Date: <span id="confirm_date"></span></p>
			<p>Time: <span id="confirm_time"></span></p>
			<p>Seats: <span id="confirm_seats"></span></p>
			<p>Food and Beverage: <span id="confirm_f&b"></span></p>
			<h2>Total Cost: RM<span value="" id="confirm_total"></span></h2>
		</fieldset>
		<input type="hidden" name="hidden_confirm_name" value="<?php echo $username ?>">
		<input type="hidden" name="hidden_confirm_email" value="<?php echo $cust[0] ?>">
		<input type="hidden" name="hidden_confirm_movie" value="">
		<input type="hidden" name="hidden_confirm_date" value="">
		<input type="hidden" name="hidden_confirm_time" value="">
		<input type="hidden" name="hidden_confirm_seats" value="">
		<input type="hidden" name="hidden_confirm_f&b" value="">
		<input type="hidden" name="hidden_confirm_total" value="">
		<fieldset>
			<legend>ActionPoints</legend>
			<p>You Have <?php echo $_SESSION['points'] ?> Points</p>
			<p>Use Points (1000 points = RM5)</p>
			<?php
			$max = $_SESSION['points'] - 1000;
			if ($max == -1000) {
				$max = 0;
			}
			$maxPointsToUse = 5000;
			$maxPointsToUse = min($maxPointsToUse, $_SESSION['points']);
			echo '<input type="number" id="seat_count" name="seat_count" min="0" max="' . $maxPointsToUse . '" step="1000" value="0" required>';
			?>
		</fieldset>
		<fieldset>
			<legend>Payment Details</legend>
			<label for="ctype">Credit Card Type:</label>
			<select id="ctype" name="ctype" required>
				<option value="">Select Card Type</option>
				<option value="visa">Visa</option>
				<option value="mastercard">Mastercard</option>
				<option value="amex">American Express</option>
			</select>

			<label for="card-name">Name on Credit Card:</label>
			<input type="text" id="cname" name="cname" placeholder="Enter the name on your credit card" required value="<?php echo $username ?>">

			<label for="card-number">Credit Card Number:</label>
			<input type="text" id="cnum" name="cnum" placeholder="Enter your credit card number" required pattern="^(4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|3[47][0-9]{13})$" title="Visa: 4111111111111111
Mastercard: 5555555555555555
American Express: 341234567890123">
			<label for="card-expiry">Credit Card Expiry Date (mm/yy):</label>
			<input type="text" id="cexp" name="cexp" placeholder="Enter expiry date (mm/yy)" required pattern="^(0[1-9]|1[0-2])\/[0-9]{2}$" title="Enter a valid expiry date in the format mm/yy">

			<label for="card-cvv">Card Verification Value (CVV):</label>
			<input type="text" id="ccvv" name="ccvv" placeholder="Enter CVV" required pattern="^[0-9]{3,4}$" title="Enter a valid CVV (3 or 4 digits)">

			<input type="submit" value="Check Out">
			<input type="submit" value="Cancel Order" onclick="cancelOrder()">
		</fieldset>

	</form>

	<?php include 'includes/footer.inc'; ?>
	<script>
		function cancelOrder() {
			// Clear sessionStorage
			sessionStorage.clear();

			// Redirect to index.php or any other page
			window.location.href = 'index.php';
		}
		var selectedMovie = sessionStorage.getItem('selectedMovie');
		// Retrieve the selected seat values string from session storage
		var selectedSeatsString = sessionStorage.getItem('selectedSeats');

		// Retrieve the selected seat count from session storage
		var selectedSeatsCount = sessionStorage.getItem('selectedSeatsCount');

		// Retrieve the selected seat count from session storage
		var selectedtime = sessionStorage.getItem('selectedTime');

		// Retrieve the selected seat count from session storage
		var selecteddate = sessionStorage.getItem('selectedDate');

		var selectedfandb = sessionStorage.getItem('selectedItems');

		// Retrieve the total price from session storage and convert it to a double
		var totalPrice = parseFloat(sessionStorage.getItem('totalPrice'));

		// Retrieve the total food and beverage price from session storage and convert it to a double
		var totalfb = parseFloat(sessionStorage.getItem('totalfoodandbeverage'));

		// Check if totalfb is NaN (not found in session storage), and set it to 0 if it is
		if (isNaN(totalfb)) {
			totalfb = 0;
		}

		// Calculate the total by adding totalPrice and totalfb
		var total = totalPrice + totalfb;


		// Display the selected movie in the span element
		document.getElementById('confirm_movie').textContent = selectedMovie;
		// Display the selected movie in the span element
		document.getElementById('confirm_time').textContent = selectedtime;

		document.getElementById('confirm_seats').textContent = selectedSeatsString;
		// Display the selected movie in the span element
		document.getElementById('confirm_date').textContent = selecteddate;

		if (selectedfandb !== "" && selectedfandb !== null) {
			document.getElementById('confirm_f&b').textContent = selectedfandb;
		} else {
			document.getElementById('confirm_f&b').textContent = "No food and beverage selected";
		}

		// Set the value of the hidden input field
		document.getElementsByName('hidden_confirm_movie')[0].value = selectedMovie;

		document.getElementsByName('hidden_confirm_seats')[0].value = selectedSeatsString;

		document.getElementsByName('hidden_confirm_date')[0].value = selecteddate;

		document.getElementsByName('hidden_confirm_f&b')[0].value = selectedfandb;

		document.getElementsByName('hidden_confirm_time')[0].value = selectedtime;


	</script>
</body>

</html>