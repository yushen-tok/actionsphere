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
    <title>FAQ</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles/responsive.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.7.2/main.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.7.2/main.min.css" rel="stylesheet">

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
            font-size: 24px;

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

        .faq-answer {
            display: none;
        }

        .faq-toggle {
            display: none;
            opacity: 0;
        }

        .faq-toggle+label::before {
            content: '\25B6';
            /* Unicode for right-pointing triangle or arrow */
            margin-right: 5px;
        }

        .faq-toggle:checked+label::before {
            content: '\25BC';
            /* Unicode for down-pointing triangle or arrow */
        }

        .faq-toggle:checked~.faq-answer {
            display: block;
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

<body>
    <div class="space"></div>
    <br><br>
    <header>
        <h1>ActionSphere Cinemas Booking System FAQ</h1>
    </header>

    <section>
        <h2>Frequently Asked Questions</h2>

        <div class="faq">
            <input type="checkbox" class="faq-toggle" id="faq1">
            <label for="faq1" class="faq-question">How do I book a movie ticket?</label>
            <div class="faq-answer">
                To book a movie ticket, follow these steps:
                <ol>
                    <li>Visit our website and view all available movies</li>
                    <li>Choose the movie you want to watch.</li>
                    <li>Select your preffered showtime and date.</li>
                    <li>Choose your seats.</li>
                    <li>Provide your payment information.</li>
                    <li>Get your receipt.</li>
                </ol>
            </div>
        </div>

        <div class="faq">
            <input type="checkbox" class="faq-toggle" id="faq2">
            <label for="faq2" class="faq-question">How do I book a theme room?</label>
            <div class="faq-answer">
                To book a theme room, follow these steps:
                <ol>
                    <li>Visit our website and view all available theme rooms</li>
                    <li>Choose the theme room you want to book.</li>
                    <li>Select your preffered date and time.</li>
                    <li>Provide your payment information.</li>
                    <li>Get your receipt.</li>
                </ol>
            </div>
        </div>

        <div class="faq">
            <input type="checkbox" class="faq-toggle" id="faq3">
            <label for="faq3" class="faq-question">Can I cancel my booking?</label>
            <p class="faq-answer">Yes, you may request for a cancellation for your booking.<br>However, it is at the
                decision of the ActionSphere staff
                team to accept the request on a case by case basis.
                Be sure to provide a valid reason.
            </p>
        </div>

        <div class="faq">
            <input type="checkbox" class="faq-toggle" id="faq4">
            <label for="faq4" class="faq-question">Can I use the points I accumulated for discounts?</label>
            <p class="faq-answer">Yes, you may use your points to get a discount to your total payment for your
                booking.<br>
                However, it is required that the total point accumulated reach the value of RM 5.00 before it can be
                used.
            </p>
        </div>

        <div class="faq">
            <input type="checkbox" class="faq-toggle" id="faq5">
            <label for="faq5" class="faq-question">How can I contact customer support for further assistance?</label>
            <div class="faq-answer">We have a variety of means that customer can use to reach for support. These are:
                <ul>
                    <li>Reach out to us via our email support@actionsphere.com</li>
                    <li>Contact through our social media pages (Facebook, Instagram)</li>
                    <li>Reach us at Whatsapp or call us</li>
                    <li>Visit our outlets to speak with a staff</li>
                </ul>
            </div>
        </div>

        <p><strong>
            We will be updating this page as fitting to provide more information and answers to your questions.<br>
            Do check back for updates on additional FAQs in the future.
            </strong>
        </p>
        <br><br><br><br>
        <div class="space"></div>
        <?php include 'includes/footer.inc'; ?>
    </section>
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