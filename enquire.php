<!DOCTYPE html>
<html lang="en">

<head>
  <title>Enquire</title>
  <meta charset="utf-8" />
  <meta name="author" content="Saw Zi Chuen" />
  <link rel="stylesheet" href="styles/style.css">
  <link rel="stylesheet" href="styles//responsive.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <script src="scripts/part2.js"></script>
  <script src="scripts/enhancements.js"></script>
</head>

<body>
  <?php include 'includes/header.inc'; ?>
  <div class="space"></div>

  <form id="regform" action="payment.php" method="post" oninput="calculatePrice()" novalidate>

    <fieldset id="person">
      <legend>Contact Information</legend>
      <div class="form-group">
        <label for="firstname">First Name *</label>
        <input type="text" id="firstname" name="firstname" maxlength="25" required>
      </div>
      <div class="form-group">
        <label for="lastname">Last Name *</label>
        <input type="text" id="lastname" name="lastname" maxlength="25" required>
      </div>
      <div class="form-group">
        <label for="email">Email Address *</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="straddr">Street Address *</label>
        <input type="text" id="straddr" name="straddr" maxlength="40" required>
      </div>
      <div class="form-group">
        <label for="suburbtown">Suburb/Town *</label>
        <input type="text" id="suburbtown" name="suburbtown" maxlength="20" required>
      </div>
      <div class="form-group">
        <label for="state">State *</label>
        <select id="state" name="state" required>
          <option value="" selected disabled hidden>State</option>
          <option value="VIC">VIC</option>
          <option value="NSW">NSW</option>
          <option value="QLD">QLD</option>
          <option value="NT">NT</option>
          <option value="WA">WA</option>
          <option value="SA">SA</option>
          <option value="TAS">TAS</option>
          <option value="ACT">ACT</option>
        </select>
      </div>
      <div class="form-group">
        <label for="postcode">Postcode *</label>
        <input type="text" id="postcode" name="postcode" pattern="[0-9]{4}" maxlength="4" required>
      </div>
      <div class="form-group">
        <label for="phonenum">Phone Number *</label>
        <input type="text" id="phonenum" name="phonenum" placeholder="e.g. 60189929402" required>
      </div>
      <br>
      <div class="form-group" id="p">
        <label for="movie"><br>Select Movie *</label>
        <select id="movie" name="movie" required>
          <option value="" selected disabled hidden>Please select a movie</option>
          <option value="Monty Python and the Holy Grail">Monty Python and the Holy Grail - RM20.99</option>
          <option value="Fear and Loathing in Las Vegas">Fear and Loathing in Las Vegas - RM19.99</option>
          <option value="El Camino: A Breaking Bad Movie">El Camino: A Breaking Bad Movie - RM18.99</option>
        </select>

        <br>

        <label for="date">Select a date:</label>
        <input type="date" id="date" name="date" required>

        <br>
        <br>

        <label for="time">Select a time:</label>
        <select id="time" name="time">
          <option value="10:00am">10:00am</option>
          <option value="1:00pm">1:00pm</option>
          <option value="4:00pm">4:00pm</option>
          <option value="7:00pm">7:00pm</option>
          <option value="10:00pm">10:00pm</option>
        </select>

        <label for="seats">Number of Seats:</label>
        <input type="number" id="seats" name="seats" min="1" max="10" required>
        <br>
        <br>
        <fieldset id="opt">
          <label for="options">Ticket Options:</label>
          <div class="option">
            <label for="opt1">Popcorn - RM10.99</label>
            <input type="checkbox" id="opt1" name="options[]" value="10.99">
          </div>
          <div class="option">
            <label for="opt2">Soda - RM7.99</label>
            <input type="checkbox" id="opt2" name="options[]" value="7.99">
          </div>
          <div class="option">
            <label for="opt3">Cookies - RM5.99</label>
            <input type="checkbox" id="opt3" name="options[]" value="5.99">
          </div>
        </fieldset>

        <p id="totprice">Total Price: RM0.00</p>
        <label for="comment"><br>Comment/Question *</label>
        <textarea id="comment" name="comment" placeholder="Enter your comment or question here" required></textarea>
      </div>
    </fieldset>

    <div id="bottom"> </div>
    <p><input type="submit" value="Order Now!" />
      <input type="reset" value="Reset" />
    </p>
  </form>


  <?php include 'includes/footer.inc'; ?>



</body>

</html>