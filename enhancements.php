<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Enhancements</title>
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
      <th>Enhancement haha</th>
      <th>Description</th>
      <th>Code Needed</th>
      <th>Third Party Source</th>
      <th>Example on Website</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Responsive Navigation Bar</td>
      <td>A navigation bar that adjusts to different screen sizes.</td>
      <td>CSS code using media queries.</td>
      <td>N/A</td>
      <td><a href="#">Example</a></td>
    </tr>
    <tr>
      <td>Hover Effect on Images</td>
      <td>A transitional effect that enlarges and adds a border to images when hovered over. The z-index is also changed so that the images that are behind another image will move to the front, thus making it visible.</td>
      <td>CSS code using :hover selector and transition property</td>
      <td>N/A</td>
      <td><a href="index.php#mov">Example</a></td>
    </tr>
    <tr>
      <td>Fixed nav bar with see-through logo and words</td>
      <td>The nav bar is fixed while the logo and words in the nav bar is see-through, this produces an effect that
        allows the user to see behind the nav bar and watch it change when scrolling.
      </td>
      <td>position property set to fixed and mix-blend-mode property set to darken</td>
      <td><a href="https://www.w3schools.com/cssref/pr_mix-blend-mode.php">W3Schools</a>    
      <td><a href="product.php">Example</a></td>
    </tr>

  </tbody>
</table>
    
<?php include 'includes/footer.inc'; ?>
  </body>
</html>