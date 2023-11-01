<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles/responsive.css">
    <style>
        /* style.css */

        body {
            background-image: url("../ActionSphere/styles/images/bg.png");
            background-size: cover;
            background-position: center;
            text-align: center;
            font-family: "Noto Sans", sans-serif;
        }

        .container1 {
            margin-top: 5%;
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
        }

        .button:hover {
            background-color: #0056b3;
        }

        .alert {
            margin-top: 20px;
        }

        html {
            scroll-behavior: smooth;
        }

        aside {
            width: 25%;
            float: right;
            border: 3px solid #000000;
            background-color: rgba(0, 0, 0, 0.8);
        }


        nav {
            top: 0;
            left: 0;
            width: 100%;
            color: #fff;
            text-align: right;
            padding: 1em;
            font-size: 300%;
            /*font-weight: 600*/

        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;

        }

        nav li {
            display: inline-block;
            margin-right: 16px;
        }

        nav ul li a {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-weight: bold;
            color: white;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            font-size: 30px;
            padding-bottom: 2px;
            border-bottom: 2px solid transparent;
            transition: border-bottom-color 0.2s ease-in-out, color 0.2s ease-in-out;
            margin: 0 1em;

        }


        nav a:hover {
            border-bottom-color: #C93636;
            color: #C93636;
        }

        .logo img {
            height: 120px;
            width: auto;
        }

        .hover_img {
            position: absolute;
            top: 0;
            left: 0;
            display: none;
            padding-top: 20px;

        }

        .hover_img img {
            height: 250px;
        }

        #mov {
            float: left;
            width: 40%;
            margin-top: 350px;

        }

        /*
.unhover_img:hover {
  display: none;
}
*/
        .logo:hover .hover_img {
            display: inline;
            height: 180px;

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

        header {
            background-color: black;
            top: 0;
            left: 0;
            right: 0;
            z-index: 9999;
            position: fixed;
            mix-blend-mode: darken;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #000000;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        }

        .dropdown-content a {
            color: rgb(255, 255, 255);
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
        }
    </style>
    <?php include("includes/header2.inc") ?>
</head>

<body>
    <br> <br> <br> <br> <br> <br> <br> <br> <br>
    <div class="container1">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="forgot-password.php" method="POST" autocomplete="">
                    <h2 class="text-center">Forgot Password</h2>
                    <p class="text-center">Enter your email address</p>
                    <?php
                    if (count($errors) > 0) {
                    ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach ($errors as $error) {
                                echo $error;
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Enter email address" required value="<?php echo $email ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="check-email" value="Continue">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br> <br> 
    <?php include 'includes/footer.inc'; ?>
</body>

</html>