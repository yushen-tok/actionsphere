<nav>
  <ul>
      <li class="dropdown">
      <a href="#" class="dropbtn">Manage</a>
      <div class="dropdown-content">
 <a href="manager.php">Edit Movie Details</a>
  <a href="addremovestaff.php">Add/Remove Staff</a>
          </div>
             </li>
    <li class="dropdown">
    <li class="dropdown">
      <a href="#" class="dropbtn">Movie Graph</a>
      <div class="dropdown-content">
        <a href="managergraph.php">Pie Chart</a>
        <a href="managergraph2.php">Column Chart</a>
      </div>
    </li>
    <li class="dropdown">
      <?php
      session_start();
 if (isset($_SESSION['staff_name'])) {
        $staffName = $_SESSION['staff_name'];
        echo '<a href="#" class="dropbtn">Welcome, ' . $staffName . '</a>';
      } else {
        echo '<a href="#" class="dropbtn">Welcome</a>';
      }

      ?>
      <div class="dropdown-content">
        <a href="managerlogout.php">Logout</a>
      </div>
    </li>
  </ul>
</nav>
</div>
</header>
