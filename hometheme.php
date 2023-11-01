<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles/responsive.css">
    <title>Theme booking page</title>

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

        .theme-container {
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
        }

        .centered-header {
            text-align: center;
        }

        .image-container {
            overflow: hidden;
            /* Hide the overflow if the image gets larger than the container */
        }

        img {
            width: 100%;
            /* Ensure the image takes up the full width of the container */
            transition: transform 0.3s ease;
            /* Add a smooth transition effect */
        }

        img:hover {
            transform: scale(1.2);
            /* Increase the scale (zoom) on hover */
        }


        /* Ong Yu Zhe */
        /* If the styling for the button doesn't change can remove the below's codes */
        .btn-select,
        input[type="submit"],
        input[type="reset"] {
            background-color: #333;
            border: none;
            color: #fff;
            font-weight: bold;
            padding: 10px 20px;
            text-transform: uppercase;
            transition: border-bottom-color 0.2s ease-in-out, color 0.2s ease-in-out;
        }

        .btn-select:hover,
        input[type="submit"]:hover,
        input[type="reset"]:hover {
            border-bottom-color: #C93636;
            color: #C93636;
        }

        .back-button {
            display: inline-block;
            padding: 12px 24px;
            margin-right: 20px;
            font-size: 18px;
            border: 2px solid black;
           
            border-radius: 25px;
            /* Rounded corners */
            background-color: black;
        
            color: red;
          
            font-weight: bold;
            text-decoration: none;
            /* Remove underline */
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }

        .back-button:hover {
            background-color: red;
          
            color: white;
            /* White text on hover */
            border-color: black;
            
        }


        .centered-header {
            display: inline-block;
        }
    </style>

</head>

<body>
    <br><br>
    <a href="index.php" class="back-button">&lt; Back</a>
    <h1 class="centered-header">Welcome to Our Theme Room Selection</h1>

    <!-- Set A: Theme Containers -->
    <div class="theme-container">
        <!-- Theme 1 -->
        <div class="theme">
            <h2>Theme Room 1 - Star Wars</h2>
            <p>Description: </p>
            <p>"May the Force be with you.<br>"The Force will be with you, always."</p>
            <a href="theme1.php">
                <button class="btn-select">View More</button>
            </a>
            <!-- Set B: Carousel Inside Theme Box -->
            <div id="carousel1" class="carousel slide" data-ride="carousel">
                <!-- Carousel Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel1" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel1" data-slide-to="1"></li>
                    <li data-target="#carousel1" data-slide-to="2"></li>
                </ol>
                <!-- Carousel Slides -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="images\theme1a.jpg" alt="Image 1">
                    </div>
                    <div class="carousel-item">
                        <img src="images\theme1b.jpg" alt="Image 2">
                    </div>
                    <div class="carousel-item">
                        <img src="images\theme1c.jpg" alt="Image 3">
                    </div>
                </div>
                <!-- Carousel Controls -->
                <a class="carousel-control-prev" href="#carousel1" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#carousel1" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
        </div>

        <!-- Theme 2 -->
        <div class="theme">
            <h2>Theme Room 2 - The Dark Knight</h2>
            <p>Description:</p>
            <p>"If You Are Good, The Shadow's Wings Are A Welcome, Protective Blanket."</p>
            <a href="theme2.php">
                <button class="btn-select">View More</button>
            </a>
            <!-- Set B: Carousel Inside Theme Box -->
            <div id="carousel2" class="carousel slide" data-ride="carousel">
                <!-- Carousel Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel2" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel2" data-slide-to="1"></li>
                    <li data-target="#carousel2" data-slide-to="2"></li>
                </ol>
                <!-- Carousel Slides -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="images\theme2a.jpg" alt="Casual Image 1">
                    </div>
                    <div class="carousel-item">
                        <img src="images\theme2b.jpg" alt="Casual Image 2">
                    </div>
                    <div class="carousel-item">
                        <img src="images\theme2c.jpg" alt="Casual Image 3">
                    </div>
                </div>
                <!-- Carousel Controls -->
                <a class="carousel-control-prev" href="#carousel2" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#carousel2" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
        </div>

        <!-- Theme 3 -->
        <div class="theme">
            <h2>Theme Room 3 - Jurassic Park</h2>
            <p>Description:</p>
            <p>"Welcome To Jurassic Park."<br>"That's How It Always Starts."</p>
            <a href="theme3.php">
                <button class="btn-select">View More</button>
            </a>
            <!-- Set B: Carousel Inside Theme Box -->
            <div id="carousel3" class="carousel slide" data-ride="carousel">
                <!-- Carousel Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel3" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel3" data-slide-to="1"></li>
                    <li data-target="#carousel3" data-slide-to="2"></li>
                </ol>
                <!-- Carousel Slides -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="image-container">
                            <img src="images\theme3a.jpg" alt="Premium Image 1">
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="image-container">
                            <img src="images\theme3b.jpg" alt="Premium Image 2">
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="images\theme3c.jpg" alt="Premium Image 3">
                    </div>
                </div>
                <!-- Carousel Controls -->
                <a class="carousel-control-prev" href="#carousel3" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#carousel3" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
        </div>
    </div>
</body>

</html>