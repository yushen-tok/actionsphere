<!DOCTYPE html>
<html lang="en">
<head>
    <title>About Us</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles/responsive.css">
</head>
<body>
    <?php include 'includes/header.inc'; ?>
    
    <div class="space"></div>
      <figure class="my-photo">
        <img src="images/face.jfif" alt="Photo of me">
        <figcaption>Me face</figcaption>
      </figure>
      <h1>About Me</h1>
      
      <dl>
        <dt>Name:</dt>
        <dd>Saw Zi Chuen</dd>
        
        <dt>Student ID:</dt>
        <dd>s104681959</dd>
        
        <dt>Course:</dt>
        <dd>Bachelor of Computer Science</dd>
        
        <dt>Email:</dt>
        <dd>s104681959@student.swin.edu.au</dd>
      </dl>

      <h1>College Timetable</h1>     
      <table class="timetable">
          <thead>
            <tr>
              <th></th>
              <th>0800</th>
              <th>0900</th>
              <th>1000</th>
              <th>1100</th>
              <th>1200</th>
              <th>1300</th>
              <th>1400</th>
              <th>1500</th>
              <th>1600</th>
              <th>1700</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>MON</td>
              <td>COS20007</td>
              <td>COS20007</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td>MPU3183</td>
              <td>MPU3183</td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td>TUE</td>
              <td>COS10011</td>
              <td>COS10011</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td>TNE10005</td>
              <td>TNE10005</td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td>WED</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td>COS10022</td>
              <td>COS10022</td>
              <td></td>
              <td></td>
              <td>COS10011</td>
              <td>COS10011</td>
            </tr>
            <tr>
              <td>THU</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td>COS20007</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td>FRI</td>
              <td></td>
              <td>COS20007</td>
              <td>COS20007</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td>TNE10005</td>
              <td>TNE10005</td>
              <td>TNE10005</td>
            </tr>
          </tbody>

          </table>

          <section class="resume">
            <h2>Resume</h2>
            <img src="images/Resume.png" alt="Resume"><br>
            <a href="images/SawZiChuen_Resume.pdf" download>Download Resume</a>
          </section>

    <?php include 'includes/footer.inc'; ?>

    <script src="scripts/enhancements2.js"></script>
</body>
</html>
