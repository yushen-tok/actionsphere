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
        .member-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .member {
            border: 2px solid #ccc;
            padding: 20px;
            margin: 10px;
            text-align: center;
            width: 350px;
            background-color: #f5f5f5;
        }

        .member img {
            max-width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 50%;
            width: 150px;
            height: 150px;
        }
    </style>
</head>
<?php include("includes/header2.inc") ?>

<body>

    <div class="space"></div>
    <h1>About Us</h1>
    <div class="member-container">
    <?php
    // Define an array of member information
    $members = [
        [
            'image' => 'images/gmem1.jpeg',
            'name' => 'Tan Wen Hau',
            'description' => 'In this project, I am the group leader, I am responsible for supervising the drection and progress of the project as well as programming.',
        ],
        [
            'image' => 'images/gmem2.jpeg',
            'name' => 'Saw Zi Chuen',
            'description' => 'In this project, I am responsible for most of the Back-End development, which includes functions such as database updating and retrievement.',
        ],
        [
            'image' => 'images/gmem3.jpeg',
            'name' => 'Ong Yu Zhe',
            'description' => 'Hello, I\'m currently pursuing the second semester of my bachelor\'s degree in computer science with a major in Software Development (BCSSUT). I enjoy problem-solving and working together as a team.',
        ],
        [
            'image' => 'images/gmem4.png',
            'name' => 'Tok Yu Shen',
            'description' => 'Hi, in this project, I am responsible for most of the Front-end development.',
        ],
    ];

    // Loop through the members and display their information
    foreach ($members as $member) {
        echo '<div class="member">';
        echo '<img src="' . $member['image'] . '" alt="' . $member['name'] . '">';
        echo '<h2>' . $member['name'] . '</h2>';
        echo '<p>' . $member['description'] . '</p>';
        echo '</div>';
    }
    ?>
    </div>
    <section>
        <br>
        <?php include 'includes/footer.inc'; ?>
    </section>

</body>

</html>