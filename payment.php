<!DOCTYPE html>
<html lang="en">

<head>
	<title>Payment</title>
	<meta charset="utf-8" />
	<meta name="author" content="Saw Zi Chuen" />
	<link rel="stylesheet" href="styles/style.css">
	<link rel="stylesheet" href="styles/responsive.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

	<script src="scripts/part22.js"></script>
</head>
sy

<body>

	<?php include 'includes/header.inc'; ?>


	<div class="space"></div>
	<?php
	session_start();
	$_SESSION['firstname'] = $_POST['firstname'];
	$_SESSION['lastname'] = $_POST['lastname'];
	$_SESSION['email'] = $_POST['email'];
	$_SESSION['straddr'] = $_POST['straddr'];
	$_SESSION['suburbtown'] = $_POST['suburbtown'];
	$_SESSION['state'] = @$_POST['state'];
	$_SESSION['postcode'] = $_POST['postcode'];
	$_SESSION['phonenum'] = $_POST['phonenum'];
	$_SESSION['movie'] = @$_POST['movie'];
	$_SESSION['date'] = $_POST['date'];
	$_SESSION['time'] = $_POST['time'];
	$_SESSION['seats'] = $_POST['seats'];
	$_SESSION['comment'] = $_POST['comment'];
	// Function to calculate the total cost based on the selected options
	$movieIndex = isset($_POST['movie']) ? $_POST['movie'] : 0;
	$seats = isset($_POST['seats']) ? intval($_POST['seats']) : 0;
	$options = isset($_POST['options']) ? $_POST['options'] : 0;

	$total = calculatePrice($movieIndex, $seats, $options);
	$_SESSION['total'] = $total;
	function calculatePrice($movieIndex, $seats, $options)
	{
		if ($movieIndex == 0 || $seats == 0 || !is_array($options)) return 0;
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
			$optionsPrice += (float)$option * $seats;
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
	
	?>

	<form id="bookform" method="post" action="process_order.php" novalidate>
		<fieldset>
			<legend>Your Order</legend>
			<p>Your Name: <span id="confirm_name"><?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname']; ?></span></p>
			<p>E-mail: <span id="confirm_email"><?php echo $_SESSION['email']; ?></span></p>
			<p>Address: <span id="confirm_straddr"><?php echo $_SESSION['straddr']; ?></span></p>
			<p>Suburb/Town: <span id="confirm_suburbtown"><?php echo $_SESSION['suburbtown']; ?></span></p>
			<p>State: <span id="confirm_state"><?php echo $_SESSION['state']; ?></span></p>
			<p>Postcode: <span id="confirm_postcode"><?php echo $_SESSION['postcode']; ?></span></p>
			<p>Phone Number: <span id="confirm_phonenum"><?php echo $_SESSION['phonenum']; ?></span></p>
			<p>Movie: <span id="confirm_movie"><?php echo $_SESSION['movie']; ?></span></p>
			<p>Date: <span id="confirm_date"><?php echo $_SESSION['date']; ?></span></p>
			<p>Time: <span id="confirm_time"><?php echo $_SESSION['time']; ?></span></p>
			<p>Seats: <span id="confirm_seats"><?php echo $_SESSION['seats']; ?></span></p>
			<p>Ticket Options: <span id="confirm_opt"><?php echo $optS; ?></span></p>
			<p>Comment: <span id="confirm_comment"><?php echo $_SESSION['comment']; ?></span></p>
			<h2>Total Cost: $<span id="confirm_total"><?php echo $total; ?></span></h2>

			<input type="hidden" name="firstname" value="<?php echo $_SESSION['firstname']; ?>">
			<input type="hidden" name="lastname" value="<?php echo $_SESSION['lastname']; ?>">
			<input type="hidden" name="email" value="<?php echo $_SESSION['email']; ?>">
			<input type="hidden" name="straddr" value="<?php echo $_SESSION['straddr']; ?>">
			<input type="hidden" name="suburbtown" value="<?php echo $_SESSION['suburbtown']; ?>">
			<input type="hidden" name="state" value="<?php echo $_SESSION['state']; ?>">
			<input type="hidden" name="postcode" value="<?php echo $_SESSION['postcode']; ?>">
			<input type="hidden" name="phonenum" value="<?php echo $_SESSION['phonenum']; ?>">
			<input type="hidden" name="movie" value="<?php echo $_SESSION['movie']; ?>">
			<input type="hidden" name="date" value="<?php echo $_SESSION['date']; ?>">
			<input type="hidden" name="time" value="<?php echo $_SESSION['time']; ?>">
			<input type="hidden" name="seats" value="<?php echo $_SESSION['seats']; ?>">
			<input type="hidden" name="options" value="<?php echo $optS; ?>">
			<input type="hidden" name="total" value="<?php echo $total; ?>">
			<input type="hidden" name="comment" value="<?php echo $_SESSION['comment']; ?>">
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
			<input type="text" id="cname" name="cname" placeholder="Enter the name on your credit card" required>

			<label for="card-number">Credit Card Number:</label>
			<input type="text" id="cnum" name="cnum" placeholder="Enter your credit card number" required>

			<label for="card-expiry">Credit Card Expiry Date (mm/yy):</label>
			<input type="text" id="cexp" name="cexp" placeholder="Enter expiry date" required>

			<label for="card-cvv">Card Verification Value (CVV):</label>
			<input type="text" id="ccvv" name="ccvv" placeholder="Enter CVV" required>

			<input type="submit" value="Check Out">
			<input type="submit" value="Cancel Order" onclick="location.href='index.php';">
		</fieldset>
	</form>




	<?php include 'includes/footer.inc'; ?>


</body>

</html>