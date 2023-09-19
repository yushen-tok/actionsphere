<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Enhancements 2</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles/responsive.css">

  </head>
  <body>
  <?php include 'includes/header.inc'; ?>
    
    <div class="space"></div>


<h2>List of Enhancements</h2>
<table class="enc">
  <thead>
    <tr>
      <th>Enhancement</th>
      <th>Description</th>
      <th>Code Needed</th>
      <th>Third Party Source</th>
      <th>Example on Website</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Trivia Questions</td>
      <td>Added a trivia section that responds to correct and incorrect answers, with a next question button. The question and answers are stored in an array that gets fetched from javascript.</td>
      <td>For this feature, the techniques used are event handling, array manipulation, and changing the style of the HTML element in JavaScript.</td>
      <td><a href="https://www.w3schools.com/jsref/met_element_addeventlistener.asp">W3Schools - addEventListener()</a><a href="https://www.w3schools.com/jsref/met_node_appendchild.asp"><br>W3Schools - appendChild()</a></td>
      <td><a href="index.php#trivia-section">Example</a></td>
    </tr>
    <tr>
      <td>Get height of one element and apply it to another</td>
      <td>The aside in product page takes the height from the div section and applies it to itself so they are both the same height</td>
      <td>it gets the height with .offsetHeight and applies it to the aside element with .style.height</td>
      <td><a href="https://www.w3schools.com/js/js_htmldom.asp">W3Schools - DOM</a></td>
      <td><a href="product.php">Example</a></td>
    </tr>
    <tr>
      <td>Calculate and display total price in real-time</td>
      <td>The total price is display everytime the user changes the input so that it shows the total price based on the user's selections.</td>
      <td>in HTML, it calls the function with oninput. In the function, it gets the values of the movie prices, number of seats, and selected options using getElementById function, which is DOM manipulation.</td>
      <td><a href="https://www.w3schools.com/js/js_htmldom_html.asp">W3Schools - DOM HTML</a></td>
      <td><a href="enquire.php#totprice">Example</a></td>
    </tr>
    <tr>
      <td>Prefill form</td>
      <td>If user has entered the details in enquier.html before and the data is not cleared, the browser will fill in the form automatically so that the user does not have to re-enter the details.</td>
      <td>For this feature, the prefill_form() function is called when the page loads, which will get the data from sessionStorage and put it in the form.</td>
      <td><p>Lab06</p></td>
      <td><a href="enquire.php">Example</a></td>
    </tr>
  </tbody>
</table>

<table class="enc">
<thead>
  <tr>
    <th colspan="2"><h1>Code</h1></th>
  </tr>
</thead>
<tbody>
  <tr>
    <td><h1>Trivia Questions</h1></td>
    <td><img src="images/enc1.png" alt="js Enhancement 1" class="encc"></td>
  </tr>
  <tr>
    <td><h1>Get height and apply</h1></td>
    <td><img src="images/enc2.png" alt="js Enhancement 2" class="encc"></td>
  </tr>
  <tr>
    <td><h1><h1>Calculate and display total price in real-time</h1></td>
    <td><img src="images/enc3.png" alt="js Enhancement 3" class="encc"></td>
  </tr>
  <tr>
    <td><h1>Prefill form</h1></td>
    <td><img src="images/enc4.png" alt="js Enhancement 4" class="encc"></td>
  </tr>
</tbody>
</table>

    
<?php include 'includes/footer.inc'; ?>
  </body>
</html>