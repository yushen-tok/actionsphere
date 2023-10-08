<!DOCTYPE html>
<html lang="en">

<head>
  <title>Movie - Mission: Impossible - Dead Reckoning Part One</title>
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

<body>

  <?php include 'includes/header.inc'; ?>

  <div id="mov">
    <div class="movie-section">
      <div class="movie-poster poster1">
        <img src="https://m.media-amazon.com/images/M/MV5BNGFkZTEwNmItMzkyYS00ZmVlLTk3MWEtOWMwNjczZmZiMmQ3XkEyXkFqcGdeQXVyMTA3MDk2NDg2._V1_FMjpg_UY3000_.jpg" alt="Poster for Mission: Impossible - Dead Reckoning Part One">
      </div>
    </div>
  </div>

  <section id="abt">
    <div>
      <br>
      <h1>Movie: Mission: Impossible - Dead Reckoning Part One</h1>
      <h2>2023</h2>
      <h2>Action / Thriller</h2>
      <p><strong>Director:</strong> Christopher McQuarrie</p>
      <p><strong>Stars:</strong> Tom Cruise, Hayley Atwell, Ving Rhames</p>
      <p><strong>Duration:</strong> 2h 43m</p>
      <p><strong>Synopsis:</strong> Ethan Hunt and his IMF team must track down a dangerous weapon before it falls into the wrong hands.</p>
      <br>
      <div id="date-selection">
        <h2>Select Date:</h2>
        <ul id="date-list">
          <li><button onclick="selectDate(this)">2023-10-05</button></li>
          <li><button onclick="selectDate(this)">2023-10-06</button></li>
          <li><button onclick="selectDate(this)">2023-10-07</button></li>
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
  <section></section>

  <br>

  <?php include 'includes/footer.inc'; ?>
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
      if (date === '2023-10-05') {
        return ['11:30 AM', '1:20 PM', '5:00 PM'];
      } else if (date === '2023-10-06') {
        return ['11:00 AM', '2:15 PM', '6:00 PM'];
      } else if (date === '2023-10-07') {
        return ['9:00 PM', '5:35 PM', '8:00 PM'];
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

      const movie = 'Mission: Impossible - Dead Reckoning Part One';
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

</html>