<?php
session_start();

// Include necessary files and establish database connection
require_once('settings.php');

$connection = mysqli_connect($host, $user, $pwd, $sql_db);

if (!$connection) {
    // Displays an error message
    echo "<p class=\"wrong\">Database connection failure</p>"; // Might not show in a production script 
} else {
    $tableExists = mysqli_query($connection, "SHOW TABLES LIKE 'Action_Customer'");

    if ($tableExists->num_rows == 0) {
        $createTableQuery = "CREATE TABLE `Action_Customer` (
            custID INT AUTO_INCREMENT PRIMARY KEY,
            cust_username VARCHAR(40) NOT NULL,
            cust_contactNo text NOT NULL,
            cust_email VARCHAR(40) NOT NULL, 
            password VARCHAR(25) NOT NULL
        )";

        // Execute the query to create the table
        if (mysqli_query($connection, $createTableQuery)) {
            echo "Table has been created successfully.";
        } else {
            echo "Error creating table: " . mysqli_error($connection);
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql_table = "Action_Customer";

    // Define error variables
    $usernameErr = $passwordErr = $emailErr = $contactErr = "";
    $username = "";
    $email = "";
    $contactno = "";

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $username = $_POST["cust_username"];
        $email = $_POST["cust_email"];
        $contactno = $_POST["cust_contactNo"];
        $password = $_POST["password"];

        // Perform server-side validation
        $isValid = true;

        // Check if username is empty or already exists
        if (empty($username)) {
            $usernameErr = "Username is required.";
            $isValid = false;
        } else {
            // Escape username to prevent SQL injection
            $escapedUsername = mysqli_real_escape_string($connection, $username);

            // Perform database query to check if username exists
            $query = "SELECT CUSTID FROM `Action_Customer` WHERE cust_username = '$escapedUsername'";
            $result = mysqli_query($connection, $query);

            if (mysqli_num_rows($result) > 0) {
                // Username already exists
                $usernameErr = "Username already exists.";
                $isValid = false;
            }
        }

        // Check if email meet your requirement
        if (empty($email)) {
            $emailErr = "Email is required.";
            $isValid = false;
        } else {
            // Check if the email is a valid email address
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format.";
                $isValid = false;
            } else {
                // Escape email to prevent SQL injection
                $escapedEmail = mysqli_real_escape_string($connection, $email);

                // Perform database query to check if email exists
                $query = "SELECT CUSTID FROM `Action_Customer` WHERE cust_email = '$escapedEmail'";
                $result = mysqli_query($connection, $query);

                if (mysqli_num_rows($result) > 0) {
                    // Username already exists
                    $usernameErr = "Email already exists.";
                    $isValid = false;
                }
            }
        }

        // Check if contact number meet your requirement
        if (empty($contactno)) {
            $contactErr = "Contact number is required.";
            $isValid = false;
        } else {
            // Check if the contact number is in a valid format (e.g., 123-456-7890)
            if (!preg_match("/^\d{3}-\d{3}-\d{4}$/", $contactno)) {
                $contactErr = "Invalid contact number format. Use XXX-XXX-XXXX.";
                $isValid = false;
            } else {
                // Escape contact to prevent SQL injection
                $escapedContact = mysqli_real_escape_string($connection, $contactno);

                // Perform database query to check if email exists
                $query = "SELECT CUSTID FROM `Action_Customer` WHERE cust_contactNo = '$escapedContact'";
                $result = mysqli_query($connection, $query);

                if (mysqli_num_rows($result) > 0) {
                    // Username already exists
                    $usernameErr = "Contact number already exists.";
                    $isValid = false;
                }
            }
        }

        // Check if password meets your desired rules
        if (empty($password)) {
            $passwordErr = "Password is required.";
            $isValid = false;
        } elseif (strlen($password) < 8) {
            $passwordErr = "Password must be at least 8 characters long.";
            $isValid = false;
        } elseif (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $password)) {
            $passwordErr = "Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.";
            $isValid = false;
        }

        // If all validation checks pass, insert manager's information into the database
        if ($isValid) {
            // Escape password to prevent SQL injection
            $escapedPassword = mysqli_real_escape_string($connection, $password);

            // Insert the username and password into the database
            $query = "INSERT INTO `Action_Customer` (cust_username, cust_contactNo, cust_email, password) VALUES ('$escapedUsername', '$escapedContact', '$escapedEmail', '$escapedPassword')";
            $result = mysqli_query($connection, $query);


            if ($result) {
                // Password successfully inserted into the database
                // Redirect to the manager login page or display a success message
                echo '<script>window.location.href = "customerlogin.php";</script>';
                exit;
            } else {
                // Error occurred while inserting the password
                // Handle the error accordingly
                echo "Error: " . mysqli_error($connection);
            }
        }
    }

    // Close the database connection
    mysqli_close($connection);
}
?>
<!-- OYZ modified 12th Oct-->
<?php
if ($_SESSION['cust_username']) {

    echo '<script>
        window.alert("You have already logged in your account.");
        window.location.href = "index.php";
        </script>';
}
?>
<!-- OYZ modified 12th Oct-->
<?php include("includes/header2.inc") ?>

<head>
    <title>Customer Registration</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles/responsive.css">
    <link rel="stylesheet" href="styles/loading.css">
    <style>
        /* CSS for the registration form */
        .containerregister {
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            width: 300px;
            margin: 0 auto;
            text-align: center;
        }

        .register-form label {
            font-weight: bold;
        }

        .register-form input[type="text"],
        .register-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .register-form input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .register-form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .register-form a {
            text-decoration: none;
            color: #007bff;
            display: block;
            margin-top: 10px;
        }

        /* Error style */
        .error {
            color: red;
            font-size: 14px;
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
    <br><br><br><br><br><br><br><br><br>
    <h1 class="title1">Customer Registration</h1>
    <div class="containerregister register-form">
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <label for="cust_username">Username:</label>
            <input type="text" name="cust_username" value="<?php echo isset($username) ? $username : ''; ?>">
            <?php if (isset($usernameErr)) : ?>
                <span class="error"><?php echo $usernameErr; ?></span>
            <?php endif; ?>
            <br><br>
            <label for="cust_contactNo">Contact No:</label>
            <input type="text" name="cust_contactNo" value="<?php echo isset($contactno) ? $contactno : ''; ?>">
            <?php if (isset($contactErr)) : ?>
                <span class="error"><?php echo $contactErr; ?></span>
            <?php endif; ?>
            <br><br>
            <label for="cust_email">Email:</label>
            <input type="text" name="cust_email" value="<?php echo isset($email) ? $email : ''; ?>">
            <?php if (isset($emailErr)) : ?>
                <span class="error"><?php echo $emailErr; ?></span>
            <?php endif; ?>
            <br><br>
            <label for="password">Password:</label>
            <input type="password" name="password">
            <br><br>
            <?php if (isset($passwordErr)) : ?>
                <span class="error"><?php echo $passwordErr; ?></span>
            <?php endif; ?>
            <br><br>
            <input type="submit" value="Sign Up">
            <br>
            <?php if (isset($username) && isset($password)) : ?>
                <br>
                <p>Already have an account? Login as a customer:</p>
                <a href="customerlogin.php" class="button">Customer Login</a>
            <?php endif; ?>
        </form>
    </div>

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