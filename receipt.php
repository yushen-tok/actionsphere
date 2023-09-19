<?php
session_start();
if (!isset($_SESSION['payment_success']) || $_SESSION['payment_success'] !== true) {
    header("Location: index.php");
    exit();
}

// Clear payment success flag
unset($_SESSION['payment_success']);

require_once 'settings.php';
$conn = mysqli_connect($host, $user, $pwd, $sql_db);

// retrieve from database
$orderID = $_SESSION['order_id']; // Assuming the order ID is stored in the session
$selectQuery = "SELECT * FROM orders WHERE order_id = $orderID";
$result = mysqli_query($conn, $selectQuery);

if (!$result) {
    die("Failed to retrieve order details: " . mysqli_error($conn));
}

$order = mysqli_fetch_assoc($result);
mysqli_free_result($result);
mysqli_close($conn);
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
            <th>Order ID:</th>
            <td><?php echo $order['order_id']; ?></td>
        </tr>
        <tr>
            <th>First Name:</th>
            <td><?php echo $order['firstname']; ?></td>
        </tr>
        <tr>
            <th>Last Name:</th>
            <td><?php echo $order['lastname']; ?></td>
        </tr>
        <tr>
            <th>Email:</th>
            <td><?php echo $order['email']; ?></td>
        </tr>
        <tr>
            <th>Address:</th>
            <td><?php echo $order['straddr']; ?></td>
        </tr>
        <tr>
            <th>Suburb/Town:</th>
            <td><?php echo $order['suburbtown']; ?></td>
        </tr>
        <tr>
            <th>State:</th>
            <td><?php echo $order['state']; ?></td>
        </tr>
        <tr>
            <th>Postcode:</th>
            <td><?php echo $order['postcode']; ?></td>
        </tr>
        <tr>
            <th>Phone Number:</th>
            <td><?php echo $order['phonenum']; ?></td>
        </tr>
        <tr>
            <th>Movie:</th>
            <td><?php echo $order['movie']; ?></td>
        </tr>
        <tr>
            <th>Date:</th>
            <td><?php echo $order['date']; ?></td>
        </tr>
        <tr>
            <th>Time:</th>
            <td><?php echo $order['time']; ?></td>
        </tr>
        <tr>
            <th>Number of Seats:</th>
            <td><?php echo $order['seats']; ?></td>
        </tr>
        <tr>
            <th>Options:</th>
            <td><?php echo $order['opt']; ?></td>
        </tr>
        <tr>
            <th>Total Price:</th>
            <td><?php echo $order['total']; ?></td>
        </tr>
        <tr>
            <th>Comment:</th>
            <td><?php echo $order['comment']; ?></td>
        </tr>
        <tr>
            <th>Order Time:</th>
            <td><?php echo $order['order_time']; ?></td>
        </tr>
        <tr>
            <th>Order Status:</th>
            <td><?php echo $order['order_status']; ?></td>
        </tr>
        <tr>
            <th>Credit Card Type:</th>
            <td><?php echo $order['ccType']; ?></td>
        </tr>
        <tr>
            <th>Credit Card Name:</th>
            <td><?php echo $order['ccName']; ?></td>
        </tr>
        <tr>
            <th>Credit Card Number:</th>
            <td><?php echo '**** **** **** ' . substr($order['ccNum'], -4); ?></td>
        </tr>
        <tr>
            <th>Credit Card Exp:</th>
            <td><?php echo '***'; ?></td>
        </tr>
        <tr>
            <th>Credit Card CVV:</th>
            <td><?php echo '***'; ?></td>
        </tr>
        
    </table>
</body>

</html>