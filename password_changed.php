<?php require_once "controllerUserData.php"; ?>
<?php
$email = $_SESSION['email'];
if ($email == false) {
    header('Location: customerlogin.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* style.css */
        body {
            background-image: url("../ActionSphere/styles/images/bg.png");
            background-size: cover;
            background-position: center;
            text-align: center;
            font-family: "Noto Sans", sans-serif;
        }

        footer {
            background-color: black;
            color: #fff;
            padding: 30px 0;
            position: relative;
            bottom: 0px;
        }

        .con {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .social-icons {
            display: flex;
        }

        .social-icons a {
            display: inline-block;
            margin-right: 30px;
            color: #fff;
            font-size: 60px;
            line-height: 30px;
            transition: color 0.2s;
        }

        .social-icons a:hover {
            color: #ccc;
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .contact-info p {
            margin: 0;
        }

        .contact-info p:first-child {
            margin-bottom: 10px;
        }

        .container {
            margin-top: 10%;
        }

        .form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px #000;
        }

        .text-center {
            text-align: center;
        }

        .form-group {
            margin-top: 20px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .button {
            background-color: #007bff;
            color: #fff;
            width: 100%;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .alert {
            margin-top: 20px;
        }

        .alert-success {
            background-color: #28a745;
            color: #fff;
        }

        .alert-danger {
            background-color: #dc3545;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form login-form">
                <?php
                if (isset($_SESSION['info'])) {
                ?>
                    <div class="alert alert-success text-center">
                        <?php echo $_SESSION['info']; ?>
                    </div>

                <?php
                }
                ?>
                <form action="customerlogin.php" method="POST">
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="login-now" value="Login Now">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br> <br>   <br> <br> <br> <br> <br> <br> <br> <br> 
    <?php include 'includes/footer.inc'; ?>
</body>
</html>