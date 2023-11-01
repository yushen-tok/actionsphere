<!DOCTYPE html>
<html>
<?php include("includes/header3.inc") ?>

<head>
  <style>
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



    /*
body::before{
  content: "";
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.7);
}*/


    main {

      margin-top: 50px;
    }

    dl {
      display: table;
      margin: 0 auto;
      width: 50%;
    }

    dt {
      font-weight: bold;
      margin-top: 20px;
    }

    dd {
      margin-left: 0;
      margin-bottom: 20px;
    }

    .tab {
      text-align: center;
      color: black;
      font-weight: bold;

      background-color: #c9d6df;

      margin: 0 auto;
      border-collapse: collapse;

    }

    #time table {
      margin: 0 auto;
      border-collapse: collapse;
    }


    #time thead {
      background-color: #e1e5e8;
    }

    #time tbody {
      background-color: #f2f4f5;
      font-weight: normal;
    }

    figure {
      /*float: right;*/
      border: 2px double;
      padding: 20px;
    }

    /*
img {
  max-width: 100%;
}
*/

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

    /*
.unhover_img:hover {
  display: none;
}
*/
    .logo:hover .hover_img {
      display: inline;
      height: 180px;

    }

    .container {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 10px;
    }

    /*-------------------------------------*/

    .space {
      margin-top: 20px;
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

    #mov {
      float: left;
      width: 40%;
      margin-top: 350px;

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
  </style>
  <title>Add/Remove Staff</title>

</head>

<body>
  <h2>Add/Remove Staff</h2>
  <?php

  // Include database connection and helper functions
  require_once('settings.php');

  $connection = @mysqli_connect(
    $host,
    $user,
    $pwd,
    $sql_db
  );

  if (!$connection) {
    echo "<p class=\"wrong\">Database connection failure</p>";
  } else {
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action'])) {
      if ($_GET['action'] === 'remove' && isset($_GET['staffID'])) {
        $staffID = mysqli_real_escape_string($connection, $_GET['staffID']);
        // Perform staff removal
        $query = "DELETE FROM Action_Staff WHERE staffID = $staffID";
        $result = mysqli_query($connection, $query);
        if ($result) {
          echo "Staff member removed successfully!";
        } else {
          echo "Failed to remove staff member.";
        }
      }
    }
  }
  ?>


  <?php
  // Check if the form is submitted
  if (isset($_POST['add'])) {
    require_once('settings.php');

    $conn = @mysqli_connect(
      $host,
      $user,
      $pwd,
      $sql_db
    );

    // Check if the connection is successful
    if (!$conn) {
      die("Database connection failed: " . mysqli_connect_error());
    }

    // Retrieve form data
    $staff_name = mysqli_real_escape_string($conn, $_POST['staff_name']);
    $staff_username = mysqli_real_escape_string($conn, $_POST['staff_username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); // Hash the password
    $secretcode = mysqli_real_escape_string($conn, $_POST['secretcode']);
    $managerial = mysqli_real_escape_string($conn, $_POST['managerial']);

    // SQL query to insert data into Action_Staff table
    $sql = "INSERT INTO Action_Staff (staff_name, staff_username, password, secretCode, Managerial)
            VALUES ('$staff_name', '$staff_username', '$password', '$secretcode', '$managerial')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
      echo "New staff member added successfully.";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
  }
  ?>
  <!DOCTYPE html>
  <html>

  <head>
    <style>
      body {
        background-image: url("../ActionSphere/styles/images/bg.png");
        background-size: cover;
        background-position: center;
        text-align: center;
        font-family: "Noto Sans", sans-serif;
        /*cursor: url(styles/images/cursor-image.png), auto;*/
      }

      .form-container {
        width: 400px;
        margin: 0 auto;
      }

      .form-container form {
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 5px;
      }

      .form-container label {
        display: block;
        margin-top: 10px;
      }

      .form-container input[type="text"],
      .form-container input[type="email"],
      .form-container input[type="password"],
      .form-container input[type="text"],
      .form-container select {
        width: 100%;
        padding: 5px;
        margin: 5px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
      }

      .form-container input[type="checkbox"] {
        margin: 5px 10px 5px 0;
      }

      .form-container input[type="submit"] {
        background-color: #007BFF;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
      }

      table {
        width: 100%;
        border-collapse: collapse;
      }

      table,
      th,
      td {
        border: 1px solid #ccc;
      }

      th,
      td {
        padding: 10px;
        text-align: left;
      }

      th {
        background-color: #f2f2f2;
      }
    </style>
  </head>

  <body>
    <br><br><br><br><br><br><br><br><br><br>
    <h2>Add Staff Members</h2>
    <div class="form-container">


      <!-- Form to add new staff members -->
      <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="staff_name">Staff Name:</label>
        <input type="text" name="staff_name" required>

        <label for="staff_username">Email:</label>
        <input type="email" name="staff_username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <label for="secretcode">Secret Code:</label>
        <input type="text" name="secretcode" required>

        <label for="managerial">Managerial Role:</label>
        <select name="managerial" required>
          <option value="M">Manager</option>
          <option value="S">Staff</option>
        </select>

        <input type="submit" name="add" value="Add Staff">
      </form>
    </div>

    <h2>Existing Staff Members</h2>
    <table>
      <tr>
        <th>Staff ID</th>
        <th>Staff Name</th>
        <th>Staff Email</th>
        <th>Managerial Role</th>
        <th>Edit</th>
        <th>Remove</th>
      </tr>

      <?php

      // Fetch and list staff members
      $query = "SELECT * FROM Action_Staff";
      $result = mysqli_query($connection, $query);
      if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>" . $row['staffID'] . "</td>";
          echo "<td>";
          if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['staffID']) && $_GET['staffID'] === $row['staffID']) {
            echo "<form method='post' action='{$_SERVER["PHP_SELF"]}'>";
            echo "<input type='hidden' name='staffID' value='{$row['staffID']}'>";
            echo "<input type='text' name='staff_name' value='{$row['staff_name']}'>";
          } else {
            echo $row['staff_name'];
          }
          echo "</td>";
          echo "<td>";
          if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['staffID']) && $_GET['staffID'] === $row['staffID']) {
            echo "<input type='text' name='staff_username' value='{$row['staff_username']}'>";
          } else {
            echo $row['staff_username'];
          }
          echo "</td>";
          echo "<td>";
          if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['staffID']) && $_GET['staffID'] === $row['staffID']) {
            echo "<input type='text' name='managerial' value='{$row['Managerial']}'>";
          } else {
            echo $row['Managerial'];
          }
          echo "</td>";
          echo "<td>";
          if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['staffID']) && $_GET['staffID'] === $row['staffID']) {
            echo "<input type='submit' name='update' value='Update'>";
            echo "</form>";
          } else {
            echo "<a href='{$_SERVER["PHP_SELF"]}?action=edit&staffID={$row['staffID']}'>Edit</a>";
          }
          echo "</td>";
          echo "<td><a href='{$_SERVER["PHP_SELF"]}?action=remove&staffID={$row['staffID']}'>Remove</a></td>";
          echo "</tr>";
        }
      }

      if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
        $staffID = mysqli_real_escape_string($connection, $_POST['staffID']);
        $staff_name = mysqli_real_escape_string($connection, $_POST['staff_name']);
        $managerial = mysqli_real_escape_string($connection, $_POST['managerial']);

        // Update the staff member's details
        $query = "UPDATE Action_Staff SET staff_name = '$staff_name', Managerial = '$managerial' WHERE staffID = $staffID";
        $result = mysqli_query($connection, $query);

        if ($result) {
          echo "Staff member updated successfully!";
        } else {
          echo "Failed to update staff member.";
        }
      }

      ?>
    </table>

  </body>

  </html>