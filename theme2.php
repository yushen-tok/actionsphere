<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles/responsive.css">
    <title>Dark Knight's theme room</title>

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
                <img src="images\theme2b.jpg" alt="Image 1" class="d-block mx-auto"> <!-- Centered image -->
                <div class="carousel-caption">
                    <h3>Front view</h3>
                    <p>Picture 1</p>
                </div>              
            </div>
            <div class="carousel-item">
                <img src="images\theme2c.jpg" alt="Image 2" class="d-block mx-auto"> <!-- Centered image -->
                <div class="carousel-caption">
                    <h3>Background view</h3>
                    <p>Picture  2</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images\theme2a.jpg" alt="Image 3" class="d-block mx-auto"> <!-- Centered image -->
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
    <h3 style="text-align: center; text-decoration: underline; color: black;">Welcome to The Dark Knight's theme room</h3>
    <p style="text-align: center;">Step into the gritty and enigmatic world of Gotham City with our Dark Knight-themed cinema room.<br>This immersive space is dedicated to the iconic vigilante, Batman, and his epic battles against the forces of darkness.<br>From the moment you enter, you'll find yourself in a cinematic realm where justice and mystery reign supreme.<br>Enhance your experience with custom Bat symbol embroidery on the seats, making you feel like a true member of the Bat-Family.<br>We encourage guests to embrace the theme by wearing their favorite <b>Batman costumes</b>, creating a true Gotham ambiance.<br>Join us for a cinematic journey through the shadowy streets of Gotham City, where justice prevails and darkness is met with unwavering resolve.<br>Our Dark Knight-themed cinema room promises an evening of intrigue, action, and unforgettable heroics.</p>
    <br>
    <h3 style="text-align: center; text-decoration: underline; color: black;">Room details</h3>
    <table>
        <tr>
            <th style="color: white">Room Size</th>
            <th style="color: white">Wall Decoration</th>
            <th style="color: white">Seat Material</th>
        </tr>
        <tr>
            <td style="color: yellow">18' x 12'</td>
            <td style="color: yellow">Gotham City skyline, Bat-Signal</td>
            <td style="color: yellow">Black leather</td>
        </tr>
        <tr>
            <th style="color: white">Audiovisual Setup</th>
            <th style="color: white">Snacks</th>
            <th style="color: white">Extras</th>
        </tr>
        <tr>
            <td style="color: yellow">110'' screen, Dolby Atmos sound system</td>
            <td style="color: yellow">"Bat Bites", Gotham Cola</td>
            <td style="color: yellow">Custom Bat symbol embriodery</td>
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
            <td style="color: yellow; text-align: left;">RM150</td>
        </tr>
        <tr>
            <td style="color: white; background-color: #292929; text-align: left;">Leather Seats (max 5pax)</td>
            <td style="color: yellow; background-color: #292929; text-align: left;">RM10 per person</td>
        </tr>
        <tr>
            <td style="color: white; text-align: left;">Audiovisual Setup **</td>
            <td style="color: yellow; text-align: left;">RM1,000</td>
        </tr>
        <tr>
            <td style="color: white; background-color: #292929; text-align: left;">Snacks and Drinks **</td>
            <td style="color: yellow; background-color: #292929; text-align: left;">RM75</td>
        </tr>
        <tr>
            <td style="color: white; background-color: #292929; text-align: left;">Interactive Pre-Show</td>
            <td style="color: yellow; background-color: #292929; text-align: left;">FREE</td>
        </tr>
        
    </table>

   
    <div class="center-button">
    <a href="book.php?category=theme_room&room=theme2"><button>Book Now</button></a>
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