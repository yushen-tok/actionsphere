<!DOCTYPE html>
<html lang="en">

<head>
  <title>Movie - Transformers: Rise of the Beasts</title>
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
        <img src="https://m.media-amazon.com/images/M/MV5BZTNiNDA4NmMtNTExNi00YmViLWJkMDAtMDAxNmRjY2I2NDVjXkEyXkFqcGdeQXVyMDM2NDM2MQ@@._V1_FMjpg_UY3000_.jpg" alt="Poster for Transformers: Rise of the Beasts">
      </div>
    </div>
  </div>

  <section id="abt">
    <div>
      <br>
      <h1>Movie: Transformers: Rise of the Beasts</h1>
      <h2>2023</h2>
      <h2>Action / Sci-Fi</h2>
      <p><strong>Director:</strong> Steven Caple Jr.</p>
      <p><strong>Stars:</strong> Anthony Ramos, Dominique Fishback, Luna Lauren Velez</p>
      <p><strong>Duration:</strong> 2h 7m</p>
      <p><strong>Synopsis:</strong> During the '90s, a new faction of Transformers - the Maximals - join the Autobots as allies in the battle for Earth.</p>
      <br>
      <div id="date-selection">
        <h2>Select Date:</h2>
        <ul id="date-list">
          <li><button onclick="selectDate(this)">2023-10-01</button></li>
          <li><button onclick="selectDate(this)">2023-10-02</button></li>
          <li><button onclick="selectDate(this)">2023-10-03</button></li>
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
    if (date === '2023-10-01') {
      return ['10:00 AM', '1:30 PM', '4:00 PM'];
    } else if (date === '2023-10-02') {
      return ['11:00 AM', '2:30 PM', '5:00 PM'];
    } else if (date === '2023-10-03') {
      return ['12:00 PM', '3:30 PM', '6:00 PM'];
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

  const movie = 'Transformers: Rise of the Beasts';
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