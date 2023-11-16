<?php
session_start();
$username = $_SESSION['cust_username'];
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// Include your database connection settings
require_once('settings.php'); // Replace with your actual connection file

$connection = @mysqli_connect(
    $host,
    $user,
    $pwd,
    $sql_db
);

// Check the database connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "UPDATE Action_Customer SET spins = spins + 2 WHERE cust_username = '$username'";
            if ($connection->query($sql) === TRUE) {
            } else {
            echo "Error updating spins." . $connection->error;
            }

// Fetch the custID based on the cust_username
$custIDQuery = "SELECT custID, cust_contactNo, cust_email FROM Action_Customer WHERE cust_username = '$username'";
$custIDResult = $connection->query($custIDQuery);

if ($custIDResult->num_rows > 0) {
    $custIDRow = $custIDResult->fetch_assoc();
    $custID = $custIDRow['custID'];
    $phoneno = $custIDRow['cust_contactNo'];
    $email = $custIDRow['cust_email'];

// Retrieve the latest booking data based on BookingID
$sql = "SELECT BookingID, datetime, RoomName, PricePerPerson, RoomPrice, MaxCapacity, AdditionalServicePrice, totalPrice, ccType, ccName, ccNumber, ccExp, ccCVV
        FROM Action_Bookings
        WHERE custID = $custID
        AND movie_name = ''
        ORDER BY BookingID DESC
        LIMIT 1";

$result = mysqli_query($connection, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    // Fetch the latest booking details
    $row = mysqli_fetch_assoc($result);
    
    $bookID = $row['BookingID'];
    $datetime = $row['datetime'];
    $room = $row['RoomName'];
    $priceperpax = $row['PricePerPerson'];
    $roomprice = $row['RoomPrice'];
    $maxcap = $row['MaxCapacity'];
    $additionalprice = $row['AdditionalServicePrice'];
    $total = $row['totalPrice'];
    $ctype = $row['ccType'];
    $cname = $row['ccName'];
    $cnum = $row['ccNumber'];
    $cexp = $row['ccExp'];
    $ccvv = $row['ccCVV'];
} else {
    echo "No matching booking found.";
}
}
// Close the database connection
mysqli_close($connection);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Order Receipt</title>
    <meta charset="utf-8" />
    <meta name="author" content="Saw Zi Chuen" />
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <h1>Order Receipt</h1>

    <table class="enc">
        <tr>
            <th>Booking ID:</th>
            <td>
                <?php echo $bookID; ?>
            </td>
        </tr>
        <tr>
            <th>Timestamp of receipt:</th>
            <td>
                <?php echo $datetime; ?>
            </td>
        </tr>
        <tr>
            <th>Name:</th>
            <td>
                <?php echo $cname; ?>
            </td>
        </tr>
        <tr>
            <th>Email:</th>
            <td>
                <?php echo $email; ?>
            </td>
        </tr>
        <tr>
            <th>Phone Number:</th>
            <td>
                <?php echo $phoneno; ?>
            </td>
        </tr>
        <tr>
            <th>Theme Room Name:</th>
            <td>
                <?php echo $room; ?>
            </td>
        </tr>
        <tr>
            <th>Theme Room Price:</th>
            <td>
                <?php echo $roomprice; ?>
            </td>
        </tr>
        <tr>
            <th>Price Per Person:</th>
            <td>
                <?php echo $priceperpax; ?>
            </td>
        </tr>
        <tr>
            <th>Additional Service Price:</th>
            <td>
                <?php echo $additionalprice; ?>
            </td>
        </tr>
        <tr>
            <th>Total Price:</th>
            <td>
                <?php echo $total; ?>
            </td>
        </tr>
        <tr>
            <th>Credit Card Type:</th>
            <td>
                <?php echo $ctype; ?>
            </td>
        </tr>
        <tr>
            <th>Credit Card Name:</th>
            <td>
                <?php echo $cname; ?>
            </td>
        </tr>
        <tr>
            <th>Credit Card Number:</th>
            <td>
                <?php echo '**** **** **** ' . substr($cnum, -4); ?>
            </td>
        </tr>
        <tr>
            <th>Credit Card Exp:</th>
            <td>
                <?php echo '**/**'; ?>
            </td>
        </tr>
        <tr>
            <th>Credit Card CVV:</th>
            <td>
                <?php echo '***'; ?>
            </td>
        </tr>

    </table>
    <button type="button" onclick="window.location.href='index.php'">Go to Home</button>
</body>

</html>