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

    //if user click verification code submit button
    if(isset($_POST['check'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM Action_Customer WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['code'];
            $email = $fetch_data['email'];
            $code = 0;
            $status = 'verified';
            $update_otp = "UPDATE Action_Customer SET code = $code, status = '$status' WHERE code = $fetch_code";
            $update_res = mysqli_query($con, $update_otp);
            if($update_res){
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                header('location: index.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while updating code!";
            }
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    //if user click continue button in forgot password form
    if(isset($_POST['check-email'])){

        $email = mysqli_real_escape_string($con, $_POST['email']);
        $check_email = "SELECT * FROM Action_Customer WHERE cust_email='$email'";
        $run_sql = mysqli_query($con, $check_email);
        
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE Action_Customer SET code = $code WHERE cust_email = '$email'";
            $run_query =  mysqli_query($con, $insert_code);
        
            if($run_query){
                $subject = "Password Reset Code";
                $message = "Dear ActionSphere User,
                
                You have requested to reset the password for your ActionSphere account: $email. Please use the following code to complete the password reset process:
                
                Reset Code: $code
                
                If you did not initiate this password reset, please ignore this email. Your account's security is important to us.
                
                Thank you for using ActionSphere.
                
                Best regards,
                The ActionSphere Team";
                $sender = "From: actionspheresup@gmail.com";
                if(mail($email, $subject, $message, $sender)){
                    $info = "We've sent a password reset otp to your email - $email";
        
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: reset_code.php');
                    exit();
                } else {
                    $errors['otp-error'] = "Failed while sending code!";
                }
            } else {
                $errors['db-error'] = "Something went wrong!";
            }
        } else {
            $errors['email'] = "This email address does not exist!";
        }
    }

    //if user click check reset otp button
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM Action_Customer WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['cust_email'];
            $_SESSION['email'] = $email;
            $info = "Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('location: new_password.php');
            exit();
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    //if user click change password button
    if(isset($_POST['change-password'])){
        echo "Email from session: " . $_SESSION['email']; // Print the email from the session
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
        if($password !== $cpassword){
            $errors['password'] = "Confirm password not matched!";
        }else{
            $code = 0;
            $email = $_SESSION['email']; //getting this email using session
            $encpass = $password;
            $update_pass = "UPDATE Action_Customer SET code = $code, password = '$encpass' WHERE cust_email = '$email'";
            $run_query = mysqli_query($con, $update_pass);
            if($run_query){
                $info = "Your password changed. Now you can login with your new password.";
                $_SESSION['info'] = $info;
                header('Location: password_changed.php');
            }else{
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }
    
    
   
