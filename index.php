<?php
$_SESSION['cust_username'] = $_POST['cust_username'];
$cust_username = $_POST['cust_username'];
// Assign the value of $cust_username to a JavaScript variable
echo "<script>";
echo "var custUsername = '" . $cust_username . "';";
echo "</script>";

// Save the JavaScript variable to session storage
echo "<script>";
echo "sessionStorage.setItem('cust_username', custUsername);";
echo "</script>";
?>
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
    <link rel="stylesheet" href="styles/loading.css">
    <style>
        .movie img {
            cursor: pointer;
            /* Change cursor to pointer on hover */
        }

        .movie p {
            display: none;
            /* Hide the paragraph by default */
        }

        .movie.clicked p {
            display: block;
            /* Display the paragraph when the movie is clicked */
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
<?php include("includes/header.inc") ?>

<!-- OYZ modified 4th Oct-->
<?php
if (empty($_SESSION['cust_username'])) {

    echo '<script>
        window.alert("Access denied. You are required to log in your account first.");
        window.location.href = "customerlogin.php";
        </script>';
}
?>
<!-- OYZ modified 4th Oct-->
<?php

$movieDetails = getMovieDetailsFromDatabase(); 
  
function getMovieDetailsFromDatabase()
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
    
    $movieIDs = [1, 2, 3]; // An array of movie IDs you want to retrieve
    $movieDetails = [];
    
    // Build the SQL query
    $sql = "SELECT * FROM Action_Movie WHERE Movie_ID IN (" . implode(",", $movieIDs) . ")";
    
    // Execute the SQL query and fetch the results
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $movieDetails[$row['Movie_ID']] = $row; // Store movie details in an array using Movie_ID as the key
        }
        mysqli_free_result($result);
    }

    // Close the database connection
    mysqli_close($conn);

    return $movieDetails;
}

// Now, $movieDetails is an associative array with Movie_ID as keys and movie details as values
// You can access the details for Movie_ID 1, 2, and 3 like this:
$image1 = $movieDetails[1]['imageurl'];
$title1 = $movieDetails[1]['title'];
$synopsis1 = $movieDetails[1]['synopsis'];

$image2 = $movieDetails[2]['imageurl'];
$title2 = $movieDetails[2]['title'];
$synopsis2 = $movieDetails[2]['synopsis'];

$image3 = $movieDetails[3]['imageurl'];
$title3 = $movieDetails[3]['title'];
$synopsis3 = $movieDetails[3]['synopsis'];

?>
<body>
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
    <div class="space"></div>
    <h1>Movie Selection</h1>
    <div class="movie-grid">
        <div class="movie" data-movie="<?php echo $title1; ?>">
            <h2><?php echo $title1; ?></h2>
            <img src="<?php echo $image1; ?>"
                alt="Poster for <?php echo $title1; ?>">
            <p><?php echo $synopsis1; ?></p>
            <button onclick="window.location.href='m_endgame.php'">Learn More</button>
        </div>

        <div class="movie" data-movie="<?php echo $title2; ?>">
            <h2><?php echo $title2; ?></h2>
            <img src="<?php echo $image2; ?>"
                alt="Poster for <?php echo $title2; ?>">
            <p><?php echo $synopsis2; ?></p>
            <button onclick="window.location.href='m_mission.php'">Learn More</button>
        </div>

        <div class="movie" data-movie="<?php echo $title3; ?>">
            <h2><?php echo $title3; ?></h2>
            <img src="<?php echo $image3; ?>"
                alt="Poster for <?php echo $title3; ?>">
            <p><?php echo $synopsis3; ?></p>
            <button onclick="window.location.href='m_transformers.php'">Learn More</button>
        </div>
    </div>



    <div id="movie-info">
        <h2>Movie Information</h2>
        <p>This is a paragraph about the selected movie.</p>
    </div>

    <h1>Theme rooms for booking are available!!!</h1>
    <button onclick="window.location.href='hometheme.php'">Find Out!!!</button>

    <section>
  <br>
  <?php include 'includes/footer.inc'; ?>
  </section>
    <script>
                setTimeout(function() {
            // Remove the loading screen after a certain delay
            document.querySelector(".loading-screen").style.display = "none";
        }, 2000); // Adjust the delay (in milliseconds) as needed
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