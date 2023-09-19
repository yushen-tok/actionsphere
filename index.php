<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Home</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles/responsive.css">

  </head>
  <body>
    
    <?php include 'includes/header.inc'; ?>

    <div id="mov">
      <div class="movie-section">
        <a href="product.php#a1">
        <div class="movie-poster poster1">
          <img src="images/poster1.jpg" alt="Movie Poster 1">
        </div>
        </a>
        <a href="product.php#a2">
      <div class="movie-poster poster2">
        <img src="images/poster2.jpg" alt="Movie Poster 2">
      </div>
    </a>
      <a href="product.php#a3">
      <div class="movie-poster poster3">
        <img src="images/poster3.jpg" alt="Movie Poster 3">
      </div>
    </a>
    </div>
    </div>

    <section id="abt">
      <h1>Dück is a movie ticket site that makes it easy and convenient for users to find and purchase tickets to their favorite movies. With a user-friendly interface and a wide selection of movies and showtimes, Dück offers a hassle-free experience for movie-goers of all ages.</h1>

      <table>
        <tr>
          <td><h2>Convenient ticket purchasing from the comfort of your own home</h2></td>
          <td><h2>Quick and easy access to showtimes and theater locations</h2></td>
        </tr>
        <tr>
          <td><h2>Secure online payment options for peace of mind</h2></td>
          <td><h2>Exclusive deals and discounts available for online purchases</h2></td>
        </tr>

      </table>

    </section>


  
  

<section id="trivia-section">
  <h1>Movie Trivia</h1>
  <h3 id="question"></h3>
  <div id="answer-buttons"></div>
  <button id="next-btn">Next Question</button>
</section> 

<?php include 'includes/footer.inc'; ?>
    <script src="scripts/enhancements2.js"></script>
  </body>
</html>