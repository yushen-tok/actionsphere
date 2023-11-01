<?php
// Retrieve error messages from the URL query parameter
session_start();
if (!isset($_SESSION['frompay']) || $_SESSION['frompay'] !== true) {
  header("Location: index.php");
  exit();
}
$errorMessages = isset($_GET['error']) ? $_GET['error'] : '';
// Retrieve form data from the URL query parameters
$firstname = isset($_SESSION['firstname']) ? $_SESSION['firstname'] : '';
$lastname = isset($_SESSION['lastname']) ? $_SESSION['lastname'] : '';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
$straddr = isset($_SESSION['straddr']) ? $_SESSION['straddr'] : '';
$suburbtown = isset($_SESSION['suburbtown']) ? $_SESSION['suburbtown'] : '';
$state = isset($_SESSION['state']) ? $_SESSION['state'] : '';
$postcode = isset($_SESSION['postcode']) ? $_SESSION['postcode'] : '';
$phonenum = isset($_SESSION['phonenum']) ? $_SESSION['phonenum'] : '';
$movie = isset($_SESSION['movie']) ? $_SESSION['movie'] : '';
$date = isset($_SESSION['date']) ? $_SESSION['date'] : '';
$time = isset($_SESSION['time']) ? $_SESSION['time'] : '';
$seats = isset($_SESSION['seats']) ? $_SESSION['seats'] : '';
$options = isset($_SESSION['options']) ? $_SESSION['options'] : array();
$total = isset($_SESSION['total']) ? $_SESSION['total'] : '';
$comment = isset($_SESSION['comment']) ? $_SESSION['comment'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Fix Order</title>
  <meta charset="utf-8" />
  <meta name="author" content="Saw Zi Chuen" />
  <link rel="stylesheet" href="styles/style.css">
  <link rel="stylesheet" href="styles/responsive.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <script src="scripts/part2.js"></script>
  <script src="scripts/enhancements.js"></script>
</head>

<body>
  <?php include 'includes/header.inc'; ?>


  <div class="space"></div>

  <form id="bookform" method="post" action="process_order.php" oninput="calculatePrice()" novalidate>
    <fieldset id="person">
      <legend>Contact Information</legend>
      <h1>Fix Order</h1>
      <?php if (!empty($errorMessages)) : ?>
        <div class="error">
          <p><?php echo $errorMessages; ?></p>
        </div>
      <?php endif; ?>

      <label for="firstname">First Name *</label>
      <input type="text" id="firstname" name="firstname" maxlength="25" value="<?php echo $firstname; ?>" required>

      <div class="form-group">
        <label for="lastname">Last Name *</label>
        <input type="text" id="lastname" name="lastname" maxlength="25" value="<?php echo $lastname; ?>" required>
      </div>
      <div class="form-group">
        <label for="email">Email Address *</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
      </div>
      <div class="form-group">
        <label for="straddr">Street Address *</label>
        <input type="text" id="straddr" name="straddr" maxlength="40" value="<?php echo $straddr; ?>" required>

      </div>
      <div class="form-group">
        <label for="suburbtown">Suburb/Town *</label>
        <input type="text" id="suburbtown" name="suburbtown" maxlength="20" value="<?php echo $suburbtown; ?>" required>

      </div>
      <div class="form-group">
        <label for="state">State *</label>
        <select id="state" name="state" required>
          <option value="" selected disabled hidden>State</option>
          <option value="VIC" <?php if ($state === 'VIC') echo 'selected'; ?>>VIC</option>
          <option value="NSW" <?php if ($state === 'NSW') echo 'selected'; ?>>NSW</option>
          <option value="QLD" <?php if ($state === 'QLD') echo 'selected'; ?>>QLD</option>
          <option value="NT" <?php if ($state === 'NT') echo 'selected'; ?>>NT</option>
          <option value="WA" <?php if ($state === 'WA') echo 'selected'; ?>>WA</option>
          <option value="SA" <?php if ($state === 'SA') echo 'selected'; ?>>SA</option>
          <option value="TAS" <?php if ($state === 'TAS') echo 'selected'; ?>>TAS</option>
          <option value="ACT" <?php if ($state === 'ACT') echo 'selected'; ?>>ACT</option>
        </select>
      </div>
      <div class="form-group">
        <label for="postcode">Postcode *</label>
        <input type="text" id="postcode" name="postcode" pattern="[0-9]{4}" maxlength="4" value="<?php echo $postcode; ?>" required>
      </div>
      <div class="form-group">
        <label for="phonenum">Phone Number *</label>
        <input type="text" id="phonenum" name="phonenum" value="<?php echo $phonenum; ?>" required>
      </div>
      <br>
      <div class="form-group" id="p">
        <label for="movie"><br>Select Movie *</label>
        <select id="movie" name="movie" required>
          <option value="" selected disabled hidden>Please select a movie</option>
          <option value="Monty Python and the Holy Grail" <?php if ($movie === 'Monty Python and the Holy Grail') echo 'selected'; ?>>Monty Python and the Holy Grail - RM20.99</option>
          <option value="Fear and Loathing in Las Vegas" <?php if ($movie === 'Fear and Loathing in Las Vegas') echo 'selected'; ?>>Fear and Loathing in Las Vegas - RM19.99</option>
          <option value="El Camino: A Breaking Bad Movie" <?php if ($movie === 'El Camino: A Breaking Bad Movie') echo 'selected'; ?>>El Camino: A Breaking Bad Movie - RM18.99</option>
        </select>

        <br>

        <label for="date">Select a date:</label>
        <input type="date" id="date" name="date" value="<?php echo $date; ?>" required>

        <br>
        <br>

        <label for="time">Select a time:</label>
        <select id="time" name="time" value="<?php echo $time; ?>">
          <option value="10:00am" <?php if ($time === '10:00am') echo 'selected'; ?>>10:00am</option>
          <option value="1:00pm" <?php if ($time === '1:00pm') echo 'selected'; ?>>1:00pm</option>
          <option value="4:00pm" <?php if ($time === '4:00pm') echo 'selected'; ?>>4:00pm</option>
          <option value="7:00pm" <?php if ($time === '7:00pm') echo 'selected'; ?>>7:00pm</option>
          <option value="10:00pm" <?php if ($time === '10:00pm') echo 'selected'; ?>>10:00pm</option>
        </select>

        <label for="seats">Number of Seats:</label>
        <input type="number" id="seats" name="seats" min="1" max="10" value="<?php echo $seats; ?>" required>
        <br>
        <br>
        
        <fieldset id="opt">
          <label for="options">Ticket Options:</label>
          <div class="option">
            <label for="opt1">Popcorn - RM10.99</label>
            <input type="checkbox" id="opt1" name="options[]" value="10.99"<?php if (in_array('Popcorn', explode(', ', $_SESSION['options']))) echo 'checked'; ?>>
          </div>
          <div class="option">
            <label for="opt2">Soda - RM7.99</label>
            <input type="checkbox" id="opt2" name="options[]" value="7.99"<?php if (in_array('Soda', explode(', ', $_SESSION['options']))) echo 'checked'; ?>>
          </div>
          <div class="option">
            <label for="opt3">Cookies - RM5.99</label>
            <input type="checkbox" id="opt3" name="options[]" value="5.99"<?php if (in_array('Cookies', explode(', ', $_SESSION['options']))) echo 'checked'; ?>>
          </div>
        </fieldset>

        <p id="totprice">Total Price: RM0.00</p>
        <label for="comment"><br>Comment/Question *</label>
        <textarea id="comment" name="comment" required><?php echo $comment; ?></textarea>

      </div>

      <!-------------------------------------------------------------------------------------------->

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