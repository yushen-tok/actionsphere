<?php
session_start();

// Redirect
if (!isset($_SESSION['frompay']) || $_SESSION['frompay'] !== true) {
    header("Location: index.php");
    exit();
}

// Sanitize input data
function sanitize($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}



$_SESSION['firstname'] = @$_POST['firstname'];
$_SESSION['lastname'] = @$_POST['lastname'];
$_SESSION['email'] = @$_POST['email'];
$_SESSION['straddr'] = @$_POST['straddr'];
$_SESSION['suburbtown'] = @$_POST['suburbtown'];
$_SESSION['state'] = @$_POST['state'];
$_SESSION['postcode'] = @$_POST['postcode'];
$_SESSION['phonenum'] = @$_POST['phonenum'];
$_SESSION['movie'] = @$_POST['movie'];
$_SESSION['date'] = @$_POST['date'];
$_SESSION['time'] = @$_POST['time'];
$_SESSION['seats'] = @$_POST['seats'];
$_SESSION['comment'] = @$_POST['comment'];
// Function to calculate the total cost based on the selected options
$seats = isset($_POST['seats']) ? intval($_POST['seats']) : 0;
if (!isset($_SERVER['HTTP_REFERER']) || $_SERVER['HTTP_REFERER'] == 'payment.php') {
    $movieIndex = isset($_POST['movie']) ? $_POST['movie'] : 0;
    $options = isset($_POST['options']) ? $_POST['options'] : 0;
    $total = calculatePrice($movieIndex, $seats, $options);
    $_SESSION['total'] = $total;


    $opt = [];

    if (isset($_POST["options"])) {
        $selectedOptions = $_POST["options"];

        if (in_array("10.99", $selectedOptions)) {
            $opt[] = "Popcorn";
        }

        if (in_array("7.99", $selectedOptions)) {
            $opt[] = "Soda";
        }

        if (in_array("5.99", $selectedOptions)) {
            $opt[] = "Cookies";
        }
    }

    $optS = implode(", ", $opt);

    $_SESSION['options'] = $optS;
}


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

// Get the form data from the session and sanitize it
$firstname = sanitize($_SESSION['firstname']);
$lastname = sanitize($_SESSION['lastname']);
$email = sanitize($_SESSION['email']);
$straddr = sanitize($_SESSION['straddr']);
$suburbtown = sanitize($_SESSION['suburbtown']);
$state = sanitize($_SESSION['state']);
$postcode = sanitize($_SESSION['postcode']);
$phonenum = sanitize($_SESSION['phonenum']);
$movie = sanitize($_SESSION['movie']);
$date = sanitize($_SESSION['date']);
$time = sanitize($_SESSION['time']);
$seats = sanitize($_SESSION['seats']);
$opt = sanitize($_SESSION['options']);
$total = sanitize($_SESSION['total']);
$comment = sanitize($_SESSION['comment']);



// Perform validation checks (replicating the client-side validation)
$errors = array();

// Part 1: Customer details validation
if (!preg_match("/^[a-zA-Z]+$/", $firstname)) {
    $errors[] = "Your first name must only contain alpha characters";
    $_SESSION['firstname'] = '';
}

if (!preg_match("/^[a-zA-Z\-]+$/", $lastname)) {
    $errors[] = "Your last name must only contain alpha characters";
    $_SESSION['lastname'] = '';
}

if (!is_numeric($postcode)) {
    $errors[] = "The Postcode must be a number";
    $_SESSION['postcode'] = '';
}

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "The email is invalid";
    $_SESSION['email'] = '';
}

if (!is_numeric($phonenum)) {
    $errors[] = "Your Phone number must be a number";
    $_SESSION['phonenum'] = '';
} elseif ($phonenum < 1000000000 || $phonenum > 999999999999) {
    $errors[] = "Your phone number must contain between 10 to 12 digits";
    $_SESSION['phonenum'] = '';
}

if ($seats < 1 || $seats > 10) {
    $errors[] = "The number of seats must be between 1 and 10";
    $_SESSION['seats'] = '';
}

if ($movie == "none") {
    $errors[] = "You must select a movie";
    $_SESSION['movie'] = '';
}

if ($time == "none") {
    $errors[] = "You must select a time";
    $_SESSION['time'] = '';
}

if ($date == "none") {
    $errors[] = "You must select a date";
    $_SESSION['date'] = '';
}

if ($state == "") {
    $errors[] = "You must select a state";
    $_SESSION['state'] = '';
} else {

    $firstDigit = intval($postcode[0]);

    switch ($_SESSION['state']) {
        case "VIC":
            if ($firstDigit !== 3 && $firstDigit !== 8) {
                $errors[] = "Invalid postcode for VIC state. Postcode must start with 3 or 8.";
                $_SESSION['postcode'] = '';
            }
            break;
        case "NSW":
            if ($firstDigit !== 1 && $firstDigit !== 2) {
                $errors[] = "Invalid postcode for NSW state. Postcode must start with 1 or 2.";
                $_SESSION['postcode'] = '';
            }
            break;
        case "QLD":
            if ($firstDigit !== 4 && $firstDigit !== 9) {
                $errors[] = "Invalid postcode for QLD state. Postcode must start with 4 or 9.";
                $_SESSION['postcode'] = '';
            }
            break;
        case "NT":
            if ($firstDigit !== 0) {
                $errors[] = "Invalid postcode for NT state. Postcode must start with 0.";
                $_SESSION['postcode'] = '';
            }
            break;
        case "WA":
            if ($firstDigit !== 6) {
                $errors[] = "Invalid postcode for WA state. Postcode must start with 6.";
                $_SESSION['postcode'] = '';
            }
            break;
        case "SA":
            if ($firstDigit !== 5) {
                $errors[] = "Invalid postcode for SA state. Postcode must start with 5.";
                $_SESSION['postcode'] = '';
            }
            break;
        case "TAS":
            if ($firstDigit !== 7) {
                $errors[] = "Invalid postcode for TAS state. Postcode must start with 7.";
                $_SESSION['postcode'] = '';
            }
            break;
        case "ACT":
            if ($firstDigit !== 0) {
                $errors[] = "Invalid postcode for ACT state. Postcode must start with 0.";
                $_SESSION['postcode'] = '';
            }
            break;
    }
}

// Part 2: Credit card details validation
$ctype = sanitize($_POST['ctype']);
$cname = sanitize($_POST['cname']);
$cnum = sanitize($_POST['cnum']);
$cexp = sanitize($_POST['cexp']);
$ccvv = sanitize($_POST['ccvv']);

if (empty($ctype)) {
    $errors[] = "Credit Card Type is required";
}

if (empty($cname)) {
    $errors[] = "Name on Credit Card is required";
}

if (empty($cnum)) {
    $errors[] = "Credit Card Number is required";
}

if (!preg_match('/^[a-zA-Z\s]{1,40}$/', $cname)) {
    $errors[] = "Name on the credit card must be maximum of 40 characters, alphabetical, and space only\n";
    $result = false;
}

switch ($ctype) {
    case "visa":
        if (!preg_match('/^4\d{15}$/', $cnum)) {
            $errors[] = "Invalid Visa card number. Visa cards have 16 digits and start with a 4\n";
            $result = false;
        }
        break;
    case "mastercard":
        if (!preg_match('/^5[1-5]\d{14}$/', $cnum)) {
            $errors[] = "Invalid Mastercard number. MasterCard cards have 16 digits and start with digits 51 through 55\n";
            $result = false;
        }
        break;
    case "amex":
        if (!preg_match('/^3[47]\d{13}$/', $cnum)) {
            $errors[] = "Invalid American Express card number. American Express cards have 15 digits and start with 34 or 37\n";
            $result = false;
        }
        break;
}

if (empty($cexp)) {
    $errors[] = "Credit Card Expiry Date is required";
}

if (!preg_match("/^(0[1-9]|1[0-2])\/?([0-9]{2})$/", $cexp)) {
    $errors[] = "Invalid Credit Card Expiry Date. Hint:(MM/YY)";
}

if (empty($ccvv)) {
    $errors[] = "Credit Card CVV is required";
}

if (!preg_match("/^\d{3,4}$/", $ccvv)) {
    $errors[] = "Invalid Credit Card CVV";
}

// If there are any validation errors, redirect back to the form page
if (!empty($errors)) {
    $errorMessages = implode("<br>", $errors);
    header("Location: fix_order.php?error=" . urlencode($errorMessages));
    exit();
}

require_once 'settings.php';
$conn = mysqli_connect($host, $user, $pwd, $sql_db);


// Check if the orders table exists, create it if not --------------------------------------------------------
$createTableQuery = "CREATE TABLE IF NOT EXISTS orders (
        order_id INT AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(50) NOT NULL,
        lastname VARCHAR(50) NOT NULL,
        email VARCHAR(50) NOT NULL,
        straddr VARCHAR(100) NOT NULL,
        suburbtown VARCHAR(50) NOT NULL,
        state VARCHAR(10) NOT NULL,
        postcode INT NOT NULL,
        phonenum VARCHAR(20) NOT NULL,
        movie VARCHAR(50) NOT NULL,
        date DATE NOT NULL,
        time TIME NOT NULL,
        seats INT NOT NULL,
        opt VARCHAR(100),
        total DECIMAL(10, 2) NOT NULL,
        comment TEXT,
        ccType VARCHAR(20) NOT NULL,
        ccName VARCHAR(100) NOT NULL,
        ccNum VARCHAR(16) NOT NULL,
        ccExp VARCHAR(7) NOT NULL,
        ccvv VARCHAR(4) NOT NULL,
        order_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        order_status VARCHAR(20) DEFAULT 'Pending'
    )";
mysqli_query($conn, $createTableQuery);
if (!isset($_SERVER['HTTP_REFERER']) || $_SERVER['HTTP_REFERER'] == 'fix_order.php') {
    $movieIndex = isset($_POST['movie']) ? $_POST['movie'] : 0;
    $total = calculatePrice($movieIndex, $seats, $options);
}
// Insert the order into the database
$insertQuery = "INSERT INTO orders (
        order_id, firstname, lastname, email, straddr, suburbtown, state, postcode, phonenum, movie, date, time, seats, opt, total, comment,
        ccType, ccName, ccNum, ccExp, ccvv, order_time, order_status
    ) VALUES (
        NULL,'$firstname', '$lastname', '$email', '$straddr', '$suburbtown', '$state', $postcode, '$phonenum', '$movie', '$date', '$time',
        $seats, '$opt', $total, '$comment', '$ctype', '$cname', '$cnum', '$cexp', '$ccvv',NULL, 'Pending'
    )";
mysqli_query($conn, $insertQuery);

//after successful payment
$_SESSION['payment_success'] = true;

// Get the inserted order ID
$orderID = mysqli_insert_id($conn);
$_SESSION['order_id'] = $orderID;

// Redirect to the receipt page with order details
header("Location: receipt.php");
exit();
