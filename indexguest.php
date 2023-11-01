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
        .popup-content {
            position: absolute;
            top: 70%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 700px;
            height: 400px;
            background-image: url("images/ad.png");
            background-size: 100% 100%;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            opacity: 0;
            /* Start with 0 opacity */
            transition: opacity 0.5s;
            /* Add a 0.5s opacity transition */
        }

        .popup-content.show {
            opacity: 1;
            /* When the 'show' class is added, set opacity to 1 */
        }

        .close {
            color: white;
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
        }

        /* Style for the Trigger Button */
        .popup-button {
            background-color: white;
            color: black;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }

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
</head>
<?php include("includes/header2.inc") ?>

<body>

    <div class="space"></div>
    <h1>Movie Selection</h1>
    <!-- Pop-up Ad Container -->
    <div id="popupContainer" class="popup show">
        <div class="popup-content">
            <span class="close" id="closePopup">&times;</span>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <a href="customerlogin.php" class="popup-button">Book Now</a>
        </div>
    </div>
    <div class="movie-grid">
        <div class="movie" data-movie="<?php echo $title1; ?>">
            <h2><?php echo $title1; ?></h2>
            <img src="<?php echo $image1; ?>" alt="Poster for <?php echo $title1; ?>">
            <p><?php echo $synopsis1; ?></p>
            <br> <br>
            <button onclick="window.location.href='customerlogin.php'">Learn More</button>
        </div>

        <div class="movie" data-movie="<?php echo $title2; ?>">
            <h2><?php echo $title2; ?></h2>
            <img src="<?php echo $image2; ?>" alt="Poster for <?php echo $title2; ?>">
            <p><?php echo $synopsis2; ?></p>
            <br> <br>
            <button onclick="window.location.href='customerlogin.php'">Learn More</button>
        </div>

        <div class="movie" data-movie="<?php echo $title3; ?>">
            <h2><?php echo $title3; ?></h2>
            <img src="<?php echo $image3; ?>" alt="Poster for <?php echo $title3; ?>">
            <p><?php echo $synopsis3; ?></p>
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
        // Function to close the pop-up
        function closePopup() {
            var popup = document.getElementById('popupContainer');
            popup.classList.remove('show');
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Get the pop-up and buttons
            var popup = document.getElementById('popupContainer');
            var showPopupButton = document.getElementById('showPopup');
            var closePopupButton = document.getElementById('closePopup');


            function showPopup() {
                var popup = document.getElementById('popupContainer');
                popup.classList.add('show');
            }

            // Function to hide the pop-up
            function hidePopup() {
                var popup = document.getElementById('popupContainer');
                popup.classList.remove('show');
            }

            // Close the pop-up when the close button is clicked
            document.getElementById('closePopup').addEventListener('click', function() {
                hidePopup();
            });

            // Display the pop-up when the page loads
            popup.classList.add('show');

            // Close the pop-up when the close button is clicked
            closePopupButton.addEventListener('click', function() {
                closePopup();
            });

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
    <section>
        <br>
        <?php include 'includes/footer.inc'; ?>
    </section>

</body>

</html>