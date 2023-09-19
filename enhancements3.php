<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Enhancements 3</title>
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
      <th>Enhancementbooro</th>
      <th>Description</th>
      <th>Code Needed</th>
      <th>Third Party Source</th>
      <th>Example on Website</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Sort Table by clicking on Table column heading</td>
      <td>Sorts the table by it's column heading attribute by clicking on it, and reverses the order when clicked again.</td>
      <td>The column headers are replaced with links that links to a function in php ($nextSortDirection), </td>
      <td>N/A</td>
      <td><a href="manager.php">Example</a></td>
    </tr>
    <tr>
      <td>More Advanced Manager reports</td>
      <td>Added report features to the manager page such as displaying most popular product, how often it is ordered, Fulfilled orders in the past 7 days, Average Orders per day, and search for order between 2 dates.</td>
      <td>Several php functions in manager.php for each feature.</td>
      <td>N/A</td>
      <td><a href="manager.php">Example</a></td>
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
    <td><h1>Sort Table with Column Heading</h1></td>
    <td><img src="images/enc31.png" alt="js Enhancement 1" class="encc"><img src="images/enc33.png" alt="js Enhancement 3" class="encc"></td>
  </tr>
  <tr>
    <td><h1>Advanced Manager reports</h1></td>
    <td><img src="images/enc32.png" alt="js Enhancement 2" class="encc"><img src="images/enc34.png" alt="js Enhancement 4" class="encc"></td>
  </tr>
</tbody>
</table>

    
<?php include 'includes/footer.inc'; ?>
  </body>
</html>