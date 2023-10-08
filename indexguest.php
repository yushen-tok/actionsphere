<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Home</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles/responsive.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.7.2/main.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.7.2/main.min.css" rel="stylesheet">

    <style>
          .movie img {
      cursor: pointer; /* Change cursor to pointer on hover */
    }

    .movie p {
      display: none; /* Hide the paragraph by default */
    }

    .movie.clicked p {
      display: block; /* Display the paragraph when the movie is clicked */
    }
        body {
            font-family: Arial, sans-serif;
            
        }

        .movie-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .movie {
            border: 1px solid #ccc;
            padding: 30px;
            text-align: center;
        }

        .movie img {
            width: 400px; 
            /*height: 225px;*/
        }

        #calendar {
            width: 800px;
            
        }

        #movie-info {
            margin-top: 20px;
        }
    </style>
  </head>
  <?php include("includes/header2.inc") ?>

  <body>
  <div class="space"></div>
    <h1>Movie Selection</h1>

    <div class="movie-grid">
    <div class="movie" data-movie="Avengers: Endgame">
        <h2>Avengers: Endgame</h2>
        <img src="https://m.media-amazon.com/images/M/MV5BMTkxNTQzNTg4Nl5BMl5BanBnXkFtZTgwMzYzNDQ2NzM@._V1_FMjpg_UY3000_.jpg" alt="Poster for Avengers: Endgame">
        <p>After the devastating events of Avengers: Infinity War (2018), the universe is in ruins. With the help of remaining allies, the Avengers assemble once more in order to reverse Thanos' actions and restore balance to the universe.</p>
        <br> <br>
        <button onclick="window.location.href='customerlogin.php'">Learn More</button>
    </div>

    <div class="movie" data-movie="Mission: Impossible - Dead Reckoning Part One">
        <h2>Mission: Impossible - Dead Reckoning Part One</h2>
        <img src="https://m.media-amazon.com/images/M/MV5BNGFkZTEwNmItMzkyYS00ZmVlLTk3MWEtOWMwNjczZmZiMmQ3XkEyXkFqcGdeQXVyMTA3MDk2NDg2._V1_FMjpg_UY3000_.jpg" alt="Poster for Mission: Impossible - Dead Reckoning Part One">
        <p>Ethan Hunt and his IMF team must track down a dangerous weapon before it falls into the wrong hands.</p>
        <br> <br>
        <button onclick="window.location.href='customerlogin.php'">Learn More</button>
    </div>

    <div class="movie" data-movie="Transformers: Rise of the Beasts">
        <h2>Transformers: Rise of the Beasts</h2>
        <img src="https://m.media-amazon.com/images/M/MV5BZTNiNDA4NmMtNTExNi00YmViLWJkMDAtMDAxNmRjY2I2NDVjXkEyXkFqcGdeQXVyMDM2NDM2MQ@@._V1_FMjpg_UY3000_.jpg" alt="Poster for Transformers: Rise of the Beasts">
        <p>During the '90s, a new faction of Transformers - the Maximals - join the Autobots as allies in the battle for Earth.</p>
        <br> <br>
        <button onclick="window.location.href='customerlogin.php'">Learn More</button>
    </div>
    </div>

    

    <div id="movie-info">
        <h2>Movie Information</h2>
        <p>This is a paragraph about the selected movie.</p>
    </div>

    <h1>Theme rooms for booking are available!!!</h1>
    <button onclick="window.location.href='customerlogin.php'">Find More!!!</button>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        
        const movies = document.querySelectorAll('.movie');
            movies.forEach((movie) => {
                movie.addEventListener('click', () => {
                    // Remove the 'selected' class from all movies
                    movies.forEach((m) => {
                        m.classList.remove('selected');
                    });

                    // Add the 'selected' class to the clicked movie
                    movie.classList.add('selected');

                    const movieName = movie.dataset.movie;
                    const movieDescription = movie.querySelector('p').textContent;
                    const movieInfo = document.getElementById('movie-info');

                    // Update the movie information paragraph
                    movieInfo.innerHTML = `
                        <h2>${movieName}</h2>
                        <p>${movieDescription}</p>
                    `;
                });
            });
        });
</script>
</body>
</html>