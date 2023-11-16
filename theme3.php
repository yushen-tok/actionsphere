<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles/responsive.css">
    <title>Jurassic Park' theme room</title>

      <!-- Add Bootstrap CSS -->
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

      <!-- Add jQuery -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
      <!-- Add Bootstrap JS -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
      <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
    
        /*.theme-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .theme {
            width: 30%;
            margin: 20px;
            padding: 10px;
            background-color: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        }
        .theme img {
                max-width: 100%;
                height: auto;
            }
        .calendar {
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        }*/

        .centered-header {
            text-align: center;
        }

        /* Center-align the button */
        .center-align {
            text-align: center;
        }
        


/* Ong Yu Zhe */ /* If the styling for the button doesn't change can remove the below's codes */
.btn-select, input[type="submit"],input[type="reset"]{
  background-color: #333;
  border: none;
  color: #fff;
  font-weight: bold;
  padding: 10px 20px;
  text-transform: uppercase;
  transition: border-bottom-color 0.2s ease-in-out, color 0.2s ease-in-out;
}

.btn-select:hover, input[type="submit"]:hover, input[type="reset"]:hover {
  border-bottom-color: #C93636;
  color: #C93636;
}
/* remove till here*/      

    /* Custom CSS to expand the carousel */
    #myCarousel {
      width: auto; /* Set the width to 100% for full-width carousel */
      max-height: 600px; /* Set the maximum height as needed */
      margin: 0 auto; /* Center the carousel horizontally */
    }
    .carousel-inner img {
      width: auto; /* Set the width of the images to 100% */
      height: 600px; /* Automatically adjust the height to maintain aspect ratio */
    }
    .carousel-container {
      display: flex;
      justify-content: flex-start;
      align-items: center;
      flex-direction: column;
    }

    .center-button {
            text-align: center;
        }

    </style>
</head>
<body>
    <div class="carousel-container">
        <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="3500">
            <!-- Indicators -->
            <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
        
            <!-- Slides -->
            <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images\theme3c.jpg" alt="Image 1" class="d-block mx-auto"> <!-- Centered image -->
                <div class="carousel-caption">
                    <h3>Front view</h3>
                    <p>Picture 1</p>
                </div>              
            </div>
            <div class="carousel-item">
                <img src="images\theme3a.jpg" alt="Image 2" class="d-block mx-auto"> <!-- Centered image -->
                <div class="carousel-caption">
                    <h3>Background view</h3>
                    <p>Picture  2</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images\theme3b.jpg" alt="Image 3" class="d-block mx-auto"> <!-- Centered image -->
                <div class="carousel-caption">
                    <h3>Side view</h3>
                    <p>Picture 3</p>
                </div>              
            </div>
            </div>
        
            <!-- Controls -->
            <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" data-slide="next">
            <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>
    <br>
    <h3 style="text-align: center; text-decoration: underline; color: black;">Welcome to the Jurassic Park' theme room</h3>
    <p style="text-align: center;">Prepare to embark on a thrilling adventure to a world where dinosaurs once roamed.<br>Our Jurassic Park-themed cinema room is a portal to prehistory, where every movie night feels like a journey through time.<br>As you step into this immersive space, you'll be transported to a land of ancient wonders and untamed wilderness.<br>For true enthusiasts, our seats feature custom upholstery with intricate dinosaur footprints, making every viewing a unique experience.<br>We encourage you to embrace the theme by coming dressed as your favorite <b>Jurassic Park characters</b> for a truly immersive adventure.<br>Join us for a cinematic journey into the past, where the wonders of the Jurassic world await.<br>Whether you're a paleontology enthusiast or simply love thrilling adventures, our Jurassic Park-themed cinema room promises an unforgettable experience.

    </p>
    <br>
    <h3 style="text-align: center; text-decoration: underline; color: black;">Room details</h3>
    <table>
        <tr>
            <th style="color: white">Room Size</th>
            <th style="color: white">Wall Decoration</th>
            <th style="color: white">Seat Material</th>
        </tr>
        <tr>
            <td style="color: yellow">22' x 16'</td>
            <td style="color: yellow">Dinosaur skin-textured wallpaper, fossils</td>
            <td style="color: yellow">Green suede</td>
        </tr>
        <tr>
            <th style="color: white">Audiovisual Setup</th>
            <th style="color: white">Snacks</th>
            <th style="color: white">Extras</th>
        </tr>
        <tr>
            <td style="color: yellow">130'' screen, immersive surround sound</td>
            <td style="color: yellow">"Dino Nuggets", Jungle Juice</td>
            <td style="color: yellow">Dinosaur footprint upholstery</td>
        </tr>
        
    </table>
    
    <h3 style="text-align: center; text-decoration: underline; color: black;">Price details</h3>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ** (Optional)</p>
    <table>
        <tr>
            <th style="color: white; text-align: center;">Item</th>
            <th style="color: white; text-align: center;">Price (RM)</th>
        </tr>
        <tr>
            <td style="color: white; text-align: left;">Room Rental (per hour)</td>
            <td style="color: yellow; text-align: left;">RM210</td>
        </tr>
        <tr>
            <td style="color: white; background-color: #292929; text-align: left;">Suede Seats (max 10pax)</td>
            <td style="color: yellow; background-color: #292929; text-align: left;">RM20 per person</td>
        </tr>
        <tr>
            <td style="color: white; text-align: left;">Audiovisual Setup **</td>
            <td style="color: yellow; text-align: left;">RM1,500</td>
        </tr>
        <tr>
            <td style="color: white; background-color: #292929; text-align: left;">Snacks and Drinks **</td>
            <td style="color: yellow; background-color: #292929; text-align: left;">RM140</td>
        </tr>
        <tr>
            <td style="color: white; background-color: #292929; text-align: left;">Interactive Pre-Show **</td>
            <td style="color: yellow; background-color: #292929; text-align: left;">FREE</td>
        </tr>
        
    </table>

    <div class="center-button">
    <a href="book.php?category=theme_room&room=theme3"><button>Book Now</button></a>
    </div>
    <br>
    <div class="center-button">
        <a href="hometheme.php">
            <button>Back</button>
        </a>
    </div>

    <!-- Add jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Add Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      
</body>
</html>