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
    $usernameErr = $passwordErr = $secretcodeErr="";
    $username = "";

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Retrieve form data
        $secretcode = $_POST["secretcode"];
        $username = $_POST["username"];
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

        // Check if secretcode is empty
        if (empty($secretcode)) {
            $secretcodeErr = "Secret code is required.";
            $isValid = false;
        }

        // If all validation checks pass, authenticate the manager
        if ($isValid) {
            // Escape username and password to prevent SQL injection
            $escapedUsername = mysqli_real_escape_string($connection, $username);
            $escapedPassword = mysqli_real_escape_string($connection, $password);
            $escapedcode = mysqli_real_escape_string($connection, $secretcode);

            // Set the table name
            $sql_table = "Action_Staff";

            // Perform database query to check if username and password match
            $query = "SELECT * FROM $sql_table WHERE staff_username = '$escapedUsername' AND password = '$escapedPassword' AND secretCode = '$escapedcode'";
            $result = mysqli_query($connection, $query);            

            if ($result) {
                // Check if any rows were returned
                if (mysqli_num_rows($result) > 0) {
                    // Authentication successful
                    // Set session variables
                    $_SESSION['managerLoggedIn'] = true;
                    $_SESSION["manager_id"] = mysqli_fetch_assoc($result)["id"];

                    // Redirect to manager web page
                    echo '<script>window.location.href = "manager.php";</script>';
                    exit;
                } else {
                    // Authentication failed
                    $usernameErr = "Invalid username or password or secret code.";
                }
            } else {
                // Error in query execution
                echo "Query error: " . mysqli_error($connection);
            }
        }
    }
}
?>
<?php include("includes/header2.inc") ?>
<head>
<title>Manager Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles/responsive.css">

  </head>
<body class="body">
    <br><br><br><br><br><br><br>
    <h1 class="title1">Manager Login</h1>
    <div class="containermanager">
        <!-- HTML form for manager login -->
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <label for="username">Username:</label>
            <input type="text" name="username" value="<?php echo $username; ?>">
            <br>
            <span class="error"><?php echo $usernameErr; ?></span>
            <br>
            <label for="password">Password:</label>
            <input type="password" name="password">

            <br>
            <span class="error"><?php echo $passwordErr; ?></span>
            <br>

            <label for="secretcode">Code:</label>
            <input type="secretcode" name="secretcode">
            <br>
            <span class="error"><?php echo $secretcodeErr; ?></span>
            <br>

            <input type="submit" class="button" value="Log In">
            <br>
        </form>
    </div>
    <br><br>
    <?php include 'includes/footer.inc'; ?>
</body>

</html>