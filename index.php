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
  

  <body>
    <h1>Movie Selection</h1>

    <div class="movie-grid">
        <div class="movie" data-movie="Movie 1">
            <h2>Movie 1</h2>
            <img src="images/poster1.jpg" alt="Movie 1 Poster">
            <p>Monty Python and the Holy Grail is a hilarious comedy film released in 1975, directed by Terry Gilliam and Terry Jones. The movie is a parody of the Arthurian legend and follows the misadventures of King Arthur and his knights as they embark on a ridiculous 
                quest for the Holy Grail. Along the way, they encounter a series of strange and absurd obstacles, from the infamous Killer Rabbit of Caerbannog to the Knights Who Say "Ni!" and the Black Knight. The film is renowned for its irreverent humor, witty writing, and 
                surreal visuals, as well as its iconic musical numbers. Monty Python and the Holy Grail has since become a cult classic, beloved by generations of fans for its timeless humor and enduring legacy in the world of comedy.</p>
        </div>

        <div class="movie" data-movie="Movie 2">
            <h2>Movie 2</h2>
            <img src="images/poster2.jpg" alt="Movie 2 Poster">
            <p>"Fear and Loathing in Las Vegas" is a 1998 movie directed by Terry Gilliam, based on the novel of the same name by Hunter S. Thompson. The movie follows the adventures of journalist Raoul Duke, played by Johnny Depp, and his attorney Dr. Gonzo, played by Benicio Del Toro, as they travel to Las Vegas to cover a motorcycle race and engage in a drug-fueled, surrealistic rampage.
              The movie is a dark comedy that satirizes the counterculture of the 1960s and the excesses of the American dream. The characters of Duke and Gonzo represent two extremes of the era: Duke, a disillusioned journalist who struggles to make sense of the chaos around him, and Gonzo, a reckless and anarchic figure who embodies the spirit of rebellion.              
              As the movie progresses, Duke and Gonzo descend into a psychedelic nightmare, fueled by a variety of drugs and fueled by their own paranoia and delusions. They encounter a variety of bizarre characters and engage in increasingly absurd and dangerous activities, including a confrontation with a hotel clerk, a drug-fueled road trip, and an encounter with a group of police officers.</p>
        </div>

        <div class="movie" data-movie="Movie 3">
            <h2>Movie 3</h2>
            <img src="images/poster3.jpg" alt="Movie 3 Poster">
            <p>"El Camino" is a 2019 movie directed by Vince Gilligan, which serves as a sequel to the critically acclaimed television series "Breaking Bad." The movie follows the character of Jesse Pinkman, played by Aaron Paul, immediately after the events of the series finale.
            Jesse, who had been held captive by a neo-Nazi gang for months, manages to escape and goes on the run to evade the law enforcement who are searching for him. The movie shows his struggle to start a new life and leave his criminal past behind, while also dealing with the trauma and emotional scars of his experiences.
            Throughout the movie, Jesse encounters various characters from his past, both allies and enemies, and must navigate a dangerous underworld while trying to secure his freedom and redemption. The movie also offers insights into Jesse's backstory and sheds light on some of the unresolved mysteries from the series.</p>
        </div>
    </div>

    

    <div id="movie-info">
        <h2>Movie Information</h2>
        <p>This is a paragraph about the selected movie.</p>
    </div>

    <h2>Select Date and Time</h2>
    <div id="calendar">
        <!-- Calendar control goes here (You can use third-party libraries like FullCalendar) -->
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth', // Display the calendar in month view
            events: [
                // Add your events here
                {
                    title: 'Movie 1',
                    start: '2023-10-01T14:00:00',
                    end: '2023-10-01T16:00:00'
                },
                {
                    title: 'Movie 2',
                    start: '2023-10-01T16:00:00',
                    end: '2023-10-01T18:00:00'
                },
                {
                    title: 'Movie 3',
                    start: '2023-10-01T18:00:00',
                    end: '2023-10-01T20:00:00'
                },
                {
                    title: 'Movie 2',
                    start: '2023-10-17T14:00:00',
                    end: '2023-10-17T16:00:00'
                },
                {
                    title: 'Movie 3',
                    start: '2023-10-17T18:00:00',
                    end: '2023-10-17T20:00:00'
                }
                // Add more events as needed
            ],
            eventClick: function (info) {
                // Handle event click
                alert('Event: ' + info.event.title);
            },
            eventTimeFormat: {
                    hour: 'numeric',
                    meridiem: 'short'
                }
        });

        calendar.render();
        
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