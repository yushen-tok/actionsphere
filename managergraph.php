<head>
  <title>Manager</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles/responsive.css">
</head>
<?php include("includes/header3.inc") ?>
<?php
session_start();

// Necessary files and establish database connection
require_once('settings.php');

$connection = @mysqli_connect(
    $host,
    $user,
    $pwd,
    $sql_db
);

$dataPoints = array(
    array("label" => "Transformers: Rise of the Beasts", "y" => 0),
    array("label" => "Avengers: Endgame", "y" => 0),
    array("label" => "Mission: Impossible - Dead Reckoning Part One", "y" => 0),
);

if (!$connection) {
    echo "<p class=\"wrong\">Database connection failure</p>"; // Might not show in a production script 
} else {
    $movies = array(
        "Transformers: Rise of the Beasts",
        "Avengers: Endgame",
        "Mission: Impossible - Dead Reckoning Part One"
    );

    // Iterate through each movie to fetch seat count
    foreach ($movies as $index => $movie) {
        $sql = "SELECT movie_seats FROM Action_Bookings WHERE movie_name = '$movie'";
        $result = mysqli_query($connection, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $movieSeats = $row['movie_seats'];
                $seatCount = count(explode(",", $movieSeats));
                // Accumulate seat count for the movie
                $dataPoints[$index]["y"] += $seatCount;
            }
        }
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <script>
        window.onload = function() {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                exportEnabled: true,
                title: {
                    text: "Average Movie Sales Per Month"
                },
                subtitles: [{
                    text: "ActionSphere"
                }],
                data: [{
                    type: "pie",
                    showInLegend: "true",
                    legendText: "{label}",
                    indexLabelFontSize: 16,
                    indexLabel: "{label} - #percent%",
                    yValueFormatString: "##0 seats",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

            
        }
    </script>
</head>
<body>
    <br><br><br><br><br><br><br><br><br><br>
    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>

</html>

    