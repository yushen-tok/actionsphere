<?php
session_start();

require_once('settings.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$connection = @mysqli_connect(
    $host,
    $user,
    $pwd,
    $sql_db
);

$con = mysqli_connect($host, $user, $pwd, $sql_db);

$email = "";
$name = "";
$errors = array();

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl'; // Use 'tls' instead of 'SSL'
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->Username = 'actionspheresup@gmail.com'; // Your Gmail address
$mail->Password = 'hduimxqxgpgldajc'; // Your Gmail password

$mail->setFrom('actionspheresup@gmail.com');

$success_message = ""; // Initialize success message
$error_message = "";   // Initialize error message

// If the user clicks the "Send Details via Email" button
if (isset($_POST['send_email'])) {
    // Get the recipient's email address
    $recipientEmail = $_POST['recipient_email'];

    // Get the details as a JSON-encoded string and decode it
    $detailsJSON = $_POST['details'];
    $details = json_decode($detailsJSON, true);

    $subject = "Booking Details- ActionSphere";
    // Create an email message with the details
    // Create an email message with the details

    $message = "Booking Details:\n\n";
    $message .= "BookingID: " . $details["BookingID"] . "\n";
    $message .= "Time Booked: " . $details["datetime"] . "\n";
    $message .= "Name: " . $details["ccName"] . "\n";
    $message .= "Movie Name: " . $details["movie_name"] . "\n";
    $message .= "Movie Seats: " . $details["movie_seats"] . "\n";
    $message .= "Movie Date: " . $details["movie_date"] . "\n";
    $message .= "Movie Time: " . $details["movie_time"] . "\n";
    $message .= "Food & Beverage: ";
    if ($details["selectedfandb"] !== "") {
        $message .= $details["selectedfandb"];
    } else {
        $message .= "No food and beverage selected for this booking";
    }
    $message .= "\n";
    $message .= "Total Price: RM" . $details["totalPrice"] . "\n";

    $message .= "
        __________________________
________|                        |_______
\       |      ActionSphere      |      /
\      |                         |     /
/      |_________________________|     \
/__________)                     (_______\

";

    $sender = "From: actionspheresup@gmail.com";

    // Send the email
    try {
        // Set the content type to HTML
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

        mail($recipientEmail, $subject, $message, $sender);
        $success_message = "Booking details sent via email.";
    } catch (Exception $e) {
        $error_message = "Failed to send details via email. Error: " . $mail->ErrorInfo;
    }
}

// If the user clicks the "Send Details via Email" button
elseif (isset($_POST['send_emailtheme'])) {
    // Get the recipient's email address
    $recipientEmail = $_POST['recipient_email'];

    $bookingID = $_POST['booking_id'];
    $datetime = $_POST['datetime'];
    $ccName = $_POST['cc_name'];
    $roomName = $_POST['room_name'];
    $PricePerPerson = $_POST['PricePerPerson'];
    $RoomPrice = $_POST['RoomPrice'];
    $MaxCapacity = $_POST['MaxCapacity'];
    $AdditionalServicePrice = $_POST['AdditionalServicePrice'];
    $totalPrice= $_POST['totalPrice'];

    $subject = "Booking Details- ActionSphere";
    // Create an email message with the details
    // Create an email message with the details
    $message = "Booking Details:\n\n";
    $message .= "BookingID: " . $bookingID . "\n";
    $message .= "Datetime: " . $datetime . "\n";
    $message .= "Name: " . $ccName . "\n";
    $message .= "Room Name: " . $roomName . "\n";
    $message .= "Movie Seats: " . $PricePerPerson . "\n";
    $message .= "Movie Date: " . $RoomPrice . "\n";
    $message .= "Movie Time: " . $MaxCapacity . "\n";
    $message .= "AddonsID: " . $AdditionalServicePrice . "\n";
    $message .= "Total Price: RM" . $totalPrice . "\n";

    $message .= "
        __________________________
________|                        |_______
\       |      ActionSphere      |      /
\      |                         |     /
/      |_________________________|     \
/__________)                     (_______\

";


    $sender = "From: actionspheresup@gmail.com";

    // Send the email
    try {
        // Set the content type to HTML
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

        mail($recipientEmail, $subject, $message, $sender);
        $success_message = "Booking details sent via email.";
    } catch (Exception $e) {
        $error_message = "Failed to send details via email. Error: " . $mail->ErrorInfo;
    }
}


// Redirect to index.php with success or error message
header('location: index.php?success=' . urlencode($success_message) . '&error=' . urlencode($error_message));
exit();
