<!DOCTYPE html>
<html>

<head>
  <title>ActionSphere SpinFest</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="styles/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="styles/responsive.css">
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet" />
  <style>
    * {
      padding: 0;
      margin: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    .wrapper {
      margin-top: 200px;
      width: 90%;
      max-width: 34.37em;
      max-height: 90vh;
      background-color: rgb(255, 212, 188);
      position: absolute;
      transform: translate(-50%, -50%);
      top: 50%;
      left: 50%;
      padding: 3em;
      border-radius: 1em;
      box-shadow: 0 4em 5em rgba(27, 8, 53, 0.2);
    }

    .container {
      position: relative;
      width: 100%;
      height: 100%;
    }

    #wheel {
      max-height: inherit;
      width: inherit;
      top: 20px;
      padding: 0;
      transition: transform 4s ease-in-out;
      /* Add this line for smooth transitions */
    }

    @keyframes rotate {
      100% {
        transform: rotate(360deg);
      }
    }

    #spin-btn {
      position: absolute;
      transform: translate(-50%, -50%);
      top: 50%;
      left: 50%;
      height: 26%;
      width: 26%;
      border-radius: 50%;
      cursor: pointer;
      border: 0;
      background: radial-gradient(#525252 50%, #525252 85%);
      color: #ffffff;
      text-transform: uppercase;
      font-size: 1.8em;
      letter-spacing: 0.1em;
      font-weight: 600;
    }

    #final-value {
      font-size: 1.5em;
      text-align: center;
      margin-top: 1.5em;
      color: #202020;
      font-weight: 500;
    }

    @media screen and (max-width: 768px) {
      .wrapper {
        font-size: 12px;
      }

      img {
        right: -5%;
      }
    }
  </style>

</head>
<?php include("includes/header.inc") ?>
<?php
require_once('settings.php');

$connection = @mysqli_connect(
  $host,
  $user,
  $pwd,
  $sql_db
);

if (!$connection) {
  // Displays an error message
  echo "<p class=\"wrong\">Database connection failure</p>";
} else {
  session_start();

  $cust_username = $_SESSION['cust_username'];
  // Set the table name
  $sql_table = "Action_Customer";

  // Perform a database query to retrieve the 'points' value for a given username
  $query = "SELECT points FROM $sql_table WHERE cust_username = '$cust_username'";
  $result = mysqli_query($connection, $query);
  $query2 = "SELECT spins FROM $sql_table WHERE cust_username = '$cust_username'";
  $result2 = mysqli_query($connection, $query2);

  if (!$result) {
    // Handle the query error, if any
    die("Query error: " . mysqli_error($connection));
  }

  if (mysqli_num_rows($result) > 0) {
    // Fetch the result row
    $row = mysqli_fetch_assoc($result);

    $points = $row['points'];
    $row2 = mysqli_fetch_assoc($result2);
    $spins = $row2['spins'];
    echo "<script>const spins = $spins;</script>";
  } else {
    // Handle the case where the user is not found
    $points = 3; // Set a default value or handle as needed
    $spins = 3;
  }
}
?>

<body>
  <div class="space"></div>

  <div class="space"></div>
  <div class="space"></div>
  <div class="space"></div>
  <div class="space"></div>
  <div id="chart">

  </div>

  <div class="wrapper">
    <h1>ActionSphere SpinFest</h1>
    <div class="container">

      <canvas id="wheel"></canvas>
      <button id="spin-btn">Spin</button>
      <h1>◀</h1>
    </div>
    <div id="final-value">
      <p>Click On The Spin Button To Start</p>
    </div>
    <br>
    <h2>
      <?php

      if (isset($points)) {
        if (isset($_COOKIE['points'])) {
          $cookie = $_COOKIE['points'];
          $points += $cookie;
        }
        if (isset($_COOKIE['spins'])) {
          $spins -= $_COOKIE['spins'];
        }

        echo "You Currently Have $points Points and $spins left";
        setcookie("spinss", $spins);
        setcookie("points", 0);
        setcookie("spins", 0);
      } else {
        echo "Points: N/A";
      }
      ?>

    </h2>
  </div>

  <!-- Chart JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
  <!-- Chart JS Plugin for displaying text over chart -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.1.0/chartjs-plugin-datalabels.min.js"></script>

  <section>
    <br>
    <?php include 'includes/footer.inc'; ?>
  </section>
  <script>
    const wheel = document.getElementById("wheel");
    const spinBtn = document.getElementById("spin-btn");
    const finalValue = document.getElementById("final-value");
    //Object that stores values of minimum and maximum angle for a value
    const rotationValues = [{
        minDegree: 0,
        maxDegree: 30,
        value: 200
      },
      {
        minDegree: 31,
        maxDegree: 90,
        value: 1000
      },
      {
        minDegree: 91,
        maxDegree: 150,
        value: 600
      },
      {
        minDegree: 151,
        maxDegree: 210,
        value: 500
      },
      {
        minDegree: 211,
        maxDegree: 270,
        value: 400
      },
      {
        minDegree: 271,
        maxDegree: 330,
        value: 300
      },
      {
        minDegree: 331,
        maxDegree: 360,
        value: 200
      },
    ];
    //Size of each piece
    const data = [16, 16, 16, 16, 16, 16];
    //background color for each piece
    var pieColors = [
      "#3b86ff",
      "#23b895",
      "#459421",
      "#ffcb3b",
      "#cf2121",
      "#b163da",
    ];
    //Create chart
    let myChart = new Chart(wheel, {
      //Plugin for displaying text on pie chart
      plugins: [ChartDataLabels],
      //Chart Type Pie
      type: "pie",
      data: {
        //Labels(values which are to be displayed on chart)
        labels: [1000, 200, 300, 400, 500, 600],
        //Settings for dataset/pie
        datasets: [{
          backgroundColor: pieColors,
          data: data,
        }, ],
      },
      options: {
        //Responsive chart
        responsive: true,
        animation: {
          duration: 0
        },
        plugins: {
          //hide tooltip and legend
          tooltip: false,
          legend: {
            display: false,
          },
          //display labels inside pie chart
          datalabels: {
            color: "#ffffff",
            formatter: (_, context) => context.chart.data.labels[context.dataIndex],
            font: {
              size: 24
            },
          },
        },
      },
    });
    //display value based on the randomAngle
    const valueGenerator = (angleValue) => {
      for (let i of rotationValues) {
        // If the angleValue is between min and max then display it
        if (angleValue >= i.minDegree && angleValue <= i.maxDegree) {
          const points = i.value; // Get the points won
          // Display the message to the user
          finalValue.innerHTML = `<p>Congrats, You Have Won ${points} Points.</p>`;
          setCookie('points', points);
          spinBtn.disabled = false;
          break;
        }
      }

    };

    function setCookie(cookieName, points) {
      document.cookie = `points=${points}`;
      <?php
      if (isset($_COOKIE['points'])) {

        $cookieValue = $_COOKIE['points']; // Ensure the value is an integer
        // Update the "points" value in the 'Action_Customer' table by adding the value from the cookie to the existing points
        $sql = "UPDATE Action_Customer SET points = points + $cookieValue WHERE cust_username = '$cust_username'";
        if ($connection->query($sql) === TRUE) {
        } else {
          echo "Error updating points." . $connection->error;
        }
        $spinss = $_COOKIE['spins'];
        $sql = "UPDATE Action_Customer SET spins = spins - $spinss WHERE cust_username = '$cust_username'";
        if ($connection->query($sql) === TRUE) {
        } else {
          echo "Error updating spins." . $connection->error;
        }
      }

      ?>
      Clear();
    }

    //Spinner count
    let count = 0;
    //100 rotations for animation and last rotation for result
    let resultValue = 101;
    //Start spinning
    spinBtn.addEventListener("click", () => {
      if (spins > 0) {
        spinBtn.disabled = true;
        document.cookie = `spins=1`;
        //Empty final value
        finalValue.innerHTML = `<p>Good Luck!</p>`;
        //Generate random degrees to stop at
        let randomDegree = Math.floor(Math.random() * (355 - 0 + 1) + 0);
        //Interval for rotation animation
        let rotationInterval = window.setInterval(() => {
          //Set rotation for piechart
          /*
          Initially to make the piechart rotate faster we set resultValue to 101 so it rotates 101 degrees at a time and this reduces by 1 with every count. Eventually on last rotation we rotate by 1 degree at a time.
          */
          myChart.options.rotation = myChart.options.rotation + resultValue;
          //Update chart with new value;
          myChart.update();
          //If rotation>360 reset it back to 0
          if (myChart.options.rotation >= 360) {
            count += 1;
            resultValue -= 5;
            myChart.options.rotation = 0;
          } else if (count > 15 && myChart.options.rotation == randomDegree) {
            valueGenerator(randomDegree);
            clearInterval(rotationInterval);
            count = 0;
            resultValue = 101;
            spinBtn.disabled = false;
          }
        }, 10);
      } else {
        alert("You don't have any spins left.");
      }
    });

    function Clear() {
      window.location = "spinwheel.php"
    }
  </script>
</body>

</html>