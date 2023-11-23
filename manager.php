<head>
  <title>Manager</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles/responsive.css">
</head>

<?php
function getAllMovieDetailsFromDatabase()
{
    require_once('settings.php');

    $conn = @mysqli_connect(
        $host,
        $user,
        $pwd,
        $sql_db
    );

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to fetch movie details for Movie_ID 1, 2, and 3
    $sql = "SELECT * FROM Action_Movie WHERE Movie_ID IN (1, 2, 3)";
    $result = $conn->query($sql);

    $movieDetails = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $movieDetails[] = $row;
        }
    }

    return $movieDetails;
}

// Function to update movie details
function updateMovie($movieID, $imageUrl, $title, $year, $genre, $director, $star, $duration, $synopsis, $date, $time)
{
    require_once('settings.php');

    $conn = @mysqli_connect(
        $host,
        $user,
        $pwd,
        $sql_db
    );

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to update movie details
    $sql = "UPDATE Action_Movie
    SET imageurl='$imageUrl', title='$title', year='$year', genre='$genre', director='$director', star='$star', 
        duration='$duration', synopsis='" . mysqli_real_escape_string($conn, $synopsis) . "', date='$date', time='$time'
    WHERE Movie_ID='$movieID'";

    if ($conn->query($sql) === TRUE) {
      // Display a success message using JavaScript alert
      echo '<script>alert("Movie details updated successfully");</script>';
      header("Location: manager.php");
  } else {
      echo "Error updating movie details: " . $conn->error;
      header("Location: manager.php");
  }
  $conn->close();
}

// Check if the form was submitted and update the movie details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $movieID = isset($_POST['movieID']) ? $_POST['movieID'] : ''; // Retrieve movieID from the form
    $imageUrl = $_POST['imageUrl'];
    $title = $_POST['title'];
    $year = $_POST['year'];
    $genre = $_POST['genre'];
    $director = $_POST['director'];
    $star = $_POST['star'];
    $duration = $_POST['duration'];
    $synopsis = $_POST['synopsis'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Call the function to update movie details
    updateMovie($movieID, $imageUrl, $title, $year, $genre, $director, $star, $duration, $synopsis, $date, $time);
}

$movies = getAllMovieDetailsFromDatabase();
?>
<?php include("includes/header3.inc") ?>
<!-- OYZ modified 18th Nov-->
<?php
if (empty($staffName)) {

    echo '<script>
        window.alert("Access denied. You are required to log in your account first.");
        window.location.href = "managerstafflogin.php";
        </script>';
}
?>
<!-- OYZ modified 18th Nov-->
<!DOCTYPE html>
<html>
<head>
  <title>Edit Movie Details</title>
  <style>
body {
  font-family: Arial, sans-serif;
  padding: 20px;
  height:100vh;
}

h1 {
  text-align: center;
  margin-bottom: 20px;
}

table {
  width: 60%;
  border-collapse: collapse;
  margin-bottom: 20px;
}

th, td {
  padding: 10px; /* Adjusted padding */
  text-align: left;
  border-width: 2px;
  border-color: #F5F5DC;
}

th {
  padding: 30px 40px; /* Adjusted padding */
  background-color: #333;
  color: white;
  white-space: nowrap; /* Prevent line breaks within the content */
  width: 120px; /* Adjusted maximum width */
  overflow: hidden;
  text-overflow: ellipsis; /* Show ellipsis (...) if content overflows */
  text-align: center;

}
td {
  padding: 8px 12px; /* Adjusted padding */
  background-color: #333;
  color: white;
  white-space: nowrap; /* Prevent line breaks within the content */
  max-width: 300px; /* Adjusted maximum width */
  overflow: hidden;
  text-overflow: ellipsis; /* Show ellipsis (...) if content overflows */
}

tr:nth-child(even) {
  background-color: #f9f9f9;
}

tr:hover {
  background-color: #f1f1f1;
}

input[type="text"], textarea {
  width: calc(100% - 16px); /* Adjusted width */
  padding: 8px; /* Adjusted padding */
  box-sizing: border-box;
  margin-bottom: 10px;
}

textarea {
  height: 100px;
}

input[type="text"]:focus, textarea:focus {
  background-color: #f1f1f1;
}

.whitte{
  background-color: white;

}

.update-button {
  width: 100%;
  padding: 10px;
  background-color: #4CAF50;
  border: none;
  color: white;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  cursor: pointer;
  border-radius: 5px;
}

.update-button:hover {
  background-color: #45a049;
}

  </style>
</head>
<br><br><br><br><br><br><br><br><br><br>
<body>

  <h1>Edit Movie Details</h1>

  <table border="1">  

  <?php foreach ($movies as $index => $movie) { ?>
            <form method="post">
            <tr>
      <th>Movie ID</th>
      <td>
        <?php echo $movie['Movie_ID']; ?>
        <input type="hidden" name="movieID" value="<?php echo $movie['Movie_ID']; ?>">
      </td>
    </tr>
    <tr>
      <th>Image Url</th>
      <td><input type="text" name="imageUrl" value="<?php echo $movie['imageurl']; ?>"></td>
    </tr>
    <tr>
      <th>Title</th>
      <td><input type="text" name="title" value="<?php echo $movie['title']; ?>"></td>
    </tr>
    <tr>
      <th>Year</th>
      <td><input type="text" name="year" value="<?php echo $movie['year']; ?>"></td>
    </tr>
    <tr>
      <th>Genre</th>
      <td><input type="text" name="genre" value="<?php echo $movie['genre']; ?>"></td>
    </tr>
    <tr>
      <th>Director</th>
      <td><input type="text" name="director" value="<?php echo $movie['director']; ?>"></td>
    </tr>
    <tr>
      <th>Stars</th>
      <td><input type="text" name="star" value="<?php echo $movie['star']; ?>"></td>
    </tr>
    <tr>
      <th>Duration</th>
      <td><input type="text" name="duration" value="<?php echo $movie['duration']; ?>"></td>
    </tr>
    <tr>
      <th>Synopsis</th>
      <td><textarea name="synopsis"><?php echo $movie['synopsis']; ?></textarea></td>
    </tr>
    <tr>
      <th>Dates</th>
      <td><input type="text" name="date" value="<?php echo $movie['date']; ?>"></td>
    </tr>
    <tr>
      <th>Times</th>
      <td><input type="text" name="time" value="<?php echo $movie['time']; ?>"></td>
    </tr>
    <tr>
      <th>Action</th>
      <td><button type="submit" class="update-button">Update</button></td>
    </tr>
            </form>
            <br>
            <?php if ($index < count($movies) - 1) { ?>
      <tr class="whitte"><td class="whitte" colspan="2"><br></td></tr>
    <?php } ?>
  <?php } ?>
  </table>
</body>
</html>