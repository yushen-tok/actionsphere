<?php

session_start();

//necessary files and establish database connection
require_once('settings.php');

$connection = @mysqli_connect(
    $host,
    $user,
    $pwd,
    $sql_db
);

if (!$connection) {
    // Displays an error message
    echo "<p class=\"wrong\">Database connection failure</p>"; // Might not show in a production script 
} else {

    // Define error variables
    $usernameErr = $passwordErr = "";
    $username = "";

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Retrieve form data
        $username = $_POST["cust_username"];
        $password = $_POST["password"];

        // Perform server-side validation
        $isValid = true;

        // Check if username is empty
        if (empty($username)) {
            $usernameErr = "Username is required.";
            $isValid = false;
        }

        // Check if password is empty
        if (empty($password)) {
            $passwordErr = "Password is required.";
            $isValid = false;
        }

        // If all validation checks pass, authenticate the manager
        if ($isValid) {
            // Escape username and password to prevent SQL injection
            $escapedUsername = mysqli_real_escape_string($connection, $username);
            $escapedPassword = mysqli_real_escape_string($connection, $password);

            // Set the table name
            $sql_table = "Action_Customer";

            // Perform database query to check if username and password match
            $query = "SELECT * FROM $sql_table WHERE cust_username = '$escapedUsername' AND password = '$escapedPassword'";
            $result = mysqli_query($connection, $query);

            if ($result) {
                // Check if any rows were returned
                if (mysqli_num_rows($result) > 0) {
                    // Authentication successful
                    // Set session variables
                    $_SESSION['cust_username'] = $escapedUsername;
                    $_SESSION['customerLoggedIn'] = true;
                    //$_SESSION["customer_id"] = mysqli_fetch_assoc($result)["id"];

                    // Redirect to manager web page
                    echo '<script>window.location.href = "index.php";</script>';
                    exit;
                } else {
                    // Authentication failed
                    $usernameErr = "Incorrect Username.";
                    $passwordErr = "Incorrect Password";
                }
            } else {
                // Error in query execution
                echo "Query error: " . mysqli_error($connection);
            }
        }
    }
}
?>
<!-- OYZ modified 5th Oct-->
<?php
if ($_SESSION['cust_username']) {

    echo '<script>
        window.alert("You have already logged in your account.");
        window.location.href = "index.php";
        </script>';
}
?>
<!-- OYZ modified 5th Oct-->
<?php include("includes/header2.inc") ?>

<head>
    <title>Customer Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles/responsive.css">
    <link rel="stylesheet" href="styles/loading.css">

    <style>
        .containermanager {
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            width: 300px;
            margin: 0 auto;
            text-align: center;
        }

        .login-form label {
            font-weight: bold;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .login-form input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .login-form a {
            text-decoration: none;
            color: #007bff;
            display: block;
            margin-top: 10px;
        }
    </style>
</head>

<body class="body">
    <!-- Loading Screen -->
    <div class="loading-screen">
        <!-- Word Animation -->
        <div class="word-animation">
            <span class="letter" style="--delay: 1;">A</span>
            <span class="letter" style="--delay: 2;">c</span>
            <span class="letter" style="--delay: 3;">t</span>
            <span class="letter" style="--delay: 4;">i</span>
            <span class="letter" style="--delay: 5;">o</span>
            <span class="letter" style="--delay: 6;">n</span>
            <span class="letter" style="--delay: 7;">S</span>
            <span class="letter" style="--delay: 8;">p</span>
            <span class="letter" style="--delay: 9;">h</span>
            <span class="letter" style="--delay: 10;">e</span>
            <span class="letter" style="--delay: 11;">r</span>
            <span class="letter" style="--delay: 12;">e</span>
        </div>
    </div>
    <br><br><br><br><br><br><br><br><br><br><br>
    <h1 class="title1">Customer Login</h1>
    <div class="containermanager login-form">
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <label for="cust_username">Username:</label>
            <input type="text" name="cust_username" value="<?php echo $username; ?>">
            <span class="error" style="color: red;"><?php echo $usernameErr; ?></span>
            <br>
            <br>
            <label for="password">Password:</label>
            <input type="password" name="password">
            <span class="error" style="color: red;"><?php echo $passwordErr; ?></span>
            <br>
            <br>
            <input type="submit" class="button" value="Log In">
            <br>
        </form>
    </div>
    <a href="forgot-password.php">Forgot Password?</a>
    <br><br>
    <?php include 'includes/footer.inc'; ?>
    <script>
        setTimeout(function() {
            // Remove the loading screen after a certain delay
            document.querySelector(".loading-screen").style.display = "none";
        }, 1500); // Adjust the delay (in milliseconds) as needed
    </script>
</body>

</html>