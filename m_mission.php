<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <link rel="stylesheet" href="styles/style.css">
  <link rel="stylesheet" href="styles/style2.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="styles/responsive.css">
  <style>
    #date-selection,
    #showtime-selection {
      margin-bottom: 20px;
    }

    #date-list,
    #showtime-list {
      list-style: none;
      padding: 0;
      display: flex;
      /* Display items in a row */
      flex-wrap: wrap;

    }

    #date-list button,
    #showtime-list button {
      margin: 5px;
      padding: 10px 20px;
      font-size: 16px;
    }

    #date-list button:hover,
    #showtime-list button:hover {
      background-color: #f0f0f0;
      cursor: pointer;
    }

    #date-list button.selected,
    #showtime-list button.selected {
      background-color: red;
    }
  </style>
</head>
<?php

$movieDetails = getMovieDetailsFromDatabase(); 

    $image = $movieDetails['imageurl'];
    $title = $movieDetails['title'];
    $year = $movieDetails['year'];
    $genre = $movieDetails['genre'];
    $director = $movieDetails['director'];
    $star = $movieDetails['star'];
    $duration = $movieDetails['duration'];
    $synopsis = $movieDetails['synopsis'];
    $dates = $movieDetails['date']; 
    $times = $movieDetails['time']; 

    // Implode dates and store in separate variables
    list($date1, $date2, $date3) = explode(',', $dates);

    // Implode times and store in separate variables
    list($time1, $time2, $time3,$time4, $time5, $time6,$time7, $time8, $time9) = explode(',', $times);
  
?>
<head>
<title>Movie - <?php echo $title; ?></title>
</head>
<body>

  <?php include 'includes/header.inc'; ?>

  <div id="mov">
    <div class="movie-section">
      <div class="movie-poster poster1">
      <a href="https://www.imdb.com/title/tt9603212/">
      <img src="<?php echo $image; ?>" alt="Poster for <?php echo $title; ?>">
        <p> Tap on movie poster for additional information </p>
        </a>
      </div>
    </div>
  </div>

  <section id="abt">
    <div>
      <br>
      <h1>Movie: <?php echo $title; ?></h1>
      <h2><?php echo $year; ?></h2>
      <h2><?php echo $genre; ?></h2>
      <p><strong>Director:</strong> <?php echo $director; ?></p>
      <p><strong>Stars:</strong> <?php echo $star; ?></p>
      <p><strong>Duration:</strong> <?php echo $duration; ?></p>
      <p><strong>Synopsis:</strong> <?php echo $synopsis; ?></p>
      <br>
      <div id="date-selection">
        <h2>Select Date:</h2>
        <ul id="date-list">
          <li><button onclick="selectDate(this)"><?php echo $date1; ?></button></li>
          <li><button onclick="selectDate(this)"><?php echo $date2; ?></button></li>
          <li><button onclick="selectDate(this)"><?php echo $date3; ?></button></li>
          <!-- Add more date buttons as needed -->
        </ul>
      </div>

      <div id="showtime-selection" style="display:none;">
        <h2>Select Showtime:</h2>
        <ul id="showtime-list">
          <!-- Showtime options will be displayed here -->
        </ul>
      </div>
      <a href="#" onclick="proceedToNextStep()"><button>Book Tickets</button></a>
    </div>
    <br><br>
  </section>
  <section>

  <br>

  <?php include 'includes/footer.inc'; ?>
  </section>
  <script src="scripts/enhancements2.js"></script>
  <script>
    function selectDate(button) {
      const dateButtons = document.querySelectorAll('#date-list button');

      // Remove 'selected' class from all date buttons
      dateButtons.forEach((btn) => {
        btn.classList.remove('selected');
      });

      // Add 'selected' class to the clicked date button
      button.classList.add('selected');

      // Call the function to load showtimes for the selected date
      // Replace this with your actual function to fetch and display showtimes
      showTimes(button.textContent);
    }

    function showTimes(selectedDate) {
      // This is a placeholder function to simulate fetching showtimes from a server
      // In a real application, you would fetch showtimes for the selected date from your server
      const showtimes = getShowtimes(selectedDate); // Replace with your actual function to fetch showtimes

      const showtimeList = document.getElementById('showtime-list');
      showtimeList.innerHTML = '';

      for (const time of showtimes) {
        const li = document.createElement('li');
        const button = document.createElement('button');
        button.textContent = time;
        button.onclick = function() {
          selectShowtime(this);
        };
        li.appendChild(button);
        showtimeList.appendChild(li);
      }

      const showtimeSelection = document.getElementById('showtime-selection');
      showtimeSelection.style.display = 'block';
    }
    
    function getShowtimes(date) {
      // Simulated showtimes for demonstration purposes
      if (date === '<?php echo $date1; ?>') {
        return ['<?php echo $time1; ?>', '<?php echo $time2; ?>', '<?php echo $time3; ?>'];
      } else if (date === '<?php echo $date2; ?>') {
        return ['<?php echo $time4; ?>', '<?php echo $time5; ?>', '<?php echo $time6; ?>'];
      } else if (date === '<?php echo $date3; ?>') {
        return ['<?php echo $time7; ?>', '<?php echo $time8; ?>', '<?php echo $time9; ?>'];
      } else {
        return [];
      }
    }

    function selectShowtime(button) {
      const showtimeButtons = document.querySelectorAll('#showtime-list button');

      // Remove 'selected' class from all showtime buttons
      showtimeButtons.forEach((btn) => {
        btn.classList.remove('selected');
      });

      // Add 'selected' class to the clicked showtime button
      button.classList.add('selected');
    }

    function proceedToNextStep() {
      const selectedDate = document.querySelector('#date-list button.selected');
      const selectedShowtime = document.querySelector('#showtime-list button.selected');

      if (!selectedDate || !selectedShowtime) {
        alert('Please select a date and showtime.');
        return;
      }

      const movie = '<?php echo $title; ?>';
      const date = selectedDate.textContent;
      const time = selectedShowtime.textContent;

      // Store in sessionStorage
      sessionStorage.setItem('selectedMovie', movie);
      sessionStorage.setItem('selectedDate', date);
      sessionStorage.setItem('selectedTime', time);

      const bookLink = `book.php?category=movie&movie=${encodeURIComponent(movie)}&date=${encodeURIComponent(date)}&time=${encodeURIComponent(time)}`;

      // Redirect to the booking page with the selected date and showtime
      window.location.href = bookLink;
    }
  </script>
</body>
<?php
  function getMovieDetailsFromDatabase()
  {
    require_once('settings.php');

    $conn= @mysqli_connect(
        $host,
        $user,
        $pwd,
        $sql_db
    );

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to fetch movie details (replace with actual query)
    $sql = "SELECT * FROM Action_Movie WHERE Movie_ID = '2'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // Fetch movie details
      $row = $result->fetch_assoc();
      return $row;
    } else {
      return null;
    }
  }
  ?>
</html>